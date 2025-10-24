@extends('layouts.app')

@section('title', 'Pakai Stock')
@section('page_title', 'Pakai Stock')

@section('content')
    <div class="card mb-4">
        <div class="card-header">Gunakan Stock</div>
        <div class="card-body">
            <form method="POST" action="{{ route('pakai-stock.process') }}">
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
                    <label for="jumlah_pakai" class="form-label">Jumlah Digunakan</label>
                    <input type="number" class="form-control" id="jumlah_pakai" name="jumlah_pakai" value="{{ old('jumlah_pakai') }}" required min="1">
                </div>
                <button type="submit" class="btn btn-primary">Gunakan Stock</button>
            </form>
        </div>
    </div>
@endsection