@extends('user.layout')

@section('body')
    <main class="flex-1 p-6">
      <!-- Header -->
   

      <!-- Hero Section -->
      <div class="img mt-8 rounded-xl shadow-lg min-h-[320px] flex items-center justify-center">
        <div class="glass p-10 rounded-lg text-white text-center max-w-3xl mx-auto">
          <h3 class="text-4xl font-bold mb-4">Sistem Manajemen Driver</h3>
          <p class="text-lg mb-4">
            Mengelola data driver kini lebih mudah dan efisien. Sistem kami menyediakan fitur lengkap mulai dari pemantauan, informasi, hingga penjadwalan driver secara terpusat dan real-time.
          </p>
          <p class="mb-6 text-sm text-gray-200">
            Kami berkomitmen memberikan solusi teknologi yang tepat guna, terpercaya, dan responsif untuk kebutuhan Anda.
          </p>
          <a href="Contact"
            class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-medium px-6 py-2 rounded transition duration-300">Hubungi Kami</a>
        </div>
      </div>

      <!-- Tim Kami -->
     <!-- Penghargaan -->
<div class="mt-12">
  <h4 class="text-2xl font-bold text-gray-700 mb-6 text-center">Penghargaan & Pencapaian</h4>
  <div class="grid md:grid-cols-3 gap-6">
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition text-center">
      <div class="text-yellow-500 text-4xl mb-4">
        <i class="fas fa-trophy"></i>
      </div>
      <h5 class="text-lg font-semibold">Penghargaan Inovasi Teknologi 2024</h5>
      <p class="text-sm text-gray-600 mt-2">
        Diakui sebagai salah satu sistem manajemen driver paling inovatif oleh Komunitas Digital Indonesia.
      </p>
    </div>
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition text-center">
      <div class="text-blue-500 text-4xl mb-4">
        <i class="fas fa-award"></i>
      </div>
      <h5 class="text-lg font-semibold">Aplikasi Terbaik 2023</h5>
      <p class="text-sm text-gray-600 mt-2">
        Mendapat penghargaan aplikasi terbaik kategori transportasi dari Web Developer Award.
      </p>
    </div>
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition text-center">
      <div class="text-green-500 text-4xl mb-4">
        <i class="fas fa-medal"></i>
      </div>
      <h5 class="text-lg font-semibold">User Satisfaction Excellence</h5>
      <p class="text-sm text-gray-600 mt-2">
        Tingkat kepuasan pengguna mencapai 98% berdasarkan survei internal pengguna tahun 2024.
      </p>
    </div>
  </div>
</div>

@endsection