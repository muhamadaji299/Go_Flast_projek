<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
public function index(Request $request)
{
    $query = Driver::query();

    // Filter berdasarkan vehicle_type jika ada
    if ($request->has('vehicle_type') && $request->vehicle_type != '') {
        $query->where('vehicle_type', $request->vehicle_type);
    }

    // (Opsional) Tambahkan filter pencarian juga
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
              ->orWhere('location', 'like', '%' . $search . '%')
              ->orWhere('vehicle_type', 'like', '%' . $search . '%');
        });
    }

    $driver = $query->latest()->paginate(10);
    return view('user.pengantar.index', compact('driver'));
}

}