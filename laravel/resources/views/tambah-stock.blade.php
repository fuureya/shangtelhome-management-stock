@extends('layouts.app')

@section('title', 'Tambah Stock')
@section('page_title', 'Tambah Stock')

@section('content')
    <div class="card mb-4">
        <div class="card-header">Tambah Jumlah Stock</div>
        <div class="card-body">
            <form method="POST" action="{{ route('tambah-stock.process') }}">
                @csrf
                <div class="mb-3">
                    <label for="stock_id" class="form-label">Nama Barang</label>
                    <select class="form-select" id="stock_id" name="stock_id" required>
                        <option value="">Pilih Barang</option>
                        @foreach ($stocks as $stock)
                            <option value="{{ $stock->id }}" {{ old('stock_id') == $stock->id ? 'selected' : '' }}>
                                {{ $stock->keterangan }} (Stock: {{ $stock->qty }} {{ $stock->satuan }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jumlah_tambah" class="form-label">Jumlah Ditambahkan</label>
                    <input type="number" class="form-control" id="jumlah_tambah" name="jumlah_tambah" value="{{ old('jumlah_tambah') }}" required min="1">
                </div>
                <button type="submit" class="btn btn-primary">Tambah Stock</button>
            </form>
        </div>
    </div>
@endsection