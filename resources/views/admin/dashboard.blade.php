@extends('layouts.admin')

@section('title', 'Dashboard Overview')
@section('page_header', 'Ikhtisar Admin SMARTEDU-NUTRICHEM')

@section('content')
<div class="space-y-8">

    <!-- Quick Stat Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Card 1: Modul -->
        <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Total Modul Edukasi</span>
                <span class="text-3xl font-extrabold text-navy-800">{{ $stats['moduls'] }}</span>
                <a href="{{ route('admin.moduls') }}" class="text-xs text-teal-600 font-semibold block mt-2 hover:underline">Kelola Modul &rarr;</a>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-teal-50 text-tealAccent-600 flex items-center justify-center text-2xl font-bold">
                <i class="fa-solid fa-book-open"></i>
            </div>
        </div>

        <!-- Card 2: Galeri -->
        <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Foto Galeri</span>
                <span class="text-3xl font-extrabold text-navy-800">{{ $stats['galleries'] }}</span>
                <a href="{{ route('admin.galleries') }}" class="text-xs text-teal-600 font-semibold block mt-2 hover:underline">Kelola Galeri &rarr;</a>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl font-bold">
                <i class="fa-solid fa-images"></i>
            </div>
        </div>

        <!-- Card 3: Pesan Masuk -->
        <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Pesan Masuk</span>
                <div class="flex items-baseline space-x-2">
                    <span class="text-3xl font-extrabold text-navy-800">{{ $stats['messages'] }}</span>
                    @if($stats['unread_messages'] > 0)
                        <span class="text-xs font-bold px-2 py-0.5 rounded-full bg-rose-500 text-white">{{ $stats['unread_messages'] }} Baru</span>
                    @endif
                </div>
                <a href="{{ route('admin.messages') }}" class="text-xs text-teal-600 font-semibold block mt-2 hover:underline">Buka Kotak Masuk &rarr;</a>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center text-2xl font-bold">
                <i class="fa-regular fa-envelope"></i>
            </div>
        </div>

        <!-- Card 4: Kuis Gizi -->
        <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Soal Kuis Gizi</span>
                <span class="text-3xl font-extrabold text-navy-800">{{ $stats['quizzes'] }}</span>
                <a href="{{ route('admin.quizzes') }}" class="text-xs text-teal-600 font-semibold block mt-2 hover:underline">Kelola Soal &rarr;</a>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center text-2xl font-bold">
                <i class="fa-solid fa-gamepad"></i>
            </div>
        </div>

    </div>

    <!-- Quick Action Banner -->
    <div class="bg-gradient-to-r from-navy-900 to-navy-800 p-8 rounded-3xl text-white shadow-xl flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="space-y-2">
            <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-white/10 text-teal-300 text-xs font-bold">
                <i class="fa-solid fa-bolt"></i>
                <span>Aksi Cepat Admin</span>
            </div>
            <h3 class="text-2xl font-extrabold">Selamat Datang di Portal Pengelolaan Informasi SMARTEDU</h3>
            <p class="text-slate-300 text-sm max-w-xl">
                Anda dapat mengubah informasi judul beranda, mengunggah modul baru, menambahkan album foto posyandu, atau mengedit testimoni warga kapan saja.
            </p>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.settings') }}" class="px-5 py-3 rounded-xl bg-tealAccent-500 hover:bg-tealAccent-600 text-navy-950 font-extrabold text-xs uppercase tracking-wider shadow-lg">
                <i class="fa-solid fa-sliders mr-1.5"></i> Edit Banner & Kontak
            </a>
            <a href="{{ route('admin.moduls') }}" class="px-5 py-3 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs uppercase tracking-wider border border-white/20">
                <i class="fa-solid fa-plus mr-1.5"></i> Tambah Modul PDF
            </a>
        </div>
    </div>

    <!-- 2 Column Section: Recent Messages & Recent Moduls -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- Recent Messages Inbox -->
        <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <h3 class="font-extrabold text-navy-800 text-base">Pesan Masuk Terbaru</h3>
                <a href="{{ route('admin.messages') }}" class="text-xs font-bold text-teal-600 hover:underline">Lihat Semua ({{ $stats['messages'] }})</a>
            </div>

            <div class="space-y-3">
                @forelse($recent_messages as $msg)
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 space-y-1">
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-navy-800 text-xs">{{ $msg->name }}</span>
                            <span class="text-[10px] text-slate-400">{{ $msg->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="text-xs text-slate-500 font-medium">{{ $msg->email }}</div>
                        <p class="text-xs text-slate-700 italic line-clamp-2">"{{ $msg->message }}"</p>
                    </div>
                @empty
                    <div class="py-8 text-center text-xs text-slate-400">Belum ada pesan masuk dari pengunjung.</div>
                @endforelse
            </div>
        </div>

        <!-- Recent Moduls -->
        <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <h3 class="font-extrabold text-navy-800 text-base">Modul Edukasi Aktif</h3>
                <a href="{{ route('admin.moduls') }}" class="text-xs font-bold text-teal-600 hover:underline">Kelola Modul</a>
            </div>

            <div class="space-y-3">
                @forelse($recent_moduls as $m)
                    <div class="p-3 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                        <div class="flex items-center space-x-3 min-w-0">
                            <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center shrink-0 font-bold">
                                <i class="fa-solid fa-file-pdf"></i>
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-bold text-navy-800 text-xs truncate">{{ $m->title }}</h4>
                                <span class="text-[10px] text-slate-400">{{ $m->category }} &bull; {{ $m->downloads_count }}x diunduh</span>
                            </div>
                        </div>
                        <a href="{{ route('modul.download', $m->id) }}" target="_blank" class="px-3 py-1.5 rounded-lg bg-navy-800 text-white text-[10px] font-bold shrink-0">Unduh</a>
                    </div>
                @empty
                    <div class="py-8 text-center text-xs text-slate-400">Belum ada modul.</div>
                @endforelse
            </div>
        </div>

    </div>

</div>
@endsection
