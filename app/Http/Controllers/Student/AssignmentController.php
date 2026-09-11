<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $assignments = Assignment::where('class_id', $user->class_id)
            ->with(['subject', 'instructor'])
            ->orderBy('due_date', 'asc')
            ->paginate(10);

        $submissions = AssignmentSubmission::where('student_id', $user->id)
            ->get()
            ->keyBy('assignment_id');

        return view('student.assignments.index', compact('assignments', 'submissions'));
    }

    public function show(Assignment $assignment)
    {
        $user = Auth::user();
        if ($user->isSiswa() && $assignment->class_id !== $user->class_id) {
            abort(403, 'Tugas ini tidak ditujukan untuk kelas Anda.');
        }

        $assignment->load(['subject', 'instructor']);

        $submission = AssignmentSubmission::where('student_id', $user->id)
            ->where('assignment_id', $assignment->id)
            ->first();

        return view('student.assignments.show', compact('assignment', 'submission'));
    }

    public function submit(Request $request, Assignment $assignment)
    {
        $user = Auth::user();
        if ($user->isSiswa() && $assignment->class_id !== $user->class_id) {
            abort(403);
        }

        $request->validate([
            'answer_text' => ['required', 'string', 'max:5000'],
        ]);

        $submission = AssignmentSubmission::firstOrNew([
            'assignment_id' => $assignment->id,
            'student_id' => $user->id,
        ]);

        $submission->answer_text = $request->answer_text;
        $submission->submitted_at = now();
        $submission->save();

        return redirect()->route('student.assignments.show', $assignment)
            ->with('success', 'Tugas Anda berhasil dikumpulkan.');
    }
}
