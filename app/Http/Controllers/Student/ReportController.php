<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Material;
use App\Models\MaterialProgress;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $classId = $user->class_id;

        // Material Progress
        $totalMaterials = Material::where('class_id', $classId)->count();
        $completedMaterials = MaterialProgress::where('user_id', $user->id)
            ->where('is_completed', true)
            ->count();
        $materialProgressPercent = $totalMaterials > 0 ? round(($completedMaterials / $totalMaterials) * 100, 1) : 0;

        // Assignments Report
        $submissions = AssignmentSubmission::with('assignment.subject')
            ->where('student_id', $user->id)
            ->latest()
            ->get();
        $gradedSubmissions = $submissions->whereNotNull('grade');
        $avgAssignmentScore = $gradedSubmissions->count() > 0 ? round($gradedSubmissions->avg('grade'), 1) : 0;

        // Quizzes Report
        $quizAttempts = QuizAttempt::with('quiz.subject')
            ->where('student_id', $user->id)
            ->whereNotNull('submitted_at')
            ->latest()
            ->get();
        $avgQuizScore = $quizAttempts->count() > 0 ? round($quizAttempts->avg('score'), 1) : 0;

        // Overall GPA / Combined average
        $totalEvaluations = $gradedSubmissions->count() + $quizAttempts->count();
        $sumEvaluations = $gradedSubmissions->sum('grade') + $quizAttempts->sum('score');
        $overallScore = $totalEvaluations > 0 ? round($sumEvaluations / $totalEvaluations, 1) : 0;

        return view('student.report.index', compact(
            'totalMaterials',
            'completedMaterials',
            'materialProgressPercent',
            'submissions',
            'avgAssignmentScore',
            'quizAttempts',
            'avgQuizScore',
            'overallScore'
        ));
    }
}
