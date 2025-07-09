<?php

use App\Http\Controllers\Admin\AcaraController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\user\WelcomeController;
use App\Http\Controllers\User\DriverController as UserDriverController;
use App\Http\Controllers\Admin\DriverController as AdminDriverController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PemesananController;
use App\Http\Controllers\admin\PenggunaController;
use App\Http\Controllers\user\AboutController;
use App\Http\Controllers\user\ContactController;
use App\Http\Controllers\user\KomentarController;
use App\Http\Controllers\user\TransaksiController;
use App\Http\Controllers\user\UserController;
use Illuminate\Foundation\Console\AboutCommand;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('otp', function () {
    return view('auth.otp');
});


Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();

        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard.index');
        } elseif ($user->role == 'user') {
            return redirect()->route('user.home.index');
        } else {
            return redirect()->route('auth.login');
        }
    }
    return app(AuthController::class)->showLoginForm();
})->name('login');

// Login POST
Route::post('/', [AuthController::class, 'login']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Register GET
Route::get('/register', function () {
    if (Auth::check()) {
        $user = Auth::user();

        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard.index');
        } elseif ($user->role == 'user') {
            return redirect()->route('user.index');
        } else {
            return redirect()->route('auth.register');
        }
    }
    return app(AuthController::class)->showRegisterForm();
})->name('register');

// Register POST
Route::post('/register', [AuthController::class, 'register']);
Route::get('admin/otp', [AuthController::class, 'showOtpForm'])->name('admin.otp.form');
Route::post('admin/otp', [AuthController::class, 'verifyOtp'])->name('admin.otp.verify');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
    Route::get('Acara', [AcaraController::class, 'index'])->name('Acara.index');
    Route::resource('drivers', AdminDriverController::class);
    Route::get('Laporan', [LaporanController::class, 'index'])->name('Laporan.index');
    Route::delete('/Laporan/{id}', [LaporanController::class, 'destroy'])->name('admin.laporan.destroy');
    Route::get('Pemesanan', [PemesananController::class, 'index'])->name('admin.pemesanan.index');
    Route::post('/pemesanan/{id}/proses', [PemesananController::class, 'proses'])->name('admin.pemesanan.proses');
    Route::post('/pemesanan/{id}/selesai', [PemesananController::class, 'selesai'])->name('admin.pemesanan.selesai');
     Route::resource('pengguna', PenggunaController::class);
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('Home', [WelcomeController::class, 'index'])->name('user.home.index');
    Route::get('Driver', [UserDriverController::class, 'index'])->name('driver.index');
    Route::get('Komentar', [KomentarController::class, 'index'])->name('komentar.index');
    Route::post('Komentar/store', [KomentarController::class, 'store'])->name('user.komentar.store');
    Route::get('Contact', [ContactController::class, 'index'])->name('contact.index');
    Route::get('About', [AboutController::class, 'index'])->name('about.index');
    Route::get('Profile', [UserController::class, 'index'])->name('profile.index');
    Route::post('Profile',[UserController::class, 'update'])->name('profile.update');
    Route::resource('transaksi', TransaksiController::class);
    Route::get('/cek-status-transaksi', function () {
    $transaksi = \App\Models\Transaksi::where('user_id', Auth::id())->latest()->first();
    return response()->json([
        'status' => $transaksi?->status ?? 'none',
    ]);
});
});
