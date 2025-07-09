@layout('admin.layout')

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
            <span>User</span>
            <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-40 bg-white border rounded shadow-lg z-10">
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-orange-100">Logout</a>
        </div>
    </div>
@endsection

@section('body')

 <!-- Tanggal dan Tahun -->
            <div class="mb-6 bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold text-gray-800">Hari Ini</h2>
                <p id="currentDate" class="text-gray-600 text-sm"></p>
            </div>

            <!-- Form Buat Acara -->
            <div class="bg-white p-6 rounded shadow mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Buat Acara</h2>
                <form id="eventForm" class="space-y-4">
                    <div>
                        <label for="eventName" class="block text-sm font-medium text-gray-700">Nama Acara</label>
                        <input type="text" id="eventName" required
                            class="w-full border border-gray-300 rounded px-3 py-2 mt-1" />
                    </div>
                    <div>
                        <label for="eventDate" class="block text-sm font-medium text-gray-700">Tanggal</label>
                        <input type="date" id="eventDate" required
                            class="w-full border border-gray-300 rounded px-3 py-2 mt-1" />
                    </div>
                    <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">Tambah
                        Acara</button>
                </form>
            </div>

               <div class="bg-white p-6 rounded shadow">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Daftar Acara</h2>
                <ul id="eventList" class="space-y-2">
                    <!-- Acara akan ditambahkan di sini -->
                </ul>
            </div>
@endsection


@section('scripts')
<script>
 // Tampilkan tanggal hari ini
            document.getElementById("currentDate").textContent = new Date().toLocaleDateString("id-ID", {
                weekday: "long", year: "numeric", month: "long", day: "numeric"
            });

            // Tambah acara ke daftar
            document.getElementById("eventForm").addEventListener("submit", function (e) {
                e.preventDefault();
                const name = document.getElementById("eventName").value;
                const date = document.getElementById("eventDate").value;

                if (!name || !date) return;

                const list = document.getElementById("eventList");

                const li = document.createElement("li");
                li.className = "flex justify-between items-center bg-gray-100 px-4 py-2 rounded";

                li.innerHTML = `
      <span>${new Date(date).toLocaleDateString("id-ID")}: ${name}</span>
      <button class="text-red-500 hover:text-red-700 font-semibold" onclick="this.parentElement.remove()">Hapus</button>
    `;

                list.appendChild(li);
                e.target.reset();
            });

</script>

@endsection