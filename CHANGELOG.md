# CHANGELOG — LMS Dani

> Catat setiap perubahan kode di sini selama implementasi.

## [Fase 7] Master — Kelas CRUD — 2026-09-11

### Ditambahkan
- `SchoolClassController` (`app/Http/Controllers/Admin/SchoolClassController.php`) untuk pengelolaan CRUD Kelas sekolah.
- Blade Views Tabler UI di `resources/views/admin/classes/`: `index.blade.php`, `create.blade.php`, `edit.blade.php`.
- Feature Test `tests/Feature/Admin/SchoolClassCrudTest.php` untuk memverifikasi daftar kelas, penambahan & pengeditan kelas, validasi keunikan nama kelas, penghapusan, dan pembatasan akses siswa.

### Diubah
- `routes/web.php`: Menambahkan rute resource `classes` di dalam grup `/admin`.

## [Fase 6] Master — Mata Pelajaran CRUD + Guru Pengampu — 2026-09-11

### Ditambahkan
- `SubjectController` (`app/Http/Controllers/Admin/SubjectController.php`) untuk pengelolaan CRUD Mata Pelajaran dan penetapan guru pengampu (many-to-many via pivot `subject_user`).
- Blade Views Tabler UI di `resources/views/admin/subjects/`: `index.blade.php`, `create.blade.php`, `edit.blade.php`.
- Feature Test `tests/Feature/Admin/SubjectCrudTest.php` untuk memverifikasi daftar mata pelajaran, pembuatan & pengeditan mata pelajaran, sinkronisasi pivot `subject_user`, dan pembatasan akses siswa.

### Diubah
- `routes/web.php`: Menambahkan rute resource `subjects` di dalam grup `/admin`.

## [Fase 5] Master — User (Daftar & Assign Role) — 2026-09-11

### Ditambahkan
- `UserController` (`app/Http/Controllers/Admin/UserController.php`) untuk melihat daftar seluruh pengguna, pencarian kata kunci (Nama, Email, NIP), filter berdasarkan role, serta pengalokasian role, kelas, dan NIP.
- Blade Views Tabler UI di `resources/views/admin/users/`: `index.blade.php` dan `edit.blade.php`.
- Feature Test `tests/Feature/Admin/UserCrudTest.php` untuk memverifikasi pencarian, filter role, pengalokasian role/kelas, validasi NIP unik, dan pembatasan akses siswa.

### Diubah
- `routes/web.php`: Menambahkan rute resource `users` (`index`, `edit`, `update`) di dalam grup `/admin`.

## [Fase 4] Master — Role CRUD — 2026-09-11

### Ditambahkan
- `RoleController` (`app/Http/Controllers/Admin/RoleController.php`) dengan fungsi CRUD lengkap untuk pengelolaan role pengguna.
- Blade Views Tabler UI di `resources/views/admin/roles/`: `index.blade.php`, `create.blade.php`, `edit.blade.php`.
- Feature Test `tests/Feature/Admin/RoleCrudTest.php` untuk menguji daftar role, penambahan role unik, pengeditan, proteksi role sistem (`guru`/`siswa`), dan pembatasan akses siswa.

### Diubah
- `routes/web.php`: Menambahkan rute resource `roles` di dalam grup `/admin`.

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
