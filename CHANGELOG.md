# CHANGELOG — LMS Dani

> Catat setiap perubahan kode di sini selama implementasi.

## [Fase 17] Student Kuis (Timer Vanilla JS + Preview/Review Jawaban) — 2026-09-11

### Ditambahkan
- `Student\QuizController` (`app/Http/Controllers/Student/QuizController.php`) untuk pengelolaan pengerjaan kuis online siswa (`index`, `show`, `start`, `attempt`, `submit`, `result`).
- Interactive Vanilla JS Countdown Timer yang menghitung mundur sisa waktu secara otomatis dan melakukan auto-submit jika durasi kuis habis.
- Perhitungan skor kuis berbasis persentase jawaban benar dan pencatatan riwayat `QuizAttempt` & `QuizAnswer`.
- Penayangan Preview & Review Jawaban (`resources/views/student/quizzes/result.blade.php`) sesuai User Request: menampilkan skor, daftar seluruh soal, jawaban yang dipilih siswa ("Jawaban Anda"), dan jawaban yang benar ("Jawaban Benar").
- Blade Views UI di `resources/views/student/quizzes/`: `index.blade.php`, `show.blade.php`, `attempt.blade.php`, dan `result.blade.php`.
- Feature Test `tests/Feature/Student/StudentQuizTest.php` untuk memverifikasi pengerjaan kuis, pengolesan skor otomatis, preview review jawaban, dan proteksi otorisasi antar-kelas.

### Diubah
- `routes/web.php`: Menambahkan rute `student.quizzes.index`, `show`, `start`, `attempt`, `submit`, dan `result`.

## [Fase 16] Student Tugas — 2026-09-11

### Ditambahkan
- `Student\AssignmentController` (`app/Http/Controllers/Student/AssignmentController.php`) untuk menyajikan daftar tugas kelas siswa (`index`), petunjuk pengerjaan (`show`), serta pengumpulan/pembaharuan jawaban tugas (`submit`).
- Penayangan status pengumpulan (Belum Dikumpulkan / Sudah Dikumpulkan / Sudah Dinilai Guru), nilai (`grade`), dan umpan balik (`feedback`).
- Blade Views Tabler UI di `resources/views/student/assignments/`: `index.blade.php` dan `show.blade.php`.
- Feature Test `tests/Feature/Student/StudentAssignmentTest.php` untuk memverifikasi isolasi tugas kelas siswa, pengumpulan jawaban tugas, dan proteksi otorisasi antar-kelas.

### Diubah
- `routes/web.php`: Menambahkan rute `student.assignments.index`, `show`, dan `submit`.

## [Fase 15] Student Materi & Diskusi Realtime — 2026-09-11

### Ditambahkan
- `Student\MaterialController` (`app/Http/Controllers/Student/MaterialController.php`) untuk pengelolaan penayangan materi kelas siswa, penandaan progres selesai (`toggleComplete`), dan penambahan komentar di ruang diskusi (`storeComment`).
- Dispatching Event Realtime `DiscussionCommentSent` (`event(new DiscussionCommentSent($discussion))`) pada channel privat `material.{material_id}` saat komentar dikirim.
- Blade Views Tabler UI di `resources/views/student/materials/`: `index.blade.php` (daftar materi per kelas) dan `show.blade.php` (penayang konten teks/dokumen/video & ruang diskusi).
- Feature Test `tests/Feature/Student/StudentMaterialTest.php` untuk memverifikasi isolasi materi per kelas siswa, toggle penandaan selesai (`material_progress`), pengiriman komentar diskusi realtime, dan proteksi otorisasi antar-kelas.

### Diubah
- `routes/web.php`: Menambahkan rute `student.materials.index`, `show`, `complete`, dan `discussions`.

## [Fase 14] Student Dashboard — 2026-09-11

### Ditambahkan
- `Student\DashboardController` (`app/Http/Controllers/Student/DashboardController.php`) untuk menyajikan metrik portal siswa: nama kelas siswa, hitungan & persentase progres penyelesaian materi, daftar tugas mendatang (deadline >= now()), kuis evaluasi aktif, dan materi pembelajaran terbaru.
- Blade View Tabler UI `resources/views/dashboard.blade.php` dengan visual ringkasan siswa yang responsif & modern.
- Feature Test `tests/Feature/Student/StudentDashboardTest.php` untuk memverifikasi penayangan dashboard siswa dan pengalihan guest ke halaman login.

### Diubah
- `routes/web.php`: Mengarahkan rute `/dashboard` ke `Student\DashboardController::class`.

## [Fase 13] Admin Laporan & Rekapitulasi Analytics — 2026-09-11

### Ditambahkan
- `ReportController` (`app/Http/Controllers/Admin/ReportController.php`) untuk menyajikan rekapitulasi progres materi (`material_progress`), rata-rata nilai tugas (`assignment_submissions`), dan rata-rata skor kuis (`quiz_attempts`) per siswa.
- Fitur Filter per Kelas dan Mata Pelajaran serta Unduh Berkas Laporan CSV (`exportCsv`).
- Blade View Tabler UI `resources/views/admin/reports/index.blade.php` dengan progress bar visual penyelesaian materi.
- Feature Test `tests/Feature/Admin/ReportTest.php` untuk memverifikasi halaman laporan analytics, ekspor CSV, dan proteksi role siswa.

### Diubah
- `routes/web.php`: Menambahkan rute `reports.index` dan `reports.export-csv` di dalam grup `/admin`.

## [Fase 12] Admin Koreksi Tugas — 2026-09-11

### Ditambahkan
- `AssignmentSubmissionController` (`app/Http/Controllers/Admin/AssignmentSubmissionController.php`) untuk pengelolaan daftar pengumpulan tugas siswa, penayangan jawaban siswa, serta pemberian nilai (0-100) dan umpan balik/catatan guru (`grade`).
- Otorisasi mata pelajaran: Guru hanya dapat menilai pengumpulan tugas pada mata pelajaran yang diampunya (`subject_user`).
- Blade Views Tabler UI di `resources/views/admin/submissions/`: `index.blade.php` (dengan filter dropdown berdasarkan tugas) dan `show.blade.php` (form penilaian & feedback).
- Feature Test `tests/Feature/Admin/AssignmentSubmissionGradeTest.php` untuk memverifikasi penayangan daftar submission, proses penilaian & feedback guru, validasi otorisasi mata pelajaran, dan proteksi role siswa.

### Diubah
- `routes/web.php`: Menambahkan rute `submissions.index`, `submissions.show`, dan `submissions.grade` di dalam grup `/admin`.

## [Fase 11] Master — Kuis CRUD & Question Management — 2026-09-11

### Ditambahkan
- `QuizController` (`app/Http/Controllers/Admin/QuizController.php`) untuk pengelolaan CRUD Kuis Evaluasi (Judul, Durasi Pengerjaan, Poin per Soal, Batas Waktu/Deadline, Mata Pelajaran, dan Kelas Target).
- Fitur Pengelolaan Soal Kuis:
  - Impor batch dari Bank Soal (`importQuestions`) beserta opsi & kunci jawaban.
  - Penambahan soal manual khusus kuis (`storeQuestion`) dan opsi dinamis.
  - Penghapusan soal kuis (`destroyQuestion`).
- Proteksi otorisasi mata pelajaran: Guru hanya dapat membuat/mengubah kuis pada mata pelajaran yang diampunya (`subject_user`).
- Blade Views Tabler UI di `resources/views/admin/quizzes/`: `index.blade.php`, `create.blade.php`, `edit.blade.php`, `show.blade.php`.
- Feature Test `tests/Feature/Admin/QuizCrudTest.php` untuk memverifikasi pembuatan kuis, impor soal dari Bank Soal, penambahan/penghapusan soal manual, validasi otorisasi mata pelajaran, dan proteksi role siswa.

### Diubah
- `routes/web.php`: Menambahkan rute resource `quizzes` serta rute penanganan `import-questions`, `questions`, dan `destroy-question` di dalam grup `/admin`.

## [Fase 10] Master — Tugas CRUD + Broadcast Event — 2026-09-11

### Ditambahkan
- `AssignmentController` (`app/Http/Controllers/Admin/AssignmentController.php`) untuk pengelolaan CRUD Tugas Siswa (Judul, Deskripsi/Petunjuk, Batas Waktu/Deadline, Mata Pelajaran, dan Kelas Target).
- Proteksi otorisasi mata pelajaran: Guru hanya dapat menambahkan/mengubah tugas pada mata pelajaran yang diampunya (`subject_user`).
- Dispatching Event Realtime `AssignmentCreated` (`event(new AssignmentCreated($assignment))`) pada channel `class.{class_id}` saat tugas baru dibuat.
- Blade Views Tabler UI di `resources/views/admin/assignments/`: `index.blade.php`, `create.blade.php`, `edit.blade.php`.
- Feature Test `tests/Feature/Admin/AssignmentCrudTest.php` untuk memverifikasi pembuatan tugas, validasi otorisasi mata pelajaran guru, penyiaran event realtime `assignment.created`, dan proteksi role siswa.

### Diubah
- `routes/web.php`: Menambahkan rute resource `assignments` di dalam grup `/admin`.

## [Fase 9] Master — Materi CRUD + Broadcast Event — 2026-09-11

### Ditambahkan
- `MaterialController` (`app/Http/Controllers/Admin/MaterialController.php`) untuk pengelolaan CRUD Materi Pembelajaran (Teks/HTML, Dokumen Upload, dan Video YouTube).
- Proteksi otorisasi mata pelajaran: Guru hanya dapat menambahkan/mengubah materi pada mata pelajaran yang diampunya (`subject_user`).
- Dispatching Event Realtime `MaterialCreated` (`event(new MaterialCreated($material))`) pada channel `class.{class_id}` saat materi baru dibuat.
- Blade Views Tabler UI di `resources/views/admin/materials/`: `index.blade.php`, `create.blade.php`, `edit.blade.php`.
- Feature Test `tests/Feature/Admin/MaterialCrudTest.php` untuk memverifikasi pembuatan materi per tipe, pengunggahan berkas dokumen, validasi otorisasi mata pelajaran guru, penyiaran event realtime, dan proteksi role siswa.

### Diubah
- `routes/web.php`: Menambahkan rute resource `materials` di dalam grup `/admin`.

## [Fase 8] Master — Bank Soal CRUD — 2026-09-11

### Ditambahkan
- `QuestionBankController` (`app/Http/Controllers/Admin/QuestionBankController.php`) untuk pengelolaan CRUD Bank Soal pilihan ganda beserta opsi jawaban dinamis dan penandaan jawaban benar.
- Blade Views Tabler UI di `resources/views/admin/question-banks/`: `index.blade.php`, `create.blade.php`, `edit.blade.php`.
- Feature Test `tests/Feature/Admin/QuestionBankCrudTest.php` untuk memverifikasi pembuatan soal dengan opsi & jawaban benar, pengeditan, penghapusan cascade opsi, dan proteksi role siswa.

### Diubah
- `routes/web.php`: Menambahkan rute resource `question-banks` di dalam grup `/admin`.

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
