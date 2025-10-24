@extends('layouts.app')

@section('title', 'Edit Stock')
@section('page_title', 'Edit Stock')

@section('content')
    <div class="card mb-4">
        <div class="card-header">Edit Stock</div>
        <div class="card-body">
            <form method="POST" action="{{ route('kelola-stock.update', $stock->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ old('keterangan', $stock->keterangan) }}" required>
                </div>
                <div class="mb-3">
                    <label for="qty" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="qty" name="qty" value="{{ old('qty', $stock->qty) }}">
                </div>
                <div class="mb-3">
                    <label for="satuan" class="form-label">Satuan</label>
                    <select class="form-select" id="satuan" name="satuan">
                        <option value="">Pilih Satuan</option>
                        <option value="unit" {{ old('satuan', $stock->satuan) == 'unit' ? 'selected' : '' }}>Unit</option>
                        <option value="batang" {{ old('satuan', $stock->satuan) == 'batang' ? 'selected' : '' }}>Batang</option>
                        <option value="roll" {{ old('satuan', $stock->satuan) == 'roll' ? 'selected' : '' }}>Roll</option>
                        <option value="meter" {{ old('satuan', $stock->satuan) == 'meter' ? 'selected' : '' }}>Meter</option>
                        <option value="hasbel" {{ old('satuan', $stock->satuan) == 'hasbel' ? 'selected' : '' }}>Hasbel</option>
                        <option value="potongan" {{ old('satuan', $stock->satuan) == 'potongan' ? 'selected' : '' }}>Potongan</option>
                        <option value="pcs" {{ old('satuan', $stock->satuan) == 'pcs' ? 'selected' : '' }}>Pcs</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update Stock</button>
                <a href="{{ route('kelola-stock.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection