@extends('user.layout')

@section('body')

@if(session('success'))
  <div id="alertBox" class="bg-green-100 text-green-800 p-3 rounded mb-4 relative">
    <button onclick="document.getElementById('alertBox').style.display='none'" class="absolute top-1 right-2 text-lg font-bold text-green-700 hover:text-green-900">&times;</button>
    {{ session('success') }}
  </div>
@endif


<section class="mt-8 bg-white p-6 rounded shadow-md w-full">

  <h3 class="text-xl font-bold text-orange-500 mb-4">Profil Saya</h3>
  <form action="{{ route('profile.update')}}" method="POST" class="space-y-4">
    @csrf
   <div>
  <label class="block text-gray-700">Nama Lengkap</label>
  <input type="text" name="nama" value="{{ old('nama', auth()->user()->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 focus:ring-orange-500 focus:border-orange-500">
</div>

<div>
  <label class="block text-gray-700">Email</label>
  <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 focus:ring-orange-500 focus:border-orange-500">
</div>

    <div>
      <label class="block text-gray-700">Password Baru</label>
      <input type="password" id="password" name="password" placeholder="Isi jika ingin mengganti" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 focus:ring-orange-500 focus:border-orange-500">
      <div class="mt-2">
        <input type="checkbox" id="togglePassword" class="mr-2">
        <label for="togglePassword" class="text-sm text-gray-600">Lihat Password</label>
      </div>
    </div>

    <div class="pt-4">
      <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition">Simpan Perubahan</button>
    </div>
  </form>
</section>

<script>
  const togglePassword = document.getElementById('togglePassword');
  const passwordField = document.getElementById('password');

  togglePassword.addEventListener('change', function () {
    passwordField.type = this.checked ? 'text' : 'password';
  });
</script>
@endsection
