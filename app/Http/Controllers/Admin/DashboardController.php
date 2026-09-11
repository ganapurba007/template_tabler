<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignmentSubmission;
use App\Models\Quiz;
use App\Models\SchoolClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the Admin / Guru dashboard with statistics according to PRD FR-3.2b.
     */
    public function index()
    {
        $user = Auth::user();

        // 1. Total Kelas
        $totalClasses = SchoolClass::count();

        // 2. Total Siswa (aktif di seluruh kelas)
        $totalStudents = User::whereHas('role', function ($query) {
            $query->where('name', 'siswa');
        })->count();

        // 3. Tugas Belum Dikoreksi (submission milik guru ini yang belum dinilai)
        $ungradedSubmissions = AssignmentSubmission::whereHas('assignment', function ($query) use ($user) {
            $query->where('instructor_id', $user->id);
        })->whereNull('grade')->count();

        // 4. Kuis Aktif (kuis milik guru ini yang deadline-nya belum terlewat)
        $activeQuizzes = Quiz::where('instructor_id', $user->id)
            ->where(function ($query) {
                $query->whereNull('deadline')
                      ->orWhere('deadline', '>=', now());
            })->count();

        return view('admin.dashboard', compact(
            'totalClasses',
            'totalStudents',
            'ungradedSubmissions',
            'activeQuizzes'
        ));
    }
}
