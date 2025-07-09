@extends('admin.layout')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <div class="text-gray-400 text-sm">Dashboard</div>
        <h1 class="text-2xl font-bold text-gray-800">Selamat Datang</h1>
    </div>
    <!-- User dropdown -->
    <div class="relative">
        <button class="flex items-center space-x-2 bg-orange-500 text-white px-4 py-2 rounded focus:outline-none" onclick="toggleDropdown()">
            <i class="fa-solid fa-user"></i>
            <span>User</span>
            <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-40 bg-white border rounded shadow-lg z-10">
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-orange-100">Logout</a>
        </div>
    </div>
@endsection


@section('content')
<div class="bg-white p-6 rounded shadow">
 <div class="flex justify-between items-center mb-4 flex-wrap gap-4">
    <h2 class="text-xl font-semibold text-gray-800">Authors table</h2>
    
    <!-- Search and Add button group -->
    <div class="flex gap-2 flex-wrap">
      <!-- Search Input -->
      <div class="relative">
        <form action="{{ route('pengguna.index')}}" method="GET">
        <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-orange-500">
        <i class="fa fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
        </form>
      </div>

      <!-- Add Button -->
      <a href="{{ route('pengguna.create') }}" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">
        <i class="fa-solid fa-plus"></i> Tambah
     </a>
    </div>
  </div>

  <!-- Example table rows -->
  <table class="min-w-full text-sm text-left">
    <thead>
      <tr class="text-gray-600">
        <th class="py-2">No</th>
        <th class="py-2">Nama</th>
        <th class="py-2">Email</th>
        <th class="py-2">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach( $users as $index => $pengguna)
        <tr class="text-gray-600">
          <td class="py-2 px-4 border-b border-gray-200">{{ $index + 1 }}</td>
          <td class="py-2 px-4 border-b border-gray-200">{{ $pengguna->name }}</td>
          <td class="py-2 px-4 border-b border-gray-200">{{ $pengguna->email }}</td>
          <td class="py-2 px-4 border-b border-gray-200">
            <form action="{{ route('pengguna.destroy',$pengguna->id)}}" method="POST" class="inline delete-form" onsubmit="return confirm('Yakin ingin Menghapus?')">
              @csrf 
              @method('DELETE')
            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
      <!-- Data rows should go here -->
    </tbody>
  </table>
  @endsection