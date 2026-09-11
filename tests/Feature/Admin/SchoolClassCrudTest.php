<?php

namespace Tests\Feature\Admin;

use App\Models\SchoolClass;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SchoolClassCrudTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_guru_can_view_class_list(): void
    {
        $guru = User::where('email', 'guru@lms.com')->first();

        $response = $this->actingAs($guru)->get('/admin/classes');

        $response->assertStatus(200);
        $response->assertSee('X-IPA-1');
        $response->assertSee('X-IPA-2');
    }

    public function test_guru_can_create_new_class(): void
    {
        $guru = User::where('email', 'guru@lms.com')->first();

        $response = $this->actingAs($guru)->post('/admin/classes', [
            'name' => 'XI-IPA-2',
        ]);

        $response->assertRedirect('/admin/classes');
        $this->assertDatabaseHas('classes', ['name' => 'XI-IPA-2']);
    }

    public function test_class_name_must_be_unique(): void
    {
        $guru = User::where('email', 'guru@lms.com')->first();

        $response = $this->actingAs($guru)->post('/admin/classes', [
            'name' => 'X-IPA-1',
        ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_guru_can_update_class(): void
    {
        $guru = User::where('email', 'guru@lms.com')->first();
        $class = SchoolClass::where('name', 'X-IPA-1')->first();

        $response = $this->actingAs($guru)->put("/admin/classes/{$class->id}", [
            'name' => 'X-MIPA-1',
        ]);

        $response->assertRedirect('/admin/classes');
        $this->assertDatabaseHas('classes', [
            'id' => $class->id,
            'name' => 'X-MIPA-1',
        ]);
    }

    public function test_guru_can_delete_class(): void
    {
        $guru = User::where('email', 'guru@lms.com')->first();
        $class = SchoolClass::create(['name' => 'XII-IPA-1']);

        $response = $this->actingAs($guru)->delete("/admin/classes/{$class->id}");

        $response->assertRedirect('/admin/classes');
        $this->assertDatabaseMissing('classes', ['name' => 'XII-IPA-1']);
    }

    public function test_siswa_cannot_access_class_crud(): void
    {
        $siswa = User::where('email', 'siswa1@lms.com')->first();

        $response = $this->actingAs($siswa)->get('/admin/classes');

        $response->assertRedirect('/dashboard');
    }
}
