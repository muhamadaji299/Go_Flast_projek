<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
      public function showLoginForm()
    {
        return view('auth.login'); // Halaman login yang sama untuk admin & kasir
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cek apakah user ada dan cocok dengan role
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Arahkan sesuai role
            if ($user->role === 'admin') {
                   Auth::logout(); // logout dulu sebelum OTP
                
                // Simpan user id di session untuk OTP
                session([
                    'admin_otp_user_id' => $user->id,
                ]);

              return redirect()->route('admin.otp.form')->with('info', 'Masukkan kode OTP untuk masuk.');
            } elseif ($user->role === 'user') {
                return redirect()->route('user.home.index');
            }
        }

        // Jika login gagal, kembalikan dengan pesan error
        return back()->withErrors(['email' => 'Email atau password salah!']);
    }   


    public function showRegisterForm(){
        return view('auth.register');
    }

    public function register(Request $request){
        $request->validate([
            'name' =>'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user', // role default "user"
        ]);

        return redirect()->route('login')->with('success','Register berhasil! silahkan login terlebih dahulu');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }


    //kode otp
      public function showOtpForm()
    {
        if (!session('admin_otp_user_id')) {
            return redirect()->route('login')->withErrors('Silahkan login terlebih dahulu.');
        }
        return view('auth.otp');
    }

     public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required',
        ]);

        // Kode OTP simulasi yang bisa kamu ubah di sini:
        $correctOtp = '085716451180';

        if ($request->otp === $correctOtp) {
            // Login ulang user admin dengan ID dari session
            $user = \App\Models\User::find(session('admin_otp_user_id'));

            if ($user && $user->role === 'admin') {
                Auth::login($user);
                
                // Hapus session OTP
                session()->forget('admin_otp_user_id');
                
                return redirect()->route('admin.dashboard.index')->with('success', 'Selamat datang admin!');
            }
        }

        return back()->withErrors(['otp' => 'Kode OTP salah']);
    }
}
