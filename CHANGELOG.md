# CHANGELOG — LMS Dani

> Catat setiap perubahan kode di sini selama implementasi.

## [Fase 3] Pusher & Echo Setup — 2026-09-11

### Ditambahkan
- Paket `pusher/pusher-php-server` (^7.3) dan konfigurasi `config/broadcasting.php`.
- Definisi channel otoritas privat di `routes/channels.php`: `class.{classId}` (materi & tugas) dan `material.{materialId}` (diskusi).
- Event Classes realtime yang mengimplementasikan `ShouldBroadcast`:
  - `DiscussionCommentSent` (`app/Events/DiscussionCommentSent.php`) pada channel `material.{id}`.
  - `MaterialCreated` (`app/Events/MaterialCreated.php`) pada channel `class.{id}`.
  - `AssignmentCreated` (`app/Events/AssignmentCreated.php`) pada channel `class.{id}`.
- Feature Test `tests/Feature/PusherBroadcastTest.php` untuk memverifikasi pemanggilan event broadcasting realtime.

## [Fase 2] Auth & Middleware — 2026-09-11

### Ditambahkan
- Middleware `EnsureUserHasRole` (`app/Http/Middleware/EnsureUserHasRole.php`) yang meregistrasi alias `'role'` di `bootstrap/app.php`. Meredirect siswa yang mencoba akses `/admin/*` ke `/dashboard` (bukan 403) dan guest ke `/login`.
- View Dashboard Admin/Guru (`resources/views/admin/dashboard.blade.php`).
- Feature Test `tests/Feature/AuthMiddlewareTest.php` untuk menguji pendaftaran siswa dengan kelas, kegagalan tanpa kelas, redirect login per role, proteksi middleware `/admin/*`, dan logout.

### Diubah
- `RegisteredUserController.php`: Mengirim `$classes` ke view register, memvalidasi `class_id`, dan otomatis meng-assign role `siswa`.
- `resources/views/auth/register.blade.php`: Menambahkan dropdown pilihan kelas (`<select name="class_id">`).
- `AuthenticatedSessionController.php`: Redirect Guru ke `/admin/dashboard` dan Siswa ke `/dashboard`.
- `routes/web.php`: Menambahkan route `/dashboard` dan group `/admin/dashboard` dengan middleware `['auth', 'role:guru']`.
- `resources/views/layouts/navigation.blade.php`: Menyesuaikan link navigasi dan dropdown user (Profil Saya, Logout) berdasarkan role.

## [Fase 1] Foundation — 2026-09-11

### Ditambahkan
- Migration untuk 17 tabel & pivot: `roles`, `classes`, `subjects`, `subject_user`, `materials`, `material_progress`, `material_discussions`, `assignments`, `assignment_submissions`, `question_bank`, `question_bank_options`, `quizzes`, `quiz_questions`, `quiz_question_options`, `quiz_attempts`, `quiz_answers`.
- Eloquent Models beserta relasinya: `Role`, `SchoolClass` (tabel `classes`), `Subject`, `Material`, `MaterialProgress`, `MaterialDiscussion`, `Assignment`, `AssignmentSubmission`, `QuestionBank`, `QuestionBankOption`, `Quiz`, `QuizQuestion`, `QuizQuestionOption`, `QuizAttempt`, `QuizAnswer`.
- Seeders: `RoleSeeder` (`guru`, `siswa`), `SchoolClassSeeder` (3 kelas), `SubjectSeeder` (3 mata pelajaran), `UserSeeder` (1 Guru `guru@lms.com`, 3 Siswa), dan `DatabaseSeeder`.
- Feature Test `tests/Feature/FoundationTest.php` untuk memverifikasi keutuhan tabel, seeder, unique constraints, dan relasi Eloquent.

### Diubah
- Model `User.php`: Tambah `$fillable` (`nip`, `role_id`, `class_id`), method helper `isGuru()` / `isSiswa()`, serta relasi ke Role, SchoolClass, Subject, Material, Assignment, Quiz, QuestionBank, dan Submissions/Attempts.
