<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\SchoolClass;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::with(['role', 'schoolClass']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role_id')) {
            $query->where('role_id', $request->role_id);
        }

        $users = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();
        $roles = Role::orderBy('name')->get();

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function edit(User $user): View
    {
        $roles = Role::orderBy('name')->get();
        $classes = SchoolClass::orderBy('name')->get();

        return view('admin.users.edit', compact('user', 'roles', 'classes'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'nip' => ['nullable', 'string', 'max:50', 'unique:users,nip,'.$user->id],
            'role_id' => ['required', 'exists:roles,id'],
            'class_id' => ['nullable', 'exists:classes,id'],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'nip' => $request->nip,
            'role_id' => $request->role_id,
            'class_id' => $request->class_id,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }
}
