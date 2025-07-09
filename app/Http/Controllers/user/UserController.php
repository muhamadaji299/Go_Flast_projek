<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // ✅ penting: import model User

class UserController extends Controller
{
    public function index()
    {
        return view('user.profile.index');
    }

 public function update(Request $request)
{
    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . Auth::id(),
        'password' => 'nullable|min:6',
    ]);

    // Mengambil user dari database dengan ID yang valid
    $user = \App\Models\User::find(Auth::id()); // pastikan menggunakan namespace yang tepat

    // Perbarui data user
    $user->name = $request->nama;
    $user->email = $request->email;

    // Jika password diisi, lakukan enkripsi dan simpan
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    // Simpan perubahan
    $user->save(); // ✅ ini seharusnya berhasil jika $user adalah instance model User

    return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
}
}
