<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Komentar;

class LaporanController extends Controller
{
     public function index()
    {
        $komentars = Komentar::with('user')->latest()->get();
        return view('admin.laporan.index', compact('komentars'));
    }

    // Hapus komentar tertentu
    public function destroy($id)
    {
        $komentar = Komentar::findOrFail($id);
        $komentar->delete();

        return redirect()->back()->with('success', 'Komentar berhasil dihapus.');
    }
}
