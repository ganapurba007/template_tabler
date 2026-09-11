<?php

namespace Tests\Feature\Admin;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Role;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AssignmentSubmissionGradeTest extends TestCase
{
    use RefreshDatabase;

    protected User $guru;
    protected User $siswa;
    protected SchoolClass $class;
    protected Subject $subject;
    protected Subject $unassignedSubject;
    protected Assignment $assignment;
    protected AssignmentSubmission $submission;

    protected function setUp(): void
    {
        parent::setUp();

        $roleGuru = Role::create(['name' => 'guru']);
        $roleSiswa = Role::create(['name' => 'siswa']);

        $this->class = SchoolClass::create(['name' => 'Kelas X IPA 3']);

        $this->guru = User::factory()->create([
            'role_id' => $roleGuru->id,
            'nip' => '198301012005011004',
        ]);

        $this->siswa = User::factory()->create([
            'role_id' => $roleSiswa->id,
            'class_id' => $this->class->id,
        ]);

        $this->subject = Subject::create([
            'name' => 'Bahasa Indonesia',
            'code' => 'IND-10',
        ]);

        $this->unassignedSubject = Subject::create([
            'name' => 'Bahasa Inggris',
            'code' => 'ING-10',
        ]);

        $this->guru->subjects()->attach($this->subject->id);

        $this->assignment = new Assignment();
        $this->assignment->title = 'Tugas Resensi Buku';
        $this->assignment->description = 'Tulis resensi buku 500 kata';
        $this->assignment->due_date = now()->addDays(5);
        $this->assignment->subject_id = $this->subject->id;
        $this->assignment->class_id = $this->class->id;
        $this->assignment->instructor_id = $this->guru->id;
        $this->assignment->save();

        $this->submission = AssignmentSubmission::create([
            'assignment_id' => $this->assignment->id,
            'student_id' => $this->siswa->id,
            'answer_text' => 'Ini jawaban resensi buku saya...',
            'submitted_at' => now(),
        ]);
    }

    public function test_guru_can_view_submission_list(): void
    {
        $response = $this->actingAs($this->guru)->get(route('admin.submissions.index'));
        $response->assertStatus(200);
        $response->assertSee('Koreksi & Penilaian Tugas Siswa');
    }

    public function test_guru_can_grade_submission(): void
    {
        $response = $this->actingAs($this->guru)->post(route('admin.submissions.grade', $this->submission), [
            'grade' => 88.5,
            'feedback' => 'Analisis resensi sangat tajam.',
        ]);

        $response->assertRedirect(route('admin.submissions.index'));
        $this->assertDatabaseHas('assignment_submissions', [
            'id' => $this->submission->id,
            'grade' => 88.5,
            'feedback' => 'Analisis resensi sangat tajam.',
        ]);

        $this->submission->refresh();
        $this->assertNotNull($this->submission->graded_at);
    }

    public function test_guru_cannot_grade_submission_for_unassigned_subject(): void
    {
        $unassignedAssignment = new Assignment();
        $unassignedAssignment->title = 'Tugas Essay English';
        $unassignedAssignment->description = 'Read chapter 1 and write essay';
        $unassignedAssignment->due_date = now()->addDays(5);
        $unassignedAssignment->subject_id = $this->unassignedSubject->id;
        $unassignedAssignment->class_id = $this->class->id;
        $unassignedAssignment->instructor_id = $this->guru->id;
        $unassignedAssignment->save();

        $unassignedSubmission = AssignmentSubmission::create([
            'assignment_id' => $unassignedAssignment->id,
            'student_id' => $this->siswa->id,
            'answer_text' => 'My English Essay...',
            'submitted_at' => now(),
        ]);

        $response = $this->actingAs($this->guru)->post(route('admin.submissions.grade', $unassignedSubmission), [
            'grade' => 90,
            'feedback' => 'Good job',
        ]);

        $response->assertSessionHasErrors(['grade']);
        $this->assertDatabaseHas('assignment_submissions', [
            'id' => $unassignedSubmission->id,
            'grade' => null,
        ]);
    }

    public function test_siswa_cannot_access_submission_grading(): void
    {
        $response = $this->actingAs($this->siswa)->get(route('admin.submissions.index'));
        $response->assertRedirect(route('dashboard'));
    }
}
