<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>
<div class="container mx-auto max-w-md p-4 mt-20 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Masukkan Kode jika anda seorang admin OTP</h2>

    @if(session('info'))
        <div class="mb-4 text-blue-600">{{ session('info') }}</div>
    @endif

    @error('otp')
        <div class="mb-4 text-red-600">{{ $message }}</div>
    @enderror

    <form action="{{ route('admin.otp.verify') }}" method="POST">
        @csrf
        <input type="password" name="otp" placeholder="Kode OTP" class="border p-2 w-full mb-4" autofocus>
        <button type="submit" class="bg-orange-500 text-white py-2 px-4 rounded w-full hover:bg-orange-600">Verifikasi</button>
    </form>
</div>
</body>

</html>
