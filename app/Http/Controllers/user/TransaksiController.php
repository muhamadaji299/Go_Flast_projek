<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Tampilkan daftar transaksi milik user (opsional).
     */
  public function index()
{
    $transaksi = Transaksi::where('user_id', Auth::id())->latest()->first();

    // Cek apakah ada alert khusus untuk user ini
    $alertKey = 'alert_perjalanan_user_' . Auth::id();
    if (session()->has($alertKey)) {
        session()->flash('alert_perjalanan', true);
    }

    return view('user.pengantar.index', compact('transaksi'));
}


    /**
     * Simpan transaksi baru dari user.
     */

public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string',
        'metode_pembayaran' => 'required|string|in:bank,cash,e-wallet',
    ]);

    // Tangkap detail pembayaran sesuai metode
    $detail = null;

    if ($request->metode_pembayaran === 'bank') {
        $detail = $request->bank ?? 'Bank tidak dipilih';
    } elseif ($request->metode_pembayaran === 'e-wallet') {
        $detail = $request->eWalletAmount ?? '0';
    }

    Transaksi::create([
        'user_id' => Auth::id(), // pastikan user login
        'nama' => $request->nama,
        'alamat' => $request->alamat,
        'metode_pembayaran' => $request->metode_pembayaran,
        'detail_pembayaran' => $detail,
        'status' => 'pending',
    ]);

    return redirect()->back()->with('success', 'Pesanan berhasil dikirim!');
}

}
