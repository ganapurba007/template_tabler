<?php

namespace Tests\Feature\Student;

use App\Models\Role;
use App\Models\SchoolClass;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentReportTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_can_view_self_report(): void
    {
        $role = Role::create(['name' => 'siswa', 'display_name' => 'Siswa']);
        $class = SchoolClass::create(['name' => 'Kelas X', 'code' => 'X-1']);
        $student = User::factory()->create([
            'role_id' => $role->id,
            'class_id' => $class->id,
        ]);

        $response = $this->actingAs($student)->get(route('student.report.index'));
        $response->assertStatus(200);
        $response->assertSee('Laporan Progres Belajar Diri');
        $response->assertSee('Progres Materi');
        $response->assertSee('Rata-Rata Tugas');
        $response->assertSee('Rata-Rata Kuis');
    }
}
