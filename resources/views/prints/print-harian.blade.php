<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cetak Kehadiran Harian</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
 
  <style>
    @media print {
      body { 
        padding: 0; 
        margin: 0; 
        font-size: 12pt;
        background: white;
      }
      .no-print { 
        display: none !important; 
      }
      header { 
        display: none; 
      }
      .print-header { 
        display: block !important; 
      }
      table {
        width: 100%;
        border-collapse: collapse;
      }
      th, td {
        padding: 8px 12px;
        border: 1px solid #e2e8f0;
      }
      .hover\:bg-gray-50 { 
        background-color: transparent !important; 
      }
      .summary-grid {
        page-break-inside: avoid;
      }
    }
    
    @page {
      size: A4 portrait;
      margin: 15mm;
    }
    
    .action-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
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
    
    .status-badge {
      display: inline-block;
      min-width: 80px;
      padding: 4px 8px;
      text-align: center;
      font-size: 12px;
      font-weight: 600;
      border-radius: 4px;
      color: white;
    }
    
    @media (max-width: 640px) {
      .action-buttons {
        display: flex;
        flex-direction: row;
        gap: 0.5rem;
        justify-content: flex-end;
      }
      .action-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
      }
      .action-text {
        display: none;
      }
    }
  </style>
</head>
<body class="bg-gray-100 min-h-screen">

  <!-- Header untuk tampilan web -->
  <header class="bg-[#33415C] shadow-sm no-print">
    <div class="max-w-7xl mx-auto px-4 py-3 sm:px-6 flex justify-between items-center">
      <div class="flex items-center space-x-3">
        <a href="{{ url('/') }}" class="text-white hover:text-gray-200 transition-colors" title="Kembali">
          <i class="fas fa-arrow-left text-lg"></i>
        </a>
        <h1 class="text-lg font-bold text-white">
          Rekap Kehadiran Harian Guru
        </h1>
      </div>
    </div>
  </header>

  <!-- Header untuk cetakan -->
  <div class="print-header hidden bg-white py-4 border-b-2 border-[#33415C]">
    <div class="text-center">
      <img src="{{ asset('images/logo.png') }}" alt="Logo Sekolah" class="h-16 mx-auto mb-2">
      <h1 class="text-xl font-bold">SMK NEGERI 1 KOTA BENGKULU</h1>
      <p class="text-sm">Jl. Jati No 41, Kelurahan Padang Jati<br>Kecamatan Ratu Samban, Kota Bengkulu 38222</p>
      <h2 class="text-lg font-semibold mt-4">REKAPITULASI KEHADIRAN HARIAN GURU</h2>
      <p class="text-md font-medium text-[#33415C]">{{ $date }}</p>
    </div>
  </div>

  <div class="max-w-7xl mx-auto p-4 sm:p-6">
    <!-- Filter Tanggal -->
    <form method="GET" action="{{ route('print.harian') }}" class="no-print mb-6 bg-white p-4 rounded-lg shadow">
      <div class="flex flex-col sm:flex-row items-start sm:items-end gap-4">
        <div class="w-full sm:w-auto">
          <label class="block mb-1 text-sm font-medium text-gray-700">Pilih Tanggal:</label>
          <input type="date" name="date" value="{{ $rawDate }}" 
                 class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-[#33415C] focus:border-[#33415C]">
        </div>
        <button type="submit" class="w-full sm:w-auto bg-[#33415C] hover:bg-[#293449] text-white text-sm px-4 py-2 rounded">
          <i class="fas fa-search mr-1"></i> Tampilkan
        </button>
      </div>
    </form>

    <!-- Report Card -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
      <!-- Report Header -->
      <div class="px-6 py-4 border-b bg-[#33415C] no-print">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
          <div class="text-center md:text-left">
            <h2 class="text-xl font-semibold text-white">REKAP KEHADIRAN HARIAN GURU</h2>
            <p class="text-gray-200">SMKN 1 Kota Bengkulu</p>
            <p class="text-md font-medium text-white">{{ $date }}</p>
          </div>
          <div class="action-buttons">
            <button onclick="window.print()" class="action-btn bg-white text-[#33415C] hover:bg-gray-100">
              <i class="fas fa-print"></i>
              <span class="action-text">Cetak</span>
            </button>
          </div>
        </div>
      </div>

      <!-- Report Content -->
      <div class="p-4 sm:p-6">
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-[#33415C]">
              <tr>
                <th class="px-4 py-3 text-center text-sm font-bold text-white uppercase tracking-wider">No</th>
                <th class="px-4 py-3 text-left text-sm font-bold text-white uppercase tracking-wider">Nama</th>
                <th class="px-4 py-3 text-left text-sm font-bold text-white uppercase tracking-wider">Status</th>
                <th class="px-4 py-3 text-left text-sm font-bold text-white uppercase tracking-wider">Keterangan</th>
                <th class="px-4 py-3 text-left text-sm font-bold text-white uppercase tracking-wider">Waktu</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @forelse($attendances as $index => $attendance)
              <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 text-center text-sm text-gray-700">{{ $index + 1 }}</td>
                <td class="px-4 py-3">
                  <div class="text-sm font-medium text-gray-900">{{ $attendance->user->name }}</div>
                </td>
                <td class="px-4 py-3">
                  <span class="status-badge
                    {{ $attendance->status === 'hadir' ? 'bg-[#005E09]' : '' }}
                    {{ $attendance->status === 'izin' ? 'bg-[#53158F]' : '' }}
                    {{ $attendance->status === 'sakit' ? 'bg-[#015BA0]' : '' }}
                    {{ $attendance->status === 'tidak hadir' ? 'bg-[#A4133C]' : '' }}">
                    {{ ucfirst($attendance->status) }}
                  </span>
                </td>
                <td class="px-4 py-3 text-sm text-gray-700">
                  {{ $attendance->keterangan ?? '-' }}
                </td>
                <td class="px-4 py-3 text-sm text-gray-700">
                  {{ $attendance->scan_time->format('H:i:s') }}
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="5" class="px-4 py-4 text-sm text-gray-500 text-center">
                  Tidak ada data kehadiran pada tanggal ini
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <!-- Summary -->
        @if($attendances->count() > 0)
        <div class="mt-6 p-4 bg-gray-50 rounded-lg summary-grid">
          <div class="mb-3 text-sm text-gray-700">
            <strong>Total Data:</strong> {{ $attendances->count() }} guru
          </div>
          <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
            <div class="bg-[#005E09] text-white p-3 rounded text-center">
              <div class="text-sm font-semibold">Hadir</div>
              <div class="text-xl font-bold">{{ $statusCounts['hadir'] ?? 0 }}</div>
            </div>
            <div class="bg-[#53158F] text-white p-3 rounded text-center">
              <div class="text-sm font-semibold">Izin</div>
              <div class="text-xl font-bold">{{ $statusCounts['izin'] ?? 0 }}</div>
            </div>
            <div class="bg-[#015BA0] text-white p-3 rounded text-center">
              <div class="text-sm font-semibold">Sakit</div>
              <div class="text-xl font-bold">{{ $statusCounts['sakit'] ?? 0 }}</div>
            </div>
            <div class="bg-[#A4133C] text-white p-3 rounded text-center">
              <div class="text-sm font-semibold">Tidak Hadir</div>
              <div class="text-xl font-bold">{{ $statusCounts['tidak_hadir'] ?? 0 }}</div>
            </div>
          </div>
          <div class="mt-4 text-xs text-gray-500 text-right">
            Dicetak pada: {{ now()->format('d-m-Y H:i:s') }} oleh {{ auth()->user()->name ?? 'Admin' }}
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>

  <script>
    // Menyiapkan halaman sebelum dicetak
    function beforePrint() {
      document.querySelectorAll('.hover\\:bg-gray-50').forEach(el => {
        el.classList.remove('hover:bg-gray-50');
      });
      document.querySelector('.print-header').classList.remove('hidden');
    }
    
    // Mengembalikan setelah cetakan
    function afterPrint() {
      document.querySelectorAll('.hover\\:bg-gray-50').forEach(el => {
        el.classList.add('hover:bg-gray-50');
      });
      document.querySelector('.print-header').classList.add('hidden');
    }
    
    window.addEventListener('beforeprint', beforePrint);
    window.addEventListener('afterprint', afterPrint);
  </script>
</body>
</html>