<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DriverController extends Controller
{
    public function index(Request $request)
    {
        $query = Driver::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('location', 'like', '%' . $search . '%')
                  ->orWhere('vehicle_type', 'like', '%' . $search . '%'); // diperbaiki dari 'category'
        }

        $drivers = $query->latest()->paginate(10);
        return view('admin.driver.index', compact('drivers'));
    }

    public function create()
    {
        return view('admin.driver.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'required|image',
            'location' => 'required|string|max:255',
            'telepon' => 'required|digits_between:10,15',
            'email' => 'required|email',
            'description' => 'required|string',
            'vehicle_type' => 'required|in:motor,mobil',
        ]);

        // Upload photo
        $validated['photo'] = $request->file('photo')->store('drivers', 'public');

        // Simpan langsung
        Driver::create($validated);

        return redirect()->route('drivers.index')->with('success', 'Driver berhasil ditambahkan!');
    }

    public function edit(Driver $driver)
    {
        return view('admin.driver.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image',
            'location' => 'required|string|max:255',
            'telepon' => 'required|digits_between:10,15',
            'email' => 'required|email',
            'description' => 'required|string',
            'vehicle_type' => 'required|in:motor,mobil',
        ]);

        $data = [
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'telepon' => $request->telepon,
            'email' => $request->email,
            'vehicle_type' => $request->vehicle_type,
        ];

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($driver->photo && Storage::disk('public')->exists($driver->photo)) {
                Storage::disk('public')->delete($driver->photo);
            }

            $data['photo'] = $request->file('photo')->store('drivers', 'public');
        }

        $driver->update($data);

        return redirect()->route('drivers.index')->with('success', 'Driver berhasil diperbarui');
    }

    public function destroy(Driver $driver)
    {
        if ($driver->photo && Storage::disk('public')->exists($driver->photo)) {
            Storage::disk('public')->delete($driver->photo);
        }

        $driver->delete();

        return redirect()->route('drivers.index')->with('success', 'Driver berhasil dihapus');
    }
}
