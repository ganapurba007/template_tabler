<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubjectController extends Controller
{
    public function index(): View
    {
        $subjects = Subject::with('instructors')
            ->withCount(['materials', 'assignments', 'quizzes'])
            ->orderBy('id')
            ->paginate(10);

        return view('admin.subjects.index', compact('subjects'));
    }

    public function create(): View
    {
        $gurus = User::whereHas('role', fn ($q) => $q->where('name', 'guru'))->orderBy('name')->get();

        return view('admin.subjects.create', compact('gurus'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'instructor_ids' => ['nullable', 'array'],
            'instructor_ids.*' => ['exists:users,id'],
        ]);

        $subject = Subject::create([
            'name' => trim($request->name),
        ]);

        $subject->instructors()->sync($request->instructor_ids ?? []);

        return redirect()->route('admin.subjects.index')->with('success', 'Mata Pelajaran berhasil ditambahkan.');
    }

    public function edit(Subject $subject): View
    {
        $gurus = User::whereHas('role', fn ($q) => $q->where('name', 'guru'))->orderBy('name')->get();
        $assignedInstructorIds = $subject->instructors->pluck('id')->toArray();

        return view('admin.subjects.edit', compact('subject', 'gurus', 'assignedInstructorIds'));
    }

    public function update(Request $request, Subject $subject): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'instructor_ids' => ['nullable', 'array'],
            'instructor_ids.*' => ['exists:users,id'],
        ]);

        $subject->update([
            'name' => trim($request->name),
        ]);

        $subject->instructors()->sync($request->instructor_ids ?? []);

        return redirect()->route('admin.subjects.index')->with('success', 'Mata Pelajaran berhasil diperbarui.');
    }

    public function destroy(Subject $subject): RedirectResponse
    {
        $subject->delete();

        return redirect()->route('admin.subjects.index')->with('success', 'Mata Pelajaran berhasil dihapus.');
    }
}
