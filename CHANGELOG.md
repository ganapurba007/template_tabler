# CHANGELOG — LMS Dani

> Catat setiap perubahan kode di sini selama implementasi.

## [Fase 26] Direct Hero Section Attachment & Modern Glassmorphism Statistics Cards Overhaul — 2026-09-11

### Ditambahkan & Diperbarui
- **Hero Section Menempel Direct ke Header (`layouts/app.blade.php` & `dashboard.blade.php`)**:
  - Menghapus header box terpisah (`<x-slot name="header">`) dari `dashboard.blade.php` dan menyesuaikan `@if(isset($header) && trim($header) !== '')` pada layout agar tidak merender elemen header kosong.
  - Hero section Arsha kini menempel langsung secara seamless di bawah top navbar tanpa celah (gap 0px).
  - Teks assertion pengujian `Dashboard Siswa` dan nama kelas dipindahkan ke dalam Hero Welcome Badge Pill pada area banner Hero.
- **Redesain 4 Kartu Statistik Pembelajaran Siswa (`dashboard.blade.php`)**:
  - Merombak total kartu statistik ringkasan pembelajaran dengan visual glassmorphism modern berlatar `#F2EFE7`.
  - Dilengkapi top accent gradients (`#3368A0`, `#10B981`, `#F59E0B`, `#8B5CF6`), glowing circular icon background, angka stat ekstra tebal, progress indicator bar, dan animasi hover lifting (`translateY(-6px)`).

### Diuji & Diverifikasi
- Seluruh 111 PHPUnit feature tests passed (100% PASS).

## [Fase 25] Replacement of Plain White Backgrounds with Warm Light Theme (#F2EFE7) & Footer Social Media Icon Styling — 2026-09-11

### Ditambahkan & Diperbarui
- **Penggantian Warna Latar Belakang Putih dengan `#F2EFE7`**:
  - `public/css/theme-custom.css`: Mengubah `.arsha-header`, `.arsha-icon-box`, `.arsha-course-card`, dan `.mobile-bottom-nav` dari latar polos putih menjadi warna warm light `#F2EFE7`.
  - `resources/views/layouts/navigation.blade.php`: Mengganti `bg-white` pada header navbar container, dropdown user button, dan mobile menu container dengan `style="background-color: #F2EFE7;"`.
  - `resources/views/layouts/app.blade.php`: Mengganti `bg-white` pada header halaman dan Pre-footer CTA card dengan `style="background-color: #F2EFE7;"`.
  - `resources/views/dashboard.blade.php`: Mengganti seluruh kartu komponen, search box, floating glassmorphism badges, filter mapel pills, dan kontainer kuis/tugas dari `bg-white` & `bg-light` menjadi `#F2EFE7`.
- **Rapikan & Beautify Ikon Media Sosial Footer (`layouts/app.blade.php` & `theme-custom.css`)**:
  - Dibuatkan styling tombol bundar khusus `.social-icon-btn` untuk Instagram, YouTube, Discord, dan WhatsApp dengan animasi hover lifting, glow shadows, dan gradien warna resmi tiap platform.

### Diuji & Diverifikasi
- Seluruh 111 PHPUnit feature tests passed (100% PASS).

## [Fase 24] Dedicated Laptop Header Display, Micro-Animations & Arsha Footer Overhaul — 2026-09-11

### Ditambahkan & Diperbarui
- **Dedicated Desktop Navigation Rule (`public/css/theme-custom.css` & `layouts/navigation.blade.php`)**:
  - Menambahkan aturan CSS `.arsha-nav-desktop` (`display: flex !important`) untuk menjamin 100% menu navigasi utama (`Dashboard`, `Courses / Materi`, `Tugas Kelas`, `Kuis Online`, `Laporan Diri`) tampil terbuka di layar laptop/desktop tanpa memunculkan hamburger icon.
  - Membatasi hamburger icon hanya untuk tampilan layar handphone (<768px) melalui `.arsha-hamburger-btn`.
- **Tambahan Micro-Animations (`public/css/theme-custom.css`)**:
  - `@keyframes pulse-glow` pada lonceng notifikasi dan elemen aktif.
  - `@keyframes shine-sweep` untuk efek kilau pada kartu materi.
  - Aturan `.hover-lift` (`translateY(-8px) scale(1.01)`) pada elemen interaktif.
- **Redesain Pre-Footer CTA & Arsha Premium Footer (`layouts/app.blade.php`)**:
  - **Seksi Pre-Footer CTA**: Banner gradien navy (`#1e3a8a` ke `#3368A0`) *"Siap Meraih Prestasi Terbaik & Nilai Impianmu?"* dengan kartu quick-start belajar, 3 badge fasilitas, dan background particle blur.
  - **Arsha Premium 4-Column Footer**: Footer gelap (`#0b1727`) dengan border atas `#66A3BF`, logo `ARSHA LMS SMA`, ikon media sosial bernavigasi animasi (Instagram, YouTube, Discord, WhatsApp), rumpun bidang studi, kontak bantuan 24/7, dan tombol Kembali ke Atas.

### Diuji & Diverifikasi
- Seluruh 111 PHPUnit feature tests passed (100% PASS).

## [Fase 23] Enhanced Rich Media & Laptop Header Optimization — 2026-09-11

### Ditambahkan & Diperbarui
- **Aset Gambar Pembelajaran High-Res (`public/images/`)**:
  - `public/images/hero-sma.jpg`: Gambar definisi tinggi siswa SMA belajar kelompok secara interaktif dengan laptop & buku di ruang kelas modern.
  - `public/images/quiz-achievement.jpg`: Gambar pencapaian kuis online siswa SMA dengan piala & badge prestasi.
- **Navigasi Header Terbuka untuk Laptop/Desktop (`resources/views/layouts/navigation.blade.php`)**:
  - Memastikan seluruh menu utama (`Dashboard`, `Courses / Materi`, `Tugas Kelas`, `Kuis Online`, `Laporan Diri`) tampil langsung secara penuh tanpa menguncup ke hamburger icon di layar laptop (`hidden md:flex lg:flex`).
  - Menambahkan indikator lonceng notifikasi aktif & badge `SMA Edition`.
- **Pengayaan Antarmuka Dashboard Siswa (`resources/views/dashboard.blade.php`)**:
  - Integration Gambar Hero HD dengan floating badges glassmorphism.
  - Baris Filter Pills Mata Pelajaran Populer (Matematika, IPA/Fisika, Biologi, Bahasa Inggris, Informatika).
  - Banner Showcase Kuis Interaktif dengan gambar pencapaian kuis.
  - Tampilan kartu materi & tugas yang lebih padat, kaya visual, tapi tetap clean & user-friendly.

### Diuji & Diverifikasi
- Automated PHPUnit Test suite (111 tests passed, 372 assertions).

## [Fase 22] Arsha Theme Overhaul (Youth & High School / SMA Design) — 2026-09-11

### Ditambahkan
- **Integrasi Arsha Bootstrap Template & Visual Interaktif SMA**:
  - `public/css/theme-custom.css`: Menambahkan styling khusus Arsha Hero Area (`.arsha-hero`), Arsha Header (`.arsha-header`, `.arsha-sitename`), Icon Service Boxes (`.arsha-icon-box`), Course Portfolio Grid (`.arsha-course-card`), dan Counter Band (`.arsha-counter-section`).
  - Animasi melayang keyframes `@keyframes img-float` (`.animated-float`) untuk ilustrasi vektor SVG interaktif di area Hero.
  - Integrasi pustaka **AOS (Animate On Scroll)** via CDN di `resources/views/layouts/app.blade.php` dengan durasi 800ms (`AOS.init({ duration: 800, once: true })`).
- **Pembaruan Visual Frontend & Header**:
  - Navigation Header (`resources/views/layouts/navigation.blade.php`) menggunakan brand logo animasi `ARSHA LMS` dengan font Jost & Poppins.
  - Dashboard Siswa (`resources/views/dashboard.blade.php`) diperbarui total dengan tampilan Arsha Bootstrap Template:
    - Hero Area interaktif dengan pesan motivasi belajar SMA & ilustrasi vektor SVG melayang (`animated-float`).
    - 4 Kartu Fitur & Services (Modul Interaktif, Tugas Essay, Kuis Realtime, Laporan Diri) dengan `data-aos="fade-up"`.
    - Katalog Courses / Materi Pelajaran dalam format grid `data-aos="zoom-in"`.
    - Band statistik counter animasi `data-aos="fade-up"`.
    - Timeline Kuis Online Aktif dan Tugas Perlu Dikumpulkan.

### Diuji & Diverifikasi
- Seluruh unit & feature test suite (111 passed, 372 assertions) 100% lulus tanpa hambatan.

## [Fase 21] Front-End Overhaul, Visual UI Improvements & PRD v1.9 Backend Alignment — 2026-09-11

### Ditambahkan
- **PWA Mobile-First Foundation (Frontend)**:
  - File `public/manifest.json` (Web App Manifest dengan `theme_color: #66A3BF`).
  - File `public/sw.js` (PWA Service Worker dengan strategi network-first untuk halaman dinamis dan cache-first untuk aset statis).
  - Tampilan Mobile Bottom Navigation Bar khusus untuk antarmuka siswa di perangkat ponsel (`layouts/app.blade.php`).
- **Skema Warna Frontend Baru (`PRD v1.9 §2.1 & §3.9`)**:
  - File CSS `public/css/theme-custom.css` berisi variabel CSS warna utama (`#66A3BF`), aksen dark (`#3368A0`), soft mint (`#C8DFDB`), dan warm background (`#F2EFE7`).
- **Audit & Penyesuaian Dashboard Admin Guru (`PRD v1.9 §3.2b`)**:
  - `Admin\DashboardController` (`app/Http/Controllers/Admin/DashboardController.php`) untuk menghitung 4 statistik ringkasan dinamis: Total Kelas, Total Siswa, Tugas Belum Dikoreksi, dan Kuis Aktif.
  - Penayangan 4 kartu statistik di `resources/views/admin/dashboard.blade.php` lengkap dengan link navigasi ke modul master terkait.
- **Skema Notifikasi Database (`PRD v1.9 §4`)**:
  - File migrasi `database/migrations/2026_09_11_000018_create_notifications_table.php` (`user_id`, `type`, `title`, `message`, `related_url`, `is_read`, `read_at`).
  - Model `app/Models/Notification.php` dan penambahan relasi `notifications()` di Model `User`.

### Diubah & Diperbaiki
- **Isolasi Tema Backend vs Frontend**:
  - Mengembalikan tampilan **Dashboard Admin Guru** 100% menggunakan tema asli dari `public/template/be/index.html` dengan mencabut `theme-custom.css` dari `layouts/be/header.blade.php`.
  - Mengisolasi palet warna baru (`#66A3BF`, `#3368A0`, `#C8DFDB`, `#F2EFE7`) khusus pada **Frontend Siswa & Public** (`layouts/app.blade.php`).
- **Perbaikan Query SQL pada Admin Dashboard**:
  - Mengoreksi nama kolom pada `DashboardController`: `score` menjadi `grade` pada tabel `assignment_submissions`.
  - Mengoreksi nama kolom pada `DashboardController`: `due_date` menjadi `deadline` pada tabel `quizzes`.
- **Manajemen Alert & Persistence (`localStorage`)**:
  - Semua alert flash notifikasi otomatis tertutup (4 detik untuk info/success, 7 detik untuk warning/danger).
  - Tombol close (`x`) alert menyimpan state penutupan di `localStorage` per ID alert agar tidak muncul kembali saat halaman di-refresh.
- **Auto-Init Select2 Dropdown**:
  - Inisialisasi otomatis Select2 dengan Bootstrap 5 theme (`window.initSelect2()`) untuk seluruh `<select class="select2">` tanpa perlu membuat skrip berulang di setiap view Blade.
- **Kontras Tombol Mode Terang (Light Mode)**:
  - Menambahkan border yang jelas pada `.btn-light` dan `.btn-white` di `theme-custom.css` agar tetap terlihat bersih dan kontras baik di mode light maupun dark.
- **Input Materi Pembelajaran Simultaneous**:
  - Halaman `admin.materials.create` dan `edit` diperbarui agar mendukung pengisian **Artikel Teks (TinyMCE 6)**, **Link YouTube Embed**, dan **Upload File Dokumen** secara bersamaan tanpa perlu memilih tipe melalui dropdown.
- **Autentikasi & Guard Redirection**:
  - `Route::fallback()` dan rute akar `/` otomatis mengarah ke `/dashboard`.
  - Permintaan ke rute `/register` otomatis diarahkan ke `/login`.
  - Proses Logout langsung mengarahkan pengguna kembali ke `/login`.

## [Fase 20] Polish & Audit Final — 2026-09-11

### Ditambahkan
- Final audit Eager Loading (`with()`) pada seluruh Controller untuk mencegah N+1 Query.
- Verifikasi konsistensi UI Tabler Blade & Bootstrap 5 pada antarmuka admin, guru, dan siswa.
- Full automated test suite (111 tests, 370 assertions) 100% PASS.

## [Fase 19] Testing & Security Audit — 2026-09-11

### Ditambahkan
- Feature Test `tests/Feature/SecurityAuditTest.php` untuk memverifikasi:
  - Resilience terhadap serangan SQL Injection pada parameter pencarian/filter query (`' OR '1'='1' --`).
  - Pembersihan/Escaping XSS (`e()` dan `{!! nl2br(e(...)) !!}`) pada render diskusi dan materi.
  - Otorisasi Role Middleware (`EnsureUserHasRole` & `role:guru`) yang mengisolasi rute admin dari siswa.
  - Proteksi otentikasi Guest pada seluruh rute terlindungi (`/dashboard`, `/student/*`, `/admin/*`).

## [Fase 18] Student Profil & Laporan Diri — 2026-09-11

### Ditambahkan
- `Student\ReportController` (`app/Http/Controllers/Student/ReportController.php`) untuk menghitung dan menyajikan rekapitulasi progres materi (`material_progress`), rata-rata nilai tugas, rata-rata skor kuis, dan performa evaluasi gabungan siswa.
- Blade View `resources/views/student/report/index.blade.php` dengan ringkasan kartu metrik dan tabel riwayat nilai tugas & skor kuis siswa.
- Feature Test `tests/Feature/Student/StudentReportTest.php` untuk memverifikasi penayangan laporan progres belajar diri siswa.

### Diubah
- `routes/web.php`: Menambahkan rute `student.report.index`.

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
