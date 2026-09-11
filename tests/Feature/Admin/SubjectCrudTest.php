<?php

namespace Tests\Feature\Admin;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubjectCrudTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_guru_can_view_subject_list(): void
    {
        $guru = User::where('email', 'guru@lms.com')->first();

        $response = $this->actingAs($guru)->get('/admin/subjects');

        $response->assertStatus(200);
        $response->assertSee('Matematika');
        $response->assertSee('Fisika');
    }

    public function test_guru_can_create_new_subject_with_instructors(): void
    {
        $guru = User::where('email', 'guru@lms.com')->first();

        $response = $this->actingAs($guru)->post('/admin/subjects', [
            'name' => 'Biologi',
            'instructor_ids' => [$guru->id],
        ]);

        $response->assertRedirect('/admin/subjects');
        $this->assertDatabaseHas('subjects', ['name' => 'Biologi']);

        $subject = Subject::where('name', 'Biologi')->first();
        $this->assertDatabaseHas('subject_user', [
            'subject_id' => $subject->id,
            'user_id' => $guru->id,
        ]);
    }

    public function test_guru_can_update_subject_and_sync_instructors(): void
    {
        $guru = User::where('email', 'guru@lms.com')->first();
        $subject = Subject::where('name', 'Matematika')->first();

        $response = $this->actingAs($guru)->put("/admin/subjects/{$subject->id}", [
            'name' => 'Matematika Lanjut',
            'instructor_ids' => [$guru->id],
        ]);

        $response->assertRedirect('/admin/subjects');
        $this->assertDatabaseHas('subjects', [
            'id' => $subject->id,
            'name' => 'Matematika Lanjut',
        ]);
    }

    public function test_guru_can_delete_subject(): void
    {
        $guru = User::where('email', 'guru@lms.com')->first();
        $subject = Subject::create(['name' => 'Kimia']);

        $response = $this->actingAs($guru)->delete("/admin/subjects/{$subject->id}");

        $response->assertRedirect('/admin/subjects');
        $this->assertDatabaseMissing('subjects', ['name' => 'Kimia']);
    }

    public function test_siswa_cannot_access_subject_crud(): void
    {
        $siswa = User::where('email', 'siswa1@lms.com')->first();

        $response = $this->actingAs($siswa)->get('/admin/subjects');

        $response->assertRedirect('/dashboard');
    }
}
