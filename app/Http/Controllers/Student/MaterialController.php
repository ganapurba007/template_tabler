<?php

namespace App\Http\Controllers\Student;

use App\Events\DiscussionCommentSent;
use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\MaterialDiscussion;
use App\Models\MaterialProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $classId = $user->class_id;

        // Base query untuk materi kelas siswa
        $query = Material::where('class_id', $classId)
            ->with(['subject', 'instructor', 'schoolClass']);

        // Filter pencarian judul, mata pelajaran, atau guru pengampu
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('subject', function ($sq) use ($search) {
                      $sq->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('instructor', function ($iq) use ($search) {
                      $iq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filter spesifik mata pelajaran
        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->input('subject_id'));
        }

        // ID materi yang telah diselesaikan oleh siswa saat ini
        $completedIds = MaterialProgress::where('user_id', $user->id)
            ->where('is_completed', true)
            ->pluck('material_id')
            ->toArray();

        // Filter berdasarkan status penyelesaian
        if ($request->input('status') === 'completed') {
            $query->whereIn('id', $completedIds);
        } elseif ($request->input('status') === 'uncompleted') {
            $query->whereNotIn('id', $completedIds);
        }

        $materials = $query->orderBy('order', 'asc')
            ->latest()
            ->paginate(12)
            ->withQueryString();

        // Hitung statistik progres belajar materi siswa
        $allClassMaterialIds = Material::where('class_id', $classId)->pluck('id');
        $totalMaterials = $allClassMaterialIds->count();
        $completedCount = count(array_intersect($completedIds, $allClassMaterialIds->toArray()));
        $uncompletedCount = max(0, $totalMaterials - $completedCount);
        $progressPercent = $totalMaterials > 0 ? round(($completedCount / $totalMaterials) * 100) : 0;

        // Daftar mata pelajaran yang memiliki materi di kelas ini
        $subjects = \App\Models\Subject::whereIn('id', Material::where('class_id', $classId)->pluck('subject_id')->unique())
            ->orderBy('name')
            ->get();

        return view('student.materials.index', compact(
            'materials',
            'completedIds',
            'totalMaterials',
            'completedCount',
            'uncompletedCount',
            'progressPercent',
            'subjects'
        ));
    }

    public function show(Material $material)
    {
        $user = Auth::user();
        if ($user->isSiswa() && $material->class_id !== $user->class_id) {
            abort(403, 'Materi ini tidak ditujukan untuk kelas Anda.');
        }

        $material->load(['subject', 'instructor', 'discussions.user.role']);

        $isCompleted = MaterialProgress::where('user_id', $user->id)
            ->where('material_id', $material->id)
            ->where('is_completed', true)
            ->exists();

        return view('student.materials.show', compact('material', 'isCompleted'));
    }

    public function toggleComplete(Material $material)
    {
        $user = Auth::user();
        if ($user->isSiswa() && $material->class_id !== $user->class_id) {
            abort(403);
        }

        $progress = MaterialProgress::firstOrNew([
            'user_id' => $user->id,
            'material_id' => $material->id,
        ]);

        $progress->is_completed = !$progress->is_completed;
        $progress->completed_at = $progress->is_completed ? now() : null;
        $progress->save();

        return back()->with('success', $progress->is_completed ? 'Materi berhasil ditandai selesai.' : 'Status penyelesaian materi dibatalkan.');
    }

    public function storeComment(Request $request, Material $material)
    {
        $user = Auth::user();
        if ($user->isSiswa() && $material->class_id !== $user->class_id) {
            abort(403);
        }

        $request->validate([
            'comment' => ['required', 'string', 'max:1000'],
        ]);

        $discussion = MaterialDiscussion::create([
            'material_id' => $material->id,
            'user_id' => $user->id,
            'comment' => $request->comment,
        ]);

        event(new DiscussionCommentSent($discussion));

        return back()->with('success', 'Komentar diskusi berhasil dikirim.');
    }
}
