<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Generate ID Anggota</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <script src="https://cdn.jsdelivr.net/npm/qrcode-generator@1.4.4/qrcode.min.js"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #0f172a;
      color: #e2e8f0;
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
    
    /* QR Code styling */
    .qr-container {
      width: 100px;
      height: 100px;
      margin: 0 auto;
      background: white;
      padding: 8px;
      border: 1px solid #334155;
      border-radius: 4px;
    }
    
    .modal-qr-container {
      width: 240px;
      height: 240px;
      margin: 0 auto;
      background: white;
      padding: 16px;
      border: 2px solid #334155;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* Modal animations */
    .modal-backdrop {
      opacity: 0;
      transition: opacity 0.3s ease;
    }
    
    .modal-backdrop.show {
      opacity: 1;
    }

    .modal-content {
      transform: scale(0.9) translateY(-20px);
      opacity: 0;
      transition: all 0.3s ease;
    }
    
    .modal-content.show {
      transform: scale(1) translateY(0);
      opacity: 1;
    }

    /* Responsive adjustments */
    @media (max-width: 640px) {
      .modal-qr-container {
        width: 200px;
        height: 200px;
        padding: 12px;
      }
      
      .action-btn {
        width: 34px;
        height: 34px;
        border-radius: 50%;
      }
      
      .action-text {
        display: none;
      }
    }

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
    
    /* Floating button styling */
    .floating-btn {
      transition: all 0.3s ease;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    
    .floating-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
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
        <a href="{{ url('/') }}" class="text-gray-400 hover:text-gray-200 transition-colors" title="Kembali ke Beranda">
          <i class="ph ph-arrow-left text-xl"></i>
        </a>
        <h1 class="text-lg sm:text-xl font-bold text-gray-200">
          Generate ID Anggota
        </h1>
      </div>
    </div>
  </header>

  <div class="max-w-7xl mx-auto p-4 sm:p-6 relative z-10">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
      @if(session('success'))
        <div class="bg-green-900 bg-opacity-20 border border-green-500 text-green-200 px-4 py-3 rounded-lg w-full md:w-auto" role="alert">
          <div class="flex items-center">
            <i class="ph ph-check-circle mr-2 text-xl"></i>
            <span>{{ session('success') }}</span>
          </div>
        </div>
      @endif
    </div>

    <!-- Generate Button -->
    <div class="bg-dark-800 rounded-lg shadow p-6 mb-8">
      <form action="{{ route('generate.id.process') }}" method="POST">
        @csrf
        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-6 rounded-lg transition duration-300 flex items-center gap-3">
          <i class="ph ph-qr-code text-xl"></i>
          Generate ID Sekarang
        </button>
      </form>
    </div>

    <!-- Users Table -->
    <div class="bg-dark-800 shadow rounded-lg overflow-hidden">
      <div class="px-6 py-4 border-b border-dark-700 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <h2 class="text-xl font-semibold text-gray-200">Daftar Anggota</h2>
        <div class="relative w-full sm:w-64">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="ph ph-magnifying-glass text-gray-500"></i>
          </div>
          <input 
            type="text" 
            id="searchInput" 
            placeholder="Cari anggota..." 
            class="w-full pl-10 pr-4 py-2 bg-dark-700 border border-dark-600 rounded-lg focus:ring-primary-500 focus:border-primary-500 text-gray-200"
          >
        </div>
      </div>
      
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-dark-700 text-left">
            <tr>
              <th class="px-6 py-3 text-xs font-medium text-gray-300 uppercase tracking-wider">#</th>
              <th class="px-6 py-3 text-xs font-medium text-gray-300 uppercase tracking-wider">Nama</th>
              <th class="px-6 py-3 text-xs font-medium text-gray-300 uppercase tracking-wider hidden sm:table-cell">Email</th>
              <th class="px-6 py-3 text-xs font-medium text-gray-300 uppercase tracking-wider">User ID</th>
              <th class="px-6 py-3 text-xs font-medium text-gray-300 uppercase tracking-wider">QR Code</th>
              <th class="px-6 py-3 text-xs font-medium text-gray-300 uppercase tracking-wider">Aksi</th>
            </tr>
          </thead>
          <tbody class="bg-dark-800 divide-y divide-dark-700">
            @foreach($users as $user)
            <tr class="hover:bg-dark-700">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-200">{{ $loop->iteration }}</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-200">{{ $user->name }}</div>
                <div class="text-sm text-gray-400 sm:hidden">{{ $user->email }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400 hidden sm:table-cell">
                {{ $user->email }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                @if($user->user_id)
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-900 text-primary-200">
                    {{ $user->user_id }}
                  </span>
                @else
                  <span class="text-gray-500">-</span>
                @endif
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                @if($user->user_id)
                  <div class="qr-container" id="qr-{{ $user->user_id }}"></div>
                @else
                  <span class="text-gray-500">-</span>
                @endif
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                @if($user->user_id)
                  <div class="action-buttons">
                    <button
                      class="action-btn bg-dark-700 text-primary-400 hover:bg-dark-600"
                      onclick="showQRModal('{{ $user->user_id }}', '{{ $user->name }}', '{{ $user->user_id }}')"
                      type="button"
                      title="View QR Code"
                    >
                      <i class="ph ph-eye"></i>
                      <span class="action-text">View</span>
                    </button>
                    <button
                      class="action-btn bg-dark-700 text-green-400 hover:bg-dark-600 ml-2"
                      onclick="downloadQRCode('{{ $user->user_id }}', '{{ $user->name }}')"
                      type="button"
                      title="Download QR Code"
                    >
                      <i class="ph ph-download-simple"></i>
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
  <div id="qrModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden modal-backdrop">
    <div class="bg-dark-800 rounded-xl w-full max-w-md mx-4 shadow-2xl modal-content border border-dark-700">
      
      <!-- Modal Header -->
      <div class="flex justify-between items-center p-6 border-b border-dark-700">
        <div class="flex-1">
          <h3 class="text-xl font-semibold text-gray-200" id="modalTitle">John Doe</h3>
          <p class="text-sm text-gray-400 mt-1">QR Code ID Anggota</p>
        </div>
        <button onclick="closeModal()" class="text-gray-400 hover:text-gray-200 transition-colors p-2 hover:bg-dark-700 rounded-full">
          <i class="ph ph-x text-lg"></i>
        </button>
      </div>
      
      <!-- Modal Body -->
      <div class="p-6">
        <!-- QR Code Container -->
        <div class="modal-qr-container">
          <canvas id="modalQRCanvas"></canvas>
        </div>
        
        <!-- User ID Display -->
        <div class="text-center mt-6 p-4 bg-dark-700 rounded-lg">
          <p class="text-sm font-medium text-gray-400 mb-1">User ID:</p>
          <p class="text-xl font-bold text-primary-400" id="modaluserId">USR001</p>
        </div>
      </div>
      
      <!-- Modal Footer -->
      <div class="flex justify-center p-6 pt-0">
        <button 
          id="modalDownloadBtn"
          class="bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-8 rounded-lg transition duration-300 flex items-center gap-3 shadow-lg hover:shadow-xl"
        >
          <i class="ph ph-download-simple"></i>
          Download QR Code
        </button>
      </div>
    </div>
  </div>

  <!-- Hidden canvas for QR generation -->
  <canvas id="qrCanvas" style="display: none;"></canvas>

  <script>
    // Initialize QR codes for each user
    document.addEventListener('DOMContentLoaded', function() {
      @foreach($users as $user)
        @if($user->user_id)
          generateQRCode(document.getElementById('qr-{{ $user->user_id }}'), '{{ $user->user_id }}', 100);
        @endif
      @endforeach
    });

    // Search functionality
    document.getElementById('searchInput').addEventListener('input', function() {
      const searchValue = this.value.toLowerCase();
      const rows = document.querySelectorAll('tbody tr');
      
      rows.forEach(row => {
        const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        const email = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
        const userId = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
        
        if (name.includes(searchValue) || email.includes(searchValue) || userId.includes(searchValue)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    });

    // Show QR modal
    function showQRModal(userId, name, userIdText) {
      document.getElementById('modalTitle').textContent = name;
      document.getElementById('modaluserId').textContent = userIdText;
      
      // Generate QR code
      const canvas = document.getElementById('modalQRCanvas');
      generateQRCode(canvas, userId, 208);
      
      // Update download button
      const downloadBtn = document.getElementById('modalDownloadBtn');
      downloadBtn.onclick = () => downloadQRCode(userId, name);
      
      // Show modal with animation
      const modal = document.getElementById('qrModal');
      const backdrop = modal;
      const content = modal.querySelector('.modal-content');
      
      modal.classList.remove('hidden');
      
      setTimeout(() => {
        backdrop.classList.add('show');
        content.classList.add('show');
      }, 10);
    }

    // Close modal
    function closeModal() {
      const modal = document.getElementById('qrModal');
      const backdrop = modal;
      const content = modal.querySelector('.modal-content');
      
      backdrop.classList.remove('show');
      content.classList.remove('show');
      
      setTimeout(() => {
        modal.classList.add('hidden');
      }, 300);
    }

    // Generate QR code to canvas
    function generateQRCode(container, text, size) {
      if (container.tagName === 'CANVAS') {
        const qr = qrcode(0, 'L');
        qr.addData(text);
        qr.make();
        
        const cellSize = size / qr.getModuleCount();
        const ctx = container.getContext('2d');
        
        container.width = size;
        container.height = size;
        
        ctx.fillStyle = 'white';
        ctx.fillRect(0, 0, size, size);
        
        ctx.fillStyle = 'black';
        for (let row = 0; row < qr.getModuleCount(); row++) {
          for (let col = 0; col < qr.getModuleCount(); col++) {
            if (qr.isDark(row, col)) {
              ctx.fillRect(col * cellSize, row * cellSize, cellSize, cellSize);
            }
          }
        }
      } else {
        const qr = qrcode(0, 'L');
        qr.addData(text);
        qr.make();
        
        container.innerHTML = qr.createImgTag(4);
      }
    }

    // Download QR code
    function downloadQRCode(userId, name) {
      const canvas = document.getElementById('qrCanvas');
      generateQRCode(canvas, userId, 512);
      
      const pngUrl = canvas.toDataURL('image/png');
      const a = document.createElement('a');
      a.href = pngUrl;
      a.download = `${name.replace(/\s+/g, '_')}_${userId}_qrcode.png`;
      document.body.appendChild(a);
      a.click();
      document.body.removeChild(a);
    }

    // Close modal when clicking outside
    document.getElementById('qrModal').addEventListener('click', function(e) {
      if (e.target === this) {
        closeModal();
      }
    });

    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        const modal = document.getElementById('qrModal');
        if (!modal.classList.contains('hidden')) {
          closeModal();
        }
      }
    });
  </script>

</body>
</html>