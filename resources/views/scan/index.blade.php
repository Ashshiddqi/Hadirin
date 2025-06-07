<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Scan QR Code</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
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
    
    /* Scanner styling */
    .scanner-container {
      border: 2px solid #38bdf8;
      box-shadow: 0 0 20px rgba(56, 189, 248, 0.3);
    }
    
    /* Pulse animation for scan indicator */
    @keyframes pulse {
      0%, 100% { opacity: 0.5; }
      50% { opacity: 1; }
    }
    
    .scan-indicator {
      animation: pulse 1.5s ease-in-out infinite;
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
    }
    
    ::-webkit-scrollbar-track {
      background: #1e293b;
    }
    
    ::-webkit-scrollbar-thumb {
      background: #334155;
      border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
      background: #475569;
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
        <a href="{{ url('/') }}" class="text-gray-400 hover:text-gray-200 transition-colors" title="Kembali ke Beranda">
          <i class="ph ph-arrow-left text-xl"></i>
        </a>
        <h1 class="text-lg sm:text-xl font-bold text-gray-200">
          Scan Presensi QR Code
        </h1>
      </div>
      <div class="flex items-center">
        <i class="ph ph-qr-code text-primary-400 text-xl"></i>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="flex-grow max-w-2xl mx-auto p-4 w-full relative z-10">
    <div class="bg-dark-800 rounded-xl shadow-lg p-6">

      @if(session('error'))
        <div class="mb-4 p-4 bg-red-900 bg-opacity-20 border border-red-500 text-red-200 rounded-lg">
          <div class="flex items-center">
            <i class="ph ph-warning-circle mr-2 text-xl"></i>
            <span>{{ session('error') }}</span>
          </div>
        </div>
      @endif

      <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-200 mb-2">Pemindai QR Code</h2>
        <p class="text-gray-400">Arahkan kamera ke QR Code untuk melakukan presensi</p>
      </div>

      <!-- Camera Selection -->
      <div class="mb-6">
        <label for="cameraSelect" class="block text-sm font-medium text-gray-300 mb-2">Pilih Kamera</label>
        <div class="flex space-x-2">
          <select id="cameraSelect" class="flex-grow p-2 bg-dark-700 border border-dark-600 rounded-lg focus:ring-primary-500 focus:border-primary-500 text-gray-200">
            <option value="">-- Pilih Kamera --</option>
          </select>
          <button onclick="startScan()" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors flex items-center">
            <i class="ph ph-play mr-2"></i> Mulai
          </button>
        </div>
      </div>

      <!-- Scanner Area -->
      <div id="reader" class="scanner-container rounded-lg w-full max-w-md aspect-square mx-auto overflow-hidden bg-dark-700 flex items-center justify-center">
        <div class="text-center p-4 text-gray-500">
          <i class="ph ph-camera text-4xl mb-2"></i>
          <p>Kamera belum diaktifkan</p>
        </div>
      </div>

      <!-- Scan Status -->
      <div id="result" class="p-4 bg-dark-700 rounded-lg border border-primary-500 text-center my-6">
        <div class="flex items-center justify-center space-x-2 text-primary-400">
          <i class="ph ph-qr-code"></i>
          <span>Menunggu scan QR Code...</span>
        </div>
      </div>

      <!-- Presence Form (Hidden by default) -->
      <form id="presenceForm" method="POST" action="{{ route('scan.process') }}" class="hidden bg-dark-700 p-4 rounded-lg border border-dark-600">
        @csrf
        <input type="hidden" name="user_id" id="user_id">
        
        <div class="mb-4">
          <label for="statusSelect" class="block text-sm font-medium text-gray-300 mb-2">Status Kehadiran</label>
          <select id="statusSelect" name="status" required class="w-full p-2 bg-dark-800 border border-dark-600 rounded-lg focus:ring-primary-500 focus:border-primary-500 text-gray-200">
            <option value="hadir" selected>Hadir</option>
            <option value="izin">Izin</option>
            <option value="sakit">Sakit</option>
            <option value="tidak hadir">Tidak Hadir</option>
          </select>
        </div>
        
        <div class="mb-4">
          <label for="keterangan" class="block text-sm font-medium text-gray-300 mb-2">Keterangan (opsional)</label>
          <textarea id="keterangan" name="keterangan" rows="3" placeholder="Masukkan keterangan tambahan..." class="w-full p-2 bg-dark-800 border border-dark-600 rounded-lg focus:ring-primary-500 focus:border-primary-500 text-gray-200"></textarea>
        </div>
        
        <button type="submit" class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors flex items-center justify-center">
          <i class="ph ph-check-circle mr-2"></i> Simpan Presensi
        </button>
      </form>

    </div>
  </main>

  <script>
    let html5QrCode;
    let isScanning = false;
    let scanInProgress = false;

    // Get available cameras
    Html5Qrcode.getCameras().then(devices => {
      const select = document.getElementById("cameraSelect");
      if (devices.length === 0) {
        const option = document.createElement("option");
        option.text = "Tidak ada kamera yang ditemukan";
        option.disabled = true;
        select.appendChild(option);
      } else {
        devices.forEach((device, index) => {
          const option = document.createElement("option");
          option.value = device.id;
          option.text = device.label || `Kamera ${index + 1}`;
          select.appendChild(option);
        });
      }
    }).catch(err => {
      console.error("Failed to get cameras:", err);
      const select = document.getElementById("cameraSelect");
      const option = document.createElement("option");
      option.text = "Gagal mengakses kamera";
      option.disabled = true;
      select.appendChild(option);
    });

    // Start scanning function
    function startScan() {
      const camId = document.getElementById("cameraSelect").value;
      if (!camId) {
        showAlert("Pilih kamera terlebih dahulu", "warning");
        return;
      }

      if (isScanning) {
        stopScan();
        setTimeout(() => startScanning(camId), 500);
      } else {
        startScanning(camId);
      }
    }

    function startScanning(camId) {
      const readerElement = document.getElementById("reader");
      readerElement.innerHTML = "";
      
      html5QrCode = new Html5Qrcode("reader");
      isScanning = true;
      scanInProgress = false;

      updateScanStatus("Memindai...", "primary-400", "ph-spinner-gap", true);

      document.getElementById("presenceForm").classList.add("hidden");

      // Calculate QR box size based on container size
      const containerWidth = readerElement.offsetWidth;
      const qrboxSize = Math.min(300, containerWidth - 40); // 40px padding

      html5QrCode.start(
        camId,
        { 
          fps: 10, 
          qrbox: { width: qrboxSize, height: qrboxSize },
          aspectRatio: 1.0,
          experimentalFeatures: {
            useBarCodeDetectorIfSupported: true
          }
        },
        (decodedText) => {
          handleScanSuccess(decodedText);
        },
        (errorMessage) => {
          // Error handling
        }
      ).catch(err => {
        console.error("Failed to start scanner:", err);
        showAlert("Gagal memulai kamera", "error");
        isScanning = false;
        resetScannerView();
      });
    }

    function stopScan() {
      if (html5QrCode && isScanning) {
        html5QrCode.stop().then(() => {
          isScanning = false;
          resetScannerView();
        }).catch(err => {
          console.error("Failed to stop scanner:", err);
        });
      }
    }

    function handleScanSuccess(decodedText) {
      if (scanInProgress) return;
      scanInProgress = true;

      updateScanStatus("QR Code berhasil dipindai", "green-500", "ph-check-circle");
      
      document.getElementById("user_id").value = decodedText;
      document.getElementById("presenceForm").classList.remove("hidden");

      stopScan();
    }

    function updateScanStatus(message, color, icon, spinning = false) {
      const resultElement = document.getElementById("result");
      resultElement.className = `p-4 bg-dark-700 rounded-lg border border-${color} text-center my-6`;
      
      let iconClass = `ph ${icon}`;
      if (spinning) iconClass += " animate-spin";
      
      resultElement.innerHTML = `
        <div class="flex items-center justify-center space-x-2 text-${color}">
          <i class="${iconClass}"></i>
          <span>${message}</span>
        </div>
      `;
    }

    function resetScannerView() {
      document.getElementById("reader").innerHTML = `
        <div class="text-center p-4 text-gray-500">
          <i class="ph ph-camera text-4xl mb-2"></i>
          <p>Kamera belum diaktifkan</p>
        </div>
      `;
      
      updateScanStatus("Menunggu scan QR Code...", "primary-400", "ph-qr-code");
    }

    function showAlert(message, type) {
      const colors = {
        warning: "yellow-500",
        error: "red-500",
        success: "green-500"
      };
      
      const icons = {
        warning: "ph-warning-circle",
        error: "ph-x-circle",
        success: "ph-check-circle"
      };
      
      const alertDiv = document.createElement("div");
      alertDiv.className = `mb-4 p-4 bg-${colors[type]}-900 bg-opacity-20 border border-${colors[type]} text-${colors[type]}-200 rounded-lg`;
      alertDiv.innerHTML = `
        <div class="flex items-center">
          <i class="ph ${icons[type]} mr-2 text-xl"></i>
          <span>${message}</span>
        </div>
      `;
      
      const container = document.querySelector("main > div");
      container.insertBefore(alertDiv, container.firstChild);
      
      setTimeout(() => {
        alertDiv.remove();
      }, 5000);
    }

    window.addEventListener('beforeunload', () => {
      if (html5QrCode && isScanning) {
        html5QrCode.stop();
      }
    });
  </script>
</body>
</html>