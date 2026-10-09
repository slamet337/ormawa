<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="default-src * 'unsafe-inline' 'unsafe-eval' data: blob:; script-src * 'unsafe-inline' 'unsafe-eval' data: blob:; style-src * 'unsafe-inline' data:; font-src * data:; img-src * data: blob:;">
    <title>@yield('title', 'SMARTEDU-NUTRICHEM')</title>
    <meta name="description" content="SMARTEDU-NUTRICHEM">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logo-untad-original.png') }}">
    <link rel="shortcut icon" href="{{ asset('logo-untad-original.png') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome & Lucide Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CSS CDN & Alpine.js -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: {
                            50: '#f0f4f9',
                            100: '#d9e2ec',
                            800: '#102847',
                            900: '#0b1b33',
                            950: '#071224',
                        },
                        tealAccent: {
                            400: '#2DD4BF',
                            500: '#00C9A7',
                            600: '#059669',
                        },
                        coralAccent: {
                            500: '#FF6B35',
                            600: '#E85520',
                        }
                    },
                    fontFamily: {
                        sans: ['Outfit', 'Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        .glass-nav {
            background: #ffffff;
            border-bottom: 1px solid rgba(16, 40, 71, 0.1);
        }
        .hero-gradient {
            background: linear-gradient(135deg, #071224 0%, #102847 60%, #0d3859 100%);
        }
        .card-glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(16, 40, 71, 0.08);
        }
        .glow-teal {
            box-shadow: 0 0 25px rgba(0, 201, 167, 0.35);
        }
        .glow-coral {
            box-shadow: 0 0 25px rgba(255, 107, 53, 0.35);
        }
        .float-animation {
            animation: float 4s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body class="font-sans text-slate-800 bg-slate-50 antialiased selection:bg-tealAccent-500 selection:text-white" x-data="{ mobileMenu: false }">

    <!-- Header Navigation -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-white text-slate-800 shadow-md border-b border-slate-200 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                <img src="{{ asset('logo-smartedu.png') }}" alt="SMARTEDU Logo" class="w-24 h-15 object-contain group-hover:scale-50 transition-transform">
                <div class="flex flex-col">
                    <span class="font-extrabold text-lg sm:text-xl tracking-tight text-navy-900 group-hover:text-teal-600 transition-colors">
                        SMARTEDU<span class="text-teal-600">-NUTRICHEM</span>
                    </span>
                    <span class="text-[10px] text-teal-700 font-bold tracking-wider uppercase">PPK Ormawa HIMASKI UNTAD</span>
                </div>
            </a>

            <!-- Desktop Menu -->
            <nav class="hidden md:flex items-center space-x-7 text-sm font-semibold">
                <a href="#tentang" class="text-slate-700 hover:text-teal-600 transition-colors py-1">Tentang</a>
                <a href="#modul" class="text-slate-700 hover:text-teal-600 transition-colors py-1">Modul Edukasi</a>
                <a href="#video" class="text-slate-700 hover:text-teal-600 transition-colors py-1">Video</a>
                <a href="#game" class="text-slate-700 hover:text-teal-600 transition-colors py-1">Game Interaktif</a>
                <a href="#galeri" class="text-slate-700 hover:text-teal-600 transition-colors py-1">Galeri</a>
                <a href="#tim" class="text-slate-700 hover:text-teal-600 transition-colors py-1">Tim Kami</a>
                <a href="#kontak" class="text-slate-700 hover:text-teal-600 transition-colors py-1">Kontak</a>
            </nav>

            <!-- Action Buttons -->
            @auth
                <div class="hidden sm:flex items-center space-x-3">
                    <a href="{{ route('admin.dashboard') }}" class="px-4 py-2.5 rounded-xl bg-tealAccent-500 hover:bg-tealAccent-600 text-navy-950 font-extrabold text-xs uppercase tracking-wider shadow-md flex items-center space-x-2 transition-all hover:scale-105">
                        <i class="fa-solid fa-gauge-high"></i>
                        <span>Dashboard Admin</span>
                    </a>
                </div>
            @endauth

            <!-- Mobile Hamburger Button -->
            <div class="md:hidden flex items-center">
                <button @click="mobileMenu = !mobileMenu" class="p-2 text-navy-800 hover:text-teal-600 focus:outline-none">
                    <i class="fa-solid" :class="mobileMenu ? 'fa-xmark text-2xl' : 'fa-bars text-xl'"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="mobileMenu" x-transition class="md:hidden bg-white border-b border-slate-200 px-4 pt-3 pb-6 space-y-3 shadow-xl">
            <a @click="mobileMenu = false" href="#tentang" class="block text-slate-700 font-semibold py-2 hover:text-teal-600">Tentang Program</a>
            <a @click="mobileMenu = false" href="#modul" class="block text-slate-700 font-semibold py-2 hover:text-teal-600">Modul Edukasi</a>
            <a @click="mobileMenu = false" href="#video" class="block text-slate-700 font-semibold py-2 hover:text-teal-600">Video Edukasi</a>
            <a @click="mobileMenu = false" href="#game" class="block text-slate-700 font-semibold py-2 hover:text-teal-600">Game Edukasi</a>
            <a @click="mobileMenu = false" href="#galeri" class="block text-slate-700 font-semibold py-2 hover:text-teal-600">Galeri Kegiatan</a>
            <a @click="mobileMenu = false" href="#tim" class="block text-slate-700 font-semibold py-2 hover:text-teal-600">Tim Pelaksana</a>
            <a @click="mobileMenu = false" href="#kontak" class="block text-slate-700 font-semibold py-2 hover:text-teal-600">Kontak</a>
            @auth
                <div class="pt-2 flex flex-col gap-2">
                    <a href="{{ route('admin.dashboard') }}" class="w-full text-center py-2.5 rounded-xl bg-tealAccent-500 text-navy-900 font-bold text-xs uppercase">Dashboard Admin</a>
                </div>
            @endauth
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-20 min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-navy-950 text-white border-t border-navy-800 pt-16 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
                <!-- Col 1: About -->
                <div class="md:col-span-2 space-y-4">
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('logo-smartedu.png') }}" alt="SMARTEDU Logo" class="w-24 h-15 object-contain group-hover:scale-50 transition-transform">
                        <span class="font-extrabold text-xl tracking-tight">SMARTEDU<span class="text-tealAccent-500">-NUTRICHEM</span></span>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed max-w-md">
                        Inovasi Program Pengabdian Masyarakat oleh Ormawa HIMASKI Universitas Tadulako dalam percepatan penurunan stunting berbasis teknologi dan kimia terapan di Desa Bale, Donggala.
                    </p>
                    <div class="flex items-center space-x-3 pt-2">
                        <a href="https://www.instagram.com/ppkormawa.himaski?cplk=ZXBwOTV4azJoMnVs" target="_blank" class="w-9 h-9 rounded-lg bg-white/10 hover:bg-tealAccent-500 hover:text-navy-900 flex items-center justify-center transition-colors">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="mailto:ppkormawahimaski@gmail.com" class="w-9 h-9 rounded-lg bg-white/10 hover:bg-tealAccent-500 hover:text-navy-900 flex items-center justify-center transition-colors" title="Kirim Email ke ppkormawahimaski@gmail.com">
                            <i class="fa-regular fa-envelope"></i>
                        </a>
                    </div>
                </div>

                <!-- Col 2: Navigation -->
                <div>
                    <h4 class="font-bold text-white text-base mb-4 tracking-wide uppercase text-xs text-teal-400">Tautan Cepat</h4>
                    <ul class="space-y-2.5 text-sm text-slate-300">
                        <li><a href="#tentang" class="hover:text-tealAccent-400 transition-colors">Mengapa SMARTEDU</a></li>
                        <li><a href="#modul" class="hover:text-tealAccent-400 transition-colors">Katalog Modul</a></li>
                        <li><a href="#video" class="hover:text-tealAccent-400 transition-colors">Video Edukasi</a></li>
                        <li><a href="#game" class="hover:text-tealAccent-400 transition-colors">Kuis & Game Gizi</a></li>
                        <li><a href="#galeri" class="hover:text-tealAccent-400 transition-colors">Galeri Posyandu</a></li>
                    </ul>
                </div>

                <!-- Col 3: Contact Info -->
                <div>
                    <h4 class="font-bold text-white text-base mb-4 tracking-wide uppercase text-xs text-teal-400">Kontak & Lokasi</h4>
                    <ul class="space-y-3 text-sm text-slate-300">
                        <li class="flex items-start space-x-3">
                            <i class="fa-solid fa-location-dot text-tealAccent-500 mt-1"></i>
                            <span>Desa Bale, Kec. Tanantovea, Donggala, Sulawesi Tengah</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fa-regular fa-envelope text-tealAccent-500"></i>
                            <span>ppkormawahimaski@gmail.com</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fa-solid fa-graduation-cap text-tealAccent-500"></i>
                            <span>HIMASKI FKIP Universitas Tadulako</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Line -->
            <div class="border-t border-navy-800/80 pt-8 flex flex-col md:flex-row items-center justify-between text-xs text-slate-400 space-y-4 md:space-y-0">
                <p>
                    &copy; {{ date('Y') }} SMARTEDU-NUTRICHEM - PPK Ormawa HIMASKI UNTAD. Hak Cipta Dilindungi.
                    <a href="{{ route('login') }}" class="opacity-20 hover:opacity-100 transition-opacity inline-block ml-1 text-slate-500" title="Akses Admin"><i class="fa-solid fa-lock text-[10px]"></i></a>
                </p>
                <div class="flex items-center space-x-4">
                    <span>Desa Bale Bebas Stunting</span>
                </div>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
