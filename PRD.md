# Product Requirements Document (PRD)

## Learning Management System (LMS) — Full Laravel

|             |                       |
| ----------- | --------------------- |
| **Author**  | Gana Purba Kusuma     |
| **Status**  | Ready for Development |
| **Version** | 1.7                   |

---

## 1. Overview

### 1.1 Tujuan

Membangun LMS sederhana untuk portfolio, menunjukkan penerapan clean code practice (Form Request, Service Layer, Policy, Testing, N+1 optimization) pada domain bisnis baru — berbeda dari HRIS dan Job Tracker yang sudah ada.

### 1.2 Target User

- **Guru (Instructor/Admin)**: mengelola kelas, materi, tugas, kuis, bank soal, dan menilai jawaban siswa. Akses lewat dashboard admin.
- **Siswa (Student)**: mengakses materi, mengerjakan tugas dan kuis sesuai kelasnya. Akses lewat halaman frontend (setelah login).

### 1.3 Batasan Scope

- Materi berupa teks, upload dokumen (PDF/file), atau link YouTube (embed)
- Tugas berupa jawaban essay/teks dari siswa (bukan upload file)
- Kuis hanya bisa dikerjakan **1 kali** oleh siswa
- Siswa dikelompokkan per **kelas** (1 siswa = 1 kelas); siswa **memilih kelas sendiri saat registrasi** (dropdown)
- **Guru/Admin hanya dapat ditambahkan langsung dari database** (via seeder atau tinker) — tidak ada halaman register untuk guru
- Materi, tugas, dan kuis langsung diasosiasikan ke **kelas** — tidak ada abstraksi "Course"
- Siswa **otomatis** dapat mengakses materi/tugas/kuis yang tersedia untuk kelasnya

---

## 2. Tech Stack

| Layer                     | Teknologi                                                         |
| ------------------------- | ----------------------------------------------------------------- |
| Backend + Admin Dashboard | Laravel (Blade)                                                   |
| Frontend Siswa            | Laravel (Blade) — 1 aplikasi yang sama, beda layout/tema          |
| Database                  | MySQL                                                             |
| Autentikasi               | Laravel Breeze (session-based, Blade stack)                       |
| Timer Kuis                | Vanilla JS (countdown client-side, submit otomatis saat habis)    |
| Realtime                  | Laravel Echo + Pusher (WebSocket) — untuk diskusi & notifikasi    |

**Keputusan arsitektur**: full Laravel Blade dipilih karena seluruh konten LMS berada di balik login (tidak butuh SEO), sehingga kelebihan SPA/Vue tidak relevan. Pendekatan ini memaksimalkan kecepatan development dan kemudahan maintenance dengan 1 codebase. **Laravel Breeze** dipilih sebagai starter kit autentikasi. **Vanilla JS** digunakan untuk countdown timer kuis (tanpa dependency tambahan). **Laravel Echo + Pusher** digunakan untuk: (a) komentar diskusi materi realtime, (b) notifikasi siswa saat ada materi/tugas baru, dan (c) notifikasi guru di backend saat ada komentar baru di ruang diskusi.

---

## 3. Functional Requirements

### 3.1 Autentikasi & Role

| ID     | Requirement                                                                                                           |
| ------ | --------------------------------------------------------------------------------------------------------------------- |
| FR-1.0 | Siswa dapat mendaftar (register) di `/register` dengan mengisi nama, memilih kelas (dropdown), email, dan password. Role **otomatis di-set `siswa`** — tidak ada pilihan role di form |
| FR-1.1 | Satu halaman login (`/login`) digunakan oleh **semua user** (guru dan siswa) dengan email & password                 |
| FR-1.2 | Setelah login, sistem mendeteksi role dan melakukan redirect: role `guru` → `/admin/dashboard`, role `siswa` → `/dashboard` |
| FR-1.3 | Role dikelola lewat tabel `roles`; pengecekan role via relasi `user->role->name`, dibatasi lewat middleware/Policy   |
| FR-1.4 | Dashboard admin (`/admin/*`) hanya bisa diakses role `guru`                                                          |
| FR-1.5 | Siswa yang mencoba mengakses `/admin/*` langsung diarahkan ke `/dashboard` (redirect, bukan 403)                     |
| FR-1.6 | User dapat meminta reset password via halaman **Forgot Password** (`/forgot-password`) menggunakan email — sistem mengirim link reset ke email |
| FR-1.7 | User dapat membuat password baru lewat link reset yang dikirim ke email (**Reset Password**)                         |
| FR-1.8 | User yang sudah login dapat **mengganti password** dari halaman profil/pengaturan dengan mengisi password lama dan password baru |

---

### 3.2 Admin — Menu Master

Menu **Master** adalah kelompok navigasi utama di admin dashboard, berisi sub-menu berikut:

| ID     | Sub-menu         | Requirement                                                                                                                        |
| ------ | ---------------- | ---------------------------------------------------------------------------------------------------------------------------------- |
| FR-2.1 | Siswa            | Guru dapat melihat daftar siswa beserta kelas yang dipilih siswa saat registrasi (read-only)                                       |
| FR-2.2 | Kelas            | Guru dapat membuat, mengedit, menghapus kelas (nama kelas)                                                                         |
| FR-2.3 | Materi           | Guru dapat membuat, mengedit, menghapus materi (CRUD) — detail di §3.3                                                             |
| FR-2.4 | Tugas            | Guru dapat membuat, mengedit, menghapus tugas (CRUD) — detail di §3.4                                                              |
| FR-2.5 | Bank Soal        | Guru dapat membuat, mengedit, menghapus soal pilihan ganda beserta kunci jawaban — detail di §3.6                                  |
| FR-2.6 | Koreksi Tugas    | Guru dapat melihat seluruh submission tugas siswa per kelas dan memberikan nilai + feedback — detail di §3.4                        |
| FR-2.7 | Role             | Admin dapat membuat, mengedit, menghapus **nama role** (CRUD role saja — misal: tambah role "admin", ubah nama, hapus)              |
| FR-2.8 | User             | Admin dapat melihat daftar semua user, melihat role saat ini, dan **mengubah role** yang ditetapkan ke user tertentu               |
| FR-2.9 | Mata Pelajaran   | Admin dapat membuat, mengedit, menghapus mata pelajaran dan **menetapkan guru** yang mengampu mata pelajaran tersebut               |

---

### 3.2b Admin — Dashboard Guru (Tampilan Setelah Login)

> Guru yang login dari `/login` di-redirect ke `/admin/dashboard`. Ini adalah halaman pertama yang dilihat guru setelah masuk.

#### Ringkasan Statistik (Kartu Ringkasan)

| Kartu                    | Data yang Ditampilkan                                               |
| ------------------------ | ------------------------------------------------------------------- |
| Total Kelas              | Jumlah kelas yang terdaftar di sistem                               |
| Total Siswa              | Jumlah siswa aktif di seluruh kelas                                 |
| Tugas Belum Dikoreksi    | Jumlah submission tugas yang belum diberi nilai oleh guru ini       |
| Kuis Aktif               | Jumlah kuis milik guru ini yang deadline-nya belum terlewat         |

#### Navigasi Menu Admin (Sidebar/Navbar)

| Menu Utama    | Sub-menu / Deskripsi                                                                       |
| ------------- | ------------------------------------------------------------------------------------------ |
| **Dashboard** | Halaman ringkasan statistik (di atas)                                                      |
| **Master**    | Siswa, Kelas, Materi, Tugas, Bank Soal, Koreksi Tugas, Role, User, Mata Pelajaran         |
| **Kuis**      | Daftar kuis milik guru; buat kuis baru, kelola soal & pengaturan                           |
| **Laporan**   | Laporan Materi, Laporan Tugas, Laporan Kuis                                                |
| **Logout**    | Keluar dari sesi dan kembali ke halaman `/login`                                           |

#### FR Admin Dashboard

| ID      | Requirement                                                                                                       |
| ------- | ----------------------------------------------------------------------------------------------------------------- |
| FR-2b.1 | Guru melihat 4 kartu ringkasan statistik di halaman dashboard admin                                              |
| FR-2b.2 | Kartu "Tugas Belum Dikoreksi" hanya menghitung submission tugas milik guru yang sedang login                     |
| FR-2b.3 | Kartu "Kuis Aktif" hanya menghitung kuis milik guru yang sedang login                                            |
| FR-2b.4 | Sidebar/navbar menampilkan seluruh menu navigasi admin sesuai tabel di atas                                      |

---

### 3.3 Admin — Materi

| ID     | Requirement                                                                                                                           |
| ------ | ------------------------------------------------------------------------------------------------------------------------------------- |
| FR-3.1 | Guru memilih kelas tujuan saat membuat materi                                                                                         |
| FR-3.2 | Materi mendukung 3 tipe konten: **teks** (rich text), **dokumen** (upload PDF/file), atau **link YouTube** (embed otomatis)           |
| FR-3.3 | Guru dapat menentukan urutan tampil materi                                                                                            |
| FR-3.4 | Guru hanya dapat mengelola materi yang dibuat oleh dirinya sendiri                                                                    |
| FR-3.5 | Setiap materi memiliki **ruang diskusi realtime**: guru dan siswa (di kelas yang sama) dapat memposting komentar/pertanyaan; komentar baru muncul langsung tanpa reload halaman (via Laravel Echo + Pusher) |
| FR-3.6 | Guru dapat menghapus komentar diskusi yang tidak sesuai                                                                                                                                                     |

---

### 3.3b Admin — Koreksi Tugas

> Dapat diakses lewat sub-menu **Koreksi Tugas** di Menu Master (FR-2.6) atau dari halaman detail tugas.

| ID      | Requirement                                                                                     |
| ------- | ----------------------------------------------------------------------------------------------- |
| FR-3b.1 | Guru memilih kelas dan tugas untuk melihat daftar submission siswa                              |
| FR-3b.2 | Guru dapat melihat jawaban essay tiap siswa beserta status (belum dinilai / sudah dinilai)      |
| FR-3b.3 | Guru dapat memberikan nilai (angka) dan feedback teks untuk setiap submission                   |
| FR-3b.4 | Setelah dinilai, siswa dapat melihat nilai dan feedback dari halaman tugas mereka               |

---

### 3.4 Admin — Tugas

| ID     | Requirement                                                                            |
| ------ | -------------------------------------------------------------------------------------- |
| FR-4.1 | Guru memilih kelas tujuan saat membuat tugas                                           |
| FR-4.2 | Guru mengisi judul tugas, deskripsi/soal essay, dan batas waktu pengumpulan (deadline) |
| FR-4.3 | Guru dapat melihat daftar jawaban siswa per kelas untuk setiap tugas                   |
| FR-4.4 | Guru dapat memberikan nilai dan feedback untuk setiap jawaban siswa                    |
| FR-4.5 | Guru hanya dapat mengelola tugas yang dibuat oleh dirinya sendiri                      |

---

### 3.5 Admin — Kuis

| ID     | Requirement                                                                                                            |
| ------ | ---------------------------------------------------------------------------------------------------------------------- |
| FR-5.1 | Guru memilih kelas tujuan saat membuat kuis                                                                            |
| FR-5.2 | Guru mengisi judul kuis                                                                                                |
| FR-5.3 | Guru dapat menambah soal ke kuis dengan dua cara: (a) buat soal baru langsung, atau (b) pilih dari Bank Soal           |
| FR-5.4 | Guru mengisi **poin per soal** (`points_per_question`). Total nilai = poin per soal × jumlah soal yang dijawab benar   |
| FR-5.5 | Guru mengatur **batas waktu pengumpulan kuis** (deadline): tanggal & jam. Siswa yang melewati deadline dianggap tidak mengerjakan |
| FR-5.6 | Guru mengatur **durasi pengerjaan** (dalam menit): **countdown timer** tampil di halaman kuis siswa, diimplementasikan dengan Vanilla JS. Timer mulai berjalan sejak siswa masuk, dan form submit otomatis saat waktu habis |
| FR-5.7 | Guru hanya dapat mengelola kuis yang dibuat oleh dirinya sendiri                                                       |

---

### 3.6 Admin — Bank Soal

| ID     | Requirement                                                                                                  |
| ------ | ------------------------------------------------------------------------------------------------------------ |
| FR-6.1 | Guru dapat membuat, mengedit, dan menghapus soal pilihan ganda                                               |
| FR-6.2 | Setiap soal memiliki: teks pertanyaan, minimal 2 pilihan jawaban, dan 1 jawaban yang ditandai sebagai benar  |
| FR-6.3 | Soal dari bank soal dapat dipilih dan dimasukkan ke dalam kuis manapun                                       |

---

### 3.7 Admin — Laporan

| ID     | Sub-laporan    | Requirement                                                                                                                        |
| ------ | -------------- | ---------------------------------------------------------------------------------------------------------------------------------- |
| FR-7.1 | Laporan Materi | Guru dapat melihat daftar kelas; di dalam setiap kelas terdapat daftar siswa beserta status penyelesaian materi (selesai/belum)    |
| FR-7.2 | Laporan Tugas  | Guru dapat melihat nilai tugas siswa dikelompokkan per kelas                                                                       |
| FR-7.3 | Laporan Kuis   | Guru dapat melihat nilai kuis siswa dikelompokkan per kelas                                                                        |

---

### 3.8 Aktivitas Siswa (Frontend)

#### 3.8.1 Halaman Dashboard

| ID      | Requirement                                                                                                      |
| ------- | ---------------------------------------------------------------------------------------------------------------- |
| FR-8.0a | Siswa dapat melihat dashboard yang berisi ringkasan: nama kelas, jumlah materi belum selesai, tugas belum dikerjakan, kuis belum dikerjakan |
| FR-8.0b | Setiap item ringkasan di dashboard dapat diklik langsung menuju halaman yang relevan                            |
| FR-8.0c | Siswa menerima **notifikasi realtime** (via Pusher) saat guru menambahkan materi baru di kelasnya               |
| FR-8.0d | Siswa menerima **notifikasi realtime** (via Pusher) saat guru menambahkan tugas baru di kelasnya                |
| FR-8.0e | Guru menerima **notifikasi realtime** di admin dashboard saat ada komentar baru di ruang diskusi materi miliknya |

#### 3.8.2 Materi

| ID      | Requirement                                                                                        |
| ------- | -------------------------------------------------------------------------------------------------- |
| FR-8.1  | Siswa dapat melihat daftar materi yang tersedia untuk kelasnya                                     |
| FR-8.2  | Siswa dapat membaca/mengakses materi dan menandainya sebagai selesai                               |
| FR-8.3  | Siswa dapat berpartisipasi di ruang diskusi pada setiap materi (baca & posting komentar); komentar baru muncul **realtime tanpa reload** via Laravel Echo + Pusher |

#### 3.8.3 Tugas

| ID      | Requirement                                                                                        |
| ------- | -------------------------------------------------------------------------------------------------- |
| FR-8.4  | Siswa dapat melihat daftar tugas yang tersedia untuk kelasnya                                      |
| FR-8.5  | Siswa dapat melihat detail tugas dan mengisi jawaban essay                                         |
| FR-8.6  | Siswa dapat submit jawaban tugas — **hanya 1 kali**, tidak bisa diedit setelah submit              |
| FR-8.7  | Siswa dapat melihat nilai dan feedback tugas setelah dikoreksi guru                                |

#### 3.8.4 Kuis

| ID      | Requirement                                                                                        |
| ------- | -------------------------------------------------------------------------------------------------- |
| FR-8.8  | Siswa dapat melihat daftar kuis yang tersedia untuk kelasnya (termasuk status: belum/sudah/expired)|
| FR-8.9  | Siswa dapat mengerjakan kuis — **hanya 1 kali kesempatan**; **countdown timer** (Vanilla JS) tampil di layar dan form otomatis ter-submit saat waktu habis |
| FR-8.10 | Siswa tidak dapat mengerjakan kuis jika sudah melewati deadline                                    |
| FR-8.11 | Siswa dapat melihat **halaman hasil kuis** setelah submit, berisi: skor total yang diperoleh                     |
| FR-8.12 | Halaman hasil kuis menampilkan **review setiap soal**: teks pertanyaan, jawaban yang dipilih siswa, jawaban yang benar, dan status (benar/salah) untuk setiap soal |

#### 3.8.5 Profil & Laporan Diri

| ID      | Requirement                                                                                        |
| ------- | -------------------------------------------------------------------------------------------------- |
| FR-8.14 | Siswa dapat melihat halaman profil/laporan diri yang berisi: daftar materi yang sudah diselesaikan, nilai seluruh tugas, dan skor seluruh kuis miliknya sendiri |
| FR-8.15 | Data pada halaman profil hanya menampilkan data milik siswa yang sedang login (tidak bisa lihat data siswa lain) |
| FR-8.16 | Navbar frontend siswa menampilkan tombol **Logout** yang mengakhiri sesi dan mengarahkan ke halaman `/login` |

---

## 4. Data Model

```
roles
├── id, name (misal: "guru", "siswa"), created_at, updated_at

subjects (mata pelajaran)
├── id, name, created_at, updated_at

classes
├── id, name (misal: "Kelas 10A"), created_at, updated_at

users
├── id, name, email, nip (string, nullable, UNIQUE — hanya diisi untuk guru), password,
│   role_id (FK → roles), class_id (FK → classes, nullable untuk guru),
│   created_at, updated_at

subject_user (pivot: guru ↔ mata pelajaran, many-to-many)
├── id, subject_id (FK → subjects), user_id (FK → users), created_at, updated_at

materials (materi)
├── id, class_id (FK → classes), instructor_id (FK → users),
│   title, content_type (text/document/youtube),
│   content (text, nullable), document_path (string, nullable), video_url (string, nullable),
│   order, created_at, updated_at

material_progress
├── id, user_id (FK → users), material_id (FK → materials),
│   is_completed, completed_at
│   UNIQUE(user_id, material_id)

material_discussions (ruang diskusi materi)
├── id, material_id (FK → materials), user_id (FK → users),
│   comment, created_at, updated_at

assignments (tugas)
├── id, class_id (FK → classes), instructor_id (FK → users),
│   title, description, due_date, created_at, updated_at

assignment_submissions
├── id, assignment_id (FK), student_id (FK → users),
│   answer_text, submitted_at, grade, feedback, graded_at
│   UNIQUE(assignment_id, student_id)

question_bank (bank soal)
├── id, instructor_id (FK → users), question_text, created_at, updated_at

question_bank_options
├── id, question_bank_id (FK), option_text, is_correct

quizzes (kuis)
├── id, class_id (FK → classes), instructor_id (FK → users),
│   title, points_per_question, deadline (datetime), duration_minutes,
│   created_at, updated_at

quiz_questions
├── id, quiz_id (FK → quizzes),
│   question_bank_id (FK → question_bank, nullable — diisi jika soal dari bank soal),
│   question_text (nullable — diisi jika soal baru, bukan dari bank soal)

quiz_question_options
├── id, quiz_question_id (FK), option_text, is_correct
│   (hanya digunakan jika soal bukan dari bank soal / question_bank_id IS NULL)

quiz_attempts
├── id, student_id (FK → users), quiz_id (FK → quizzes),
│   score, started_at, submitted_at
│   UNIQUE(student_id, quiz_id)

quiz_answers
├── id, quiz_attempt_id (FK), quiz_question_id (FK), selected_option_id (FK)
```

## Entity Relationship

```
Class (kelas) ──< User (siswa, via class_id)
      │
      ├──< Material ──< MaterialProgress
      │              └──< MaterialDiscussion
      ├──< Assignment ──< AssignmentSubmission
      └──< Quiz ──< QuizQuestion ──< QuizQuestionOption
                │
                └──< QuizAttempt ──< QuizAnswer

QuizQuestion ──> QuestionBank (opsional, jika soal dari bank soal)
QuestionBank ──< QuestionBankOption

Role ──< User (via role_id)

Subject (mata pelajaran) ──>< User (guru) [many-to-many via subject_user]

User (guru)  ──< Material (sebagai instructor_id)
User (guru)  ──< Assignment (sebagai instructor_id)
User (guru)  ──< Quiz (sebagai instructor_id)
User (guru)  ──< QuestionBank (sebagai instructor_id)
User (guru)  ──< MaterialDiscussion

User (siswa) ──< MaterialProgress
User (siswa) ──< MaterialDiscussion
User (siswa) ──< AssignmentSubmission
User (siswa) ──< QuizAttempt ──< QuizAnswer
```

---

## 5. Keamanan

| Area                  | Penerapan                                                                                                                                                                                                          |
| --------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| Mass Assignment       | `student_id`, `instructor_id`, `class_id` di relasi TIDAK masuk `$fillable`, selalu diisi dari `auth()->id()` atau route parameter                                                                                 |
| Register auto-role    | Field `role` di-hardcode ke `siswa` di dalam `RegisterService` (hanya untuk siswa) — guru/admin ditambahkan langsung via seeder/tinker, tidak ada form register guru                                               |
| Forgot & Reset Password | Menggunakan fitur bawaan Breeze: token reset disimpan di tabel `password_reset_tokens`, link dikirim via email (Laravel Mail/SMTP)                                                                                 |
| Blokir Backend Siswa  | Middleware `role:guru` dipasang di route group `/admin/*`; siswa yang mencoba akses di-redirect ke `/dashboard` (bukan 403)                                                                                        |
| Redirect by Role      | `AuthenticatedSessionController` mendeteksi role setelah login: guru → `/admin/dashboard`, siswa → `/dashboard`                                                                                                   |
| Otorisasi             | Policy per model (`MaterialPolicy`, `AssignmentPolicy`, `QuizPolicy`, `MaterialDiscussionPolicy`, dll) — guru hanya kelola resource miliknya, siswa hanya akses resource kelas mereka                              |
| Diskusi Materi        | Siswa hanya bisa posting komentar di materi kelas sendiri (validasi `class_id`). Guru bisa hapus komentar manapun di materi miliknya                                                                               |
| Duplikasi submission  | Unique constraint di level database (`assignment_submissions`, `quiz_attempts`) — bukan cuma validasi aplikasi                                                                                                     |
| N+1 Prevention        | Eager loading wajib untuk material + progress + discussions, quiz + questions + attempts                                                                                                                           |
| Validasi kondisional  | `MaterialRequest` memvalidasi: `content` wajib jika `content_type=text`, `document_path` wajib jika `content_type=document`, `video_url` wajib (format URL YouTube valid) jika `content_type=youtube`, menggunakan rule `required_if` |
| Deadline & Timer kuis | Validasi server-side: cek deadline sebelum siswa bisa memulai kuis; cek durasi saat submit (`submitted_at − started_at ≤ duration_minutes`)                                                                        |

---

## 6. Milestone Pengerjaan

| Fase                              | Deliverable                                                                                          |
| --------------------------------- | ---------------------------------------------------------------------------------------------------- |
| 1. Foundation                     | Migration seluruh tabel, Model + relasi, Seeder data dummy (termasuk akun guru awal)                 |
| 2. Auth & Middleware              | Install Breeze; register siswa (dropdown kelas), login, forgot password, reset password, ganti password, role middleware, redirect by role, Policy dasar |
| 3. Pusher & Echo Setup            | Install Laravel Echo + Pusher SDK, konfigurasi `.env`, buat channel & event class dasar             |
| 4. Master — Role                  | CRUD Role (nama role)                                                                                |
| 5. Master — User                  | Daftar semua user + assign/ubah role per user                                                        |
| 6. Master — Mata Pelajaran        | CRUD Mata Pelajaran + penetapan guru pengampu (many-to-many)                                         |
| 7. Master — Kelas                 | CRUD Kelas                                                                                           |
| 8. Master — Bank Soal             | CRUD Bank Soal (soal + pilihan jawaban)                                                              |
| 9. Master — Materi                | CRUD Materi (teks, dokumen, YouTube) + urutan tampil + broadcast event saat materi baru              |
| 10. Master — Tugas                | CRUD Tugas + deadline + broadcast event saat tugas baru                                              |
| 11. Admin — Kuis                  | Buat kuis, tambah soal (baru / dari bank soal), atur poin/deadline/durasi                            |
| 12. Admin — Koreksi Tugas         | Halaman koreksi submission per kelas: lihat jawaban, beri nilai + feedback                           |
| 13. Admin — Laporan               | Laporan materi (progress per siswa), laporan tugas & kuis (nilai per kelas)                          |
| 14. Student — Dashboard           | Dashboard siswa: ringkasan kelas, materi/tugas/kuis yang belum dikerjakan + notifikasi realtime      |
| 15. Student — Materi & Diskusi    | List & baca materi, tandai selesai, ruang diskusi realtime + notifikasi komentar ke guru            |
| 16. Student — Tugas               | Submit jawaban essay (1x), lihat nilai & feedback setelah dikoreksi                                  |
| 17. Student — Kuis                | Kerjakan kuis (1x, timer Vanilla JS, auto-submit), lihat hasil: skor total + review jawaban per soal |
| 18. Student — Profil & Laporan    | Halaman profil/laporan diri: materi selesai, nilai tugas, skor kuis                                  |
| 19. Testing                       | PHPUnit untuk otorisasi & business logic kritis (register, submission, deadline, diskusi)            |
| 20. Polish & N+1 Audit            | Audit query via Debugbar, styling dasar                                                              |

---

## 7. Success Criteria

- [ ] Siswa dapat mendaftar (register) dengan memilih kelas dari dropdown; role otomatis `siswa`
- [ ] Guru/admin hanya bisa ditambahkan via seeder atau tinker — tidak ada form register guru
- [ ] Forgot password mengirim link reset ke email user
- [ ] User dapat membuat password baru lewat link reset
- [ ] User yang login dapat mengganti password dari halaman profil
- [ ] Siswa yang mencoba akses `/admin/*` di-redirect ke dashboard siswa (bukan 403)
- [ ] Dashboard siswa menampilkan ringkasan materi/tugas/kuis yang belum dikerjakan
- [ ] Guru hanya bisa kelola materi/tugas/kuis miliknya sendiri (Policy teruji)
- [ ] Guru bisa menilai & memberi feedback submission tugas dari halaman Koreksi Tugas
- [ ] Siswa tidak bisa submit tugas/kuis lebih dari 1 kali (constraint DB + validasi)
- [ ] Siswa tidak bisa mengerjakan kuis setelah deadline terlewat (validasi server-side)
- [ ] Skor kuis terhitung otomatis berdasarkan poin per soal × jawaban benar
- [ ] Siswa hanya bisa posting diskusi di materi kelas sendiri
- [ ] Halaman profil siswa hanya menampilkan data milik siswa yang sedang login
- [ ] Tidak ada N+1 query di halaman dashboard, list materi, diskusi & laporan
- [ ] Semua relasi FK tidak fillable langsung dari request (aman dari Mass Assignment)
- [ ] Minimal ada test untuk skenario otorisasi utama (siswa akses resource kelas lain → ditolak)

---

## 8. Development Guidelines

> Seluruh pengerjaan proyek ini **wajib mengacu pada [`rules.md`](./rules.md)**. Berikut penerapan konkretnya dalam konteks LMS ini:

### 8.1 Think Before Coding

- Sebelum implementasi fitur apapun, **nyatakan asumsi secara eksplisit** di komentar kode atau PR description.
- Jika ada ambiguitas (misal: apakah 1 guru bisa mengajar di banyak kelas?), **tanyakan dulu** — jangan menebak dan langsung kode.
- Jika ada interpretasi ganda pada requirement (misal: "laporan" bisa berarti rekap per siswa atau per kelas), **sajikan opsi**nya.
- Contoh pertanyaan wajib sebelum implementasi:
  - "Apakah satu guru bisa membuat materi untuk kelas yang berbeda?"
  - "Apakah kuis yang sudah expired masih ditampilkan di list siswa?"

### 8.2 Simplicity First

Panduan ini **secara langsung mengatur** pilihan teknis di proyek ini:

| Keputusan | Penerapan di LMS ini |
| --------- | -------------------- |
| No abstraksi untuk single-use | Tidak ada lapisan `Repository` — gunakan Eloquent langsung di `Service` |
| No fitur yang tidak diminta | Tidak ada notifikasi email untuk komentar diskusi (tidak diminta) |
| No konfigurasi berlebihan | `content_type` di materi cukup 3 nilai tetap (text/document/youtube), bukan sistem plugin |
| Minimal kode | Jika sebuah controller bisa < 50 baris, jangan pecah jadi lebih dari 1 class |

### 8.3 Surgical Changes

Saat mengedit kode yang sudah ada:

- **Jangan refactor** komponen yang tidak terkait dengan task saat ini.
- **Jangan ubah** format/style file yang tidak disentuh.
- **Setiap baris yang diubah harus bisa ditelusuri** ke satu FR atau bug tertentu di PRD ini.
- Jika menemukan dead code / N+1 yang tidak terkait task — **catat di CHANGELOG.md**, jangan langsung hapus/fix.

### 8.4 Goal-Driven Execution

Setiap fase milestone harus didefinisikan sebagai **verifiable goal** sebelum dikerjakan:

```
Fase X: [Nama Fase]
→ Goal    : [Apa yang harus bisa dilakukan setelah fase ini selesai]
→ Verify  : [Cara mengecek — test, curl, atau UI flow]
→ Done when: [Kriteria selesai yang konkret]
```

**Contoh untuk Fase 2 (Auth & Middleware):**
```
→ Goal    : Siswa bisa register, login, dan di-redirect ke /dashboard. Guru login dan di-redirect ke /admin/dashboard.
→ Verify  : php artisan test --filter AuthTest
→ Done when: Semua test hijau; siswa tidak bisa akses /admin/dashboard secara manual
```
