# CHANGELOG — LMS Dani

> Catat setiap perubahan kode di sini selama implementasi.

## [Fase 1] Foundation — 2026-09-11

### Ditambahkan
- Migration untuk 17 tabel & pivot: `roles`, `classes`, `subjects`, `subject_user`, `materials`, `material_progress`, `material_discussions`, `assignments`, `assignment_submissions`, `question_bank`, `question_bank_options`, `quizzes`, `quiz_questions`, `quiz_question_options`, `quiz_attempts`, `quiz_answers`.
- Eloquent Models beserta relasinya: `Role`, `SchoolClass` (tabel `classes`), `Subject`, `Material`, `MaterialProgress`, `MaterialDiscussion`, `Assignment`, `AssignmentSubmission`, `QuestionBank`, `QuestionBankOption`, `Quiz`, `QuizQuestion`, `QuizQuestionOption`, `QuizAttempt`, `QuizAnswer`.
- Seeders: `RoleSeeder` (`guru`, `siswa`), `SchoolClassSeeder` (3 kelas), `SubjectSeeder` (3 mata pelajaran), `UserSeeder` (1 Guru `guru@lms.com`, 3 Siswa), dan `DatabaseSeeder`.
- Feature Test `tests/Feature/FoundationTest.php` untuk memverifikasi keutuhan tabel, seeder, unique constraints, dan relasi Eloquent.

### Diubah
- Model `User.php`: Tambah `$fillable` (`nip`, `role_id`, `class_id`), method helper `isGuru()` / `isSiswa()`, serta relasi ke Role, SchoolClass, Subject, Material, Assignment, Quiz, QuestionBank, dan Submissions/Attempts.
