<?php

namespace Tests\Feature;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Material;
use App\Models\MaterialProgress;
use App\Models\Role;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class FoundationTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_tables_exist_in_database(): void
    {
        $tables = [
            'roles',
            'classes',
            'subjects',
            'users',
            'subject_user',
            'materials',
            'material_progress',
            'material_discussions',
            'assignments',
            'assignment_submissions',
            'question_bank',
            'question_bank_options',
            'quizzes',
            'quiz_questions',
            'quiz_question_options',
            'quiz_attempts',
            'quiz_answers',
        ];

        foreach ($tables as $table) {
            $this->assertTrue(Schema::hasTable($table), "Table {$table} does not exist.");
        }
    }

    public function test_database_seeder_populates_required_foundation_data(): void
    {
        $this->seed();

        $this->assertDatabaseHas('roles', ['name' => 'guru']);
        $this->assertDatabaseHas('roles', ['name' => 'siswa']);

        $this->assertDatabaseCount('classes', 3);
        $this->assertDatabaseCount('subjects', 4);

        $guru = User::where('email', 'guru@lms.com')->first();
        $this->assertNotNull($guru);
        $this->assertTrue($guru->isGuru());
        $this->assertEquals('198501012010011001', $guru->nip);

        $this->assertCount(4, $guru->subjects);

        $siswaCount = User::whereHas('role', fn ($q) => $q->where('name', 'siswa'))->count();
        $this->assertEquals(3, $siswaCount);
    }

    public function test_unique_constraints_are_enforced(): void
    {
        $this->seed();

        $guru = User::where('email', 'guru@lms.com')->first();

        // Unique NIP test
        $this->expectException(\Illuminate\Database\QueryException::class);
        User::create([
            'name' => 'Guru Duplicate NIP',
            'email' => 'guru2@lms.com',
            'password' => 'password',
            'nip' => '198501012010011001',
            'role_id' => $guru->role_id,
        ]);
    }

    public function test_model_relationships_work_correctly(): void
    {
        $this->seed();

        $guru = User::where('email', 'guru@lms.com')->first();
        $siswa = User::where('email', 'siswa1@lms.com')->first();
        $class = SchoolClass::first();
        $subject = Subject::first();

        // Test Material relationship (mass-assignment protected fields set explicitly)
        $material = new Material([
            'title' => 'Pengenalan Laravel',
            'content_type' => 'text',
            'content' => 'Materi pendahuluan Laravel.',
        ]);
        $material->class_id = $class->id;
        $material->subject_id = $subject->id;
        $material->instructor_id = $guru->id;
        $material->save();

        $this->assertEquals($class->id, $material->schoolClass->id);
        $this->assertEquals($subject->id, $material->subject->id);
        $this->assertEquals($guru->id, $material->instructor->id);

        // Test MaterialProgress relationship
        $progress = new MaterialProgress([
            'is_completed' => true,
            'completed_at' => now(),
        ]);
        $progress->user_id = $siswa->id;
        $progress->material_id = $material->id;
        $progress->save();

        $this->assertEquals($siswa->id, $progress->user->id);
        $this->assertEquals($material->id, $progress->material->id);

        // Test Assignment & Submission
        $assignment = new Assignment([
            'title' => 'Tugas 1',
            'description' => 'Kerjakan soal berikut.',
            'due_date' => now()->addDays(7),
        ]);
        $assignment->class_id = $class->id;
        $assignment->subject_id = $subject->id;
        $assignment->instructor_id = $guru->id;
        $assignment->save();

        $submission = new AssignmentSubmission([
            'answer_text' => 'Ini jawaban tugas.',
            'submitted_at' => now(),
        ]);
        $submission->assignment_id = $assignment->id;
        $submission->student_id = $siswa->id;
        $submission->save();

        $this->assertEquals($assignment->id, $submission->assignment->id);
        $this->assertEquals($siswa->id, $submission->student->id);
    }
}
