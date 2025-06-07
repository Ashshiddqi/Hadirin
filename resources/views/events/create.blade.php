<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <title>Tambah Event</title>
  <style>
    /* Dark theme styles */
    body {
      background-color: #0f172a;
      color: #e2e8f0;
      font-family: 'Inter', sans-serif;
    }
    
    /* Form input styling */
    .form-input {
      transition: all 0.3s ease;
      background-color: #1e293b;
      border: 1px solid #334155;
      color: #e2e8f0;
    }
    
    .form-input:focus {
      border-color: #38bdf8;
      box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.3);
    }
    
    /* Select dropdown styling */
    .form-select {
      background-color: #1e293b;
      border: 1px solid #334155;
      color: #e2e8f0;
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%2394a3b8' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
      background-position: right 0.5rem center;
      background-repeat: no-repeat;
      background-size: 1.5em 1.5em;
    }
    
    /* Input icon styling */
    .input-icon {
      color: #64748b;
      transition: color 0.3s ease;
    }
    
    .input-container:focus-within .input-icon {
      color: #38bdf8;
    }
    
    /* Blob background effects */
    .blob {
      position: absolute;
      width: 300px;
      height: 300px;
      background: linear-gradient(135deg, rgba(14, 165, 233, 0.1) 0%, rgba(124, 58, 237, 0.08) 100%);
      border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
      filter: blur(40px);
      z-index: 0;
      animation: float 12s ease-in-out infinite;
    }
    
    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }
    
    .blob-1 {
      top: -100px;
      left: -100px;
      width: 400px;
      height: 400px;
      animation-delay: 0s;
    }
    
    .blob-2 {
      bottom: -50px;
      right: -100px;
      width: 350px;
      height: 350px;
      animation-delay: 2s;
      animation-direction: reverse;
    }
    
    /* Card styling */
    .card {
      background-color: #1e293b;
      border: 1px solid #334155;
      box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.3);
    }
    
    /* Required field indicator */
    .required:after {
      content: " *";
      color: #f87171;
    }
  </style>
</head>
<body class="min-h-screen relative">

  <!-- Blob background elements -->
  <div class="blob blob-1"></div>
  <div class="blob blob-2"></div>

  <!-- Header -->
  <header class="bg-dark-800 shadow-sm sticky top-0 z-10">
    <div class="max-w-7xl mx-auto px-4 py-3 sm:py-4 sm:px-6 lg:px-8 flex justify-between items-center">
      <div class="flex items-center space-x-3 sm:space-x-4">
        <a href="{{ route('events.index') }}" class="text-gray-400 hover:text-gray-200 transition-colors">
          <i class="ph ph-arrow-left text-xl"></i>
        </a>
        <h1 class="text-lg sm:text-xl font-bold text-gray-200">Manajemen Event</h1>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="max-w-7xl mx-auto p-4 sm:p-6 relative z-10">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
      <div>
        <h2 class="text-2xl font-bold text-gray-200">Tambah Event Baru</h2>
        <p class="text-sm text-gray-400">Tambahkan event baru ke dalam sistem</p>
      </div>
    </div>

    <!-- Create Form Card -->
    <div class="card rounded-lg overflow-hidden">
      <!-- Card Header -->
      <div class="px-6 py-4 border-b bg-gradient-to-r from-primary-600 to-primary-700">
        <h3 class="text-lg font-semibold text-white flex items-center">
          <i class="ph ph-calendar-plus mr-2"></i> Informasi Event
        </h3>
      </div>

      <!-- Card Body -->
      <div class="p-6">
        <!-- Error Messages -->
        @if ($errors->any())
          <div class="mb-6 p-4 bg-red-900 bg-opacity-20 border-l-4 border-red-500 rounded-lg">
            <div class="flex items-center">
              <div class="flex-shrink-0 text-red-400">
                <i class="ph ph-warning-circle text-xl"></i>
              </div>
              <div class="ml-3">
                <h3 class="text-sm font-medium text-red-200">
                  Terdapat {{ $errors->count() }} error pada input Anda
                </h3>
                <div class="mt-2 text-sm text-red-300">
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

        <!-- Form -->
        <form action="{{ route('events.store') }}" method="POST" class="space-y-6">
          @csrf

          <!-- Title Field -->
          <div>
            <label for="title" class="block text-sm font-medium text-gray-300 mb-1 required">
              Judul Event
            </label>
            <div class="relative rounded-md shadow-sm input-container">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="ph ph-text-aa input-icon"></i>
              </div>
              <input 
                type="text" 
                name="title" 
                id="title" 
                value="{{ old('title') }}"
                class="form-input block w-full pl-10 py-2 rounded-md focus:ring-primary-500 focus:border-primary-500"
                placeholder="Masukkan judul event"
                required
              >
            </div>
          </div>

          <!-- Description Field -->
          <div>
            <label for="description" class="block text-sm font-medium text-gray-300 mb-1 required">
              Deskripsi
            </label>
            <div class="relative rounded-md shadow-sm input-container">
              <div class="absolute inset-y-0 left-0 pl-3 pt-3 flex items-start pointer-events-none">
                <i class="ph ph-align-left input-icon"></i>
              </div>
              <textarea 
                name="description" 
                id="description" 
                rows="4"
                class="form-input block w-full pl-10 py-2 rounded-md focus:ring-primary-500 focus:border-primary-500"
                placeholder="Masukkan deskripsi event"
                required
              >{{ old('description') }}</textarea>
            </div>
          </div>

          <!-- Date Field -->
          <div>
            <label for="date" class="block text-sm font-medium text-gray-300 mb-1 required">
              Tanggal Event
            </label>
            <div class="relative rounded-md shadow-sm input-container">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="ph ph-calendar-blank input-icon"></i>
              </div>
              <input 
                type="date" 
                name="date" 
                id="date" 
                value="{{ old('date') }}"
                class="form-input block w-full pl-10 py-2 rounded-md focus:ring-primary-500 focus:border-primary-500"
                required
              >
            </div>
          </div>

          <!-- Form Actions -->
          <div class="flex items-center justify-end pt-6 border-t border-dark-700">
            <a 
              href="{{ route('events.index') }}" 
              class="mr-4 inline-flex items-center px-4 py-2 border border-dark-600 shadow-sm text-sm font-medium rounded-md text-gray-300 bg-dark-700 hover:bg-dark-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
            >
              <i class="ph ph-x mr-2"></i> Batal
            </a>
            <button 
              type="submit"
              class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
            >
              <i class="ph ph-floppy-disk mr-2"></i> Simpan Event
            </button>
          </div>
        </form>
      </div>
    </div>
  </main>

</body>
</html>