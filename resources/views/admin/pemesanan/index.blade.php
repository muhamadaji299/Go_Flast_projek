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
            <h2 class="text-xl font-semibold text-gray-800">Transaksi Table</h2>

            <!-- Search and Add button group -->
            <div class="flex gap-2 flex-wrap">
                <!-- Search Input -->
                <div class="relative">
                    <form action="{{ route('drivers.index')}}" method="get">
                        <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <i class="fa fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </form>
                </div>

              
            </div>
        </div>

        <!-- Example table rows -->
<table class="min-w-full text-sm text-left">
  <thead>
    <tr class="text-gray-600">
      <th class="py-2">No</th>
      <th class="py-2">User</th>
      <th class="py-2">Nama</th>
      <th class="py-2">Metode Pembayaran</th>
      <th class="py-2">Detail</th>
      <th class="py-2">Status</th>
      <th class="py-2">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse($transaksi as $index => $t)
    <tr class="text-gray-600">
      <td class="py-2 px-4 border-b border-gray-200">{{ $index + 1 }}</td>
      <td class="py-2 px-4 border-b border-gray-200">{{ $t->user->name ?? '-' }}</td>
      <td class="py-2 px-4 border-b border-gray-200">{{ $t->nama }}</td>
      <td class="py-2 px-4 border-b border-gray-200">{{ $t->metode_pembayaran }}</td>
      

      <!-- Status Badge -->
      <td class="py-2 px-4 border-b border-gray-200">
        @if($t->status == 'pending')
          <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full inline-flex items-center gap-1">
            <i class="fas fa-clock"></i> Pending
          </span>
        @elseif($t->status == 'diproses')
          <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full inline-flex items-center gap-1">
            <i class="fas fa-spinner fa-spin"></i> Diproses
          </span>
        @elseif($t->status == 'selesai')
          <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full inline-flex items-center gap-1">
            <i class="fas fa-check-circle"></i> Selesai
          </span>
        @endif
      </td>

      <!-- Aksi -->
      <td class=" px-4 border-gray-200 ">
        @if($t->status == 'pending')
        <form action="{{ route('admin.pemesanan.proses', $t->id) }}" method="POST" class="inline">
          @csrf
          <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600" onclick="return confirm('Proses transaksi ini?')">
            <i class="fas fa-play mr-1"></i> Proses
          </button>
        </form>

        @elseif($t->status == 'diproses')
        <form action="{{ route('admin.pemesanan.selesai', $t->id) }}" method="POST" class="inline">
          @csrf
          <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600" onclick="return confirm('Selesaikan transaksi ini?')">
            <i class="fas fa-check mr-1"></i> Selesai
          </button>
        </form>

        @elseif($t->status == 'selesai')
        <span class="text-green-600 text-xl">
          <i class="fas fa-check-circle"></i>
        </span>
        @endif
      </td>
    </tr>
    @empty
    <tr>
      <td colspan="7" class="text-center py-4 text-gray-500">Data transaksi tidak ditemukan.</td>
    </tr>
    @endforelse
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