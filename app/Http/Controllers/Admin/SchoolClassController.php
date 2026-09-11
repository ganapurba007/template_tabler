<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SchoolClassController extends Controller
{
    public function index(): View
    {
        $classes = SchoolClass::withCount('students')->orderBy('name')->paginate(10);

        return view('admin.classes.index', compact('classes'));
    }

    public function create(): View
    {
        return view('admin.classes.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:classes,name'],
        ]);

        SchoolClass::create([
            'name' => trim($request->name),
        ]);

        return redirect()->route('admin.classes.index')->with('success', 'Data Kelas berhasil ditambahkan.');
    }

    public function edit(SchoolClass $class): View
    {
        return view('admin.classes.edit', compact('class'));
    }

    public function update(Request $request, SchoolClass $class): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:classes,name,'.$class->id],
        ]);

        $class->update([
            'name' => trim($request->name),
        ]);

        return redirect()->route('admin.classes.index')->with('success', 'Data Kelas berhasil diperbarui.');
    }

    public function destroy(SchoolClass $class): RedirectResponse
    {
        $class->delete();

        return redirect()->route('admin.classes.index')->with('success', 'Data Kelas berhasil dihapus.');
    }
}
