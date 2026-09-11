<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentSubmissionController extends Controller
{
    public function index(Request $request)
    {
        $query = AssignmentSubmission::with(['assignment.subject', 'assignment.schoolClass', 'student']);

        if ($request->has('assignment_id') && $request->assignment_id) {
            $query->where('assignment_id', $request->assignment_id);
        }

        $submissions = $query->latest('submitted_at')->paginate(10);
        $assignments = Assignment::with(['subject', 'schoolClass'])->latest()->get();

        return view('admin.submissions.index', compact('submissions', 'assignments'));
    }

    public function show(AssignmentSubmission $submission)
    {
        $submission->load(['assignment.subject', 'assignment.schoolClass', 'student']);

        return view('admin.submissions.show', compact('submission'));
    }

    public function grade(Request $request, AssignmentSubmission $submission)
    {
        $request->validate([
            'grade' => ['required', 'numeric', 'min:0', 'max:100'],
            'feedback' => ['nullable', 'string'],
        ]);

        $user = Auth::user();
        if ($user->subjects()->exists() && !$user->subjects()->where('subjects.id', $submission->assignment->subject_id)->exists()) {
            return back()->withErrors(['grade' => 'Anda tidak berhak menilai tugas untuk mata pelajaran ini.'])->withInput();
        }

        $submission->grade = $request->grade;
        $submission->feedback = $request->feedback;
        $submission->graded_at = now();
        $submission->save();

        return redirect()->route('admin.submissions.index')
            ->with('success', 'Nilai dan umpan balik tugas berhasil disimpan.');
    }
}
