@extends('layouts.app')

@section('title', 'Kelola User')
@section('page_title', 'Kelola User')

@section('content')
    <div class="card mb-4">
        <div class="card-header">Daftar User</div>
        <div class="card-body">
            <a href="{{ route('kelola-user.create') }}" class="btn btn-primary mb-3">Tambah User Baru</a>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <a href="{{ route('kelola-user.edit', $user->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                                    <form action="{{ route('kelola-user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Tidak ada user ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection