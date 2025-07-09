<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tambah Driver Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body class="bg-gray-50 min-h-screen flex flex-col justify-center py-10">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
        <div class="flex justify-between items-center mb-8">
            <div>
                <div class="text-gray-400 text-sm font-medium">Dashboard</div>
                <h1 class="text-3xl font-bold text-gray-900">Tambah Driver</h1>
            </div>
            <a href="{{ route('drivers.index') }}" 
               class="inline-flex items-center gap-2 bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 transition">
               <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('drivers.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-gray-700 font-semibold mb-2">Nama Driver</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500" />
            </div>

            <div>
                <label for="photo" class="block text-gray-700 font-semibold mb-2">Foto Driver</label>
                <input type="file" name="photo" id="photo" accept="image/*" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 cursor-pointer focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500" />
            </div>

            <div>
                <label for="location" class="block text-gray-700 font-semibold mb-2">Lokasi</label>
                <input type="text" name="location" id="location" value="{{ old('location') }}" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500" />
            </div>

              <div>
                <label for="telepon" class="block text-gray-700 font-semibold mb-2">Telepon</label>
                <input type="number" name="telepon" id="telepon" value="{{ old('telepon') }}" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500" />
            </div>

              <div>
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500" />
            </div>

            <div>
                <label for="description" class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                <textarea name="description" id="description" rows="4" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 resize-y focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">{{ old('description') }}</textarea>
            </div>

            <div>
                <label for="vehicle_type" class="block text-gray-700 font-semibold mb-2">Jenis Kendaraan</label>
                <select name="vehicle_type" id="vehicle_type" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 cursor-pointer focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                    <option value="" disabled {{ old('vehicle_type') ? '' : 'selected' }}>-- Pilih Jenis Kendaraan --</option>
                    <option value="motor" {{ old('vehicle_type') == 'motor' ? 'selected' : '' }}>Motor</option>
                    <option value="mobil" {{ old('vehicle_type') == 'mobil' ? 'selected' : '' }}>Mobil</option>
                </select>
            </div>

            <button type="submit" 
                class="w-full bg-orange-500 text-white font-semibold py-3 rounded-lg hover:bg-orange-600 transition">
                Simpan
            </button>
        </form>
    </div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();

    Swal.fire({
      title: 'Konfirmasi',
      text: "Apakah Anda yakin ingin menyimpan data driver ini?",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#F97316',
      cancelButtonColor: '#6B7280',
      confirmButtonText: 'Ya, simpan!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        this.submit();
      }
    });
  });
</script>

</body>
</html>
