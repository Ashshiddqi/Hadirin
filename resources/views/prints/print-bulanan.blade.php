<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cetak Kehadiran Bulanan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #0f172a;
      color: #e2e8f0;
    }
    
    @media print {
      body { 
        padding: 0; 
        margin: 0; 
        font-size: 12pt;
        background: white;
        color: #1f2937;
      }
      .no-print { 
        display: none !important; 
      }
      .page-break { 
        page-break-after: always; 
      }
      header { 
        display: none; 
      }
      table {
        width: 100%;
        border-collapse: collapse;
      }
      th, td {
        padding: 8px 12px;
        border: 1px solid #e2e8f0;
      }
      .print-header {
        display: block !important;
        text-align: center;
        margin-bottom: 20px;
      }
      .dark\:bg-dark-800 {
        background-color: white !important;
      }
      .dark\:text-gray-200 {
        color: #1f2937 !important;
      }
    }
    
    @page {
      size: A4 portrait;
      margin: 15mm;
    }
    
    .action-btn {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 16px;
      border-radius: 6px;
      font-weight: 500;
      transition: all 0.2s ease;
      cursor: pointer;
    }
    
    .action-btn:hover {
      transform: translateY(-1px);
    }
    
    @media (max-width: 640px) {
      .action-text {
        display: none;
      }
      .action-btn {
        padding: 8px 12px;
      }
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
  </style>
</head>
<body class="min-h-screen relative">

  <!-- Blob background elements -->
  <div class="blob blob-1"></div>
  <div class="blob blob-2"></div>

  <!-- Header untuk tampilan web -->
  <header class="bg-dark-800 shadow-sm no-print sticky top-0 z-10">
    <div class="max-w-7xl mx-auto px-4 py-3 sm:py-4 sm:px-6 lg:px-8 flex justify-between items-center">
      <div class="flex items-center space-x-3 sm:space-x-4">
        <a href="{{ url('/') }}" class="text-gray-400 hover:text-gray-200 transition-colors" title="Kembali ke Beranda">
          <i class="ph ph-arrow-left text-xl"></i>
        </a>
        <h1 class="text-lg sm:text-xl font-bold text-gray-200">
          Rekap Kehadiran Bulanan Guru
        </h1>
      </div>
    </div>
  </header>

  <!-- Header untuk cetakan -->
  <div class="print-header hidden bg-white py-4 border-b-2 border-primary-600">
    <div class="text-center">
      <img src="{{ asset('images/logo.png') }}" alt="Logo Sekolah" class="h-16 mx-auto mb-2">
      <h1 class="text-xl font-bold">SMK NEGERI 1 KOTA BENGKULU</h1>
      <p class="text-sm">Jl. Jati No 41, Kelurahan Padang Jati<br>Kecamatan Ratu Samban, Kota Bengkulu 38222</p>
      <h2 class="text-lg font-semibold mt-4">REKAPITULASI KEHADIRAN BULANAN GURU</h2>
      <p class="text-md font-medium text-primary-600">{{ $month }}</p>
    </div>
  </div>

  <div class="max-w-7xl mx-auto p-4 sm:p-6 relative z-10">
    <div class="bg-dark-800 rounded-lg shadow overflow-hidden">
      <div class="px-6 py-4 border-b border-dark-700 no-print">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
          <div class="text-center md:text-left">
            <h2 class="text-xl font-semibold text-gray-200">REKAP KEHADIRAN GURU BULANAN</h2>
            <p class="text-gray-400">SMKN 1 Kota Bengkulu</p>
            <p class="text-md font-medium text-primary-400">{{ $month }}</p>
          </div>
          <div class="flex items-center gap-2">
            <button onclick="window.print()" class="action-btn bg-primary-600 text-white hover:bg-primary-700">
              <i class="ph ph-printer"></i>
              <span class="action-text">Cetak</span>
            </button>
          </div>
        </div>
      </div>
      
      <div class="p-4 sm:p-6">
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-700">
            <thead class="bg-dark-700">
              <tr>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">No</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Nama Guru</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Tanggal</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Waktu</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Keterangan</th>
              </tr>
            </thead>
            <tbody class="bg-dark-800 divide-y divide-gray-700">
              @forelse($attendances as $index => $attendance)
              <tr class="hover:bg-dark-700">
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-300 text-center">{{ $index + 1 }}</td>
                <td class="px-4 py-3 whitespace-nowrap">
                  <div class="text-sm font-medium text-gray-200">{{ $attendance->user->name }}</div>
                </td>
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-300">
                  {{ $attendance->scan_time->format('d-m-Y') }}
                </td>
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-300">
                  {{ $attendance->scan_time->format('H:i:s') }}
                </td>
                <td class="px-4 py-3 whitespace-nowrap">
                  <span class="px-2 py-1 text-xs font-semibold rounded-full 
                    {{ $attendance->status === 'hadir' ? 'bg-green-900 text-green-200' : '' }}
                    {{ $attendance->status === 'izin' ? 'bg-blue-900 text-blue-200' : '' }}
                    {{ $attendance->status === 'sakit' ? 'bg-purple-900 text-purple-200' : '' }}
                    {{ $attendance->status === 'tidak hadir' ? 'bg-red-900 text-red-200' : '' }}">
                    {{ ucfirst($attendance->status) }}
                  </span>
                </td>
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-300">
                  {{ $attendance->keterangan ?? '-' }}
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="px-4 py-4 whitespace-nowrap text-sm text-gray-400 text-center">
                  Tidak ada data kehadiran guru bulan ini
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        @if($attendances->count() > 0)
        <div class="mt-6 p-4 bg-dark-700 rounded-lg">
          <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="text-sm text-gray-400">
              Total Kehadiran Guru: <span class="font-semibold text-gray-200">{{ $attendances->count() }} data</span>
            </div>
            <div class="text-sm text-gray-500">
              Dicetak pada : {{ now()->format('d-m-Y H:i:s') }}
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>

  <script>
    // Menyiapkan halaman sebelum dicetak
    function beforePrint() {
      document.querySelectorAll('.hover\\:bg-dark-700').forEach(el => el.classList.remove('hover:bg-dark-700'));
      document.querySelector('.print-header').classList.remove('hidden');
    }
    
    // Mengembalikan setelah cetakan
    function afterPrint() {
      document.querySelectorAll('.hover\\:bg-dark-700').forEach(el => el.classList.add('hover:bg-dark-700'));
      document.querySelector('.print-header').classList.add('hidden');
    }
    
    // Event listeners untuk cetak
    if (window.matchMedia) {
      const mediaQueryList = window.matchMedia('print');
      mediaQueryList.addListener(mql => {
        if (mql.matches) {
          beforePrint();
        } else {
          afterPrint();
        }
      });
    }
    
    window.addEventListener('beforeprint', beforePrint);
    window.addEventListener('afterprint', afterPrint);
  </script>
</body>
</html>