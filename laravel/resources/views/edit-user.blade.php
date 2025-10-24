@extends('layouts.app')

@section('title', 'Edit User')
@section('page_title', 'Edit User')

@section('content')
    <div class="card mb-4">
        <div class="card-header">Form Edit User</div>
        <div class="card-body">
            <form method="POST" action="{{ route('kelola-user.update', $user->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password (kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role" name="role" required>
                        <option value="">Pilih Role</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update User</button>
                <a href="{{ route('kelola-user.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection