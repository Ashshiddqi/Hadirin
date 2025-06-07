<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Sistem Pengelola Kehadiran Modern SMKN 1 Kota Bengkulu">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        fontFamily: {
          sans: ['Inter', 'sans-serif'],
        },
        extend: {
          colors: {
            primary: {
              50: '#f0f9ff',
              100: '#e0f2fe',
              200: '#bae6fd',
              300: '#7dd3fc',
              400: '#38bdf8',
              500: '#0ea5e9',
              600: '#0284c7',
              700: '#0369a1',
              800: '#075985',
              900: '#0c4a6e',
            },
            dark: {
              900: '#0f172a',
              800: '#1e293b',
              700: '#334155',
              600: '#475569',
              500: '#64748b',
              400: '#94a3b8',
            },
            accent: {
              500: '#7c3aed',
              600: '#6d28d9',
            },
            success: {
              500: '#10b981',
              600: '#059669',
            },
            warning: {
              500: '#f59e0b',
              600: '#d97706',
            }
          },
          boxShadow: {
            'soft': '0 4px 20px -2px rgba(0, 0, 0, 0.2)',
            'soft-lg': '0 10px 25px -5px rgba(0, 0, 0, 0.3)',
            'card': '0 2px 8px rgba(0, 0, 0, 0.15)',
            'card-hover': '0 8px 25px rgba(0, 0, 0, 0.25)',
          },
          animation: {
            'fade-in': 'fadeIn 0.3s ease-in-out',
            'slide-up': 'slideUp 0.3s ease-out',
            'float': 'float 6s ease-in-out infinite',
          },
          keyframes: {
            fadeIn: {
              '0%': { opacity: '0' },
              '100%': { opacity: '1' }
            },
            slideUp: {
              '0%': { transform: 'translateY(10px)', opacity: '0' },
              '100%': { transform: 'translateY(0)', opacity: '1' }
            },
            float: {
              '0%, 100%': { transform: 'translateY(0)' },
              '50%': { transform: 'translateY(-10px)' }
            }
          }
        }
      }
    }
  </script>
  <title>Presensi Digital - SMKN 1 Kota Bengkulu</title>
  <style>
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
    
    .blob-3 {
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 250px;
      height: 250px;
      animation-delay: 4s;
    }
    
    .card-hover-effect {
      transition: all 0.3s ease;
    }
    
    .card-hover-effect:hover {
      transform: translateY(-5px);
    }
    
    .tab-button {
      transition: all 0.2s ease;
    }
    
    .tab-button.active {
      position: relative;
    }
    
    .tab-button.active::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 100%;
      height: 3px;
      background-color: #0ea5e9;
      border-radius: 3px;
    }
    
    @media (max-width: 640px) {
      .header-height {
        height: auto;
        min-height: 16rem;
      }
      
      .card-square {
        aspect-ratio: 1/1;
      }
      
      .card-rectangle {
        aspect-ratio: 2/1;
      }
      
      .blob {
        width: 200px;
        height: 200px;
        filter: blur(30px);
      }
      
      .blob-1 {
        top: -50px;
        left: -50px;
        width: 250px;
        height: 250px;
      }
      
      .blob-2 {
        bottom: -30px;
        right: -50px;
        width: 200px;
        height: 200px;
      }
      
      .blob-3 {
        width: 150px;
        height: 150px;
      }
    }
  </style>
</head>
<body class="bg-dark-900 text-gray-200 font-sans min-h-screen antialiased">

  <!-- Header -->
  <header class="w-full header-height rounded-b-3xl bg-gradient-to-br from-dark-800 to-dark-700 px-6 py-8 md:px-8 md:py-10 relative overflow-hidden">
    <!-- Blob background elements -->
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>
    
    <div class="relative z-10 max-w-6xl mx-auto">
      <div class="flex justify-between items-center">
        <div class="flex items-center">
          <div class="w-8 h-8 md:w-10 md:h-10 bg-dark-600 rounded-lg flex items-center justify-center mr-2">
            <i class="ph ph-fingerprint text-primary-400 text-lg md:text-xl"></i>
          </div>
          <span class="text-white font-bold text-xl md:text-2xl">PRESENSI DIGITAL</span>
        </div>
        <div class="flex space-x-2">
          <button class="w-8 h-8 rounded-full bg-dark-600 flex items-center justify-center text-gray-300 hover:bg-dark-500 transition-all">
            <i class="ph ph-bell text-sm"></i>
          </button>
          <button class="w-8 h-8 rounded-full bg-dark-600 flex items-center justify-center text-gray-300 hover:bg-dark-500 transition-all">
            <i class="ph ph-gear text-sm"></i>
          </button>
        </div>
      </div>

      <div class="text-white text-center mt-8 md:mt-10">
        <div class="mx-auto w-20 h-20 md:w-24 md:h-24 bg-dark-600 rounded-full backdrop-blur-sm flex items-center justify-center shadow-md">
          <img src="{{ asset('images/logo.png') }}" alt="Logo SMKN 1 Kota Bengkulu" class="w-16 h-16 object-contain" />
        </div>
        <h1 class="text-2xl md:text-3xl font-bold tracking-tight mt-4">SMKN 1 KOTA BENGKULU</h1>
        <p class="text-sm md:text-base text-dark-400 mt-1">Sistem Presensi Digital Modern</p>
      </div>

      <nav class="flex justify-center mt-8 md:mt-10 space-x-1 md:space-x-2 lg:space-x-3 bg-dark-600 backdrop-blur-sm rounded-full p-1 max-w-md mx-auto">
        <button id="b1" onclick="switchTab(1)" class="tab-button text-gray-300 font-medium text-xs md:text-sm px-4 py-2 rounded-full hover:bg-dark-500 transition-all duration-200 flex items-center active">
          <i class="ph ph-toolbox mr-2 text-sm md:text-base"></i> Tools
        </button>
        <button id="b2" onclick="switchTab(2)" class="tab-button text-gray-300 font-medium text-xs md:text-sm px-4 py-2 rounded-full hover:bg-dark-500 transition-all duration-200 flex items-center">
          <i class="ph ph-printer mr-2 text-sm md:text-base"></i> Cetak
        </button>
        <button id="b3" onclick="switchTab(3)" class="tab-button text-gray-300 font-medium text-xs md:text-sm px-4 py-2 rounded-full hover:bg-dark-500 transition-all duration-200 flex items-center">
          <i class="ph ph-info mr-2 text-sm md:text-base"></i> Info
        </button>
      </nav>
    </div>
  </header>

  <!-- Main Content -->
  <main class="px-4 py-6 md:px-8 md:py-10 max-w-6xl mx-auto transition-all duration-300 relative z-10">

    <!-- Tools Tab -->
    <div id="tab1" class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 transition-opacity duration-300">
      <!-- Card 1 -->
      <a href="/users" class="card-square bg-dark-800 rounded-2xl shadow-card hover:shadow-card-hover card-hover-effect transition-all duration-200 group overflow-hidden border border-dark-700 animate-fade-in animate-slide-up">
        <div class="h-full p-4 md:p-5 flex flex-col">
          <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl bg-dark-700 mb-3 md:mb-4 flex items-center justify-center group-hover:bg-dark-600 transition-colors duration-200 mx-auto">
            <i class="ph ph-users-three text-primary-400 text-2xl md:text-3xl"></i>
          </div>
          <h3 class="text-sm md:text-base font-semibold text-gray-200 mb-1 text-center">Data Anggota</h3>
          <p class="text-xs text-dark-400 text-center mt-auto">Kelola data anggota</p>
        </div>
      </a>
      
      <!-- Card 2 -->
      <a href="/events" class="card-square bg-dark-800 rounded-2xl shadow-card hover:shadow-card-hover card-hover-effect transition-all duration-200 group overflow-hidden border border-dark-700 animate-fade-in animate-slide-up">
        <div class="h-full p-4 md:p-5 flex flex-col">
          <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl bg-dark-700 mb-3 md:mb-4 flex items-center justify-center group-hover:bg-dark-600 transition-colors duration-200 mx-auto">
            <i class="ph ph-calendar-blank text-accent-400 text-2xl md:text-3xl"></i>
          </div>
          <h3 class="text-sm md:text-base font-semibold text-gray-200 mb-1 text-center">Jadwal Kegiatan</h3>
          <p class="text-xs text-dark-400 text-center mt-auto">Atur jadwal kegiatan</p>
        </div>
      </a>
      
      <!-- Card 3 -->
      <a href="{{ route('generate.id.show') }}" class="card-square bg-dark-800 rounded-2xl shadow-card hover:shadow-card-hover card-hover-effect transition-all duration-200 group overflow-hidden border border-dark-700 animate-fade-in animate-slide-up">
        <div class="h-full p-4 md:p-5 flex flex-col">
          <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl bg-dark-700 mb-3 md:mb-4 flex items-center justify-center group-hover:bg-dark-600 transition-colors duration-200 mx-auto">
            <i class="ph ph-identification-card text-success-400 text-2xl md:text-3xl"></i>
          </div>
          <h3 class="text-sm md:text-base font-semibold text-gray-200 mb-1 text-center">Buat ID Card</h3>
          <p class="text-xs text-dark-400 text-center mt-auto">Generate kartu identitas</p>
        </div>
      </a>
      
      <!-- Card 4 -->
      <a href="{{ route('scan.show') }}" class="card-square bg-dark-800 rounded-2xl shadow-card hover:shadow-card-hover card-hover-effect transition-all duration-200 group overflow-hidden border border-dark-700 animate-fade-in animate-slide-up">
        <div class="h-full p-4 md:p-5 flex flex-col">
          <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl bg-dark-700 mb-3 md:mb-4 flex items-center justify-center group-hover:bg-dark-600 transition-colors duration-200 mx-auto">
            <i class="ph ph-qr-code text-warning-400 text-2xl md:text-3xl"></i>
          </div>
          <h3 class="text-sm md:text-base font-semibold text-gray-200 mb-1 text-center">Scan Presensi</h3>
          <p class="text-xs text-dark-400 text-center mt-auto">Scan QR code kehadiran</p>
        </div>
      </a>
    </div>

    <!-- Prints Tab -->
    <div id="tab2" class="hidden grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 transition-opacity duration-300">
      <!-- Card 1 -->
      <a href="{{ route('print.harian') }}" class="card-rectangle bg-dark-800 rounded-2xl shadow-card hover:shadow-card-hover card-hover-effect transition-all duration-200 group overflow-hidden border border-dark-700 animate-fade-in animate-slide-up">
        <div class="h-full p-5 md:p-6 flex items-center">
          <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl bg-dark-700 mr-4 flex items-center justify-center group-hover:bg-dark-600 transition-colors duration-200">
            <i class="ph ph-calendar-check text-primary-400 text-2xl md:text-3xl"></i>
          </div>
          <div>
            <h3 class="text-sm md:text-base font-semibold text-gray-200 mb-1">Laporan Harian</h3>
            <p class="text-xs text-dark-400">Cetak rekap kehadiran harian</p>
          </div>
          <i class="ph ph-arrow-right ml-auto text-dark-500 group-hover:text-primary-400 transition-colors"></i>
        </div>
      </a>
      
      <!-- Card 2 -->
      <a href="{{ route('print.bulanan') }}" class="card-rectangle bg-dark-800 rounded-2xl shadow-card hover:shadow-card-hover card-hover-effect transition-all duration-200 group overflow-hidden border border-dark-700 animate-fade-in animate-slide-up">
        <div class="h-full p-5 md:p-6 flex items-center">
          <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl bg-dark-700 mr-4 flex items-center justify-center group-hover:bg-dark-600 transition-colors duration-200">
            <i class="ph ph-calendar-blank text-accent-400 text-2xl md:text-3xl"></i>
          </div>
          <div>
            <h3 class="text-sm md:text-base font-semibold text-gray-200 mb-1">Laporan Bulanan</h3>
            <p class="text-xs text-dark-400">Cetak rekap kehadiran bulanan</p>
          </div>
          <i class="ph ph-arrow-right ml-auto text-dark-500 group-hover:text-accent-400 transition-colors"></i>
        </div>
      </a>
      
      <!-- Card 3 -->
      <a href="{{ route('print.card.id') }}" class="card-rectangle bg-dark-800 rounded-2xl shadow-card hover:shadow-card-hover card-hover-effect transition-all duration-200 group overflow-hidden border border-dark-700 animate-fade-in animate-slide-up">
        <div class="h-full p-5 md:p-6 flex items-center">
          <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl bg-dark-700 mr-4 flex items-center justify-center group-hover:bg-dark-600 transition-colors duration-200">
            <i class="ph ph-cards text-success-400 text-2xl md:text-3xl"></i>
          </div>
          <div>
            <h3 class="text-sm md:text-base font-semibold text-gray-200 mb-1">Cetak Semua ID</h3>
            <p class="text-xs text-dark-400">Print semua kartu identitas</p>
          </div>
          <i class="ph ph-arrow-right ml-auto text-dark-500 group-hover:text-success-400 transition-colors"></i>
        </div>
      </a>
      
      <!-- Card 4 -->
      <a href="#" class="card-rectangle bg-dark-800 rounded-2xl shadow-card hover:shadow-card-hover card-hover-effect transition-all duration-200 group overflow-hidden border border-dark-700 animate-fade-in animate-slide-up">
        <div class="h-full p-5 md:p-6 flex items-center">
          <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl bg-dark-700 mr-4 flex items-center justify-center group-hover:bg-dark-600 transition-colors duration-200">
            <i class="ph ph-file-text text-warning-400 text-2xl md:text-3xl"></i>
          </div>
          <div>
            <h3 class="text-sm md:text-base font-semibold text-gray-200 mb-1">Laporan Custom</h3>
            <p class="text-xs text-dark-400">Buat laporan sesuai kebutuhan</p>
          </div>
          <i class="ph ph-arrow-right ml-auto text-dark-500 group-hover:text-warning-400 transition-colors"></i>
        </div>
      </a>
    </div>

    <!-- Info Tab -->
    <div id="tab3" class="hidden transition-opacity duration-300 animate-fade-in">
      <div class="bg-dark-800 rounded-2xl shadow-soft p-6 md:p-8">
        <div class="flex items-center mb-5">
          <div class="w-10 h-10 rounded-lg bg-dark-700 flex items-center justify-center mr-3">
            <i class="ph ph-info text-primary-400 text-xl"></i>
          </div>
          <h2 class="text-xl md:text-2xl font-bold text-gray-200">Tentang Sistem</h2>
        </div>
        
        <div class="space-y-4">
          <div class="flex items-start">
            <div class="flex-shrink-0 mt-1">
              <div class="w-2 h-2 rounded-full bg-primary-400 mt-2"></div>
            </div>
            <div class="ml-3">
              <h3 class="font-semibold text-gray-200">Presensi Digital SMKN 1</h3>
              <p class="text-dark-400 text-sm md:text-base mt-1">
                Sistem modern untuk mengelola kehadiran dengan fitur canggih dan antarmuka yang intuitif.
              </p>
            </div>
          </div>
          
          <div class="flex items-start">
            <div class="flex-shrink-0 mt-1">
              <div class="w-2 h-2 rounded-full bg-primary-400 mt-2"></div>
            </div>
            <div class="ml-3">
              <h3 class="font-semibold text-gray-200">Fitur Unggulan</h3>
              <p class="text-dark-400 text-sm md:text-base mt-1">
                Scan QR code, pembuatan ID digital, laporan otomatis, dan integrasi dengan sistem sekolah lainnya.
              </p>
            </div>
          </div>
          
          <div class="flex items-start">
            <div class="flex-shrink-0 mt-1">
              <div class="w-2 h-2 rounded-full bg-primary-400 mt-2"></div>
            </div>
            <div class="ml-3">
              <h3 class="font-semibold text-gray-200">Pengembangan</h3>
              <p class="text-dark-400 text-sm md:text-base mt-1">
                Dikembangkan oleh tim Guru Produktif Jurusan PPLG sebagai solusi digital untuk manajemen kehadiran.
              </p>
            </div>
          </div>
          
          <div class="pt-4 mt-4 border-t border-dark-700">
            <div class="flex items-center">
              <div class="w-8 h-8 rounded-lg bg-dark-700 flex items-center justify-center mr-3">
                <i class="ph ph-code text-primary-400"></i>
              </div>
              <div>
                <h3 class="font-medium text-gray-200">Versi 2.1.0</h3>
                <p class="text-xs text-dark-500">Terakhir diperbarui: Juni 2024</p>
              </div>
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
      }
      
      // Show selected tab
      document.getElementById('tab' + id).classList.remove('hidden');
      document.getElementById('b' + id).classList.add('active');
      
      // Store selected tab in sessionStorage
      sessionStorage.setItem('selectedTab', id);
    }

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