<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100">

  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="fixed w-64 h-screen bg-white shadow p-6">
      <div class="flex items-center space-x-2 mb-8">
        <img src="img/logo-removebg-preview.png" alt="logo">
      </div>
      <nav class="space-y-4">
        <a href="dashboard" class="flex items-center gap-2 text-gray-700 hover:text-orange-500">
          <i class="fa-solid  fa-table-columns"></i> Dashboard
        </a>
         <a href="drivers" class="flex items-center gap-2 text-gray-700 hover:text-orange-500">
          <i class="fa-solid fa-id-card"></i> Driver
        </a>
        <a href="Laporan" class="flex items-center gap-2 text-gray-700 hover:text-orange-500">
          <i class="fa-solid fa-file-lines"></i> Laporan
        </a>
        <a href="pengguna" class="flex items-center gap-2 text-gray-700 hover:text-orange-500">
          <i class="fa-solid fa-user"></i> Pengguna
        </a>
        <a href="Pemesanan" class="flex items-center gap-2 text-gray-700 hover:text-orange-500">
          <i class="fa-solid fa-user"></i> Laporan Transaksi
        </a>
      </nav>
    </aside>

    <!-- Main Content -->
    <div class="ml-64 flex-1 p-6">
      @yield('header')
      </div>

      <!-- Cards -->
       @yield('content')
    </div>
  </div>


  @yield('script')
  <script>
    function toggleDropdown() {
      const menu = document.getElementById('dropdownMenu');
      menu.classList.toggle('hidden');
    }

     function toggleDropdown() {
      const menu = document.getElementById('dropdownMenu');
      menu.classList.toggle('hidden');
    }
  </script>
</body>
</html>
