@extends('layouts.app')

@section('title', 'Tambah User Baru')
@section('page_title', 'Tambah User Baru')

@section('content')
    <div class="card mb-4">
        <div class="card-header">Form Tambah User</div>
        <div class="card-body">
            <form method="POST" action="{{ route('kelola-user.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required autocomplete="new-password">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role" name="role" required>
                        <option value="">Pilih Role</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan User</button>
                <a href="{{ route('kelola-user.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection