<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Sistem Pengelola Kehadiran SMKN 1 Kota Bengkulu">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        fontFamily: {
          sans: ['Inter', 'sans-serif'],
        },
        extend: {
          colors: {
            gray: {
              700: '#374151',
              800: '#1f2937',
              900: '#111827',
            }
          },
          animation: {
            'fade-in': 'fadeIn 0.3s ease-in-out',
            'slide-up': 'slideUp 0.3s ease-out'
          },
          keyframes: {
            fadeIn: {
              '0%': { opacity: '0' },
              '100%': { opacity: '1' }
            },
            slideUp: {
              '0%': { transform: 'translateY(20px)' },
              '100%': { transform: 'translateY(0)' }
            }
          }
        }
      }
    }
  </script>
  <script src="https://unpkg.com/feather-icons"></script>
  <title>Hadirin - Sistem Kehadiran SMKN 1 Kota Bengkulu</title>
  <style>
    .card {
      transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
      border: 1px solid rgba(229, 231, 235, 0.1);
    }
    
    .card:hover {
      transform: translateY(-2px);
      border-color: rgba(156, 163, 175, 0.3);
    }
    
    .tab-button {
      transition: all 0.2s ease;
    }
    
    .tab-button:hover {
      background-color: rgba(255, 255, 255, 0.05);
    }
    
    .tab-button.active {
      background-color: rgba(255, 255, 255, 0.1);
    }
    
    .decorative-line {
      position: absolute;
      height: 1px;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
    }
  </style>
</head>
<body class="bg-gray-900 text-gray-100 font-sans min-h-screen antialiased">

  <!-- Modern Header -->
  <header class="w-full bg-gray-800 px-6 py-8 md:px-8 md:py-10 relative overflow-hidden border-b border-gray-700">
    <!-- Decorative lines -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden">
      <div class="decorative-line w-full top-1/4"></div>
      <div class="decorative-line w-full top-1/2"></div>
      <div class="decorative-line w-full top-3/4"></div>
    </div>
    
    <div class="relative z-10 max-w-6xl mx-auto">
      <div class="flex justify-between items-center">
        <div class="text-gray-100 font-bold text-xl flex items-center">
          <i data-feather="clock" class="mr-2 text-gray-400"></i>
          <span class="bg-clip-text text-transparent bg-gradient-to-r from-gray-100 to-gray-300">HADIRIN</span>
        </div>
        <div class="text-sm text-gray-400">
          SMKN 1 Kota Bengkulu
        </div>
      </div>

      <div class="text-center mt-12 md:mt-16">
        <div class="mx-auto w-20 h-20 md:w-24 md:h-24 bg-gray-700 rounded-full p-4 border border-gray-600 flex items-center justify-center">
          <img src="{{ asset('images/logo.png') }}" alt="Logo SMKN 1 Kota Bengkulu" class="w-full h-full object-contain" />
        </div>
        <h1 class="text-2xl md:text-3xl font-bold tracking-tight mt-6 text-gray-100">Sistem Kehadiran Digital</h1>
        <p class="text-gray-400 mt-2">Manajemen presensi</p>
      </div>

      <nav class="flex justify-center mt-10 md:mt-12 space-x-1 md:space-x-2 bg-gray-700 rounded-full p-1 max-w-md mx-auto">
        <button id="b1" onclick="switchTab(1)" class="tab-button text-gray-200 text-sm font-medium px-4 py-2 rounded-full transition-all duration-200 flex items-center">
          <i data-feather="tool" class="mr-2 w-4 h-4"></i> Tools
        </button>
        <button id="b2" onclick="switchTab(2)" class="tab-button text-gray-400 text-sm font-medium px-4 py-2 rounded-full transition-all duration-200 flex items-center">
          <i data-feather="printer" class="mr-2 w-4 h-4"></i> Cetak
        </button>
        <button id="b3" onclick="switchTab(3)" class="tab-button text-gray-400 text-sm font-medium px-4 py-2 rounded-full transition-all duration-200 flex items-center">
          <i data-feather="info" class="mr-2 w-4 h-4"></i> Info
        </button>
      </nav>
    </div>
  </header>

  <!-- Main Content -->
  <main class="px-4 py-8 md:px-8 md:py-12 max-w-6xl mx-auto transition-all duration-300">

    <!-- Tools Tab -->
    <div id="tab1" class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 transition-opacity duration-300">
      <!-- Card 1 -->
      <a href="/users" class="card bg-gray-800 rounded-lg hover:bg-gray-700 transition-all duration-200 group overflow-hidden border border-gray-700 animate-fade-in animate-slide-up">
        <div class="h-full p-5 flex flex-col items-center">
          <div class="w-12 h-12 rounded-lg bg-gray-700 mb-3 flex items-center justify-center group-hover:bg-gray-600 transition-colors duration-200">
            <img src="https://img.icons8.com/ios-filled/50/9ca3af/add-user-group-man-man.png" class="w-6 h-6" alt="Input Anggota" />
          </div>
          <h3 class="text-sm font-semibold text-gray-100 mb-1 text-center">Input Anggota</h3>
          <p class="text-xs text-gray-400 text-center">Tambah/edit data anggota</p>
        </div>
      </a>
      
      <!-- Card 2 -->
      <a href="/events" class="card bg-gray-800 rounded-lg hover:bg-gray-700 transition-all duration-200 group overflow-hidden border border-gray-700 animate-fade-in animate-slide-up">
        <div class="h-full p-5 flex flex-col items-center">
          <div class="w-12 h-12 rounded-lg bg-gray-700 mb-3 flex items-center justify-center group-hover:bg-gray-600 transition-colors duration-200">
            <img src="https://img.icons8.com/ios-filled/50/9ca3af/edit-calendar.png" class="w-6 h-6" alt="Input Kegiatan" />
          </div>
          <h3 class="text-sm font-semibold text-gray-100 mb-1 text-center">Input Kegiatan</h3>
          <p class="text-xs text-gray-400 text-center">Kelola jadwal kegiatan</p>
        </div>
      </a>
      
      <!-- Card 3 -->
      <a href="{{ route('generate.id.show') }}" class="card bg-gray-800 rounded-lg hover:bg-gray-700 transition-all duration-200 group overflow-hidden border border-gray-700 animate-fade-in animate-slide-up">
        <div class="h-full p-5 flex flex-col items-center">
          <div class="w-12 h-12 rounded-lg bg-gray-700 mb-3 flex items-center justify-center group-hover:bg-gray-600 transition-colors duration-200">
            <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIzMiIgaGVpZ2h0PSIzMiIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9IiM5Y2EzYWYiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIiBjbGFzcz0ibHVjaWRlIGx1Y2lkZS1pZC1jYXJkLWljb24gbHVjaWRlLWlkLWNhcmQiPjxwYXRoIGQ9Ik0xNiAxMGgyIi8+PHBhdGggZD0iTTE2IDE0aDIiLz48cGF0aCBkPSJNNi4xNyAxNWEzIDMgMCAwIDEgNS42NiAwIi8+PGNpcmNsZSBjeD0iOSIgY3k9IjExIiByPSIyIi8+PHJlY3QgeD0iMiIgeT0iNSIgd2lkdGg9IjIwIiBoZWlnaHQ9IjE0IiByeD0iMiIvPjwvc3ZnPg==" class="w-6 h-6" alt="Generate ID" />
          </div>
          <h3 class="text-sm font-semibold text-gray-100 mb-1 text-center">Generate ID</h3>
          <p class="text-xs text-gray-400 text-center">Buat kartu identitas</p>
        </div>
      </a>
      
      <!-- Card 4 -->
      <a href="{{ route('scan.show') }}" class="card bg-gray-800 rounded-lg hover:bg-gray-700 transition-all duration-200 group overflow-hidden border border-gray-700 animate-fade-in animate-slide-up">
        <div class="h-full p-5 flex flex-col items-center">
          <div class="w-12 h-12 rounded-lg bg-gray-700 mb-3 flex items-center justify-center group-hover:bg-gray-600 transition-colors duration-200">
            <i data-feather="maximize" class="w-6 h-6 text-gray-300"></i>
          </div>
          <h3 class="text-sm font-semibold text-gray-100 mb-1 text-center">Scan Kehadiran</h3>
          <p class="text-xs text-gray-400 text-center">Scan QR code presensi</p>
        </div>
      </a>
    </div>

    <!-- Prints Tab -->
    <div id="tab2" class="hidden grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4 transition-opacity duration-300">
      <!-- Card 1 -->
      <a href="#" class="card bg-gray-800 rounded-lg hover:bg-gray-700 transition-all duration-200 group overflow-hidden border border-gray-700 animate-fade-in animate-slide-up">
        <div class="h-full p-5 flex flex-col items-center justify-center">
          <div class="w-12 h-12 rounded-lg bg-gray-700 mb-3 flex items-center justify-center group-hover:bg-gray-600 transition-colors duration-200">
            <i data-feather="calendar" class="w-6 h-6 text-gray-300"></i>
          </div>
          <h3 class="text-sm font-semibold text-gray-100 mb-1 text-center">Cetak Harian</h3>
          <p class="text-xs text-gray-400 text-center">Laporan kehadiran harian</p>
        </div>
      </a>
      
      <!-- Card 2 -->
      <a href="#" class="card bg-gray-800 rounded-lg hover:bg-gray-700 transition-all duration-200 group overflow-hidden border border-gray-700 animate-fade-in animate-slide-up">
        <div class="h-full p-5 flex flex-col items-center justify-center">
          <div class="w-12 h-12 rounded-lg bg-gray-700 mb-3 flex items-center justify-center group-hover:bg-gray-600 transition-colors duration-200">
            <i data-feather="calendar" class="w-6 h-6 text-gray-300"></i>
          </div>
          <h3 class="text-sm font-semibold text-gray-100 mb-1 text-center">Cetak Bulanan</h3>
          <p class="text-xs text-gray-400 text-center">Laporan kehadiran bulanan</p>
        </div>
      </a>
      
      <!-- Card 3 -->
      <a href="{{ route('print.all.id') }}" class="card bg-gray-800 rounded-lg hover:bg-gray-700 transition-all duration-200 group overflow-hidden border border-gray-700 animate-fade-in animate-slide-up">
        <div class="h-full p-5 flex flex-col items-center justify-center">
          <div class="w-12 h-12 rounded-lg bg-gray-700 mb-3 flex items-center justify-center group-hover:bg-gray-600 transition-colors duration-200">
            <img src="https://img.icons8.com/ios-filled/50/9ca3af/print.png" class="w-6 h-6" alt="Print ID" />
          </div>
          <h3 class="text-sm font-semibold text-gray-100 mb-1 text-center">Cetak Semua ID</h3>
          <p class="text-xs text-gray-400 text-center">Cetak semua kartu identitas</p>
        </div>
      </a>
    </div>

    <!-- Info Tab -->
    <div id="tab3" class="hidden transition-opacity duration-300 animate-fade-in">
      <div class="bg-gray-800 rounded-lg p-6 md:p-8 border border-gray-700">
        <div class="flex items-center mb-6">
          <div class="w-10 h-10 rounded-lg bg-gray-700 flex items-center justify-center mr-4">
            <i data-feather="info" class="w-5 h-5 text-gray-300"></i>
          </div>
          <h2 class="text-xl font-bold text-gray-100">Tentang Hadirin</h2>
        </div>
        
        <div class="space-y-4">
          <div class="flex items-start">
            <div class="flex-shrink-0 mt-1">
              <div class="w-2 h-2 rounded-full bg-gray-400"></div>
            </div>
            <p class="ml-3 text-gray-300 text-sm">
              <span class="font-semibold text-gray-100">Hadirin</span> merupakan sistem pengelola kehadiran digital untuk lingkungan sekolah yang dirancang dengan antarmuka modern dan intuitif.
            </p>
          </div>
          
          <div class="flex items-start">
            <div class="flex-shrink-0 mt-1">
              <div class="w-2 h-2 rounded-full bg-gray-400"></div>
            </div>
            <p class="ml-3 text-gray-300 text-sm">
              Sistem ini memungkinkan pencatatan kehadiran yang efisien dengan fitur QR code scanning, manajemen anggota, dan pelaporan otomatis.
            </p>
          </div>
          
          <div class="flex items-start">
            <div class="flex-shrink-0 mt-1">
              <div class="w-2 h-2 rounded-full bg-gray-400"></div>
            </div>
            <p class="ml-3 text-gray-300 text-sm">
              Dikembangkan oleh tim Guru Produktif Jurusan PPLG SMKN 1 Kota Bengkulu sebagai solusi digital untuk manajemen kehadiran yang lebih baik.
            </p>
          </div>
          
          <div class="pt-4 mt-6 border-t border-gray-700">
            <div class="flex items-center text-xs text-gray-500">
              <i data-feather="code" class="w-3 h-3 mr-2"></i>
              <span>Versi 1.0.0 - © 2023 SMKN 1 Kota Bengkulu</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script>
    function switchTab(id) {
      // Hide all tabs
      for (let i = 1; i <= 3; i++) {
        document.getElementById('tab' + i).classList.add('hidden');
        document.getElementById('b' + i).classList.remove('active');
        document.getElementById('b' + i).classList.remove('text-gray-100');
        document.getElementById('b' + i).classList.add('text-gray-400');
      }
      
      // Show selected tab
      document.getElementById('tab' + id).classList.remove('hidden');
      document.getElementById('b' + id).classList.add('active');
      document.getElementById('b' + id).classList.add('text-gray-100');
      document.getElementById('b' + id).classList.remove('text-gray-400');
      
      // Store selected tab in sessionStorage
      sessionStorage.setItem('selectedTab', id);
    }

    // Initialize feather icons
    feather.replace();
    
    // Set initial tab from sessionStorage or default to 1
    document.addEventListener('DOMContentLoaded', () => {
      const selectedTab = sessionStorage.getItem('selectedTab') || 1;
      switchTab(selectedTab);
      
      // Add animation delay to cards
      const cards = document.querySelectorAll('[id^="tab"] a');
      cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 50}ms`;
      });
    });
  </script>
</body>
</html>