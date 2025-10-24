@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
    <div class="card">
        <div class="card-header">Welcome</div>
        <div class="card-body">
            @if (Auth::check())
                <p>Welcome, {{ Auth::user()->name }}!</p>
                <p>Your role is: {{ Auth::user()->role }}</p>
            @else
                <p>You are not logged in.</p>
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            @endif
        </div>
    </div>

    {{-- <h2 class="mt-4">STOK OPNAME PER {{ date('d M Y') }} PEMBANGUNAN JARINGAN SHANGTELHOOME</h2> --}}
    <h2 class="mt-4">Daftar Stock Barang</h2>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($allStocks as $index => $stock)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $stock->keterangan }}</td>
                                <td>{{ $stock->qty }}</td>
                                <td>{{ $stock->satuan }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Tidak ada stock barang.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <h2 class="mt-4">Log Aktivitas Terbaru</h2>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Pengguna</th>
                            <th>Aksi</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logAktivitas as $log)
                            <tr>
                                <td>{{ $log->created_at->format('d M Y H:i:s') }}</td>
                                <td>{{ $log->user->name ?? 'N/A' }}</td>
                                <td>{{ $log->action }}</td>
                                <td>{{ $log->description }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Tidak ada log aktivitas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
