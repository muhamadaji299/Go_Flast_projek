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
      <span>{{ Auth::user()->name }}</span>
      <i class="fa-solid fa-chevron-down"></i>
    </button>
    <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-40 bg-white border rounded shadow-lg z-10">
      <form id="logoutForm" action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-orange-100">Logout</button>
      </form>

    </div>
  </div>
  @endsection


  @section('content')
  <div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4 flex-wrap gap-4">
      <h2 class="text-xl font-semibold text-gray-800">Table Laporan</h2>

      <!-- Search and Add button group -->
      <div class="flex gap-2 flex-wrap">
        <!-- Search Input -->
        <div class="relative">
          <form action="{{ route('drivers.index')}}" method="get">
            <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-orange-500">
            <i class="fa fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
          </form>
        </div>

        <!-- Add Button -->

      </div>
    </div>

    <!-- Example table rows -->
    <table class="min-w-full text-sm text-left">
      <thead>
        <tr class="text-gray-600">
          <th class="py-2">No</th>
          <th class="py-2">Nama</th>
          <th class="py-2">Email</th>
          <th class="py-2">Komentar</th>
          <th class="py-2">Rating</th>
          <th class="py-2">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($komentars as $komentar)
        <tr class="text-gray-600">
          <td class="py-2 px-4 border-b border-gray-200">{{ $loop->iteration }}</td>
          <td class="py-2 px-4 border-b border-gray-200">{{ $komentar->user->name ?? '-' }}</td>
          <td class="py-2 px-4 border-b border-gray-200">{{ $komentar->user->email ?? '-'}}</td>
          <td class="py-2 px-4 border-b border-gray-200">{{ $komentar->isi }}</td>
          <td class="py-2 px-4 border-b border-gray-200">{{ $komentar->rating }} / 5</td>
          <td class="py-2 px-4 border-b border-gray-200 space-x-2">
            <form action="{{ route('admin.laporan.destroy', $komentar->id) }}" method="POST" class="inline delete-form">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-600 hover:underline">Hapus</button>
            </form>

          </td>
        </tr>
        <tr>
        
        </tr>
   @endforeach
   
      </tbody>
    </table>
    @endsection
    @section('script')
    <script>
      //alert logoout
      const logoutForm = document.getElementById('logoutForm');

      logoutForm.addEventListener('submit', function(e) {
        e.preventDefault(); // cegah langsung logout

        Swal.fire({
          title: 'Yakin ingin logout?',
          text: "Anda akan keluar dari sesi saat ini.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#F97316',
          cancelButtonColor: '#6B7280',
          confirmButtonText: 'Ya, logout',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            logoutForm.submit(); // submit form jika dikonfirmasi
          }
        });
      });


      //alert hapus
      document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
          e.preventDefault(); // hentikan form submit langsung

          Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data driver akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
          }).then((result) => {
            if (result.isConfirmed) {
              form.submit(); // submit form jika dikonfirmasi
            }
          });
        });
      });
    </script>


    @endsection