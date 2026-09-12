<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            if ($user->isSiswa()) {
                Notification::firstOrCreate(
                    [
                        'user_id' => $user->id,
                        'title' => 'Materi Pembelajaran Baru',
                    ],
                    [
                        'type' => 'new_material',
                        'message' => 'Guru Dani telah menambahkan materi "Fisika Kuantum & Relativitas Khusus".',
                        'related_url' => route('student.materials.index'),
                        'is_read' => false,
                        'created_at' => now()->subMinutes(15),
                    ]
                );

                Notification::firstOrCreate(
                    [
                        'user_id' => $user->id,
                        'title' => 'Tugas Baru Diterbitkan',
                    ],
                    [
                        'type' => 'new_assignment',
                        'message' => 'Tugas baru "Latihan Soal Hukum Newton" telah tersedia dengan batas waktu 14 Sept.',
                        'related_url' => route('student.assignments.index'),
                        'is_read' => false,
                        'created_at' => now()->subHours(2),
                    ]
                );

                Notification::firstOrCreate(
                    [
                        'user_id' => $user->id,
                        'title' => 'Kuis Online Siap Dikerjakan',
                    ],
                    [
                        'type' => 'new_quiz',
                        'message' => 'Kuis "Evaluasi Bab 2 Matematika Lanjut" telah dibuka. Segera kerjakan kuis Anda.',
                        'related_url' => route('student.quizzes.index'),
                        'is_read' => true,
                        'read_at' => now()->subDay(),
                        'created_at' => now()->subDay(),
                    ]
                );
            } else {
                Notification::firstOrCreate(
                    [
                        'user_id' => $user->id,
                        'title' => 'Jawaban Tugas Baru Dikirim',
                    ],
                    [
                        'type' => 'new_assignment',
                        'message' => 'Siswa Budi Santoso telah mengumpulkan tugas "Latihan Hukum Newton".',
                        'related_url' => route('admin.submissions.index'),
                        'is_read' => false,
                        'created_at' => now()->subMinutes(30),
                    ]
                );

                Notification::firstOrCreate(
                    [
                        'user_id' => $user->id,
                        'title' => 'Komentar Diskusi Kelas',
                    ],
                    [
                        'type' => 'comment',
                        'message' => 'Siti Rahma bertanya pada diskusi materi "Fisika Kuantum".',
                        'related_url' => route('admin.materials.index'),
                        'is_read' => false,
                        'created_at' => now()->subHours(3),
                    ]
                );
            }
        }
    }
}
