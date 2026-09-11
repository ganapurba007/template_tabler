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
    public function index()
    {
        $user = Auth::user();
        $materials = Material::where('class_id', $user->class_id)
            ->with(['subject', 'instructor'])
            ->orderBy('order', 'asc')
            ->latest()
            ->paginate(10);

        $completedIds = MaterialProgress::where('user_id', $user->id)
            ->where('is_completed', true)
            ->pluck('material_id')
            ->toArray();

        return view('student.materials.index', compact('materials', 'completedIds'));
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
