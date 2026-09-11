<?php

namespace Tests\Feature\Student;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\QuizQuestion;
use App\Models\QuizQuestionOption;
use App\Models\Role;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentQuizTest extends TestCase
{
    use RefreshDatabase;

    private User $student;
    private SchoolClass $class;
    private Quiz $quiz;
    private QuizQuestion $question;
    private QuizQuestionOption $optionCorrect;
    private QuizQuestionOption $optionWrong;

    protected function setUp(): void
    {
        parent::setUp();

        $studentRole = Role::create(['name' => 'siswa', 'display_name' => 'Siswa']);
        $teacherRole = Role::create(['name' => 'guru', 'display_name' => 'Guru']);

        $this->class = SchoolClass::create([
            'name' => 'Kelas X IPA 1',
            'code' => 'X-IPA-1',
        ]);

        $this->student = User::factory()->create([
            'role_id' => $studentRole->id,
            'class_id' => $this->class->id,
        ]);

        $teacher = User::factory()->create([
            'role_id' => $teacherRole->id,
        ]);

        $subject = Subject::create([
            'code' => 'MTK01',
            'name' => 'Matematika',
        ]);

        $this->quiz = new Quiz([
            'title' => 'Kuis Harian 1',
            'duration_minutes' => 30,
            'points_per_question' => 100,
            'deadline' => now()->addDays(7),
        ]);
        $this->quiz->class_id = $this->class->id;
        $this->quiz->subject_id = $subject->id;
        $this->quiz->instructor_id = $teacher->id;
        $this->quiz->save();

        $this->question = QuizQuestion::create([
            'quiz_id' => $this->quiz->id,
            'question_text' => 'Berapakah 5 + 5?',
        ]);

        $this->optionCorrect = QuizQuestionOption::create([
            'quiz_question_id' => $this->question->id,
            'option_text' => '10',
            'is_correct' => true,
        ]);

        $this->optionWrong = QuizQuestionOption::create([
            'quiz_question_id' => $this->question->id,
            'option_text' => '12',
            'is_correct' => false,
        ]);
    }

    public function test_siswa_can_view_quizzes_for_their_class(): void
    {
        $response = $this->actingAs($this->student)->get(route('student.quizzes.index'));
        $response->assertStatus(200);
        $response->assertSee('Kuis Harian 1');
    }

    public function test_siswa_can_start_and_submit_quiz_with_scoring(): void
    {
        // Start quiz
        $startResponse = $this->actingAs($this->student)->post(route('student.quizzes.start', $this->quiz));
        $startResponse->assertRedirect(route('student.quizzes.attempt', $this->quiz));

        $this->assertDatabaseHas('quiz_attempts', [
            'student_id' => $this->student->id,
            'quiz_id' => $this->quiz->id,
        ]);

        // Submit correct answer
        $submitResponse = $this->actingAs($this->student)->post(route('student.quizzes.submit', $this->quiz), [
            'answers' => [
                $this->question->id => $this->optionCorrect->id,
            ],
        ]);

        $submitResponse->assertRedirect(route('student.quizzes.result', $this->quiz));

        $this->assertDatabaseHas('quiz_attempts', [
            'student_id' => $this->student->id,
            'quiz_id' => $this->quiz->id,
            'score' => 100,
        ]);

        $this->assertDatabaseHas('quiz_answers', [
            'quiz_question_id' => $this->question->id,
            'selected_option_id' => $this->optionCorrect->id,
        ]);
    }

    public function test_siswa_can_view_quiz_result_preview_showing_selected_and_correct_answers(): void
    {
        $attempt = QuizAttempt::create([
            'student_id' => $this->student->id,
            'quiz_id' => $this->quiz->id,
            'score' => 100,
            'started_at' => now()->subMinutes(10),
            'submitted_at' => now(),
        ]);

        \App\Models\QuizAnswer::create([
            'quiz_attempt_id' => $attempt->id,
            'quiz_question_id' => $this->question->id,
            'selected_option_id' => $this->optionCorrect->id,
        ]);

        $response = $this->actingAs($this->student)->get(route('student.quizzes.result', $this->quiz));
        $response->assertStatus(200);
        $response->assertSee('Hasil &amp; Preview Kuis', false);
        $response->assertSee('Berapakah 5 + 5?');
        $response->assertSee('Jawaban Anda');
        $response->assertSee('Jawaban Benar');
    }

    public function test_siswa_cannot_access_quiz_from_another_class(): void
    {
        $otherClass = SchoolClass::create(['name' => 'Kelas XI IPA 2', 'code' => 'XI-IPA-2']);
        $otherQuiz = new Quiz([
            'title' => 'Kuis Rahasia',
            'duration_minutes' => 30,
            'deadline' => now()->addDays(7),
        ]);
        $otherQuiz->class_id = $otherClass->id;
        $otherQuiz->subject_id = $this->quiz->subject_id;
        $otherQuiz->instructor_id = $this->quiz->instructor_id;
        $otherQuiz->save();

        $response = $this->actingAs($this->student)->get(route('student.quizzes.show', $otherQuiz));
        $response->assertStatus(403);
    }
}
