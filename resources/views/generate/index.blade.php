<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Generate ID Anggota - QR Code PNG</title>
  <!-- Include Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Include Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Include QR Code library -->
  <script src="https://cdn.jsdelivr.net/npm/qrcode-generator@1.4.4/qrcode.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #111827;
    }
    
    /* Styling untuk tombol aksi di mobile */
    @media (max-width: 640px) {
      .action-buttons {
        display: flex;
        flex-direction: row;
        gap: 0.5rem;
        justify-content: flex-end;
      }
      .action-btn {
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
      }
      .action-text {
        display: none;
      }
    }

    /* Styling untuk desktop */
    @media (min-width: 641px) {
      .action-btn {
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
      }
      .action-text {
        display: inline;
        margin-left: 0.25rem;
      }
    }

    /* Styling untuk tombol floating */
    .floating-btn {
      transition: all 0.3s ease;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    .floating-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    /* Styling untuk QR Code */
    .qr-container {
      width: 100px;
      height: 100px;
      margin: 0 auto;
      background: white;
      padding: 8px;
      border: 1px solid #374151;
    }
    
    .modal-qr-container {
      width: 256px;
      height: 256px;
      margin: 0 auto;
      background: white;
      padding: 16px;
      border: 1px solid #374151;
    }

    /* Hidden canvas for QR generation */
    #qrCanvas {
      display: none;
    }
    
    /* Decorative line */
    .decorative-line {
      position: absolute;
      height: 1px;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
    }
  </style>
</head>
<body class="min-h-screen">

  <!-- Header -->
  <header class="bg-gray-800 border-b border-gray-700">
    <div class="max-w-7xl mx-auto px-4 py-3 sm:py-4 sm:px-6 lg:px-8 flex justify-between items-center">
      <div class="flex items-center space-x-3 sm:space-x-4">
        <a href="{{ url('/') }}" class="text-gray-400 hover:text-gray-200 transition-colors" title="Kembali ke Beranda">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
        </a>
        <h1 class="text-lg sm:text-xl font-bold text-gray-100">
          Generate ID Anggota
        </h1>
      </div>
    </div>
  </header>

  <div class="max-w-7xl mx-auto p-4 sm:p-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
      
      @if(session('success'))
        <div class="bg-gray-700 border-l-4 border-green-500 text-green-400 px-4 py-3 rounded relative w-full md:w-auto" role="alert">
          <span class="block sm:inline">{{ session('success') }}</span>
        </div>
      @endif
    </div>

    <!-- Generate Button -->
    <div class="bg-gray-800 rounded-lg border border-gray-700 p-6 mb-8">
      <form action="{{ route('generate.id.process') }}" method="POST">
        @csrf
        <button type="submit" class="bg-gray-700 hover:bg-gray-600 text-white font-medium py-3 px-6 rounded-lg transition duration-300 flex items-center gap-2 border border-gray-600">
          <i class="fas fa-qrcode"></i>
          Generate ID Sekarang
        </button>
      </form>
    </div>

    <!-- Users Table -->
    <div class="bg-gray-800 border border-gray-700 shadow rounded-lg overflow-hidden">
      <div class="px-6 py-4 border-b border-gray-700 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <h2 class="text-xl font-semibold text-gray-100">Daftar Anggota</h2>
        <div class="relative w-full sm:w-64">
          <input type="text" id="searchInput" placeholder="Cari anggota..." class="w-full pl-10 pr-4 py-2 border border-gray-600 rounded-lg focus:outline-none focus:ring-1 focus:ring-gray-500 bg-gray-700 text-gray-100 placeholder-gray-400">
          <i class="fas fa-search absolute left-3 top-3 text-gray-500"></i>
        </div>
      </div>
      
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-gray-700 text-left">
            <tr>
              <th class="px-6 py-3 text-xs font-medium text-gray-300 uppercase tracking-wider">#</th>
              <th class="px-6 py-3 text-xs font-medium text-gray-300 uppercase tracking-wider">Nama</th>
              <th class="px-6 py-3 text-xs font-medium text-gray-300 uppercase tracking-wider">User ID</th>
              <th class="px-6 py-3 text-xs font-medium text-gray-300 uppercase tracking-wider">QR Code</th>
              <th class="px-6 py-3 text-xs font-medium text-gray-300 uppercase tracking-wider">Aksi</th>
            </tr>
          </thead>
          <tbody class="bg-gray-800 divide-y divide-gray-700">
            @foreach($users as $user)
            <tr class="hover:bg-gray-700 transition-colors">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-100">{{ $loop->iteration }}</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-100">{{ $user->name }}</div>
              </td>
              
              <td class="px-6 py-4 whitespace-nowrap text-sm">
                @if($user->user_id)
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-700 text-gray-300 border border-gray-600">
                    {{ $user->user_id }}
                  </span>
                @else
                  <span class="text-gray-500">-</span>
                @endif
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                @if($user->user_id)
                  <div class="qr-container" id="qr-{{ $user->user_id }}">
                    {!! DNS2D::getBarcodeSVG($user->user_id, 'QRCODE', 4, 4) !!}
                  </div>
                @else
                  <span class="text-gray-500">-</span>
                @endif
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                @if($user->user_id)
                  <div class="action-buttons">
                    <button
                      class="action-btn bg-gray-700 text-gray-300 hover:bg-gray-600 hover:text-gray-100"
                      onclick="showQRModal('{{ $user->user_id }}', '{{ $user->name }}', '{{ $user->user_id }}')"
                      type="button"
                      title="View QR Code"
                    >
                      <i class="fas fa-eye"></i>
                      <span class="action-text">View</span>
                    </button>
                    <button
                      class="action-btn bg-gray-700 text-green-400 hover:bg-gray-600 hover:text-green-300 ml-2"
                      onclick="downloadQRCode('{{ $user->user_id }}', '{{ $user->name }}')"
                      type="button"
                      title="Download QR Code"
                    >
                      <i class="fas fa-download"></i>
                      <span class="action-text">Download</span>
                    </button>
                  </div>
                @else
                  <span class="text-gray-500">-</span>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- QR Code Modal -->
  <div id="qrModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden">
    <div class="bg-gray-800 rounded-lg p-6 max-w-md w-full mx-4 border border-gray-700">
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold text-gray-100" id="modalTitle"></h3>
        <button onclick="closeModal()" class="text-gray-400 hover:text-gray-200">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="flex flex-col items-center">
        <div class="modal-qr-container">
          <canvas id="modalQRCanvas"></canvas>
        </div>
        <p class="text-sm text-gray-400 mb-4" id="modaluserId"></p>
        <button 
          id="modalDownloadBtn"
          class="bg-gray-700 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition duration-300 flex items-center gap-2 border border-gray-600"
        >
          <i class="fas fa-download"></i>
          Download QR Code
        </button>
      </div>
    </div>
  </div>

  <!-- Hidden canvas for QR generation -->
  <canvas id="qrCanvas" style="display: none;"></canvas>

  <script>
    // Fungsi pencarian
    document.getElementById('searchInput').addEventListener('input', function() {
      const searchValue = this.value.toLowerCase();
      const rows = document.querySelectorAll('tbody tr');
      
      rows.forEach(row => {
        const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        const userId = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
        
        if (name.includes(searchValue) || userId.includes(searchValue)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    });

    // Fungsi untuk menampilkan modal QR Code
    function showQRModal(userId, name, userIdText) {
      document.getElementById('modalTitle').textContent = name;
      document.getElementById('modaluserId').textContent = `User ID: ${userIdText}`;
      
      // Generate QR code
      const canvas = document.getElementById('modalQRCanvas');
      generateQRCode(canvas, userId, 256);
      
      // Update tombol download
      const downloadBtn = document.getElementById('modalDownloadBtn');
      downloadBtn.onclick = () => downloadQRCode(userId, name);
      
      // Tampilkan modal
      document.getElementById('qrModal').classList.remove('hidden');
    }

    // Fungsi untuk menutup modal
    function closeModal() {
      document.getElementById('qrModal').classList.add('hidden');
    }

    // Fungsi untuk generate QR code ke canvas
    function generateQRCode(canvas, text, size) {
      const qr = qrcode(0, 'L');
      qr.addData(text);
      qr.make();
      
      const cellSize = size / qr.getModuleCount();
      const ctx = canvas.getContext('2d');
      
      canvas.width = size;
      canvas.height = size;
      
      // Background putih
      ctx.fillStyle = 'white';
      ctx.fillRect(0, 0, size, size);
      
      // Gambar QR code
      ctx.fillStyle = 'black';
      for (let row = 0; row < qr.getModuleCount(); row++) {
        for (let col = 0; col < qr.getModuleCount(); col++) {
          if (qr.isDark(row, col)) {
            ctx.fillRect(col * cellSize, row * cellSize, cellSize, cellSize);
          }
        }
      }
    }

    // Fungsi untuk download QR Code
    function downloadQRCode(userId, name) {
      const canvas = document.getElementById('qrCanvas');
      generateQRCode(canvas, userId, 512);
      
      // Konversi ke PNG dan download
      const pngUrl = canvas.toDataURL('image/png');
      const a = document.createElement('a');
      a.href = pngUrl;
      a.download = `${name.replace(/\s+/g, '_')}_${userId}_qrcode.png`;
      document.body.appendChild(a);
      a.click();
      document.body.removeChild(a);
    }
  </script>

</body>
</html>