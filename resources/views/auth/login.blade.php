<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">

  <div class="flex w-full max-w-6xl bg-white shadow-lg rounded-lg overflow-hidden">
    <!-- Left Side -->
    <div class="w-1/2 relative bg-cover bg-center" style="background-image: url('img/driver.jpg');">
      <div class="absolute top-4 left-4">
        <img src="img/logo-removebg-preview.png" alt="Logo" style="height: 100px;" class="rounded-full  ">
      </div>
      <div class="absolute bottom-10 left-6 text-white p-4 max-w-xs">
        <h2 class="text-2xl font-bold">GO-FLAST</h2>
        <p class="text-sm text-white/90 mt-2">Suatu web site yg dapat menyediakan kemudahan bagi pada pengguna</p>
      </div>
    </div>

    <!-- Right Side -->
    <div class="w-1/2 p-10">
      <h2 class="text-2xl font-bold text-orange-500 mb-2">GO FLAST</h2>
      <p class="text-gray-500 mb-6">Sign in to access your account</p>

     <form method="POST" action="{{ route('login') }}">
  @csrf
  <div class="mb-4">
    <label class="block text-sm text-gray-700 mb-1">Email Address</label>
    <input name="email" type="email" placeholder="example@example.com" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-orange-500" required>
  </div>

  <div class="mb-4">
    <label class="block text-sm text-gray-700 mb-1">Password</label>
    <input name="password" type="password" placeholder="Your Password" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-orange-500" required>
  </div>

  <div class="flex justify-between items-center mb-4">
    <label class="text-sm text-gray-600">
      <input type="checkbox" name="remember" class="mr-1"> Remember me
    </label>
    <a href="#" class="text-sm text-orange-500 hover:underline">Forgot password?</a>
  </div>

  <button type="submit" class="w-full bg-orange-500 text-white py-2 rounded hover:bg-orange-600">Sign in</button>

  <p class="text-sm text-gray-600 mt-4 text-center">
    Don’t have an account yet?
    <a href="{{ route('register')}}" class="text-orange-500 hover:underline">Sign up.</a>
  </p>
</form>

    </div>
  </div>

</body>
</html>
