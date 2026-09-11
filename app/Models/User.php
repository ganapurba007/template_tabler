<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'nip',
        'password',
        'role_id',
        'class_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'subject_user');
    }

    public function materials(): HasMany
    {
        return $this->hasMany(Material::class, 'instructor_id');
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class, 'instructor_id');
    }

    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class, 'instructor_id');
    }

    public function questionBanks(): HasMany
    {
        return $this->hasMany(QuestionBank::class, 'instructor_id');
    }

    public function assignmentSubmissions(): HasMany
    {
        return $this->hasMany(AssignmentSubmission::class, 'student_id');
    }

    public function quizAttempts(): HasMany
    {
        return $this->hasMany(QuizAttempt::class, 'student_id');
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function isGuru(): bool
    {
        return $this->role && $this->role->name === 'guru';
    }

    public function isSiswa(): bool
    {
        return $this->role && $this->role->name === 'siswa';
    }
}
