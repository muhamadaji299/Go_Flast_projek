<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function index(){
        $transaksi = Transaksi::with('user')->latest()->get();
        return view('admin.pemesanan.index' , compact('transaksi'));
    }

    public function proses($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update(['status' => 'diproses']);

        return redirect()->back()->with('success', 'Transaksi diproses!');
    }

   public function selesai($id)
{
    $transaksi = Transaksi::findOrFail($id);
    $transaksi->status = 'selesai';
    $transaksi->save();

    // Flash message untuk halaman admin (jika perlu)
    session()->flash('success', 'Transaksi diselesaikan.');

    // Tambahkan session flash khusus untuk user
    session()->flash('alert_perjalanan_user_' . $transaksi->user_id, true);

    return redirect()->back();
}

}

