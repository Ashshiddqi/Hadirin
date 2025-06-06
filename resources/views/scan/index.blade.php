<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Scan QR - Pilih Kamera</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #111827;
    }
    
    @media print {
      body { padding: 0; margin: 0; }
      .no-print { display: none !important; }
      .page-break { page-break-after: always; }
      header { display: none; }
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

    /* Scanner specific styles */
    .scanner-container { 
      transition: all 0.3s ease; 
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    .scanner-container:hover { 
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    #reader { 
      width: 100%; 
      max-width: 400px; 
      margin: 0 auto; 
      border-radius: 0.5rem;
      overflow: hidden;
    }
    .scan-line { 
      position: absolute; 
      width: 100%; 
      height: 3px; 
      background-color: #3B82F6;
      animation: scan 2s infinite linear; 
      box-shadow: 0 0 10px rgba(59, 130, 246, 0.7); 
    }
    @keyframes scan { 
      0% { top: 0; } 
      100% { top: 100%; } 
    }
    
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
          Scan Kehadiran
        </h1>
      </div>
    </div>
  </header>

  <main class="max-w-7xl mx-auto p-4 sm:p-6">
    <!-- Scanner Card -->
    <div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden scanner-container">
      <!-- Scanner Header -->
      <div class="px-6 py-4 border-b border-gray-700 bg-gray-700">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
          <div class="text-center md:text-left">
            <h2 class="text-xl font-semibold text-gray-100">SCAN KARTU ANGGOTA</h2>
            <p class="text-gray-400">Arahkan kamera ke QR Code pada kartu anggota</p>
          </div>
        </div>
      </div>
      
      <!-- Scanner Content -->
      <div class="p-6">
        <div class="flex flex-col items-center mb-6">
          <label for="cameraSelect" class="block text-sm font-medium text-gray-300 mb-1">Pilih Kamera:</label>
          <div class="flex gap-2 w-full max-w-md">
            <select id="cameraSelect" class="flex-1 block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 bg-gray-700 text-gray-100">
              <option value="">-- Pilih Kamera --</option>
            </select>
            <button onclick="startScan()" class="action-btn bg-gray-700 text-gray-100 hover:bg-gray-600 border border-gray-600">
              <i class="fas fa-play"></i>
              <span class="action-text">Mulai Scan</span>
            </button>
          </div>
        </div>

        <div id="reader" class="relative border-4 border-blue-500 rounded-lg overflow-hidden mx-auto">
          <div class="scan-line"></div>
        </div>

        <div id="result" class="mt-6 p-4 bg-gray-700 rounded-lg text-center text-gray-400 border border-gray-600">
          <i class="fas fa-qrcode text-2xl mr-3"></i><span class="text-lg">Menunggu scan QR Code...</span>
        </div>
      </div>
    </div>
  </main>

<script>
  let html5QrCode;

  Html5Qrcode.getCameras().then(devices => {
    const select = document.getElementById("cameraSelect");
    devices.forEach(device => {
      const option = document.createElement("option");
      option.value = device.id;
      option.text = device.label || `Kamera ${select.length}`;
      select.appendChild(option);
    });
  }).catch(err => {
    console.error("Error getting cameras:", err);
    document.getElementById("cameraSelect").innerHTML = '<option value="">Tidak ada kamera yang terdeteksi</option>';
  });

  function startScan() {
    const camId = document.getElementById("cameraSelect").value;
    if (!camId) return alert("Pilih kamera terlebih dahulu");

    if (html5QrCode) html5QrCode.stop().then(() => mulai(camId));
    else mulai(camId);
  }

  function mulai(camId) {
    html5QrCode = new Html5Qrcode("reader");
    html5QrCode.start(
      camId,
      { fps: 10, qrbox: { width: 250, height: 250 } },
      (decodedText) => {
        document.getElementById("result").innerHTML = `
          <div class="text-center text-green-400">
            <i class="fas fa-check-circle text-3xl mr-3"></i>
            <span class="text-xl font-semibold">Berhasil memindai!</span>
            <div class="mt-2 text-gray-300">${decodedText}</div>
          </div>
        `;

        fetch("/scan", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
          },
          body: JSON.stringify({
            user_id: decodedText,
            event_id: "{{ $activeEvent->id ?? null }}"
          })
        }).then(res => res.json())
          .then(data => {
            if (data.status !== "success") alert(data.message);
          });

        html5QrCode.stop();
      },
      error => {
        console.error("QR Code scan error:", error);
      }
    ).catch(err => {
      console.error("Failed to start QR scanner:", err);
      alert("Gagal memulai scanner. Pastikan kamera tersedia dan izin diberikan.");
    });
  }
</script>
</body>
</html>