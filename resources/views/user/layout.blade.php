<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Driver Management Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<style>
  .img {
    background-image: url(img/driver.jpg);
    background-size: cover;
    background-position: center;
    width: 100%;
    height: 75vh;
  }



  .glass {
    backdrop-filter: blur(10px);
    background-color: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.2);
  }
</style>

<body class="bg-gray-100">
  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="fixed w-64 h-screen bg-white shadow p-6 flex flex-col items-start">
      <!-- Logo di bagian atas -->
      <img src="img/logo-removebg-preview.png" alt="logo" class="w-[90px]mb-6 self-center">

      <!-- Navigasi -->
      <nav class="space-y-4 w-full">
        <a href="Home" class="flex items-center gap-2 text-gray-700 hover:text-red-500">
          <i class="fa-solid fa-house"></i> Beranda
        </a>
        <a href="About" class="flex items-center gap-2 text-gray-700 hover:text-red-500">
          <i class="fa-solid fa-info-circle"></i>Tentang Kami
        </a>
        <a href="Driver" class="flex items-center gap-2 text-gray-700 hover:text-red-500">
          <i class="fa-solid fa-id-card"></i> Driver Management
        </a>
        <a href="Komentar" class="flex items-center gap-2 text-gray-700 hover:text-red-500">
          <i class="fa-solid fa-comment"></i> Komentar
        </a>
        <a href="Contact" class="flex items-center gap-2 text-gray-700 hover:text-red-500">
          <i class="fa-solid fa-envelope"></i>Contact
        </a>
        <p class="text-gray-700">Profile</p>
        <a href="Profile" class="border border-gray-300 rounded-lg flex items-center gap-2 px-3 py-2 hover:text-red-500">
          <!-- Foto profil bulat -->
          <img src="img/default-user.jpeg" alt="Profile" class="w-10 h-10 rounded-full">

          <!-- Teks profil -->
          <div class="text-sm font-medium text-gray-700">
            {{ Auth::user()->name}}
          </div>
        </a>


      </nav>
    </aside>

    <!-- Main Content -->
    <main class="ml-64 flex-1 p-6">
      <div class="flex justify-between items-center flex-wrap gap-4">
        <div>
          <h2 class="text-2xl text-orange-500 font-bold">GO-FLAST DRIVER</h2>
          <p class="text-gray-600">Website Yg Menyediakan Layanan Driver </p>
        </div>
        <div class="flex items-center gap-4">
          <div class="relative inline-block text-left">
            <button id="dropdownBtn"
              class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
              Hello, <span class="text-orange-500">{{ Auth::user()->name}}</span>
            </button>
            <div id="dropdownMenu"
              class="hidden absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10">
              <div class="py-1">
                   <a href="Profile" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                  @csrf
                  <button class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                </form>
              </div>
            </div>
          </div>

        </div>
      </div>


      @yield('body')

  </div>




  </main>
  </div>


  @yield('script')
  <script>
    document.getElementById('dropdownBtn').addEventListener('click', function() {
      const menu = document.getElementById('dropdownMenu');
      menu.classList.toggle('hidden');
    });
    document.addEventListener('click', function(event) {
      const dropdown = document.getElementById('dropdownMenu');
      const button = document.getElementById('dropdownBtn');
      if (!button.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.classList.add('hidden');
      }

      const kendaraanMenu = document.getElementById('kendaraanDropdownMenu');
      const kendaraanBtn = document.getElementById('kendaraanDropdownBtn');
      if (!kendaraanBtn.contains(event.target) && !kendaraanMenu.contains(event.target)) {
        kendaraanMenu.classList.add('hidden');
      }
    });

    document.getElementById('kendaraanDropdownBtn').addEventListener('click', function() {
      const kendaraanMenu = document.getElementById('kendaraanDropdownMenu');
      kendaraanMenu.classList.toggle('hidden');
    });
  </script>
</body>

</html>