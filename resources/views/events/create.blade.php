<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <title>Tambah Event</title>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #111827; /* gray-900 */
    }
    .form-input {
      background-color: rgba(31, 41, 55, 0.5);
      transition: all 0.3s ease;
    }
    .form-input:focus {
      box-shadow: 0 0 0 2px rgba(156, 163, 175, 0.3);
      border-color: #4b5563; /* gray-600 */
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

  <div class="bg-gray-800 rounded-lg border border-gray-700 shadow-lg p-6 w-full max-w-md">
    <h1 class="text-2xl font-bold text-gray-100 mb-6 flex items-center">
      <i class="fas fa-calendar-plus mr-2 text-blue-400"></i>Tambah Event
    </h1>

    @if ($errors->any())
      <div class="mb-4 p-3 bg-gray-700 border-l-4 border-red-500 rounded-lg">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <i class="fas fa-exclamation-circle text-red-400"></i>
          </div>
          <div class="ml-3">
            <h3 class="text-sm font-medium text-red-300">
              Terdapat {{ $errors->count() }} kesalahan
            </h3>
            <div class="mt-2 text-sm text-red-200">
              <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    @endif

    <form action="{{ route('events.store') }}" method="POST">
      @csrf

      <div class="mb-4">
        <label for="title" class="block text-sm font-medium text-gray-300 mb-2">Judul</label>
        <div class="relative rounded-md shadow-sm">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-heading text-gray-500"></i>
          </div>
          <input type="text" name="title" id="title" required
                 value="{{ old('title') }}"
                 class="form-input block w-full pl-10 py-2 border border-gray-600 rounded-md text-gray-100 placeholder-gray-500"
                 placeholder="Masukkan judul event">
        </div>
      </div>

      <div class="mb-4">
        <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Deskripsi</label>
        <div class="relative rounded-md shadow-sm">
          <div class="absolute inset-y-0 left-0 pl-3 pt-3 pointer-events-none">
            <i class="fas fa-align-left text-gray-500"></i>
          </div>
          <textarea name="description" id="description" rows="3" required
                    class="form-input block w-full pl-10 py-2 border border-gray-600 rounded-md text-gray-100 placeholder-gray-500"
                    placeholder="Masukkan deskripsi event">{{ old('description') }}</textarea>
        </div>
      </div>

      <div class="mb-6">
        <label for="date" class="block text-sm font-medium text-gray-300 mb-2">Tanggal</label>
        <div class="relative rounded-md shadow-sm">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-calendar-day text-gray-500"></i>
          </div>
          <input type="date" name="date" id="date" required
                 value="{{ old('date') }}"
                 class="form-input block w-full pl-10 py-2 border border-gray-600 rounded-md text-gray-100">
        </div>
      </div>

      <div class="flex justify-between items-center pt-4 border-t border-gray-700">
        <a href="{{ route('events.index') }}" 
           class="text-gray-400 hover:text-gray-200 transition-colors flex items-center">
          <i class="fas fa-arrow-left mr-2"></i> Batal
        </a>
        <button type="submit" 
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-500 transition-colors flex items-center">
          <i class="fas fa-save mr-2"></i> Simpan
        </button>
      </div>
    </form>
  </div>

</body>
</html>