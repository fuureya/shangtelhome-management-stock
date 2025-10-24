<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::all();
        return view('kelola-stock', compact('stocks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'keterangan' => 'required|string|max:255',
            'qty' => 'nullable|integer',
            'satuan' => 'nullable|string|max:255',
        ]);

        $stock = Stock::create([
            'keterangan' => $request->keterangan,
            'qty' => $request->qty,
            'satuan' => $request->satuan,
            'created_by' => Auth::user()->username,
        ]);

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'model_type' => Stock::class,
            'model_id' => $stock->id,
            'new_data' => $stock->toJson(),
            'description' => 'Menambah stock baru: ' . $stock->keterangan,
        ]);

        return redirect()->route('kelola-stock.index')->with('success', 'Stock added successfully!');
    }

    public function destroy(Stock $stock)
    {
        $oldData = $stock->toJson();
        $stock->delete();

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'model_type' => Stock::class,
            'model_id' => $stock->id,
            'old_data' => $oldData,
            'description' => 'Menghapus stock: ' . $stock->keterangan,
        ]);

        return redirect()->route('kelola-stock.index')->with('success', 'Stock deleted successfully!');
    }

    public function edit(Stock $stock)
    {
        return view('edit-stock', compact('stock'));
    }

    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'keterangan' => 'required|string|max:255',
            'qty' => 'nullable|integer',
            'satuan' => 'nullable|string|max:255',
        ]);

        $oldData = $stock->toJson();

        $stock->update([
            'keterangan' => $request->keterangan,
            'qty' => $request->qty,
            'satuan' => $request->satuan,
            'edited_by' => Auth::user()->username,
        ]);

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'model_type' => Stock::class,
            'model_id' => $stock->id,
            'old_data' => $oldData,
            'new_data' => $stock->toJson(),
            'description' => 'Memperbarui stock: ' . $stock->keterangan,
        ]);

        return redirect()->route('kelola-stock.index')->with('success', 'Stock updated successfully!');
    }

    public function pakaiStockForm()
    {
        $stocks = Stock::where('qty', '>', 0)->get();
        return view('pakai-stock', compact('stocks'));
    }

    public function pakaiStock(Request $request)
    {
        $request->validate([
            'stock_id' => 'required|exists:stock,id',
            'jumlah_pakai' => 'required|integer|min:1',
        ]);

        $stock = Stock::find($request->stock_id);

        if (!$stock) {
            return back()->withErrors(['stock_id' => 'Stock tidak ditemukan.']);
        }

        if ($stock->qty < $request->jumlah_pakai) {
            return back()->withErrors(['jumlah_pakai' => 'Jumlah yang dipakai melebihi stock yang tersedia.']);
        }

        $oldData = $stock->toJson();

        $stock->qty -= $request->jumlah_pakai;
        $stock->edited_by = Auth::user()->username;
        $stock->save();

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'action' => 'use_stock',
            'model_type' => Stock::class,
            'model_id' => $stock->id,
            'old_data' => $oldData,
            'new_data' => $stock->toJson(),
            'description' => 'Menggunakan ' . $request->jumlah_pakai . ' ' . $stock->satuan . ' dari stock: ' . $stock->keterangan,
        ]);

        return redirect()->route('pakai-stock.form')->with('success', 'Stock berhasil digunakan!');
    }

    public function showDashboard()
    {
        $logAktivitas = LogAktivitas::with('user')->latest()->take(10)->get();
        $allStocks = Stock::all(); // Ambil semua data stock
        return view('dashboard', compact('logAktivitas', 'allStocks'));
    }

    public function tambahStockForm()
    {
        $stocks = Stock::all();
        return view('tambah-stock', compact('stocks'));
    }

    public function tambahStock(Request $request)
    {
        $request->validate([
            'stock_id' => 'required|exists:stock,id',
            'jumlah_tambah' => 'required|integer|min:1',
        ]);

        $stock = Stock::find($request->stock_id);

        if (!$stock) {
            return back()->withErrors(['stock_id' => 'Stock tidak ditemukan.']);
        }

        $oldData = $stock->toJson();

        $stock->qty += $request->jumlah_tambah;
        $stock->edited_by = Auth::user()->username;
        $stock->save();

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'action' => 'add_stock',
            'model_type' => Stock::class,
            'model_id' => $stock->id,
            'old_data' => $oldData,
            'new_data' => $stock->toJson(),
            'description' => 'Menambah ' . $request->jumlah_tambah . ' ' . $stock->satuan . ' ke stock: ' . $stock->keterangan,
        ]);

        return redirect()->route('tambah-stock.form')->with('success', 'Stock berhasil ditambahkan!');
    }
}
