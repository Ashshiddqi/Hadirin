<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Error Presensi</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <style>
    /* Dark theme styles */
    body {
      background-color: #0f172a;
      color: #e2e8f0;
    }
    
    /* Blob background effects */
    .blob {
      position: absolute;
      width: 300px;
      height: 300px;
      background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(124, 58, 237, 0.08) 100%);
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
    
    /* Error card styling */
    .error-card {
      background-color: #1e293b;
      border: 1px solid #334155;
      box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.3);
    }
    
    /* Pulse animation for error icon */
    @keyframes pulse {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.05); }
    }
    
    .error-icon {
      animation: pulse 1.5s ease-in-out infinite;
    }
  </style>
</head>
<body class="min-h-screen flex flex-col relative">

  <!-- Blob background elements -->
  <div class="blob blob-1"></div>
  <div class="blob blob-2"></div>

  <!-- Header -->
  <header class="bg-dark-800 shadow-sm sticky top-0 z-10">
    <div class="max-w-7xl mx-auto px-4 py-3 sm:py-4 sm:px-6 lg:px-8 flex justify-between items-center">
      <div class="flex items-center space-x-3 sm:space-x-4">
        <a href="{{ route('scan.show') }}" class="text-gray-400 hover:text-gray-200 transition-colors" title="Kembali ke Scanner">
          <i class="ph ph-arrow-left text-xl"></i>
        </a>
        <h1 class="text-lg sm:text-xl font-bold text-gray-200">
          Gagal Presensi
        </h1>
      </div>
    </div>
  </header>

  <main class="flex-grow max-w-2xl mx-auto p-4 w-full relative z-10">
    <div class="error-card rounded-xl p-6 text-center">
      <!-- Error Message -->
      <div class="mb-6 p-4 bg-red-900 bg-opacity-20 border border-red-500 text-red-200 rounded-lg">
        <i class="ph ph-warning-circle error-icon text-4xl mb-3 text-red-400"></i>
        <h2 class="text-xl font-semibold mb-2">{{ $message }}</h2>
        @if(isset($details))
          <p class="text-sm text-red-300 mt-2">{{ $details }}</p>
        @endif
      </div>

      <!-- Action Buttons -->
      <div class="flex flex-col sm:flex-row justify-center gap-4">
        <a href="{{ route('scan.show') }}" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors flex items-center justify-center">
          <i class="ph ph-qr-code mr-2"></i> Coba Lagi
        </a>
        <a href="{{ url('/') }}" class="px-4 py-2 bg-dark-600 text-white rounded-lg hover:bg-dark-700 transition-colors flex items-center justify-center">
          <i class="ph ph-house mr-2"></i> Beranda
        </a>
      </div>

      <!-- Additional Help Section -->
      <div class="mt-8 text-left bg-dark-700 rounded-lg p-4">
        <h3 class="font-medium text-gray-300 mb-2 flex items-center">
          <i class="ph ph-question mr-2 text-primary-400"></i> Butuh Bantuan?
        </h3>
        <ul class="text-sm text-gray-400 space-y-2">
          <li class="flex items-start">
            <i class="ph ph-caret-right mt-1 mr-2 text-xs text-primary-400"></i>
            Pastikan QR Code valid dan belum kadaluarsa
          </li>
          <li class="flex items-start">
            <i class="ph ph-caret-right mt-1 mr-2 text-xs text-primary-400"></i>
            Coba scan di tempat dengan pencahayaan cukup
          </li>
          <li class="flex items-start">
            <i class="ph ph-caret-right mt-1 mr-2 text-xs text-primary-400"></i>
            Hubungi admin jika masalah berlanjut
          </li>
        </ul>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-dark-800 text-center p-4 text-sm text-gray-500">
    <p>Sistem Presensi Digital © {{ date('Y') }} SMKN 1 Kota Bengkulu</p>
  </footer>
</body>
</html>