<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="default-src * 'unsafe-inline' 'unsafe-eval' data: blob:; script-src * 'unsafe-inline' 'unsafe-eval' data: blob:; style-src * 'unsafe-inline' data:; font-src * data:; img-src * data: blob:;">
    <title>@yield('title', 'Admin Dashboard') | SMARTEDU-NUTRICHEM</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logo-smartedu.png') }}">
    <link rel="shortcut icon" href="{{ asset('logo-smartedu.png') }}">
    
    <!-- Google Fonts & FontAwesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
                            800: '#102847',
                            900: '#0b1b33',
                            950: '#071224',
                        },
                        tealAccent: {
                            500: '#00C9A7',
                            600: '#059669',
                        }
                    },
                    fontFamily: {
                        sans: ['Outfit', 'Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans text-slate-800 bg-slate-100 antialiased" x-data="{ sidebarOpen: false }">

    <div class="min-h-screen flex">
        
        <!-- Sidebar Navigation -->
        <aside class="w-64 bg-navy-900 text-white shrink-0 hidden md:flex flex-col justify-between border-r border-navy-800">
            <div>
                <!-- Brand Header -->
                <div class="h-20 px-6 flex items-center space-x-3 border-b border-navy-800">
                    <img src="{{ asset('logo-smartedu.png') }}" alt="SMARTEDU Logo" class="w-24 h-15 object-contain group-hover:scale-50 transition-transform">
                    <div>
                        <span class="font-extrabold text-base tracking-tight text-white block">SMARTEDU</span>
                        <span class="text-[10px] text-teal-300 font-bold uppercase tracking-wider">Administrator</span>
                    </div>
                </div>

                <!-- Nav Items -->
                <nav class="p-4 space-y-1.5 text-sm font-medium">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-tealAccent-500 text-navy-950 font-bold shadow-md' : 'text-slate-300 hover:bg-navy-800 hover:text-white' }}">
                        <i class="fa-solid fa-gauge-high text-base w-5"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('admin.settings') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.settings') ? 'bg-tealAccent-500 text-navy-950 font-bold shadow-md' : 'text-slate-300 hover:bg-navy-800 hover:text-white' }}">
                        <i class="fa-solid fa-sliders text-base w-5"></i>
                        <span>Pengaturan Situs</span>
                    </a>

                    <a href="{{ route('admin.moduls') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.moduls') ? 'bg-tealAccent-500 text-navy-950 font-bold shadow-md' : 'text-slate-300 hover:bg-navy-800 hover:text-white' }}">
                        <i class="fa-solid fa-book-open text-base w-5"></i>
                        <span>Modul Edukasi</span>
                    </a>

                    <a href="{{ route('admin.galleries') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.galleries') ? 'bg-tealAccent-500 text-navy-950 font-bold shadow-md' : 'text-slate-300 hover:bg-navy-800 hover:text-white' }}">
                        <i class="fa-solid fa-images text-base w-5"></i>
                        <span>Galeri Kegiatan</span>
                    </a>

                    <a href="{{ route('admin.teams') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.teams') ? 'bg-tealAccent-500 text-navy-950 font-bold shadow-md' : 'text-slate-300 hover:bg-navy-800 hover:text-white' }}">
                        <i class="fa-solid fa-users text-base w-5"></i>
                        <span>Tim Pelaksana</span>
                    </a>

                    <a href="{{ route('admin.testimonials') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.testimonials') ? 'bg-tealAccent-500 text-navy-950 font-bold shadow-md' : 'text-slate-300 hover:bg-navy-800 hover:text-white' }}">
                        <i class="fa-solid fa-comments text-base w-5"></i>
                        <span>Testimoni Warga</span>
                    </a>

                    <a href="{{ route('admin.messages') }}" class="flex items-center justify-between px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.messages') ? 'bg-tealAccent-500 text-navy-950 font-bold shadow-md' : 'text-slate-300 hover:bg-navy-800 hover:text-white' }}">
                        <div class="flex items-center space-x-3">
                            <i class="fa-regular fa-envelope text-base w-5"></i>
                            <span>Pesan Masuk</span>
                        </div>
                        @php $unread = \App\Models\Message::where('is_read', false)->count(); @endphp
                        @if($unread > 0)
                            <span class="px-2 py-0.5 rounded-full bg-rose-500 text-white text-xs font-bold">{{ $unread }}</span>
                        @endif
                    </a>

                    <a href="{{ route('admin.quizzes') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.quizzes') ? 'bg-tealAccent-500 text-navy-950 font-bold shadow-md' : 'text-slate-300 hover:bg-navy-800 hover:text-white' }}">
                        <i class="fa-solid fa-clipboard-question text-base w-5"></i>
                        <span>Kuis Gizi</span>
                    </a>

                    <a href="{{ route('admin.plate_items') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.plate_items') ? 'bg-tealAccent-500 text-navy-950 font-bold shadow-md' : 'text-slate-300 hover:bg-navy-800 hover:text-white' }}">
                        <i class="fa-solid fa-utensils text-base w-5"></i>
                        <span>Susun Piring Sehat</span>
                    </a>

                    <a href="{{ route('admin.guesses') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.guesses') ? 'bg-tealAccent-500 text-navy-950 font-bold shadow-md' : 'text-slate-300 hover:bg-navy-800 hover:text-white' }}">
                        <i class="fa-solid fa-lightbulb text-base w-5"></i>
                        <span>Tebak Nutrisi</span>
                    </a>
                </nav>
            </div>

            <!-- Bottom User & Logout -->
            <div class="p-4 border-t border-navy-800 space-y-3">
                <a href="{{ route('home') }}" target="_blank" class="w-full flex items-center justify-center space-x-2 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-xs transition-colors">
                    <i class="fa-solid fa-globe"></i>
                    <span>Lihat Website Utama</span>
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center space-x-2 py-2.5 rounded-xl bg-rose-500/20 hover:bg-rose-500 text-rose-300 hover:text-white font-semibold text-xs border border-rose-500/30 transition-colors">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Keluar / Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0">
            
            <!-- Top Navbar -->
            <header class="h-20 bg-white border-b border-slate-200 px-4 sm:px-8 flex items-center justify-between shadow-sm">
                <div class="flex items-center space-x-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="md:hidden p-2 text-slate-600 hover:text-navy-800">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                    <h1 class="text-xl font-extrabold text-navy-800 hidden sm:block">
                        @yield('page_header', 'Dashboard Admin')
                    </h1>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-xs font-bold text-teal-600 hover:underline flex items-center space-x-1">
                        <span>Ke Website</span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                    </a>
                    
                    <div class="h-6 w-px bg-slate-200"></div>

                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-full bg-navy-800 text-tealAccent-500 font-bold flex items-center justify-center text-sm shadow">
                            A
                        </div>
                        <div class="hidden sm:block text-left">
                            <span class="block text-xs font-bold text-navy-800">{{ Auth::user()->name ?? 'Administrator' }}</span>
                            <span class="block text-[10px] text-slate-500">{{ Auth::user()->email ?? 'admin@smartedu.id' }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Body View Container -->
            <main class="flex-1 p-4 sm:p-8 overflow-y-auto">
                
                @if(session('success'))
                    <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold flex items-center justify-between shadow-sm">
                        <div class="flex items-center space-x-3">
                            <i class="fa-solid fa-circle-check text-xl text-emerald-500"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-sm font-semibold space-y-1 shadow-sm">
                        <div class="flex items-center space-x-2 text-rose-600">
                            <i class="fa-solid fa-circle-exclamation text-lg"></i>
                            <span>Terdapat beberapa kesalahan input:</span>
                        </div>
                        <ul class="list-disc list-inside text-xs pl-6">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>

    </div>

    @yield('scripts')
</body>
</html>
