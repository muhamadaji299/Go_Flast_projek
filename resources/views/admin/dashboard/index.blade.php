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
</form>

        </div>
    </div>
    @endsection

    @section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white rounded shadow p-6 flex items-center gap-4">
        <div class="bg-orange-100 text-orange-500 p-3 rounded-full">
            <i class="fa-solid fa-users fa-lg"></i>
        </div>
        <div>
            <h2 class="text-lg font-semibold text-gray-800">Pengguna</h2>
            <p class="text-gray-500 text-sm">Kelola data pengguna</p>
        </div>
    </div>

    <!-- Laporan -->
    <div class="bg-white rounded shadow p-6 flex items-center gap-4">
        <div class="bg-orange-100 text-orange-500 p-3 rounded-full">
            <i class="fa-solid fa-file-lines fa-lg"></i>
        </div>
        <div>
            <h2 class="text-lg font-semibold text-gray-800">Laporan</h2>
            <p class="text-gray-500 text-sm">Lihat dan cetak laporan</p>
        </div>
    </div>

    <!-- Histori -->
    <div class="bg-white rounded shadow p-6 flex items-center gap-4">
        <div class="bg-orange-100 text-orange-500 p-3 rounded-full">
            <i class="fa-solid fa-clock-rotate-left fa-lg"></i>
        </div>
        <div>
            <h2 class="text-lg font-semibold text-gray-800">Histori</h2>
            <p class="text-gray-500 text-sm">Riwayat aktivitas</p>
        </div>
    </div>
</div>

      <div class="bg-white rounded shadow p-6 mt-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Statistik Pengguna</h2>
        <canvas id="userChart" height="100"></canvas>
      </div>
    </div>
  </div>

    @endsection
    
    @section('script')
<script>
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

//chats 
 const ctx = document.getElementById('userChart').getContext('2d');
    const userChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
        datasets: [{
          label: 'Jumlah Pengguna',
          data: [12, 19, 3, 5, 2, 3],
          backgroundColor: 'rgba(255, 115, 0, 0.6)', // orange semi transparan
          borderColor: 'rgba(255, 115, 0, 1)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
    </script>
    @endsection 