@extends('layouts.admin')

@section('title', 'Pengaturan Informasi Situs')
@section('page_header', 'Pengaturan Informasi Website')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div class="bg-white p-8 rounded-3xl border border-slate-200/80 shadow-sm space-y-6">
        <div>
            <h2 class="text-xl font-extrabold text-navy-800">Kelola Informasi Utama Beranda</h2>
            <p class="text-slate-500 text-xs">Ubah teks banner hero, deskripsi program, kontak resmi, link video, dan statistik utama.</p>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Section 1: Hero Banner -->
            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-4">
                <h3 class="font-bold text-navy-800 text-sm flex items-center space-x-2">
                    <i class="fa-solid fa-heading text-tealAccent-500"></i>
                    <span>Teks Banner Utama (Hero Section)</span>
                </h3>

                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Badge Atas Hero</label>
                        <input type="text" name="hero_badge" value="{{ $settings['hero_badge'] ?? '' }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Judul Utama (Hero Title)</label>
                        <input type="text" name="hero_title" value="{{ $settings['hero_title'] ?? '' }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Sub-Judul Slogan Program</label>
                        <textarea name="hero_subtitle" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">{{ $settings['hero_subtitle'] ?? '' }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Lokasi Tagline</label>
                        <input type="text" name="hero_tagline" value="{{ $settings['hero_tagline'] ?? '' }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">
                    </div>
                </div>
            </div>

            <!-- Section 2: Deskripsi & Video Embed -->
            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-4">
                <h3 class="font-bold text-navy-800 text-sm flex items-center space-x-2">
                    <i class="fa-solid fa-video text-tealAccent-500"></i>
                    <span>Tentang Program & Embed Video YouTube</span>
                </h3>

                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Deskripsi Ringkas "Mengapa SMARTEDU"</label>
                        <textarea name="about_description" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">{{ $settings['about_description'] ?? '' }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">URL / Tautan Video YouTube</label>
                        <input type="text" name="video_url" value="{{ $settings['video_url'] ?? '' }}" placeholder="Contoh: https://www.youtube.com/watch?v=XXXXXX atau https://youtu.be/XXXXXX" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">
                        <p class="text-[11px] text-slate-400 mt-1">Anda dapat menempelkan link YouTube biasa, link embed, atau link bagikan (youtu.be). Sistem akan otomatis mengonversi agar video diputar langsung di dalam website.</p>
                    </div>
                </div>
            </div>

            <!-- Section 3: Kontak & Lokasi -->
            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-4">
                <h3 class="font-bold text-navy-800 text-sm flex items-center space-x-2">
                    <i class="fa-solid fa-address-book text-tealAccent-500"></i>
                    <span>Informasi Kontak & Lokasi Posko</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Email Resmi</label>
                        <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? '' }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nomor Kontak / WA</label>
                        <input type="text" name="contact_phone" value="{{ $settings['contact_phone'] ?? '' }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Alamat Lengkap Posko</label>
                        <input type="text" name="contact_location" value="{{ $settings['contact_location'] ?? '' }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">
                    </div>
                </div>
            </div>

            <!-- Section 4: Angka Statistik -->
            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-4">
                <h3 class="font-bold text-navy-800 text-sm flex items-center space-x-2">
                    <i class="fa-solid fa-chart-line text-tealAccent-500"></i>
                    <span>Teks Statistik Capaian</span>
                </h3>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Kader Terlatih</label>
                        <input type="text" name="stat_kader" value="{{ $settings['stat_kader'] ?? '' }}" class="w-full px-3 py-2 rounded-xl border border-slate-300 text-sm font-medium">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Posyandu</label>
                        <input type="text" name="stat_posyandu" value="{{ $settings['stat_posyandu'] ?? '' }}" class="w-full px-3 py-2 rounded-xl border border-slate-300 text-sm font-medium">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Balita</label>
                        <input type="text" name="stat_balita" value="{{ $settings['stat_balita'] ?? '' }}" class="w-full px-3 py-2 rounded-xl border border-slate-300 text-sm font-medium">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Modul Terbit</label>
                        <input type="text" name="stat_modul" value="{{ $settings['stat_modul'] ?? '' }}" class="w-full px-3 py-2 rounded-xl border border-slate-300 text-sm font-medium">
                    </div>
                </div>
            </div>

            <div class="pt-4 flex justify-end">
                <button type="submit" class="px-8 py-3.5 rounded-xl bg-tealAccent-500 hover:bg-tealAccent-600 text-navy-950 font-extrabold text-sm uppercase tracking-wider shadow-lg">
                    <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Semua Pengaturan
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
