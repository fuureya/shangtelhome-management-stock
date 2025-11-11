@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@push('styles')
<style>
    .card-dashboard {
        border-radius: .75rem;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        transition: all .3s ease;
    }
    .card-dashboard:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }
    .welcome-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    .welcome-card p {
        margin-bottom: 0;
    }

    @media (max-width: 767.98px) {
        .responsive-table-to-card thead {
            display: none;
        }

        .responsive-table-to-card tr {
            display: block;
            border: 1px solid #ddd;
            border-radius: .5rem;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .responsive-table-to-card td {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border: none;
            text-align: right;
        }

        .responsive-table-to-card td:before {
            content: attr(data-label);
            font-weight: bold;
            padding-right: 1rem;
            text-align: left;
        }
    }
</style>
@endpush

@section('content')
    <div class="card card-dashboard welcome-card mb-4">
        <div class="card-body">
            @if (Auth::check())
                <h5 class="card-title">Welcome, {{ Auth::user()->name }}!</h5>
                <p>Your role is: <strong>{{ ucfirst(Auth::user()->role) }}</strong></p>
            @else
                <h5 class="card-title">Welcome!</h5>
                <p>You are not logged in.</p>
                <a href="{{ route('login') }}" class="btn btn-light mt-2">Login</a>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <h4 class="mt-4"><i class="bi bi-box-seam-fill me-2"></i>Daftar Stock Barang</h4>
            <div class="card card-dashboard mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm responsive-table-to-card">
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
                                        <td data-label="No">{{ $index + 1 }}</td>
                                        <td data-label="Nama Barang">{{ $stock->keterangan }}</td>
                                        <td data-label="Jumlah">{{ $stock->qty }}</td>
                                        <td data-label="Satuan">{{ $stock->satuan }}</td>
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
        </div>
        <div class="col-lg-6">
            <h4 class="mt-4"><i class="bi bi-clock-history me-2"></i>Log Aktivitas Terbaru</h4>
            <div class="card card-dashboard mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm responsive-table-to-card">
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
                                        <td data-label="Waktu">{{ $log->created_at->format('d M Y H:i:s') }}</td>
                                        <td data-label="Pengguna">{{ $log->user->name ?? 'N/A' }}</td>
                                        <td data-label="Aksi">{{ $log->action }}</td>
                                        <td data-label="Deskripsi">{{ $log->description }}</td>
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
        </div>
    </div>
@endsection
