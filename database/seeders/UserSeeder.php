<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $guruRole = Role::where('name', 'guru')->firstOrFail();
        $siswaRole = Role::where('name', 'siswa')->firstOrFail();

        $kelas1 = SchoolClass::where('name', 'X-IPA-1')->firstOrFail();
        $kelas2 = SchoolClass::where('name', 'X-IPA-2')->firstOrFail();

        // Akun Guru Default
        $guru = User::firstOrCreate(
            ['email' => 'guru@lms.com'],
            [
                'name' => 'Guru Dani',
                'nip' => '198501012010011001',
                'password' => Hash::make('password'),
                'role_id' => $guruRole->id,
                'class_id' => null,
            ]
        );

        // Akun Guru Test (Sesuai Permintaan User)
        $guruTest = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Guru Test',
                'nip' => '198501012010011002',
                'password' => Hash::make('password'),
                'role_id' => $guruRole->id,
                'class_id' => null,
            ]
        );

        // Assign Guru ke semua mata pelajaran
        $subjects = Subject::all();
        $guru->subjects()->sync($subjects->pluck('id'));
        $guruTest->subjects()->sync($subjects->pluck('id'));

        // Akun Siswa Dummy
        User::firstOrCreate(
            ['email' => 'siswa1@lms.com'],
            [
                'name' => 'Budi Santoso',
                'password' => Hash::make('password'),
                'role_id' => $siswaRole->id,
                'class_id' => $kelas1->id,
            ]
        );

        User::firstOrCreate(
            ['email' => 'siswa2@lms.com'],
            [
                'name' => 'Siti Rahma',
                'password' => Hash::make('password'),
                'role_id' => $siswaRole->id,
                'class_id' => $kelas1->id,
            ]
        );

        User::firstOrCreate(
            ['email' => 'siswa3@lms.com'],
            [
                'name' => 'Ahmad Fauzi',
                'password' => Hash::make('password'),
                'role_id' => $siswaRole->id,
                'class_id' => $kelas2->id,
            ]
        );
    }
}
