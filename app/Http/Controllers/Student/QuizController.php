<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\QuizAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $quizzes = Quiz::with(['subject', 'instructor', 'questions', 'attempts' => function ($q) use ($user) {
            $q->where('student_id', $user->id);
        }])
        ->where('class_id', $user->class_id)
        ->latest()
        ->paginate(10);

        return view('student.quizzes.index', compact('quizzes'));
    }

    public function show(Quiz $quiz)
    {
        $user = Auth::user();
        if ($quiz->class_id !== $user->class_id) {
            abort(403, 'Anda tidak memiliki akses ke kuis ini.');
        }

        $quiz->load(['subject', 'instructor', 'questions']);
        $attempt = QuizAttempt::where('quiz_id', $quiz->id)
            ->where('student_id', $user->id)
            ->first();

        return view('student.quizzes.show', compact('quiz', 'attempt'));
    }

    public function start(Quiz $quiz)
    {
        $user = Auth::user();
        if ($quiz->class_id !== $user->class_id) {
            abort(403, 'Anda tidak memiliki akses ke kuis ini.');
        }

        $attempt = QuizAttempt::where('quiz_id', $quiz->id)
            ->where('student_id', $user->id)
            ->first();

        if ($attempt && $attempt->submitted_at) {
            return redirect()->route('student.quizzes.result', $quiz);
        }

        if (!$attempt) {
            $attempt = QuizAttempt::create([
                'student_id' => $user->id,
                'quiz_id' => $quiz->id,
                'started_at' => now(),
            ]);
        }

        return redirect()->route('student.quizzes.attempt', $quiz);
    }

    public function attempt(Quiz $quiz)
    {
        $user = Auth::user();
        if ($quiz->class_id !== $user->class_id) {
            abort(403, 'Anda tidak memiliki akses ke kuis ini.');
        }

        $attempt = QuizAttempt::where('quiz_id', $quiz->id)
            ->where('student_id', $user->id)
            ->first();

        if (!$attempt) {
            return redirect()->route('student.quizzes.show', $quiz);
        }

        if ($attempt->submitted_at) {
            return redirect()->route('student.quizzes.result', $quiz);
        }

        $quiz->load(['questions.options']);

        // Calculate remaining seconds
        $durationSeconds = ($quiz->duration_minutes ?? 30) * 60;
        $elapsedSeconds = now()->diffInSeconds($attempt->started_at);
        $remainingSeconds = max(0, $durationSeconds - $elapsedSeconds);

        return view('student.quizzes.attempt', compact('quiz', 'attempt', 'remainingSeconds'));
    }

    public function submit(Request $request, Quiz $quiz)
    {
        $user = Auth::user();
        if ($quiz->class_id !== $user->class_id) {
            abort(403, 'Anda tidak memiliki akses ke kuis ini.');
        }

        $attempt = QuizAttempt::where('quiz_id', $quiz->id)
            ->where('student_id', $user->id)
            ->first();

        if (!$attempt) {
            return redirect()->route('student.quizzes.show', $quiz);
        }

        if ($attempt->submitted_at) {
            return redirect()->route('student.quizzes.result', $quiz);
        }

        $answers = $request->input('answers', []);
        $questions = $quiz->questions()->with('options')->get();

        $correctCount = 0;
        $totalQuestions = $questions->count();

        foreach ($questions as $question) {
            $selectedOptionId = isset($answers[$question->id]) ? (int)$answers[$question->id] : null;

            QuizAnswer::updateOrCreate(
                [
                    'quiz_attempt_id' => $attempt->id,
                    'quiz_question_id' => $question->id,
                ],
                [
                    'selected_option_id' => $selectedOptionId,
                ]
            );

            if ($selectedOptionId) {
                $correctOption = $question->options->firstWhere('is_correct', true);
                if ($correctOption && $correctOption->id === $selectedOptionId) {
                    $correctCount++;
                }
            }
        }

        $score = $totalQuestions > 0 ? round(($correctCount / $totalQuestions) * 100, 2) : 0;

        $attempt->update([
            'score' => $score,
            'submitted_at' => now(),
        ]);

        return redirect()->route('student.quizzes.result', $quiz)->with('success', 'Kuis berhasil dikumpulkan!');
    }

    public function result(Quiz $quiz)
    {
        $user = Auth::user();
        if ($quiz->class_id !== $user->class_id) {
            abort(403, 'Anda tidak memiliki akses ke kuis ini.');
        }

        $attempt = QuizAttempt::with(['answers.selectedOption', 'answers.quizQuestion.options'])
            ->where('quiz_id', $quiz->id)
            ->where('student_id', $user->id)
            ->firstOrFail();

        if (!$attempt->submitted_at) {
            return redirect()->route('student.quizzes.attempt', $quiz);
        }

        $quiz->load(['questions.options']);
        $answersMap = $attempt->answers->keyBy('quiz_question_id');

        return view('student.quizzes.result', compact('quiz', 'attempt', 'answersMap'));
    }
}
