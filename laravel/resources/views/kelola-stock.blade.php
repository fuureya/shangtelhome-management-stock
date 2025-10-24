@extends('layouts.app')

@section('title', 'Kelola Stock')
@section('page_title', 'Kelola Stock')

@section('content')
    <div class="card mb-4">
        <div class="card-header">Tambah Stock Baru</div>
        <div class="card-body">
            <form method="POST" action="{{ route('kelola-stock.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ old('keterangan') }}" required>
                </div>
                <div class="mb-3">
                    <label for="qty" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="qty" name="qty" value="{{ old('qty') }}">
                </div>
                <div class="mb-3">
                    <label for="satuan" class="form-label">Satuan</label>
                    <select class="form-select" id="satuan" name="satuan">
                        <option value="">Pilih Satuan</option>
                        <option value="unit" {{ old('satuan') == 'unit' ? 'selected' : '' }}>Unit</option>
                        <option value="batang" {{ old('satuan') == 'batang' ? 'selected' : '' }}>Batang</option>
                        <option value="roll" {{ old('satuan') == 'roll' ? 'selected' : '' }}>Roll</option>
                        <option value="meter" {{ old('satuan') == 'meter' ? 'selected' : '' }}>Meter</option>
                        <option value="hasbel" {{ old('satuan') == 'hasbel' ? 'selected' : '' }}>Hasbel</option>
                        <option value="potongan" {{ old('satuan') == 'potongan' ? 'selected' : '' }}>Potongan</option>
                        <option value="pcs" {{ old('satuan') == 'pcs' ? 'selected' : '' }}>Pcs</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Stock</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Daftar Stock</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Keterangan</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stocks as $stock)
                            <tr>
                                <td>{{ $stock->id }}</td>
                                <td>{{ $stock->keterangan }}</td>
                                <td>{{ $stock->qty }}</td>
                                <td>{{ $stock->satuan }}</td>
                                <td>{{ $stock->created_by }}</td>
                                <td>{{ $stock->edited_by }}</td>
                                <td>{{ $stock->created_at->format('d M Y H:i') }}</td>
                                <td>{{ $stock->updated_at->format('d M Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('kelola-stock.edit', $stock->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                                    <form action="{{ route('kelola-stock.destroy', $stock->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this stock?');" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">No stock found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection