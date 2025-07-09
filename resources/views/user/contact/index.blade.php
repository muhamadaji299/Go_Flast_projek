@extends('user.layout')

@section('body')

<div class="flex min-h-screen">
    <!-- Main Content -->
    <main class="flex-1 p-6">

        <div class="flex flex-col md:flex-row gap-6">
            <!-- Google Map -->
            <div class="md:flex-1 bg-white p-6 rounded-lg shadow-lg flex flex-col items-start space-y-6">
                <!-- Google Map -->
                <div class="w-full h-64 rounded-lg overflow-hidden shadow">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3162.914882086749!2d-122.08424908469293!3d37.42206577982547!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb7307a1592b5%3A0xdea53ca794d2a41f!2sGoogleplex!5e0!3m2!1sen!2sid!4v1686248673907!5m2!1sen!2sid"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                <!-- Media Sosial Vertikal -->
                <div class="space-y-4 text-gray-700">
                    <div class="flex items-center space-x-3">
                        <i class="fab fa-facebook text-blue-600 text-xl"></i>
                        <span>Facebook: Goflast Official</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fab fa-twitter text-blue-400 text-xl"></i>
                        <span>Twitter: @goflast_id</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fab fa-instagram text-pink-500 text-xl"></i>
                        <span>Instagram: @goflast</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fab fa-linkedin text-blue-700 text-xl"></i>
                        <span>LinkedIn: Goflast Company</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-envelope text-red-500 text-xl"></i>
                        <span>Email: goflast@gmail.com</span>
                    </div>
                </div>
            </div>


            <!-- Form Komentar -->
            <form action="#" method="POST" class="md:flex-1 bg-white p-6 rounded-lg shadow-lg flex flex-col">
                <h3 class="text-xl font-semibold mb-4 text-orange-500">Tinggalkan Pesan</h3>
                <div class="mb-4">
                    <label for="name" class="block mb-1 font-medium text-gray-700">Nama</label>
                    <input type="text" id="name" name="name" required
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500" />
                </div>
                <div class="mb-4">
                    <label for="email" class="block mb-1 font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" required
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500" />
                </div>
                <div class="mb-4 flex-grow">
                    <label for="message" class="block mb-1 font-medium text-gray-700">Pesan</label>
                    <textarea id="message" name="message" rows="5" required
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 resize-none"></textarea>
                </div>
                <button type="submit"
                    class="bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-600 transition-colors mt-auto">
                    Kirim
                </button>

                <!-- Social Media bawah form -->
            </form>
        </div>
    </main>
</div>
@endsection