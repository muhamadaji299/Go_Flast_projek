@extends('user.layout')

@section('body')

<div class="flex justify-between items-center mt-6 flex-wrap gap-4">
  <div class="relative w-full max-w-md">
    <input type="text" class="w-full pl-10 pr-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Cari Driver">
    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
      <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
      </svg>
    </div>
  </div>

  <div class="relative inline-block text-left">
    <button id="kendaraanDropdownBtn" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
      <i class="fas fa-wind mr-2"></i>Kendaraan
    </button>
    <div id="kendaraanDropdownMenu" class="hidden absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10">
      <div class="py-1">
        <a href="{{ route('driver.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left">
          <i class="fas fa-list mr-2"></i>All
        </a>
        <a href="{{ route('driver.index', ['vehicle_type' => 'mobil']) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left">
          <i class="fas fa-car mr-2"></i>Mobil
        </a>
        <a href="{{ route('driver.index', ['vehicle_type' => 'motor']) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left">
          <i class="fas fa-motorcycle mr-2"></i>Motor
        </a>
      </div>
    </div>
  </div>
</div>


<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
  @foreach($driver as $item)
  <!-- Driver Card -->
  <div class="bg-white p-4 rounded-lg shadow">
    <p class="text-sm text-gray-500">Driver ID: <span class="text-orange-500 font-semibold">{{ $loop->iteration }}</span></p>
    <img src="{{ asset('storage/' . $item->photo) }}" alt="Driver" class="w-16 h-16 rounded-full my-3 object-cover">
    <p><strong>Nama Driver:</strong> {{ $item->name }}</p>
    <p><strong>Telepon:</strong> {{ $item->telepon }}</p>
    <p><strong>Email:</strong> {{ $item->email }}</p>
    <p><strong>Lokasi:</strong> {{ $item->location }}</p>
      <p><strong>Type Kendaraan:</strong> {{ $item->vehicle_type }}</p>
    <p><strong>Deskripsi:</strong> {{ $item->description }}</p>
   <button type="button" class="order-btn mt-4 inline-block bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold px-4 py-2 rounded">
  Pesan Sekarang
</button>

  </div>

  @endforeach
</div>


<!-- Pagination -->
<div class="flex justify-center gap-4 mt-8">
  <button class="px-4 py-2 border rounded hover:bg-gray-100">&lt; Previous Page</button>
  <button class="px-4 py-2 border rounded hover:bg-gray-100">Next Page &gt;</button>
</div>

<!-- ... bagian atas tetap ... -->

<!-- Modal Pemesanan -->
<div id="orderModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
  <div class="bg-white rounded-lg p-6 w-full max-w-2xl relative flex gap-6">
    <div class="flex-1">
      <h3 class="text-xl font-semibold mb-4 text-orange-500">Form Pemesanan Driver</h3>
      <form id="orderForm" method="POST" action="{{ route('transaksi.store')}}" class="space-y-4">
        @csrf
        <div>
          <label for="name" class="block font-medium text-gray-700">Nama</label>
          <input type="text" name="nama" id="name" required class="w-full border border-gray-300 rounded px-3 py-2" />
        </div>
        <div>
          <label for="address" class="block font-medium text-gray-700">Alamat</label>
          <textarea id="address" name="alamat" required class="w-full border border-gray-300 rounded px-3 py-2"></textarea>
        </div>
        <div>
          <label for="paymentMethod" class="block font-medium text-gray-700">Metode Pembayaran</label>
          <select id="paymentMethod" name="metode_pembayaran" required
            class="w-full border border-gray-300 rounded px-3 py-2">
            <option value="">Pilih Metode Pembayaran</option>
            <option value="bank">Bank</option>
            <option value="cash">Cash</option>
            <option value="e-wallet">E-Wallet</option>
          </select>
        </div>

        <!-- ✅ Sidebar dinamis pindah ke dalam form -->
        <div id="paymentSidebar" class="w-full border border-gray-300 rounded p-4 hidden">
          <!-- Konten dinamis dari JS -->
        </div>

        <div class="flex justify-end gap-2 mt-4">
          <button type="button" id="cancelBtn"
            class="px-4 py-2 rounded border border-gray-300 hover:bg-gray-100">Batal</button>
          <button type="submit"
            class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">Kirim Pesanan</button>
        </div>
      </form>
    </div>

    <!-- Tombol close -->
    <button id="closeModalBtn"
      class="absolute top-2 right-3 text-gray-500 hover:text-gray-700 text-xl font-bold">&times;</button>
  </div>
</div>

@endsection

<script>
setInterval(function () {
  fetch('/cek-status-transaksi')
    .then(response => response.json())
    .then(data => {
      if (data.status === 'selesai' && !window.alertShown) {
        window.alertShown = true; // Agar tidak muncul berkali-kali
        alert('Driver Anda sedang dalam perjalanan! 🚗');
      }
    });
}, 3000); // Cek ke server tiap 3 detik
</script>



@section('script')

<script>
  const orderModal = document.getElementById('orderModal');
  const closeModalBtn = document.getElementById('closeModalBtn');
  const cancelBtn = document.getElementById('cancelBtn');
  const orderForm = document.getElementById('orderForm');
  const paymentMethod = document.getElementById('paymentMethod');
  const paymentSidebar = document.getElementById('paymentSidebar');
  const orderButtons = document.querySelectorAll('.order-btn');

  orderButtons.forEach(btn => {
    btn.addEventListener('click', (e) => {
      orderModal.classList.remove('hidden');
      orderModal.classList.add('flex');
    });
  });

  function closeModal() {
    orderModal.classList.add('hidden');
    orderModal.classList.remove('flex');
    orderForm.reset();
    paymentSidebar.innerHTML = '';
    paymentSidebar.classList.add('hidden');
  }

  closeModalBtn.addEventListener('click', closeModal);
  cancelBtn.addEventListener('click', closeModal);

  // Handle perubahan metode pembayaran
  paymentMethod.addEventListener('change', function () {
    const val = this.value;
    paymentSidebar.innerHTML = '';
    paymentSidebar.classList.add('hidden');

   if (val === 'bank') {
  paymentSidebar.classList.remove('hidden');
  paymentSidebar.innerHTML = `
    <h4 class="font-semibold mb-3 text-orange-500">Pilih Bank</h4>
    <select name="bank" class="w-full border border-gray-300 rounded px-3 py-2">
      <option value="">-- Pilih Bank --</option>
      <option value="bca">BCA</option>
      <option value="mandiri">Mandiri</option>
      <option value="bri">BRI</option>
      <option value="bni">BNI</option>
    </select>
    <input type="number" name="eWalletAmount" placeholder="Masukkan Nomor Rekening" min="0" class="w-full border border-gray-300 rounded px-3 py-2 mt-3" />
  `;


    } else if (val === 'e-wallet') {
      paymentSidebar.classList.remove('hidden');
      paymentSidebar.innerHTML = `
        <h4 class="font-semibold mb-3 text-orange-500">Jumlah Pembayaran</h4>
        <input type="number" name="eWalletAmount" placeholder="Masukkan jumlah" min="0" class="w-full border border-gray-300 rounded px-3 py-2" />
      `;
    }
  });

  // Tidak perlu e.preventDefault di sini
  // Biarkan browser submit form ke Laravel

  // Dropdown menu handler
  document.getElementById('dropdownBtn').addEventListener('click', function () {
    const menu = document.getElementById('dropdownMenu');
    menu.classList.toggle('hidden');
  });

  document.addEventListener('click', function (event) {
    const dropdown = document.getElementById('dropdownMenu');
    const button = document.getElementById('dropdownBtn');
    if (!button.contains(event.target) && !dropdown.contains(event.target)) {
      dropdown.classList.add('hidden');
    }

  });

    document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('kendaraanDropdownBtn').addEventListener('click', function () {
      const kendaraanMenu = document.getElementById('kendaraanDropdownMenu');
      kendaraanMenu.classList.toggle('hidden');
    });
  });

  

  document.getElementById('kendaraanDropdownBtn').addEventListener('click', function () {
    const kendaraanMenu = document.getElementById('kendaraanDropdownMenu');
    kendaraanMenu.classList.toggle('hidden');
  });
</script>
@endsection