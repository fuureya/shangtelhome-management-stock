@extends('layouts.app')

@section('title', 'Log Aktivitas')
@section('page_title', 'Log Aktivitas')

@push('styles')
<style>
    .card-log {
        border-radius: .75rem;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }

    /* Responsive Table to Card styles */
    @media (max-width: 767.98px) {
        .responsive-table-to-card {
            display: block;
            width: 100%;
        }
        .responsive-table-to-card thead {
            display: none; /* Hide table headers */
        }
        .responsive-table-to-card tbody,
        .responsive-table-to-card tr,
        .responsive-table-to-card td {
            display: block;
            width: 100%;
        }
        .responsive-table-to-card tr {
            margin-bottom: 1rem;
            border: 1px solid #e9ecef;
            border-radius: .5rem;
            padding: 1rem;
        }
        .responsive-table-to-card td {
            padding: 0.5rem 0;
            border: none;
            position: relative;
            padding-left: 50%; /* Space for the label */
            text-align: right;
        }
        .responsive-table-to-card td:before {
            content: attr(data-label);
            position: absolute;
            left: 0.5rem;
            width: calc(50% - 1rem);
            padding-right: 10px;
            white-space: nowrap;
            text-align: left;
            font-weight: bold;
            color: #333;
        }
    }
</style>
@endpush

@section('content')
    <div class="card card-log mb-4">
        <div class="card-header">
            <i class="bi bi-clock-history me-2"></i>
            Semua Log Aktivitas
        </div>
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
                        @forelse ($logs as $log)
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

            <div class="mt-4">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
@endsection
