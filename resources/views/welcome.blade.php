<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Sistem Pengelola Kehadiran SMKN 1 Kota Bengkulu">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        fontFamily: {
          sans: ['Poppins', 'sans-serif'],
        },
        extend: {
          colors: {
            primary: {
              700: '#33415C',
              800: '#2A354B',
              900: '#21283A',
            },
          },
          boxShadow: {
            'card': '0 6px 10px -1px rgba(0, 0, 0, 0.2), 0 4px 6px -1px rgba(0, 0, 0, 0.15)',
            'card-hover': '0 15px 20px -5px rgba(0, 0, 0, 0.25), 0 6px 10px -3px rgba(0, 0, 0, 0.2)',
            'card-active': '0 4px 8px -2px rgba(0, 0, 0, 0.25)',
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
  <title>Hadirin - Sistem Kehadiran SMKN 1 Kota Bengkulu</title>
  <style>
    @media (max-width: 640px) {
      .header-height {
        height: auto;
        min-height: 18rem;
      }
      .card-square {
        aspect-ratio: 1/1;
      }
    }
    
    .card {
      transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
      box-shadow: 0 6px 10px -1px rgba(0, 0, 0, 0.2), 0 4px 6px -1px rgba(0, 0, 0, 0.15);
      will-change: transform, box-shadow;
    }
    
    .card:hover {
      transform: translateY(-6px);
      box-shadow: 0 15px 20px -5px rgba(0, 0, 0, 0.25), 0 6px 10px -3px rgba(0, 0, 0, 0.2);
    }
    
    .card:active {
      transform: translateY(-2px) scale(0.98);
      box-shadow: 0 4px 8px -2px rgba(0, 0, 0, 0.25);
    }
  </style>
</head>
<body class="bg-gray-100 font-sans min-h-screen antialiased">

  <!-- Header -->
  <header class="w-full header-height bg-primary-700 border-white border-4 border-t-0 rounded-b-3xl px-6 py-8 md:px-8 md:py-10 relative overflow-hidden">
    <div class="relative z-10 max-w-6xl mx-auto">
      <div class="flex justify-between items-start">
        <div class="text-white font-bold text-lg">HADIRIN</div>
        <div class="inline-flex">
          <div class="w-4 h-4 bg-[#979DAC] rounded-full"></div>
          <div class="w-4 h-4 bg-[#979DAC] rounded-full ml-3"></div>
        </div>
      </div>

      <div class="w-full my-5 text-white text-center">
        <div class="mx-auto w-20 h-20 md:w-24 md:h-24 rounded-full">
          <img src="{{ asset('images/logo.png') }}" alt="Logo SMKN 1 Kota Bengkulu" class="w-full h-full object-contain" />
        </div>
        <p class="text-2xl tracking-wider mt-2">SMKN 1</p>
        <p class="text-2xl font-semibold">Kota Bengkulu</p>
      </div>

      <!-- Increased margin-top here (from mt-6 to mt-8) and added font-semibold -->
      <nav class="w-full mt-8 grid place-items-center">
        <div class="inline-flex gap-6">
          <button id="b1" onclick="switchTab(1)" class="hover:scale-150 duration-300 text-white text-lg px-4 py-2 font-semibold">Tools</button>
          <button id="b2" onclick="switchTab(2)" class="hover:scale-150 duration-300 text-white text-lg px-4 py-2 font-semibold">Prints</button>
          <button id="b3" onclick="switchTab(3)" class="hover:scale-150 duration-300 text-white text-lg px-4 py-2 font-semibold">Info</button>
        </div>
      </nav>
    </div>
  </header>

  <!-- Main Content -->
  <main class="w-full h-fit px-4 sm:px-10 py-10 max-w-6xl mx-auto">

    <!-- Tools Tab -->
    <div id="tab1" class="grid grid-cols-2 sm:grid-cols-2 gap-4">
      <a href="/users" class="card bg-primary-700 rounded-xl overflow-hidden text-center font-bold animate-fade-in animate-slide-up">
        <div class="h-full p-4 md:p-6 flex flex-col items-center justify-center">
          <img src="{{ asset('images/users.png') }}" class="w-16 h-16 md:w-20 md:h-20 mb-3 md:mb-4" alt="Input Pengguna" />
          <h3 class="text-sm md:text-base font-semibold text-white mb-1">Input Pengguna</h3>
          <p class="text-xs text-white text-opacity-80">Tambah atau Ubah Data Pengguna</p>
        </div>
      </a>
      
      <a href="/events" class="card bg-primary-700 rounded-xl overflow-hidden text-center font-bold animate-fade-in animate-slide-up">
        <div class="h-full p-4 md:p-6 flex flex-col items-center justify-center">
          <img src="{{ asset('images/input.png') }}" class="w-16 h-16 md:w-20 md:h-20 mb-3 md:mb-4" alt="Input Kegiatan" />
          <h3 class="text-sm md:text-base font-semibold text-white mb-1">Input Kegiatan</h3>
          <p class="text-xs text-white text-opacity-80">Kelola Jadwal Kegiatan</p>
        </div>
      </a>
      
      <a href="{{ route('generate.id.show') }}" class="card bg-primary-700 rounded-xl overflow-hidden text-center font-bold animate-fade-in animate-slide-up">
        <div class="h-full p-4 md:p-6 flex flex-col items-center justify-center">
          <img src="{{ asset('images/id.png') }}" class="w-16 h-16 md:w-20 md:h-20 mb-3 md:mb-4" alt="Generate ID" />
          <h3 class="text-sm md:text-base font-semibold text-white mb-1">Generate ID Pengguna</h3>
          <p class="text-xs text-white text-opacity-80">Buat Kartu Pengguna</p>
        </div>
      </a>
      
      <a href="{{ route('scan.show') }}" class="card bg-primary-700 rounded-xl overflow-hidden text-center font-bold animate-fade-in animate-slide-up">
        <div class="h-full p-4 md:p-6 flex flex-col items-center justify-center">
          <img src="{{ asset('images/scan.png') }}" class="w-16 h-16 md:w-20 md:h-20 mb-3 md:mb-4" alt="Scan Kehadiran" />
          <h3 class="text-sm md:text-base font-semibold text-white mb-1">Scan Kehadiran</h3>
          <p class="text-xs text-white text-opacity-80">Scan QR Code Presensi</p>
        </div>
      </a>
    </div>

    <!-- Prints Tab -->
    <div id="tab2" class="hidden grid grid-cols-1 gap-4">
      <a href="{{ route('print.harian') }}" class="card bg-primary-700 rounded-xl overflow-hidden text-center font-bold animate-fade-in animate-slide-up">
        <div class="h-full p-4 md:p-6 flex flex-col items-center justify-center">
          <img src="{{ asset('images/calender.png') }}" class="w-16 h-16 md:w-20 md:h-20 mb-3 md:mb-4" alt="Print Kehadiran Harian" />
          <h3 class="text-sm md:text-base font-semibold text-white mb-1">Cetak Kehadiran Harian</h3>
          <p class="text-xs text-white text-opacity-80">Cetak Kehadiran Harian</p>
        </div>
      </a>
      
      <div class="grid grid-cols-2 gap-4">
        <a href="{{ route('print.bulanan') }}" class="card bg-primary-700 rounded-xl overflow-hidden text-center font-bold animate-fade-in animate-slide-up">
          <div class="h-full p-4 md:p-6 flex flex-col items-center justify-center">
            <img src="{{ asset('images/calender.png') }}" class="w-16 h-16 md:w-20 md:h-20 mb-3 md:mb-4" alt="Print Kehadiran Bulanan" />
            <h3 class="text-sm md:text-base font-semibold text-white mb-1">Cetak Kehadiran Bulanan</h3>
            <p class="text-xs text-white text-opacity-80">Cetak Kehadiran Bulanan</p>
          </div>
        </a>
        
        <a href="{{ route('print.card.id') }}" class="card bg-primary-700 rounded-xl overflow-hidden text-center font-bold animate-fade-in animate-slide-up">
          <div class="h-full p-4 md:p-6 flex flex-col items-center justify-center">
            <img src="{{ asset('images/print.png') }}" class="w-16 h-16 md:w-20 md:h-20 mb-3 md:mb-4" alt="Print ID" />
            <h3 class="text-sm md:text-base font-semibold text-white mb-1">Cetak Semua ID Pengguna</h3>
            <p class="text-xs text-white text-opacity-80">Cetak Semua Kartu Pengguna</p>
          </div>
        </a>
      </div>
    </div>

    <!-- Info Tab -->
    <div id="tab3" class="hidden animate-fade-in">
      <div class="card bg-primary-700 rounded-xl p-6 md:p-8">
        <div class="flex items-center mb-4 md:mb-6">
          <h2 class="text-xl md:text-2xl font-bold text-white">Tentang Hadirin</h2>
        </div>
        
        <div class="space-y-3 md:space-y-4">
          <div class="flex items-start">
            <div class="flex-shrink-0 mt-1">
              <div class="w-2 h-2 rounded-full bg-white"></div>
            </div>
            <p class="ml-3 text-white text-opacity-90 text-sm md:text-base">
              <span class="font-semibold">Hadirin</span> merupakan sebuah sistem pengelola kehadiran dalam lingkungan sekolah.
            </p>
          </div>
          
          <div class="flex items-start">
            <div class="flex-shrink-0 mt-1">
              <div class="w-2 h-2 rounded-full bg-white"></div>
            </div>
            <p class="ml-3 text-white text-opacity-90 text-sm md:text-base">
              Dengan desain minimalis dan sederhana, Hadirin mampu mengakomodasi 
              kebutuhan pencatatan kehadiran masyarakat sekolah dalam berbagai situasi.
            </p>
          </div>
          
          <div class="flex items-start">
            <div class="flex-shrink-0 mt-1">
              <div class="w-2 h-2 rounded-full bg-white"></div>
            </div>
            <p class="ml-3 text-white text-opacity-90 text-sm md:text-base">
              Pengembangan sistem ini didukung sepenuhnya secara swadaya, sebagai
              produk hibah dari Guru Produktif Jurusan PPLG SMKN 1 Kota Bengkulu.
            </p>
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
        document.getElementById('b' + i).classList.remove('opacity-50');
      }
      
      // Show selected tab
      document.getElementById('tab' + id).classList.remove('hidden');
      document.getElementById('b' + id).classList.add('opacity-50');
      
      // Store selected tab in sessionStorage
      sessionStorage.setItem('selectedTab', id);
    }

    // Set initial tab from sessionStorage or default to 1
    document.addEventListener('DOMContentLoaded', () => {
      const selectedTab = sessionStorage.getItem('selectedTab') || 1;
      switchTab(selectedTab);
    });
  </script>
</body>
</html>