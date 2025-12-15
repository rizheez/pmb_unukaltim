<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of admin and staff users.
     */
    public function index()
    {
        // Pengecekan hanya untuk Role Admin
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman User Management!');
        }

        // Only show admin and staff users
        $users = User::whereIn('role', ['admin', 'staff', 'student'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses!');
        }

        return view('admin.users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses!');
        }
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,staff'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'email_verified_at' => now(), // Auto verify admin/staff
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses!');
        }

        // Only allow editing admin and staff
        if (! in_array($user->role, ['admin', 'staff'])) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses!');
        }

        // Only allow updating admin and staff
        if (! in_array($user->role, ['admin', 'staff'])) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,staff'],

        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
        ];

        // Only update password if provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diupdate!');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses!');
        }

        // Only allow deleting admin and staff
        if (! in_array($user->role, ['admin', 'staff'])) {
            abort(403, 'Unauthorized action.');
        }

        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus!');
    }
}
