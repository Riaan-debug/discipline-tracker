<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\AuditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => ['required', 'in:admin,principal,teacher,counselor'],
            'department' => ['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'department' => $validated['department'],
            'is_active' => true,
            'email_verified_at' => now(), // Auto-verify for admin-created accounts
        ]);

        AuditService::logDataModification(
            'created',
            'user',
            $user->id,
            ["name" => $user->name, "role" => $user->role]
        );

        return redirect()->route('users.index')
            ->with('success', 'User created successfully!');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'in:admin,principal,teacher,counselor'],
            'department' => ['required', 'string', 'max:255'],
            'is_active' => ['boolean'],
        ]);

        // Handle password update if provided
        if ($request->filled('password')) {
            $request->validate([
                'password' => ['confirmed', Password::defaults()],
            ]);
            $validated['password'] = Hash::make($request->password);
        }

        // Handle checkbox for is_active
        $validated['is_active'] = $request->has('is_active');

        $oldName = $user->name;
        $user->update($validated);

        AuditService::logDataModification(
            'updated',
            'user',
            $user->id,
            ["old_name" => $oldName, "new_name" => $user->name]
        );

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        // Prevent admin from deleting themselves
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        // Check if user has any associated data
        if ($user->incidents()->count() > 0 || $user->positiveReports()->count() > 0) {
            return back()->with('error', 'Cannot delete user that has associated incidents or reports.');
        }

        $name = $user->name;
        $user->delete();

        AuditService::logDataModification(
            'deleted',
            'user',
            0,
            ["deleted_user_name" => $name]
        );

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully!');
    }
}
