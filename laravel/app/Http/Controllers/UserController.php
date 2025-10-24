<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('kelola-user', compact('users'));
    }

    public function create()
    {
        return view('create-user');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,user',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'model_type' => User::class,
            'model_id' => $user->id,
            'new_data' => $user->toJson(),
            'description' => 'Menambah user baru: ' . $user->username,
        ]);

        return redirect()->route('kelola-user.index')->with('success', 'User created successfully!');
    }

    public function edit(User $user)
    {
        return view('edit-user', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:admin,user',
        ]);

        $oldData = $user->toJson();

        $user->name = $request->name;
        $user->username = $request->username;
        $user->role = $request->role;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'model_type' => User::class,
            'model_id' => $user->id,
            'old_data' => $oldData,
            'new_data' => $user->toJson(),
            'description' => 'Memperbarui user: ' . $user->username,
        ]);

        return redirect()->route('kelola-user.index')->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        $oldData = $user->toJson();
        $user->delete();

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'model_type' => User::class,
            'model_id' => $user->id,
            'old_data' => $oldData,
            'description' => 'Menghapus user: ' . $user->username,
        ]);

        return redirect()->route('kelola-user.index')->with('success', 'User deleted successfully!');
    }
}
