@extends('layouts.app')

@section('title', 'Admin Login | SMARTEDU-NUTRICHEM')

@section('content')
<div class="hero-gradient min-h-[85vh] flex items-center justify-center py-16 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Glow Backgrounds -->
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-tealAccent-500/20 rounded-full filter blur-3xl"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-coralAccent-500/20 rounded-full filter blur-3xl"></div>

    <div class="max-w-md w-full relative z-10 space-y-6">
        
        <!-- Top Logo & Title -->
        <div class="text-center space-y-3">
            <a href="{{ route('home') }}" class="inline-flex items-center space-x-3">
                <!-- <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-tealAccent-500 to-emerald-400 flex items-center justify-center text-navy-900 font-extrabold text-2xl shadow-xl shadow-tealAccent-500/30">
                    <i class="fa-solid fa-atom"></i>
                </div> -->
                <img src="{{ asset('logo-smartedu.png') }}" alt="SMARTEDU Logo" class="w-24 h-15 object-contain group-hover:scale-50 transition-transform">
            </a>
            <h2 class="text-3xl font-extrabold text-white tracking-tight">
                Portal Admin SMARTEDU
            </h2>
            <p class="text-slate-300 text-sm">Masuk untuk mengelola seluruh informasi, modul, galeri, dan pesan publik.</p>
        </div>

        <!-- Notification Banner -->
        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 text-xs font-semibold flex items-center space-x-2">
                <i class="fa-solid fa-circle-check text-base"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 rounded-2xl bg-rose-500/20 border border-rose-500/40 text-rose-300 text-xs font-semibold flex items-center space-x-2">
                <i class="fa-solid fa-circle-exclamation text-base"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <!-- Login Form Card -->
        <div class="bg-white/95 backdrop-blur-xl p-8 rounded-3xl shadow-2xl border border-white/20 text-slate-800">
            <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                @csrf
                
                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Alamat Email Administrator</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-regular fa-envelope"></i>
                        </div>
                        <input type="email" name="email" id="email" required value="{{ old('email') }}" placeholder="username" class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-300 focus:border-tealAccent-500 focus:ring-2 focus:ring-tealAccent-500/20 text-sm font-medium outline-none">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Kata Sandi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <input type="password" name="password" id="password" required placeholder="••••••••" class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-300 focus:border-tealAccent-500 focus:ring-2 focus:ring-tealAccent-500/20 text-sm font-medium outline-none">
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded text-tealAccent-500 focus:ring-tealAccent-500">
                        <span class="text-slate-600 font-medium">Ingat Saya</span>
                    </label>
                    <a href="{{ route('home') }}" class="text-teal-600 font-semibold hover:underline">Kembali ke Beranda</a>
                </div>

                <button type="submit" class="w-full py-4 rounded-xl bg-tealAccent-500 hover:bg-tealAccent-600 text-navy-950 font-extrabold text-sm uppercase tracking-wider shadow-lg shadow-tealAccent-500/30 transition-all hover:scale-[1.02] flex items-center justify-center space-x-2">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    <span>Masuk ke Dashboard Admin</span>
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
