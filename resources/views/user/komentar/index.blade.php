@extends('user.layout')

@section('body')
<br>

<!-- Judul -->
<div class="mb-6 bg-white p-4 rounded shadow">
  <h2 class="text-lg font-semibold text-gray-700">Tolong Berikan Masukan Atau Kritik Untuk Halaman Website Go-Flast</h2>
  <p id="currentDate" class="text-gray-600 text-sm"></p>
</div>

<!-- Form Komentar -->
<div class="bg-white p-10 rounded shadow mb-6">
  <form action="{{ route('user.komentar.store') }}" method="POST" class="space-y-4">
    @csrf

    <div>
      <label for="isi" class="block text-sm font-medium text-gray-700">Komentar</label>
      <textarea id="isi" name="isi" required
        class="w-full border border-gray-300 rounded px-3 py-2 mt-1"></textarea>
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
      <div class="flex flex-row-reverse justify-end">
        @for ($i = 5; $i >= 1; $i--)
        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" class="hidden" />
        <label for="star{{ $i }}" class="cursor-pointer text-2xl text-gray-400 hover:text-yellow-400">&#9733;</label>
        @endfor
      </div>
    </div>

    <button type="submit"
      class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">Kirim Komentar</button>
  </form>
</div>

@endsection

@section('script')
<script>
  document.querySelectorAll('input[name="rating"]').forEach((radio) => {
    radio.addEventListener('change', function () {
      let rating = this.value;
      document.querySelectorAll('label[for^="star"]').forEach((label) => {
        label.classList.remove('text-yellow-400');
        label.classList.add('text-gray-400');
      });
      for (let i = 1; i <= rating; i++) {
        document.querySelector(`label[for="star${i}"]`).classList.add('text-yellow-400');
      }
    });
  });
</script>
@endsection