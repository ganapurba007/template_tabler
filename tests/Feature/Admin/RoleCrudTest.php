<?php

namespace Tests\Feature\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleCrudTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_guru_can_view_role_list(): void
    {
        $guru = User::where('email', 'guru@lms.com')->first();

        $response = $this->actingAs($guru)->get('/admin/roles');

        $response->assertStatus(200);
        $response->assertSee('Guru');
        $response->assertSee('Siswa');
    }

    public function test_guru_can_create_new_role(): void
    {
        $guru = User::where('email', 'guru@lms.com')->first();

        $response = $this->actingAs($guru)->post('/admin/roles', [
            'name' => 'Pengawas',
        ]);

        $response->assertRedirect('/admin/roles');
        $this->assertDatabaseHas('roles', ['name' => 'pengawas']);
    }

    public function test_role_name_must_be_unique(): void
    {
        $guru = User::where('email', 'guru@lms.com')->first();

        $response = $this->actingAs($guru)->post('/admin/roles', [
            'name' => 'guru',
        ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_guru_can_update_role(): void
    {
        $guru = User::where('email', 'guru@lms.com')->first();
        $role = Role::create(['name' => 'staf']);

        $response = $this->actingAs($guru)->put("/admin/roles/{$role->id}", [
            'name' => 'staf pengajar',
        ]);

        $response->assertRedirect('/admin/roles');
        $this->assertDatabaseHas('roles', ['id' => $role->id, 'name' => 'staf pengajar']);
    }

    public function test_system_roles_cannot_be_deleted(): void
    {
        $guru = User::where('email', 'guru@lms.com')->first();
        $siswaRole = Role::where('name', 'siswa')->first();

        $response = $this->actingAs($guru)->delete("/admin/roles/{$siswaRole->id}");

        $response->assertSessionHas('error');
        $this->assertDatabaseHas('roles', ['name' => 'siswa']);
    }

    public function test_custom_role_can_be_deleted(): void
    {
        $guru = User::where('email', 'guru@lms.com')->first();
        $role = Role::create(['name' => 'temporary']);

        $response = $this->actingAs($guru)->delete("/admin/roles/{$role->id}");

        $response->assertRedirect('/admin/roles');
        $this->assertDatabaseMissing('roles', ['name' => 'temporary']);
    }

    public function test_siswa_cannot_access_role_crud(): void
    {
        $siswa = User::where('email', 'siswa1@lms.com')->first();

        $response = $this->actingAs($siswa)->get('/admin/roles');

        $response->assertRedirect('/dashboard');
    }
}
