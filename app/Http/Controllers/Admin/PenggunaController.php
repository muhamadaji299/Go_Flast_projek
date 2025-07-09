<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();  // Inisialisasi query
    
        // Cek apakah ada input pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
    
            // Cari berdasarkan nama atau email
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
    
        // Ambil data hasil query
        $users = $query->get();  // Gunakan nama variabel yang benar dan konsisten
    
        return view('admin.pengguna.index', compact('users'));
    }

    // Form tambah pengguna
public function create()
{
    return view('admin.pengguna.create');
}

// Proses simpan pengguna baru
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'role' => 'required|string|in:admin,user',
        'password' => 'required|string|min:6|confirmed',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'password' => bcrypt($request->password),
    ]);

    return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);  // Menemukan user berdasarkan ID

        if (!$user) {
            return redirect()->route('pengguna.index')->with('error', 'Pengguna tidak ditemukan!');
        }

        $user->delete();
        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil dihapus');
    }
}
