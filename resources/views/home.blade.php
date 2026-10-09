@extends('layouts.app')

@section('title', 'SMARTEDU-NUTRICHEM')

@section('content')

<!-- HERO SECTION -->
<section class="hero-gradient text-white relative overflow-hidden py-20 lg:py-28">
    <!-- Background Decorative Elements -->
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#00C9A7_1px,transparent_1px)] [background-size:24px_24px]"></div>
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-tealAccent-500/20 rounded-full filter blur-3xl"></div>
    <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-coralAccent-500/20 rounded-full filter blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left Column: Copy & CTAs -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <!-- Badge -->
                <div class="inline-flex items-center space-x-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-tealAccent-500/40 text-teal-300 text-xs sm:text-sm font-semibold backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-tealAccent-500 animate-ping"></span>
                    <span>{{ $settings['hero_badge'] ?? 'PPK Ormawa HIMASKI UNTAD 2024' }}</span>
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight">
                    <span class="text-white">SMARTEDU</span>
                    <span class="bg-gradient-to-r from-tealAccent-500 to-emerald-400 bg-clip-text text-transparent">-NUTRICHEM</span>
                </h1>

                <p class="text-lg sm:text-xl text-slate-300 leading-relaxed max-w-2xl font-normal">
                    {{ $settings['hero_subtitle'] ?? 'Model Edukasi Berbasis Teknologi dan Kimia Terapan dalam Percepatan Penurunan Stunting' }}
                </p>

                <div class="flex items-center justify-center lg:justify-start space-x-2 text-sm text-teal-300 font-medium">
                    <i class="fa-solid fa-location-dot text-coralAccent-500"></i>
                    <span>{{ $settings['hero_tagline'] ?? 'Desa Bale, Kec. Tanantovea, Donggala — Sulawesi Tengah' }}</span>
                </div>

                <!-- CTA Buttons -->
                <div class="pt-4 flex flex-wrap items-center justify-center lg:justify-start gap-4">
                    <a href="#modul" class="px-7 py-4 rounded-xl bg-gradient-to-r from-tealAccent-500 to-emerald-500 hover:from-tealAccent-600 hover:to-emerald-600 text-navy-950 font-bold text-sm tracking-wide shadow-xl shadow-tealAccent-500/30 flex items-center space-x-3 transition-all hover:scale-105">
                        <i class="fa-solid fa-book-open"></i>
                        <span>Jelajahi Modul Edukasi</span>
                    </a>
                    <a href="#game" class="px-7 py-4 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold text-sm tracking-wide backdrop-blur-md flex items-center space-x-3 transition-all hover:scale-105">
                        <i class="fa-solid fa-gamepad text-coralAccent-500"></i>
                        <span>Main Game Gizi</span>
                    </a>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="px-7 py-4 rounded-xl bg-tealAccent-500 hover:bg-tealAccent-600 text-navy-950 font-bold text-sm tracking-wide flex items-center space-x-3 transition-all hover:scale-105 shadow-xl">
                            <i class="fa-solid fa-gauge-high"></i>
                            <span>Dashboard Admin</span>
                        </a>
                    @endauth
                </div>

                <!-- Stats Bar -->
                <div class="pt-8 border-t border-white/10 grid grid-cols-2 sm:grid-cols-4 gap-6 text-center lg:text-left">
                    <div>
                        <div class="text-2xl sm:text-3xl font-extrabold text-tealAccent-400">{{ $settings['stat_kader'] ?? '35+' }}</div>
                        <div class="text-xs text-slate-400 font-medium">Kader Terlatih</div>
                    </div>
                    <div>
                        <div class="text-2xl sm:text-3xl font-extrabold text-tealAccent-400">{{ $settings['stat_posyandu'] ?? '5 Posyandu' }}</div>
                        <div class="text-xs text-slate-400 font-medium">Mitra Posyandu</div>
                    </div>
                    <div>
                        <div class="text-2xl sm:text-3xl font-extrabold text-tealAccent-400">{{ $settings['stat_balita'] ?? '120+' }}</div>
                        <div class="text-xs text-slate-400 font-medium">Balita Terdampingi</div>
                    </div>
                    <div>
                        <div class="text-2xl sm:text-3xl font-extrabold text-tealAccent-400">{{ $settings['stat_modul'] ?? '8 Modul' }}</div>
                        <div class="text-xs text-slate-400 font-medium">Modul Sains Terbit</div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Interactive Science Molecule Graphic -->
            <div class="lg:col-span-5 relative flex justify-center">
                <div class="w-full max-w-md p-6 rounded-3xl bg-white/5 border border-white/10 backdrop-blur-xl shadow-2xl relative">
                    
                    <!-- Floating Chemistry Elements -->
                    <div class="absolute -top-8 -left-6 z-20 p-4 rounded-2xl bg-tealAccent-500 text-navy-950 shadow-xl float-animation flex items-center space-x-3">
                        <i class="fa-solid fa-vial-circle-check text-2xl"></i>
                        <div>
                            <div class="font-extrabold text-sm">Fe²⁺ & Zn²⁺</div>
                            <div class="text-[10px] font-semibold uppercase">Mikro Nutrisi</div>
                        </div>
                    </div>

                    <div class="absolute -bottom-8 -right-6 z-20 p-4 rounded-2xl bg-coralAccent-500 text-white shadow-xl float-animation flex items-center space-x-3" style="animation-delay: 2s;">
                        <i class="fa-solid fa-heart-pulse text-2xl"></i>
                        <div>
                            <div class="font-extrabold text-sm">Ca²⁺ + Vit D</div>
                            <div class="text-[10px] font-semibold uppercase">Tumbuh Tinggi</div>
                        </div>
                    </div>

                    <div class="space-y-4 text-left pt-8 pb-4">
                        <div class="flex items-center justify-between pb-3 border-b border-white/10">
                            <span class="text-xs font-bold uppercase tracking-wider text-teal-300">Pillar Utama Science</span>
                            <span class="text-xs px-2 py-0.5 rounded bg-teal-500/20 text-teal-300">HIMASKI UNTAD</span>
                        </div>
                        <div class="space-y-3">
                            <div class="p-3.5 rounded-xl bg-white/10 flex items-start space-x-3">
                                <div class="w-8 h-8 rounded-lg bg-tealAccent-500/20 text-tealAccent-400 flex items-center justify-center shrink-0 mt-0.5">
                                    <i class="fa-solid fa-flask text-sm"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-white">Kimia Gizi Terapan</h4>
                                    <p class="text-xs text-slate-300">Analisis kandungan protein hewani & fortifikasi alami pangan lokal.</p>
                                </div>
                            </div>

                            <div class="p-3.5 rounded-xl bg-white/10 flex items-start space-x-3">
                                <div class="w-8 h-8 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0 mt-0.5">
                                    <i class="fa-solid fa-mobile-screen-button text-sm"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-white">Digital Education Hub</h4>
                                    <p class="text-xs text-slate-300">Akses modul, video interaktif, dan kuis gizi berbasis web modern.</p>
                                </div>
                            </div>

                            <div class="p-3.5 rounded-xl bg-white/10 flex items-start space-x-3">
                                <div class="w-8 h-8 rounded-lg bg-coralAccent-500/20 text-coralAccent-400 flex items-center justify-center shrink-0 mt-0.5">
                                    <i class="fa-solid fa-hands-holding-child text-sm"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-white">Pemberdayaan Posyandu</h4>
                                    <p class="text-xs text-slate-300">Pendampingan pengukuran antropometri & demo masak pangan sehat.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- SECTION 1: TENTANG PROGRAM -->
<section id="tentang" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
            <span class="text-xs font-bold uppercase tracking-widest text-tealAccent-600 bg-teal-50 px-3.5 py-1.5 rounded-full border border-teal-200">Inovasi Pengabdian</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-navy-800">Mengapa SMARTEDU-NUTRICHEM?</h2>
            <p class="text-slate-600 text-base sm:text-lg leading-relaxed">
                {{ $settings['about_description'] ?? 'SMARTEDU-NUTRICHEM adalah inovasi program pengabdian masyarakat oleh Ormawa HIMASKI Universitas Tadulako. Program ini mengintegrasikan buku edukasi berbasis sains sederhana, media digital berbasis QR code dan video, pelatihan kader posyandu, serta sistem pemantauan perubahan perilaku keluarga. Pendekatan kimia terapan digunakan untuk menjelaskan hubungan antara komposisi zat gizi, proses pengolahan makanan, dan pengaruhnya terhadap pertumbuhan anak sehingga materi lebih mudah dipahami masyarakat.' }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card 1 -->
            <div class="p-8 rounded-2xl bg-slate-50 border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all">
                <div class="w-14 h-14 rounded-2xl bg-navy-800 text-tealAccent-500 flex items-center justify-center text-2xl font-bold mb-6 shadow-lg">
                    <i class="fa-solid fa-microscope"></i>
                </div>
                <h3 class="text-xl font-bold text-navy-800 mb-3">Pendekatan Sains Kimia</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Menjelaskan mengenai gizi seimbang, peran zat gizi makro dan mikro dalam pertumbuhan anak, serta hubungan antara kekurangan gizi dengan risiko stunting. Penjelasan kimia terapan digunakan untuk membantu masyarakat memahami secara logis mengapa protein, zat besi, kalsium, dan zat gizi lainnya penting bagi pertumbuhan anak.
                </p>
            </div>

            <!-- Card 2 -->
            <div class="p-8 rounded-2xl bg-slate-50 border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all">
                <div class="w-14 h-14 rounded-2xl bg-tealAccent-500 text-navy-950 flex items-center justify-center text-2xl font-bold mb-6 shadow-lg">
                    <i class="fa-solid fa-utensils"></i>
                </div>
                <h3 class="text-xl font-bold text-navy-800 mb-3">Pemanfaatan Pangan Lokal</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Mengoptimalkan kekayaan pangan lokal yang ada di Desa Bale seperti Kelor dan hasil kebun B2SA lainnya menjadi menu MP-ASI bernilai gizi tinggi tanpa biaya mahal.
                </p>
            </div>

            <!-- Card 3 -->
            <div class="p-8 rounded-2xl bg-slate-50 border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all">
                <div class="w-14 h-14 rounded-2xl bg-coralAccent-500 text-white flex items-center justify-center text-2xl font-bold mb-6 shadow-lg">
                    <i class="fa-solid fa-users-gear"></i>
                </div>
                <h3 class="text-xl font-bold text-navy-800 mb-3">Penguatan Kader Posyandu</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Membekali kader dengan modul edukasi, pelatihan, dan kemampuan penyuluhan berkelanjutan yang berdampak jangka panjang.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 2: KATALOG MODUL EDUKASI -->
<section id="modul" class="py-20 bg-slate-50 border-t border-b border-slate-200/70">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-tealAccent-600 bg-teal-100/70 px-3.5 py-1.5 rounded-full">Perpustakaan Digital</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-navy-800 mt-2">Modul & Panduan Edukasi</h2>
                <p class="text-slate-600 text-sm sm:text-base max-w-xl mt-1">Unduh modul gratis yang disusun oleh tim pakar sains dan pendamping Ormawa HIMASKI UNTAD.</p>
            </div>
            @auth
                <a href="{{ route('admin.moduls') }}" class="inline-flex items-center space-x-2 text-xs font-bold uppercase text-navy-800 bg-white px-4 py-2.5 rounded-xl border border-slate-200 shadow-sm hover:bg-teal-50">
                    <i class="fa-solid fa-plus text-tealAccent-500"></i>
                    <span>Kelola Modul (Admin)</span>
                </a>
            @endauth
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($moduls as $m)
                @php
                    $coverUrl = $m->cover_image ?: 'https://images.unsplash.com/photo-1498837167922-ddd27525d352?auto=format&fit=crop&w=600&q=80';
                    if (!Str::startsWith($coverUrl, ['http://', 'https://'])) {
                        $coverUrl = asset(ltrim($coverUrl, '/'));
                    }
                @endphp
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group">
                    <!-- Image Container -->
                    <div class="h-48 overflow-hidden relative bg-slate-100">
                        <img src="{{ $coverUrl }}" alt="{{ $m->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1498837167922-ddd27525d352?auto=format&fit=crop&w=600&q=80';">
                        <div class="absolute top-3 left-3 bg-navy-800/80 backdrop-blur-md text-white text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                            {{ $m->category }}
                        </div>
                        @if($m->badge)
                            <div class="absolute top-3 right-3 bg-tealAccent-500 text-navy-950 text-[10px] font-extrabold px-2.5 py-1 rounded-full uppercase">
                                {{ $m->badge }}
                            </div>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                        <div class="space-y-2">
                            <h3 class="font-bold text-navy-800 text-base leading-snug group-hover:text-tealAccent-600 transition-colors line-clamp-2">
                                {{ $m->title }}
                            </h3>
                            <p class="text-xs text-slate-500 leading-relaxed line-clamp-3">
                                {{ $m->description }}
                            </p>
                        </div>

                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                            <div class="text-[11px] text-slate-400 font-medium">
                                <i class="fa-solid fa-download text-teal-500 mr-1"></i>
                                <span>{{ $m->downloads_count }}x diunduh</span>
                            </div>

                            <a href="{{ route('modul.download', $m->id) }}" target="_blank" class="px-3.5 py-2 rounded-lg bg-navy-800 hover:bg-tealAccent-500 hover:text-navy-950 text-white font-bold text-xs flex items-center space-x-1.5 transition-colors">
                                <span>Unduh</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-slate-400 bg-white rounded-2xl border border-dashed border-slate-300">
                    <i class="fa-solid fa-book-open text-4xl mb-3 text-slate-300"></i>
                    <p>Belum ada modul yang diterbitkan.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- SECTION 3: VIDEO EDUKASI INTERAKTIF -->
<section id="video" class="py-20 bg-navy-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            
            <div class="lg:col-span-5 space-y-6">
                <span class="text-xs font-bold uppercase tracking-widest text-tealAccent-400 bg-white/10 px-3.5 py-1.5 rounded-full border border-white/10">Media Audiovisual</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white leading-tight">
                    Video Edukasi Interaktif SMARTEDU
                </h2>
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                    Saksikan tayangan lengkap mengenai Edukasi Stunting, Pembuatan Pupuk Organik Cair untunk kebun B2SA, serta Perjalanan tim PPK ORMAWA HIMASKI dalam satu periode kegiatan PPK ORMAWA.
                </p>

                <div class="space-y-3 pt-2">
                    <div class="flex items-center space-x-3 text-sm text-slate-200">
                        <i class="fa-solid fa-circle-check text-tealAccent-400"></i>
                        <span>Visual animasi ramah ibu & kader Posyandu</span>
                    </div>
                    <div class="flex items-center space-x-3 text-sm text-slate-200">
                        <i class="fa-solid fa-circle-check text-tealAccent-400"></i>
                        <span>Dilengkapi subtitel dan petunjuk langkah demi langkah</span>
                    </div>
                    <div class="flex items-center space-x-3 text-sm text-slate-200">
                        <i class="fa-solid fa-circle-check text-tealAccent-400"></i>
                        <span>Dapat diputar di acara penyuluhan lapangan</span>
                    </div>
                </div>
            </div>

            <!-- Video Player Window -->
            <div class="lg:col-span-7" x-data="{ isPlaying: false }">
                @php
                    $rawUrl = $settings['video_url'] ?? 'https://www.youtube.com/watch?v=dQw4w9WgXcQ';
                    preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $rawUrl, $matches);
                    $videoId = $matches[1] ?? 'dQw4w9WgXcQ';
                    $embedUrl = "https://www.youtube.com/embed/" . $videoId . "?autoplay=1&rel=0&modestbranding=1&playsinline=1&enablejsapi=1";
                    $thumbnailUrl = "https://img.youtube.com/vi/" . $videoId . "/hqdefault.jpg";
                @endphp

                <div class="rounded-3xl overflow-hidden border-2 border-white/15 shadow-2xl bg-black relative aspect-video group">
                    <!-- Thumbnail Cover Overlay before Play -->
                    <div x-show="!isPlaying" @click="isPlaying = true" class="absolute inset-0 z-10 cursor-pointer flex flex-col items-center justify-center bg-cover bg-center transition-all" style="background-image: url('{{ $thumbnailUrl }}');">
                        <div class="absolute inset-0 bg-navy-950/60 backdrop-blur-[2px] group-hover:bg-navy-950/40 transition-colors"></div>
                        
                        <div class="relative z-20 text-center space-y-3 p-4">
                            <div class="w-20 h-20 mx-auto rounded-full bg-tealAccent-500 text-navy-950 flex items-center justify-center text-3xl shadow-xl shadow-tealAccent-500/30 group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-play ml-1"></i>
                            </div>
                            <span class="inline-block text-xs font-extrabold text-white uppercase tracking-wider bg-navy-900/90 px-4 py-2 rounded-full border border-white/20 shadow-lg">
                                ▶ Putar Video Di Dalam Website
                            </span>
                        </div>
                    </div>

                    <!-- Embedded YouTube Iframe -->
                    <template x-if="isPlaying">
                        <iframe class="w-full h-full relative z-0" src="{{ $embedUrl }}" title="{{ $settings['video_title'] ?? 'SMARTEDU Video Edukasi' }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </template>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- SECTION 4: GAME & KUIS EDUKASI INTERAKTIF -->
<script>
    window.gameSystem = function gameSystem(dbPlateItems = [], dbGuesses = []) {
        const optionMap = { a: 0, b: 1, c: 2, d: 3 };

        const formattedPlateItems = (dbPlateItems && dbPlateItems.length > 0) ? dbPlateItems.map(i => ({
            id: i.id,
            name: i.name,
            icon: i.icon || '🍚',
            correctCat: i.category
        })) : [
            { id: 1, name: 'Nasi', icon: '🍚', correctCat: 'karbohidrat' },
            { id: 2, name: 'Ikan', icon: '🐟', correctCat: 'protein' },
            { id: 3, name: 'Pisang', icon: '🍌', correctCat: 'buah' },
            { id: 4, name: 'Wortel', icon: '🥕', correctCat: 'sayuran' },
            { id: 5, name: 'Telur', icon: '🥚', correctCat: 'protein' },
            { id: 6, name: 'Sayur', icon: '🥒', correctCat: 'sayuran' }
        ];

        const formattedGuesses = (dbGuesses && dbGuesses.length > 0) ? dbGuesses.map(g => {
            let qText = g.food_name || '';
            const lower = qText.toLowerCase();
            if (!lower.includes('manakah') && !lower.includes('apa') && !lower.includes('bagaimana') && !lower.includes('mengapa') && !lower.includes('berapa') && !qText.includes('?')) {
                qText = 'Manakah kandungan nutrisi utama pada: ' + qText + '?';
            }
            return {
                food: qText,
                options: [g.option_a, g.option_b, g.option_c, g.option_d],
                correct: optionMap[g.correct_option] || 0,
                note: g.explanation || 'Kandungan nutrisi esensial bagi tubuh.'
            };
        }) : [
            { food: 'Daun Kelor (Moringa)', options: ['Zat Besi & Vitamin A', 'Karbohidrat Tinggi', 'Lemak Jenuh', 'Glukosa'], correct: 0, note: 'Daun Kelor kaya akan Zat Besi (Fe) & Vitamin A untuk mencegah anemia & stunting!' },
            { food: 'Ikan Gabus / Bandeng', options: ['Protein & Albumin', 'Karbohidrat Murni', 'Serat Kasar', 'Kalsium Oksalat'], correct: 0, note: 'Ikan mengandung Protein & Albumin tinggi yang sangat penting bagi tumbuh kembang anak.' },
            { food: 'Telur Ayam', options: ['Kolin & Protein Hewani', 'Vitamin C', 'Serat Pektin', 'Asam Urat'], correct: 0, note: 'Telur adalah sumber Protein Hewani terjangkau berdaya cerna tinggi.' }
        ];

        return {
            tab: 'quiz',
            visitorName: '',
            answers: {},
            quizSubmitted: false,
            quizScore: { score: 0, total: 0, percentage: 0, visitor_name: '', results: {} },
            
            // SUSUN PIRING SEHAT DATA
            initialItems: formattedPlateItems,
            availableItems: JSON.parse(JSON.stringify(formattedPlateItems)),
            selectedFood: null,
            draggedFoodId: null,
            categories: {
                karbohidrat: [],
                protein: [],
                sayuran: [],
                buah: []
            },
            gameChecked: false,
            gameResult: { success: false, message: '' },

            handleDragStart(evt, item) {
                this.draggedFoodId = item.id;
                evt.dataTransfer.setData('text/plain', item.id);
            },

            handleDrop(catKey) {
                const foodId = this.draggedFoodId || (this.selectedFood ? this.selectedFood.id : null);
                if (!foodId) return;

                let item = this.availableItems.find(i => i.id == foodId);
                if (item) {
                    this.availableItems = this.availableItems.filter(i => i.id != foodId);
                } else {
                    Object.keys(this.categories).forEach(k => {
                        let existing = this.categories[k].find(i => i.id == foodId);
                        if (existing) {
                            item = existing;
                            this.categories[k] = this.categories[k].filter(i => i.id != foodId);
                        }
                    });
                }

                if (item) {
                    this.categories[catKey].push(item);
                }
                this.selectedFood = null;
                this.draggedFoodId = null;
                this.gameChecked = false;
            },

            removeFromCategory(item, catKey) {
                this.categories[catKey] = this.categories[catKey].filter(i => i.id !== item.id);
                if (!this.availableItems.find(i => i.id === item.id)) {
                    this.availableItems.push(item);
                }
                this.gameChecked = false;
            },

            selectFood(item) {
                if (this.selectedFood && this.selectedFood.id === item.id) {
                    this.selectedFood = null;
                } else {
                    this.selectedFood = item;
                }
            },

            checkPiringAnswers() {
                this.gameChecked = true;
                let totalPlaced = 0;
                let correctCount = 0;
                let totalTarget = this.initialItems.length;
                let details = [];

                Object.keys(this.categories).forEach(catKey => {
                    this.categories[catKey].forEach(item => {
                        totalPlaced++;
                        const isCorrect = (item.correctCat === catKey);
                        if (isCorrect) {
                            correctCount++;
                        }
                        details.push({
                            question: 'Makanan: ' + item.name + ' (' + item.icon + ')',
                            user_ans: 'Kategori: ' + catKey,
                            correct_ans: 'Kategori: ' + item.correctCat,
                            correct: isCorrect,
                            explanation: isCorrect ? 'Sesuai dengan kelompok piring sehat.' : 'Kategori kurang tepat.'
                        });
                    });
                });

                if (totalPlaced < totalTarget) {
                    this.gameResult = {
                        success: false,
                        message: `Harap tarik semua ${totalTarget} makanan ke dalam kotak kategori! (Baru ${totalPlaced}/${totalTarget} makanan dimasukkan)`
                    };
                } else if (correctCount === totalTarget) {
                    this.gameResult = {
                        success: true,
                        message: '🎉 Luar Biasa! Komposisi Piring Sehat Anda 100% Benar & Tepat!'
                    };
                    this.logGameResult('piring', correctCount, totalTarget, details);
                } else {
                    this.gameResult = {
                        success: false,
                        message: `Jawaban kurang tepat. Ada makanan yang salah tempat. Periksa kembali dan coba lagi!`
                    };
                    this.logGameResult('piring', correctCount, totalTarget, details);
                }
            },

            resetPiringGame() {
                this.availableItems = JSON.parse(JSON.stringify(this.initialItems));
                this.categories = { karbohidrat: [], protein: [], sayuran: [], buah: [] };
                this.selectedFood = null;
                this.draggedFoodId = null;
                this.gameChecked = false;
            },

            // TEBAK NUTRISI DATA
            tebakIndex: 0,
            tebakScore: 0,
            tebakAnswered: false,
            tebakFeedback: '',
            tebakQuestions: formattedGuesses,
            tebakHistory: [],

            answerTebak(idx) {
                if (this.tebakAnswered) return;
                this.tebakAnswered = true;
                const current = this.tebakQuestions[this.tebakIndex];
                const isCorrect = (idx === current.correct);
                if (isCorrect) {
                    this.tebakScore += 100;
                    this.tebakFeedback = '🎉 Benar! ' + current.note;
                } else {
                    this.tebakFeedback = '❌ Kurang tepat. ' + current.note;
                }

                this.tebakHistory.push({
                    question: current.food,
                    user_ans: current.options[idx],
                    correct_ans: current.options[current.correct],
                    correct: isCorrect,
                    explanation: current.note
                });
            },

            nextTebak() {
                if (this.tebakIndex < this.tebakQuestions.length - 1) {
                    this.tebakIndex++;
                    this.tebakAnswered = false;
                    this.tebakFeedback = '';
                } else {
                    const scoreCount = Math.round(this.tebakScore / 100);
                    this.logGameResult('tebak', scoreCount, this.tebakQuestions.length, this.tebakHistory);
                    alert('Selamat! Anda telah menyelesaikan Tebak Nutrisi.');
                    this.tebakIndex = 0;
                    this.tebakAnswered = false;
                    this.tebakFeedback = '';
                    this.tebakHistory = [];
                }
            },

            async logGameResult(gameType, score, total, details = []) {
                try {
                    await fetch('{{ route("game.log") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            game_type: gameType,
                            visitor_name: this.visitorName,
                            score: score,
                            total: total,
                            details: details
                        })
                    });
                } catch(e) {}
            },

            async submitQuiz() {
                try {
                    const response = await fetch('{{ route("quiz.submit") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ answers: this.answers, visitor_name: this.visitorName })
                    });
                    const data = await response.json();
                    this.quizScore = data;
                    this.quizSubmitted = true;
                } catch (e) {
                    alert('Terjadi kesalahan saat memproses kuis.');
                }
            },

            resetQuiz() {
                this.answers = {};
                this.quizSubmitted = false;
            }
        };
    };
</script>

<section id="game" class="py-20 bg-white" x-data="gameSystem({{ json_encode($plateItems) }}, {{ json_encode($guesses) }})">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-8 space-y-3">
            <span class="text-xs font-bold uppercase tracking-widest text-coralAccent-500 bg-orange-50 px-3.5 py-1.5 rounded-full border border-orange-200">Pembelajaran Interaktif</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-navy-800">Game & Kuis Gizi Anti-Stunting</h2>
            <p class="text-slate-600 text-sm sm:text-base">Uji pemahaman gizi Anda melalui permainan edukatif interaktif di bawah ini!</p>
        </div>

        <!-- Global Visitor Name Input Bar -->
        <div class="max-w-md mx-auto mb-8 bg-slate-100/90 p-4 rounded-2xl border border-slate-300 shadow-sm flex items-center space-x-3">
            <div class="w-10 h-10 rounded-xl bg-tealAccent-500 text-navy-950 flex items-center justify-center shrink-0 font-extrabold text-sm shadow">
                <i class="fa-solid fa-user-pen"></i>
            </div>
            <div class="flex-1">
                <label class="block text-[10px] font-extrabold uppercase text-slate-500 tracking-wider">Nama / Inisial Pengunjung</label>
                <input type="text" x-model="visitorName" placeholder="Ketik nama Anda (misal: Ibu Rahma)" class="w-full text-xs font-bold text-navy-900 bg-transparent outline-none placeholder:font-normal placeholder:text-slate-400">
            </div>
        </div>

        <!-- Navigation Tabs matching Canva design -->
        <div class="flex justify-center mb-10">
            <div class="inline-flex p-1.5 bg-[#0f243d] rounded-2xl border border-slate-700/60 space-x-2 shadow-lg">
                <button @click="tab = 'quiz'" :class="tab === 'quiz' ? 'bg-tealAccent-500 text-navy-950 font-extrabold shadow-md' : 'text-slate-300 hover:text-white'" class="px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all flex items-center space-x-2 cursor-pointer">
                    <span>🧠 Quiz Gizi</span>
                </button>
                <button @click="tab = 'piring'" :class="tab === 'piring' ? 'bg-tealAccent-500 text-navy-950 font-extrabold shadow-md' : 'text-slate-300 hover:text-white'" class="px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all flex items-center space-x-2 cursor-pointer">
                    <span>🍽️ Susun Piring Sehat</span>
                </button>
                <button @click="tab = 'tebak'" :class="tab === 'tebak' ? 'bg-tealAccent-500 text-navy-950 font-extrabold shadow-md' : 'text-slate-300 hover:text-white'" class="px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all flex items-center space-x-2 cursor-pointer">
                    <span>📊 Tebak Nutrisi</span>
                </button>
            </div>
        </div>

        <!-- TAB 1: KUIS GIZI -->
        <div x-show="tab === 'quiz'" x-transition class="max-w-4xl mx-auto bg-slate-50 border border-slate-200 rounded-3xl p-6 sm:p-10 shadow-lg">
            <template x-if="!quizSubmitted">
                <div>
                    @if(count($quizzes) > 0)
                        <form @submit.prevent="submitQuiz">
                            <div class="space-y-8">

                                @foreach($quizzes as $index => $q)
                                    <div class="p-6 bg-white rounded-2xl border border-slate-200 space-y-4 shadow-sm">
                                        <div class="flex items-start space-x-3">
                                            <span class="w-7 h-7 rounded-lg bg-tealAccent-500 text-navy-950 font-extrabold text-xs flex items-center justify-center shrink-0 mt-0.5">
                                                {{ $index + 1 }}
                                            </span>
                                            <h4 class="font-bold text-navy-800 text-base leading-snug">
                                                {{ $q->question }}
                                            </h4>
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                                            <label class="p-3.5 rounded-xl border border-slate-200 hover:border-tealAccent-500 hover:bg-teal-50/50 flex items-center space-x-3 cursor-pointer transition-all">
                                                <input type="radio" name="q_{{ $q->id }}" value="a" x-model="answers[{{ $q->id }}]" class="text-tealAccent-500 focus:ring-tealAccent-500">
                                                <span class="text-xs text-slate-700 font-medium">A. {{ $q->option_a }}</span>
                                            </label>
                                            <label class="p-3.5 rounded-xl border border-slate-200 hover:border-tealAccent-500 hover:bg-teal-50/50 flex items-center space-x-3 cursor-pointer transition-all">
                                                <input type="radio" name="q_{{ $q->id }}" value="b" x-model="answers[{{ $q->id }}]" class="text-tealAccent-500 focus:ring-tealAccent-500">
                                                <span class="text-xs text-slate-700 font-medium">B. {{ $q->option_b }}</span>
                                            </label>
                                            <label class="p-3.5 rounded-xl border border-slate-200 hover:border-tealAccent-500 hover:bg-teal-50/50 flex items-center space-x-3 cursor-pointer transition-all">
                                                <input type="radio" name="q_{{ $q->id }}" value="c" x-model="answers[{{ $q->id }}]" class="text-tealAccent-500 focus:ring-tealAccent-500">
                                                <span class="text-xs text-slate-700 font-medium">C. {{ $q->option_c }}</span>
                                            </label>
                                            <label class="p-3.5 rounded-xl border border-slate-200 hover:border-tealAccent-500 hover:bg-teal-50/50 flex items-center space-x-3 cursor-pointer transition-all">
                                                <input type="radio" name="q_{{ $q->id }}" value="d" x-model="answers[{{ $q->id }}]" class="text-tealAccent-500 focus:ring-tealAccent-500">
                                                <span class="text-xs text-slate-700 font-medium">D. {{ $q->option_d }}</span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="text-center pt-4">
                                    <button type="submit" class="px-10 py-4 rounded-xl bg-tealAccent-500 hover:bg-tealAccent-600 text-navy-950 font-extrabold text-sm uppercase tracking-wider shadow-lg shadow-tealAccent-500/20 hover:scale-105 transition-all cursor-pointer">
                                        <i class="fa-solid fa-paper-plane mr-2"></i> Submit & Lihat Nilai
                                    </button>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="text-center py-12 space-y-3">
                            <div class="w-16 h-16 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center text-2xl mx-auto">
                                <i class="fa-solid fa-file-circle-question"></i>
                            </div>
                            <h4 class="font-extrabold text-navy-800 text-lg">Belum Ada Soal Kuis</h4>
                            <p class="text-slate-500 text-xs max-w-sm mx-auto">Pertanyaan kuis sedang disiapkan oleh tim admin.</p>
                        </div>
                    @endif
                </div>
            </template>

            <!-- Quiz Results Screen -->
            <template x-if="quizSubmitted">
                <div class="space-y-6 py-4">
                    <div class="text-center space-y-4">
                        <div class="w-24 h-24 rounded-full bg-teal-100 text-tealAccent-600 flex items-center justify-center text-4xl mx-auto font-extrabold shadow-inner border-4 border-teal-200">
                            <span x-text="quizScore.percentage + '%'"></span>
                        </div>

                        <div class="space-y-1">
                            <p class="text-xs font-bold text-teal-600 uppercase tracking-wider" x-show="quizScore.visitor_name">
                                Hasil Kuis: <span class="font-extrabold text-navy-800" x-text="quizScore.visitor_name"></span>
                            </p>
                            <h3 class="text-2xl font-extrabold text-navy-800">
                                Skor Kuis: <span x-text="quizScore.score"></span> / <span x-text="quizScore.total"></span> Soal Benar
                            </h3>
                            <p class="text-slate-600 text-xs sm:text-sm" x-text="quizScore.percentage >= 80 ? '🎉 Luar biasa! Anda paham betul sains gizi anti-stunting.' : '💪 Bagus sekali! Pelajari terus modul SMARTEDU untuk pemahaman lebih dalam.'"></p>
                        </div>
                    </div>

                    <!-- Pembahasan Jawaban -->
                    <div class="space-y-3 pt-4 border-t border-slate-200">
                        <h4 class="font-extrabold text-navy-800 text-sm flex items-center space-x-2">
                            <i class="fa-solid fa-clipboard-check text-tealAccent-500"></i>
                            <span>Pembahasan & Ringkasan Jawaban:</span>
                        </h4>
                        <div class="space-y-2.5">
                            <template x-for="(res, qid) in quizScore.results" :key="qid">
                                <div class="p-4 rounded-2xl border text-xs space-y-2" :class="res.correct ? 'bg-emerald-50/70 border-emerald-300 text-emerald-950' : 'bg-rose-50/70 border-rose-300 text-rose-950'">
                                    <div class="flex items-start justify-between gap-3 font-extrabold">
                                        <span x-text="res.question"></span>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] uppercase tracking-wider shrink-0 font-extrabold" :class="res.correct ? 'bg-emerald-600 text-white' : 'bg-rose-600 text-white'" x-text="res.correct ? 'BENAR' : 'SALAH'"></span>
                                    </div>
                                    <div class="text-[11px] text-slate-700 space-y-0.5">
                                        <p>Jawaban Anda: <strong class="uppercase" x-text="res.user_ans || '(Tidak diisi)'"></strong> | Jawaban Benar: <strong class="uppercase text-emerald-700" x-text="res.correct_ans"></strong></p>
                                        <p x-show="res.explanation" class="pt-1 text-slate-600 font-medium">
                                            💡 <strong>Penjelasan:</strong> <span x-text="res.explanation"></span>
                                        </p>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div class="text-center pt-4">
                        <button @click="resetQuiz()" class="px-8 py-3.5 rounded-xl bg-navy-800 hover:bg-navy-900 text-white font-extrabold text-xs uppercase tracking-wider cursor-pointer shadow-md">
                            <i class="fa-solid fa-rotate-right mr-1.5"></i> Coba Kuis Lagi
                        </button>
                    </div>
                </div>
            </template>
        </div>

        <!-- TAB 2: SUSUN PIRING SEHAT (EXACT MATCHING CANVA SITE) -->
        <div x-show="tab === 'piring'" x-transition class="max-w-4xl mx-auto bg-[#102847] border border-slate-700/70 rounded-3xl p-6 sm:p-10 shadow-2xl text-white space-y-6">
            
            <!-- Siska Guide Banner -->
            <div class="p-4.5 rounded-2xl bg-[#16365c] border border-slate-700/80 flex items-start space-x-4">
                <div class="w-12 h-12 rounded-full bg-amber-400/20 border border-amber-400/40 flex items-center justify-center text-2xl shrink-0">
                    👩
                </div>
                <div class="space-y-1">
                    <h4 class="font-extrabold text-amber-300 text-sm">Siska memandu:</h4>
                    <p class="text-xs sm:text-sm text-slate-200 leading-relaxed font-medium">
                        "Susun piring sehat dengan komposisi yang tepat! Tarik makanan ke kategori yang benar."
                    </p>
                </div>
            </div>

            <!-- Food Items Pool Box -->
            <div class="space-y-3">
                <p class="text-xs font-bold text-slate-300 uppercase tracking-wider">
                    Tarik makanan ke kategori yang tepat:
                </p>

                <div class="p-4 rounded-2xl bg-[#16365c]/80 border border-slate-700/80 flex flex-wrap items-center gap-3 min-h-[64px]">
                    <template x-for="item in availableItems" :key="item.id">
                        <div draggable="true" 
                             @dragstart="handleDragStart($event, item)" 
                             @click="selectFood(item)"
                             :class="selectedFood && selectedFood.id === item.id ? 'ring-4 ring-tealAccent-400 scale-105' : ''"
                             class="px-4 py-2.5 rounded-xl bg-slate-800 border border-slate-600 text-white font-extrabold text-xs shadow-md cursor-grab active:cursor-grabbing flex items-center space-x-2 transition-transform hover:scale-105 select-none">
                            <span x-text="item.icon" class="text-sm"></span>
                            <span x-text="item.name"></span>
                        </div>
                    </template>

                    <span x-show="availableItems.length === 0" class="text-xs text-tealAccent-400 font-bold italic">
                        ✓ Semua makanan sudah ditaruh di piring! Klik "Cek Jawaban!" di bawah.
                    </span>
                </div>
                <p class="text-[11px] text-slate-400 italic" x-show="availableItems.length > 0">
                    💡 Tips: Anda dapat menggeser (drag & drop) atau mengeklik nama makanan lalu mengeklik kotak kategori.
                </p>
            </div>

            <!-- 4 Category Drop Zones (2x2 Grid) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Zone 1: Karbohidrat -->
                <div @dragover.prevent @drop="handleDrop('karbohidrat')" 
                     @click="selectedFood && handleDrop('karbohidrat')"
                     class="p-5 rounded-2xl border-2 border-dashed border-slate-600/80 bg-[#16365c]/50 min-h-[120px] space-y-3 transition-all hover:border-tealAccent-400/70 cursor-pointer">
                    <div class="flex items-center justify-between text-xs font-extrabold text-amber-300 uppercase tracking-wider">
                        <span>🌾 Karbohidrat</span>
                        <span class="text-[10px] text-slate-400 font-semibold" x-text="categories.karbohidrat.length + ' item'"></span>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <template x-for="item in categories.karbohidrat" :key="item.id">
                            <span @click.stop="removeFromCategory(item, 'karbohidrat')" class="px-3.5 py-1.5 rounded-xl bg-amber-500/20 border border-amber-400/40 text-amber-200 font-extrabold text-xs flex items-center space-x-2 hover:bg-rose-500/30 transition-colors cursor-pointer" title="Klik untuk kembalikan">
                                <span x-text="item.icon"></span>
                                <span x-text="item.name"></span>
                                <i class="fa-solid fa-xmark text-[10px] opacity-70"></i>
                            </span>
                        </template>
                    </div>
                </div>

                <!-- Zone 2: Protein -->
                <div @dragover.prevent @drop="handleDrop('protein')" 
                     @click="selectedFood && handleDrop('protein')"
                     class="p-5 rounded-2xl border-2 border-dashed border-slate-600/80 bg-[#16365c]/50 min-h-[120px] space-y-3 transition-all hover:border-tealAccent-400/70 cursor-pointer">
                    <div class="flex items-center justify-between text-xs font-extrabold text-rose-300 uppercase tracking-wider">
                        <span>🥩 Protein</span>
                        <span class="text-[10px] text-slate-400 font-semibold" x-text="categories.protein.length + ' item'"></span>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <template x-for="item in categories.protein" :key="item.id">
                            <span @click.stop="removeFromCategory(item, 'protein')" class="px-3.5 py-1.5 rounded-xl bg-rose-500/20 border border-rose-400/40 text-rose-200 font-extrabold text-xs flex items-center space-x-2 hover:bg-rose-500/30 transition-colors cursor-pointer" title="Klik untuk kembalikan">
                                <span x-text="item.icon"></span>
                                <span x-text="item.name"></span>
                                <i class="fa-solid fa-xmark text-[10px] opacity-70"></i>
                            </span>
                        </template>
                    </div>
                </div>

                <!-- Zone 3: Sayuran -->
                <div @dragover.prevent @drop="handleDrop('sayuran')" 
                     @click="selectedFood && handleDrop('sayuran')"
                     class="p-5 rounded-2xl border-2 border-dashed border-slate-600/80 bg-[#16365c]/50 min-h-[120px] space-y-3 transition-all hover:border-tealAccent-400/70 cursor-pointer">
                    <div class="flex items-center justify-between text-xs font-extrabold text-emerald-300 uppercase tracking-wider">
                        <span>🥦 Sayuran</span>
                        <span class="text-[10px] text-slate-400 font-semibold" x-text="categories.sayuran.length + ' item'"></span>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <template x-for="item in categories.sayuran" :key="item.id">
                            <span @click.stop="removeFromCategory(item, 'sayuran')" class="px-3.5 py-1.5 rounded-xl bg-emerald-500/20 border border-emerald-400/40 text-emerald-200 font-extrabold text-xs flex items-center space-x-2 hover:bg-rose-500/30 transition-colors cursor-pointer" title="Klik untuk kembalikan">
                                <span x-text="item.icon"></span>
                                <span x-text="item.name"></span>
                                <i class="fa-solid fa-xmark text-[10px] opacity-70"></i>
                            </span>
                        </template>
                    </div>
                </div>

                <!-- Zone 4: Buah -->
                <div @dragover.prevent @drop="handleDrop('buah')" 
                     @click="selectedFood && handleDrop('buah')"
                     class="p-5 rounded-2xl border-2 border-dashed border-slate-600/80 bg-[#16365c]/50 min-h-[120px] space-y-3 transition-all hover:border-tealAccent-400/70 cursor-pointer">
                    <div class="flex items-center justify-between text-xs font-extrabold text-teal-300 uppercase tracking-wider">
                        <span>🍎 Buah</span>
                        <span class="text-[10px] text-slate-400 font-semibold" x-text="categories.buah.length + ' item'"></span>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <template x-for="item in categories.buah" :key="item.id">
                            <span @click.stop="removeFromCategory(item, 'buah')" class="px-3.5 py-1.5 rounded-xl bg-teal-500/20 border border-teal-400/40 text-teal-200 font-extrabold text-xs flex items-center space-x-2 hover:bg-rose-500/30 transition-colors cursor-pointer" title="Klik untuk kembalikan">
                                <span x-text="item.icon"></span>
                                <span x-text="item.name"></span>
                                <i class="fa-solid fa-xmark text-[10px] opacity-70"></i>
                            </span>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Feedback Alert -->
            <div x-show="gameChecked" x-transition class="p-4 rounded-2xl border text-sm font-bold flex flex-wrap items-center justify-between gap-3"
                 :class="gameResult.success ? 'bg-emerald-950/90 border-emerald-500 text-emerald-200' : 'bg-amber-950/90 border-amber-500 text-amber-200'">
                <div class="flex items-center space-x-2">
                    <i class="text-xl" :class="gameResult.success ? 'fa-solid fa-circle-check text-emerald-400' : 'fa-solid fa-triangle-exclamation text-amber-400'"></i>
                    <span x-text="gameResult.message"></span>
                </div>
                <button type="button" @click="resetPiringGame()" class="px-3.5 py-1.5 rounded-xl bg-white/10 hover:bg-white/20 text-xs uppercase font-extrabold shrink-0 cursor-pointer">
                    <i class="fa-solid fa-rotate-right mr-1"></i> Reset Game
                </button>
            </div>

            <!-- Action Button matching Canva Cek Jawaban! -->
            <div>
                <button type="button" @click="checkPiringAnswers()" class="w-full py-4 rounded-2xl bg-tealAccent-500 hover:bg-tealAccent-600 text-navy-950 font-extrabold text-base uppercase tracking-wider shadow-lg shadow-tealAccent-500/20 cursor-pointer transition-transform hover:scale-[1.01]">
                    Cek Jawaban!
                </button>
            </div>
        </div>

        <!-- TAB 3: TEBAK NUTRISI -->
        <div x-show="tab === 'tebak'" x-transition class="max-w-4xl mx-auto bg-[#102847] border border-slate-700/70 rounded-3xl p-6 sm:p-10 shadow-2xl text-white space-y-6">
            <div class="flex items-center justify-between border-b border-slate-700 pb-4">
                <h3 class="font-extrabold text-xl text-tealAccent-400">📊 Game Tebak Nutrisi Pangan Lokal</h3>
                <span class="text-xs font-bold bg-teal-500/20 px-3 py-1 rounded-full text-teal-300">
                    Skor: <span x-text="tebakScore"></span> PTS
                </span>
            </div>

            <div class="space-y-4">
                <p class="text-xs font-bold text-slate-300 uppercase tracking-wider">
                    Soal <span x-text="tebakIndex + 1"></span> dari <span x-text="tebakQuestions.length"></span>:
                </p>

                <div class="p-6 rounded-2xl bg-[#16365c] border border-slate-700 space-y-4">
                    <h4 class="text-lg font-bold text-amber-300" x-text="tebakQuestions[tebakIndex].food"></h4>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                        <template x-for="(opt, idx) in tebakQuestions[tebakIndex].options" :key="idx">
                            <button type="button" @click="answerTebak(idx)" 
                                    :disabled="tebakAnswered"
                                    class="p-4 rounded-xl border text-left text-xs font-extrabold transition-all cursor-pointer flex items-center justify-between"
                                    :class="tebakAnswered && idx === tebakQuestions[tebakIndex].correct ? 'bg-emerald-600 border-emerald-400 text-white' : 'bg-slate-800 border-slate-600 hover:border-tealAccent-400 text-slate-200'">
                                <span x-text="opt"></span>
                                <i x-show="tebakAnswered && idx === tebakQuestions[tebakIndex].correct" class="fa-solid fa-circle-check text-emerald-300"></i>
                            </button>
                        </template>
                    </div>
                </div>

                <div x-show="tebakFeedback" x-transition class="p-4 rounded-2xl bg-teal-950/80 border border-teal-500 text-teal-200 text-xs font-bold flex items-center justify-between">
                    <span x-text="tebakFeedback"></span>
                    <button type="button" @click="nextTebak()" class="px-4 py-2 rounded-xl bg-tealAccent-500 text-navy-950 font-extrabold uppercase text-[11px]">
                        Lanjut Soal <i class="fa-solid fa-arrow-right ml-1"></i>
                    </button>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- SECTION 5: GALERI KEGIATAN & NEWS MODAL -->
<section id="galeri" class="py-20 bg-slate-50 border-t border-slate-200" x-data="{ 
    showNewsModal: false, 
    selectedNews: null, 
    openNews(item) { 
        this.selectedNews = item; 
        this.showNewsModal = true; 
    } 
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-tealAccent-600 bg-teal-100/80 px-3.5 py-1.5 rounded-full">Dokumentasi Lapangan</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-navy-800 mt-2">Galeri Kegiatan Desa Bale</h2>
                <p class="text-slate-600 text-sm sm:text-base max-w-xl mt-1">Potret semangat warga Desa Bale, kader Posyandu, dan tim PPK Ormawa HIMASKI UNTAD. Klik pada berita/kegiatan untuk melihat detail lengkap.</p>
            </div>
            @auth
                <a href="{{ route('admin.galleries') }}" class="inline-flex items-center space-x-2 text-xs font-bold uppercase text-navy-800 bg-white px-4 py-2.5 rounded-xl border border-slate-200 shadow-sm hover:bg-teal-50">
                    <i class="fa-solid fa-camera text-tealAccent-500"></i>
                    <span>Kelola Galeri (Admin)</span>
                </a>
            @endauth
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($galleries as $g)
                @php
                    $gImgUrl = $g->image_path ?: 'https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?auto=format&fit=crop&w=800&q=80';
                    if (!Str::startsWith($gImgUrl, ['http://', 'https://'])) {
                        $gImgUrl = asset(ltrim($gImgUrl, '/'));
                    }
                    $formattedGalleryItem = [
                        'id' => $g->id,
                        'title' => $g->title,
                        'category' => $g->category ?: 'Sosialisasi',
                        'image_path' => $gImgUrl,
                        'caption' => $g->caption,
                        'date_formatted' => $g->event_date ? date('d M Y', strtotime($g->event_date)) : $g->created_at->format('d M Y')
                    ];
                @endphp

                <div @click="openNews({{ json_encode($formattedGalleryItem) }})" class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 group cursor-pointer flex flex-col justify-between">
                    <div>
                        <div class="h-56 overflow-hidden relative bg-slate-900/95 flex items-center justify-center p-2">
                            <img src="{{ $gImgUrl }}" alt="{{ $g->title }}" class="w-auto h-auto max-w-full max-h-full object-contain group-hover:scale-105 transition-transform duration-500 rounded-lg" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?auto=format&fit=crop&w=800&q=80';">
                            <div class="absolute top-3 left-3 bg-navy-800/80 backdrop-blur-md text-white text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wider z-10">
                                {{ $g->category }}
                            </div>
                            <!-- Overlay Hover Badge -->
                            <div class="absolute inset-0 bg-navy-950/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center z-10">
                                <span class="px-4 py-2 rounded-xl bg-tealAccent-500 text-navy-950 font-extrabold text-xs uppercase tracking-wider shadow-lg flex items-center space-x-2">
                                    <i class="fa-solid fa-newspaper"></i>
                                    <span>Baca Detail Berita</span>
                                </span>
                            </div>
                        </div>

                        <div class="p-5 space-y-2">
                            <h4 class="font-bold text-navy-800 text-base leading-snug group-hover:text-tealAccent-600 transition-colors line-clamp-2">
                                {{ $g->title }}
                            </h4>
                            <p class="text-xs text-slate-500 leading-relaxed line-clamp-3">
                                {{ $g->caption }}
                            </p>
                        </div>
                    </div>

                    <div class="px-5 pb-5 pt-3 border-t border-slate-100 flex items-center justify-between">
                        @if($g->event_date)
                            <div class="text-[11px] text-teal-600 font-semibold">
                                <i class="fa-regular fa-calendar mr-1"></i> {{ date('d M Y', strtotime($g->event_date)) }}
                            </div>
                        @else
                            <div class="text-[11px] text-slate-400 font-semibold">
                                <i class="fa-regular fa-clock mr-1"></i> {{ $g->created_at->format('d M Y') }}
                            </div>
                        @endif

                        <span class="text-xs font-bold text-tealAccent-600 group-hover:translate-x-1 transition-transform inline-flex items-center space-x-1">
                            <span>Baca Berita</span>
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </span>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-slate-400 bg-white rounded-2xl border border-dashed border-slate-300">
                    <p>Belum ada foto galeri.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- MODAL VIEW BERITA & DETAIL GALERI -->
    <div x-show="showNewsModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-navy-950/80 backdrop-blur-sm" x-transition>
        <div @click.away="showNewsModal = false" class="bg-white rounded-3xl max-w-2xl w-full shadow-2xl relative border border-slate-100 max-h-[90vh] overflow-y-auto overflow-x-hidden flex flex-col">
            
            <!-- Sticky Header Bar -->
            <div class="sticky top-0 z-20 bg-white/95 backdrop-blur-md px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <span class="w-3 h-3 rounded-full bg-tealAccent-500 animate-pulse"></span>
                    <span class="text-xs font-extrabold uppercase tracking-wider text-navy-800">Berita & Dokumentasi Lapangan</span>
                </div>
                <button type="button" @click="showNewsModal = false" class="w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-navy-900 flex items-center justify-center transition-colors cursor-pointer">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <template x-if="selectedNews">
                <div class="p-6 sm:p-8 space-y-6">
                    <!-- Cover Image (Full View - No Cropping) -->
                    <div class="relative rounded-2xl overflow-hidden shadow-md border border-slate-200 bg-slate-900/95 p-3 flex items-center justify-center min-h-[250px] max-h-[500px]">
                        <img :src="selectedNews.image_path" :alt="selectedNews.title" class="w-auto h-auto max-w-full max-h-[460px] object-contain rounded-xl shadow">
                        <div class="absolute top-4 left-4 bg-navy-900/80 backdrop-blur-md text-tealAccent-400 text-xs font-extrabold px-3.5 py-1.5 rounded-full uppercase tracking-wider border border-white/10 shadow z-10">
                            <i class="fa-solid fa-tag mr-1"></i>
                            <span x-text="selectedNews.category"></span>
                        </div>
                    </div>

                    <!-- Title & Meta Info -->
                    <div class="space-y-3">
                        <div class="flex flex-wrap items-center gap-2 text-xs font-medium">
                            <span class="inline-flex items-center text-teal-700 font-bold bg-teal-50 px-3 py-1 rounded-full border border-teal-200">
                                <i class="fa-regular fa-calendar-check mr-1.5"></i>
                                <span x-text="selectedNews.date_formatted"></span>
                            </span>
                            <span class="inline-flex items-center text-slate-600 bg-slate-100 px-3 py-1 rounded-full">
                                <i class="fa-solid fa-location-dot mr-1.5 text-coralAccent-500"></i>
                                <span>Desa Bale, Kec. Tanantovea</span>
                            </span>
                            <span class="inline-flex items-center text-slate-600 bg-slate-100 px-3 py-1 rounded-full">
                                <i class="fa-solid fa-users mr-1.5 text-teal-600"></i>
                                <span>PPK Ormawa HIMASKI UNTAD</span>
                            </span>
                        </div>

                        <h3 class="text-2xl sm:text-3xl font-extrabold text-navy-800 leading-snug" x-text="selectedNews.title"></h3>
                    </div>

                    <!-- Divider -->
                    <div class="border-t border-slate-100"></div>

                    <!-- Article Body / Caption -->
                    <div class="space-y-4 text-slate-700 leading-relaxed">
                        <div class="p-4 rounded-2xl bg-teal-50/60 border-l-4 border-tealAccent-500 text-teal-900 text-xs sm:text-sm font-semibold">
                            <i class="fa-solid fa-quote-left text-tealAccent-500 mr-2"></i>
                            Dokumentasi resmi kegiatan lapangan program SMARTEDU-NUTRICHEM Ormawa HIMASKI UNTAD di Desa Bale.
                        </div>

                        <div class="whitespace-pre-line text-slate-800 font-normal leading-relaxed text-sm sm:text-base pt-1" x-text="selectedNews.caption || 'Tidak ada deskripsi rinci untuk berita ini.'"></div>
                    </div>

                    <!-- Footer Actions -->
                    <div class="pt-6 border-t border-slate-100 flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center space-x-2">
                            <button type="button" @click="navigator.clipboard.writeText(window.location.href); alert('Tautan berita berhasil disalin!');" class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-navy-800 font-bold text-xs flex items-center space-x-2 transition-colors cursor-pointer">
                                <i class="fa-regular fa-copy"></i>
                                <span>Salin Tautan</span>
                            </button>
                            <a :href="'https://api.whatsapp.com/send?text=' + encodeURIComponent(selectedNews.title + ' - ' + window.location.href)" target="_blank" class="px-4 py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs flex items-center space-x-2 shadow-sm transition-colors">
                                <i class="fa-brands fa-whatsapp text-sm"></i>
                                <span>Bagikan WA</span>
                            </a>
                        </div>

                        <button type="button" @click="showNewsModal = false" class="px-6 py-2.5 rounded-xl bg-navy-800 hover:bg-navy-900 text-white font-extrabold text-xs uppercase tracking-wider shadow-md cursor-pointer">
                            Tutup Berita
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </div>
</section>

<!-- SECTION 6: TESTIMONI -->
<section class="py-20 bg-white border-t border-slate-200" x-data="publicTestimonial()">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div class="space-y-3">
                <span class="text-xs font-bold uppercase tracking-widest text-tealAccent-600 bg-teal-50 px-3.5 py-1.5 rounded-full border border-teal-200">Kata Mereka</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-navy-800">Testimoni & Suara Warga</h2>
                <p class="text-slate-600 text-sm sm:text-base max-w-xl">Apresiasi dari Kepala Desa, Kader Posyandu, dan Ibu Balita Desa Bale.</p>
            </div>

            <button type="button" @click="openModal = true" class="px-6 py-3.5 rounded-xl bg-tealAccent-500 hover:bg-tealAccent-600 text-navy-950 font-extrabold text-xs uppercase tracking-wider shadow-lg flex items-center space-x-2 transition-transform hover:scale-105 shrink-0 cursor-pointer">
                <i class="fa-solid fa-pen-to-square"></i>
                <span>+ Tulis Testimoni Anda</span>
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($testimonials as $t)
                <div class="p-8 rounded-3xl bg-slate-50 border border-slate-200/80 shadow-sm flex flex-col justify-between hover:shadow-lg transition-shadow">
                    <div class="space-y-4">
                        <div class="flex text-amber-400 text-sm space-x-1">
                            @for($i=0; $i < $t->rating; $i++)
                                <i class="fa-solid fa-star"></i>
                            @endfor
                        </div>
                        <p class="text-slate-700 text-sm leading-relaxed italic">
                            "{{ $t->content }}"
                        </p>
                    </div>

                    <div class="pt-6 mt-6 border-t border-slate-200/60 flex items-center space-x-3">
                        @php
                            $tAvatar = $t->avatar ?: 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=200&q=80';
                            if (!Str::startsWith($tAvatar, ['http://', 'https://'])) {
                                $tAvatar = asset(ltrim($tAvatar, '/'));
                            }
                            $tFallback = 'https://ui-avatars.com/api/?name=' . urlencode($t->name) . '&background=00C9A7&color=0f172a&bold=true';
                        @endphp
                        <img src="{{ $tAvatar }}" alt="{{ $t->name }}" class="w-11 h-11 rounded-full object-cover border-2 border-tealAccent-500" onerror="this.onerror=null; this.src='{{ $tFallback }}';">
                        <div>
                            <h4 class="font-bold text-navy-800 text-sm">{{ $t->name }}</h4>
                            <p class="text-xs text-slate-500">{{ $t->role }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Public Testimonial Modal -->
    <div x-show="openModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-navy-950/70 backdrop-blur-sm" x-transition>
        <div @click.away="openModal = false" class="bg-white rounded-3xl max-w-lg w-full p-8 shadow-2xl space-y-6 relative border border-slate-100 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <div>
                    <h3 class="text-lg font-extrabold text-navy-800">Tulis Testimoni & Beri Rating</h3>
                    <p class="text-xs text-slate-500">Bagikan kesan & ulasan Anda tentang program SMARTEDU-NUTRICHEM.</p>
                </div>
                <button type="button" @click="openModal = false" class="text-slate-400 hover:text-slate-600 cursor-pointer">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <div x-show="submitted" class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold flex items-center space-x-3">
                <i class="fa-solid fa-circle-check text-xl text-emerald-500"></i>
                <span>Terima kasih! Testimoni & rating Anda berhasil diterbitkan.</span>
            </div>

            <form @submit.prevent="submitTestimonial" x-show="!submitted" enctype="multipart/form-data" class="space-y-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-2">Beri Rating Bintang *</label>
                    <div class="flex items-center space-x-2 text-2xl text-amber-400">
                        <template x-for="star in [1,2,3,4,5]">
                            <i class="fa-star cursor-pointer transition-transform hover:scale-125" :class="star <= form.rating ? 'fa-solid' : 'fa-regular text-slate-300'" @click="form.rating = star"></i>
                        </template>
                        <span class="text-xs text-slate-500 font-bold ml-2" x-text="form.rating + ' / 5 Bintang'"></span>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Lengkap *</label>
                    <input type="text" x-model="form.name" required placeholder="Contoh: Ibu Rahmawati" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Peran / Status Di Desa *</label>
                    <input type="text" x-model="form.role" required placeholder="Contoh: Kader Posyandu Mawar / Ibu Balita Desa Bale" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Ulasan / Pesan Testimoni *</label>
                    <textarea x-model="form.content" rows="3" required placeholder="Tuliskan ulasan atau manfaat yang dirasakan dari program SMARTEDU..." class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500"></textarea>
                </div>

                <!-- Direct Camera Snapshot / Avatar Info (No Choose File) -->
                <div class="p-4 rounded-2xl bg-teal-50/60 border border-teal-200/80 space-y-3">
                    <div class="flex items-center justify-between">
                        <label class="block text-xs font-extrabold uppercase text-navy-900">
                            📸 Foto Profil (Opsional)
                        </label>
                        <button type="button" @click="toggleCamera()" class="px-3.5 py-1.5 rounded-xl bg-navy-800 text-white font-bold text-xs uppercase hover:bg-navy-900 flex items-center space-x-1.5 cursor-pointer">
                            <i class="fa-solid fa-video text-teal-400 text-xs"></i>
                            <span x-text="useCamera ? 'Tutup Kamera' : 'Ambil Foto Kamera'"></span>
                        </button>
                    </div>

                    <p class="text-[11px] text-slate-500">Jika tidak ambil foto, profil akan otomatis memakai inisial nama Anda.</p>

                    <!-- Live WebCam Stream Box -->
                    <div x-show="useCamera" class="space-y-2 pt-2 text-center">
                        <div class="w-40 h-40 mx-auto rounded-2xl overflow-hidden bg-black relative border-2 border-tealAccent-500 shadow-md">
                            <video id="webcam_stream" autoplay playsinline class="w-full h-full object-cover"></video>
                            <canvas id="webcam_canvas" class="hidden"></canvas>
                        </div>
                        <button type="button" @click="captureWebcamSnapshot()" class="px-4 py-2 rounded-xl bg-tealAccent-500 hover:bg-tealAccent-600 text-navy-950 text-xs font-extrabold uppercase shadow cursor-pointer">
                            📸 Potret Foto Sekarang
                        </button>
                    </div>

                    <div x-show="fileName && !useCamera" class="text-xs text-emerald-700 font-bold flex items-center space-x-1 bg-emerald-50 p-2.5 rounded-xl border border-emerald-200">
                        <i class="fa-solid fa-check-circle"></i>
                        <span>Foto dari kamera berhasil dipotret!</span>
                    </div>
                </div>

                <div class="pt-4 flex justify-end space-x-3 border-t border-slate-100">
                    <button type="button" @click="openModal = false" class="px-5 py-2.5 rounded-xl bg-slate-100 text-slate-600 font-bold text-xs uppercase cursor-pointer">Batal</button>
                    <button type="submit" :disabled="loading" class="px-6 py-2.5 rounded-xl bg-tealAccent-500 text-navy-950 font-extrabold text-xs uppercase shadow-md flex items-center space-x-2 cursor-pointer">
                        <span x-show="!loading">Kirim Testimoni</span>
                        <span x-show="loading"><i class="fa-solid fa-spinner animate-spin"></i> Mengirim...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- SECTION 7: TIM PELAKSANA -->
<section id="tim" class="py-20 bg-slate-50 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
            <span class="text-xs font-bold uppercase tracking-widest text-tealAccent-600 bg-teal-100/70 px-3.5 py-1.5 rounded-full">Pelaksana Program</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-navy-800">Tim PPK Ormawa HIMASKI UNTAD</h2>
            <p class="text-slate-600 text-sm sm:text-base">Mahasiswa FKIP Universitas Tadulako yang berdedikasi tinggi untuk penurunan stunting.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($teams as $tm)
                @php
                    $teamPhoto = $tm->photo ?: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80';
                    if (!Str::startsWith($teamPhoto, ['http://', 'https://'])) {
                        $teamPhoto = asset(ltrim($teamPhoto, '/'));
                    }
                    $teamAvatarFallback = 'https://ui-avatars.com/api/?name=' . urlencode($tm->name) . '&background=00C9A7&color=0f172a&bold=true';
                @endphp
                <div class="bg-white rounded-3xl p-6 text-center border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 group">
                    <div class="w-28 h-28 mx-auto rounded-full overflow-hidden mb-4 border-4 border-tealAccent-500 shadow-md group-hover:scale-105 transition-transform bg-slate-100 flex items-center justify-center">
                        <img src="{{ $teamPhoto }}" alt="{{ $tm->name }}" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='{{ $teamAvatarFallback }}';">
                    </div>
                    <h3 class="font-bold text-navy-800 text-base mb-1 group-hover:text-tealAccent-600 transition-colors">{{ $tm->name }}</h3>
                    <p class="text-xs font-semibold text-teal-600 uppercase tracking-wider mb-2">{{ $tm->role }}</p>
                    <span class="inline-block px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-[11px] font-medium">
                        {{ $tm->division }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- SECTION 8: KONTAK & FORM PESAN -->
<section id="kontak" class="py-20 bg-white text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- Left Info -->
            <div class="lg:col-span-5 space-y-6">
                <span class="text-xs font-bold uppercase tracking-widest text-tealAccent-400 bg-white/10 px-3.5 py-1.5 rounded-full border border-white/10">Hubungi Kami</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-navy-800">
                    Mari Berkolaborasi Demi Desa Bebas Stunting
                </h2>
                <p class="text-navy-800 text-sm leading-relaxed">
                    Punya pertanyaan mengenai materi modul, jadwal penyuluhan, atau ingin berkolaborasi? Kirimkan pesan Anda langsung kepada tim SMARTEDU.
                </p>

                <div class="space-y-4 pt-4">
                    <div class="flex items-start space-x-4 p-4 rounded-2xl bg-white/5 border border-white/10">
                        <div class="w-10 h-10 rounded-xl bg-tealAccent-500 text-navy-950 flex items-center justify-center shrink-0 font-bold">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <h4 class="text-xs uppercase font-bold text-teal-300">Lokasi Posko</h4>
                            <p class="text-sm text-navy-800">{{ $settings['contact_location'] ?? 'Desa Bale, Kec. Tanantovea, Donggala' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 p-4 rounded-2xl bg-white/5 border border-white/10">
                        <div class="w-10 h-10 rounded-xl bg-tealAccent-500 text-navy-950 flex items-center justify-center shrink-0 font-bold">
                            <i class="fa-regular fa-envelope"></i>
                        </div>
                        <div>
                            <h4 class="text-xs uppercase font-bold text-teal-300">Email Resmi</h4>
                            <p class="text-sm text-navy-800">{{ $settings['contact_email'] ?? 'ppkormawahimaski@gmail.com' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Form -->
            <div class="lg:col-span-7" x-data="contactForm()">
                <div class="bg-white text-slate-800 p-8 sm:p-10 rounded-3xl shadow-2xl space-y-6">
                    <h3 class="text-xl font-bold text-navy-800">Kirim Pesan / Pertanyaan</h3>

                    <div x-show="submitted" class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold flex items-center space-x-3">
                        <i class="fa-solid fa-circle-check text-xl text-emerald-500"></i>
                        <span>Pesan Anda berhasil dikirim! Tim Admin SMARTEDU akan membaca pesan ini di Dashboard Admin.</span>
                    </div>

                    <form @submit.prevent="sendContact" x-show="!submitted" class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Lengkap *</label>
                                <input type="text" x-model="form.name" required class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-tealAccent-500 focus:ring-2 focus:ring-tealAccent-500/20 text-sm outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Email / WhatsApp *</label>
                                <input type="text" x-model="form.email" required class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-tealAccent-500 focus:ring-2 focus:ring-tealAccent-500/20 text-sm outline-none">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Subjek / Topik</label>
                            <input type="text" x-model="form.subject" placeholder="Contoh: Permintaan Modul Edukasi" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-tealAccent-500 focus:ring-2 focus:ring-tealAccent-500/20 text-sm outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Isi Pesan *</label>
                            <textarea x-model="form.message" rows="4" required placeholder="Tuliskan pesan atau konsultasi Anda di sini..." class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-tealAccent-500 focus:ring-2 focus:ring-tealAccent-500/20 text-sm outline-none"></textarea>
                        </div>

                        <button type="submit" :disabled="loading" class="w-full py-4 rounded-xl bg-tealAccent-500 hover:bg-tealAccent-600 text-navy-950 font-bold text-sm uppercase tracking-wider shadow-lg shadow-tealAccent-500/20 transition-all flex items-center justify-center space-x-2">
                            <span x-show="!loading">Kirim Pesan Sekarang</span>
                            <span x-show="loading"><i class="fa-solid fa-spinner animate-spin"></i> Mengirim...</span>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
    function publicTestimonial() {
        return {
            openModal: false,
            loading: false,
            submitted: false,
            useCamera: false,
            stream: null,
            file: null,
            fileName: '',
            form: { name: '', role: '', content: '', rating: 5, avatar: '' },

            handleFileUpload(event) {
                if (event.target.files.length > 0) {
                    this.file = event.target.files[0];
                    this.fileName = this.file.name;
                }
            },

            async toggleCamera() {
                this.useCamera = !this.useCamera;
                if (this.useCamera) {
                    try {
                        this.stream = await navigator.mediaDevices.getUserMedia({ video: true });
                        const video = document.getElementById('webcam_stream');
                        video.srcObject = this.stream;
                    } catch (e) {
                        alert('Tidak dapat mengakses kamera perangkat Anda. Pastikan izin kamera diaktifkan.');
                        this.useCamera = false;
                    }
                } else {
                    if (this.stream) {
                        this.stream.getTracks().forEach(track => track.stop());
                    }
                }
            },

            captureWebcamSnapshot() {
                const video = document.getElementById('webcam_stream');
                const canvas = document.getElementById('webcam_canvas');
                canvas.width = video.videoWidth || 300;
                canvas.height = video.videoHeight || 300;
                const ctx = canvas.getContext('2d');
                ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
                
                canvas.toBlob((blob) => {
                    this.file = new File([blob], "camera_snapshot.jpg", { type: "image/jpeg" });
                    this.fileName = "Kamera_Snapshot.jpg";
                    alert('Foto kamera berhasil dipotret!');
                    this.toggleCamera();
                }, 'image/jpeg');
            },

            async submitTestimonial() {
                this.loading = true;
                try {
                    const formData = new FormData();
                    formData.append('name', this.form.name);
                    formData.append('role', this.form.role);
                    formData.append('content', this.form.content);
                    formData.append('rating', this.form.rating);
                    formData.append('avatar', this.form.avatar);
                    if (this.file) {
                        formData.append('avatar_upload', this.file);
                    }

                    const response = await fetch('{{ route("testimonial.store") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: formData
                    });
                    if (response.ok) {
                        this.submitted = true;
                        setTimeout(() => {
                            window.location.reload();
                        }, 1800);
                    } else {
                        alert('Gagal mengirim testimoni. Pastikan isian lengkap.');
                    }
                } catch(e) {
                    alert('Terjadi kesalahan koneksi.');
                } finally {
                    this.loading = false;
                }
            }
        }
    }

    window.gameSystem = function gameSystem(dbPlateItems = [], dbGuesses = []) {
        const optionMap = { a: 0, b: 1, c: 2, d: 3 };

        const formattedPlateItems = dbPlateItems.length > 0 ? dbPlateItems.map(i => ({
            id: i.id,
            name: i.name,
            icon: i.icon || '🍚',
            correctCat: i.category
        })) : [
            { id: 1, name: 'Nasi', icon: '🍚', correctCat: 'karbohidrat' },
            { id: 2, name: 'Ikan', icon: '🐟', correctCat: 'protein' },
            { id: 3, name: 'Pisang', icon: '🍌', correctCat: 'buah' },
            { id: 4, name: 'Wortel', icon: '🥕', correctCat: 'sayuran' },
            { id: 5, name: 'Telur', icon: '🥚', correctCat: 'protein' },
            { id: 6, name: 'Sayur', icon: '🥒', correctCat: 'sayuran' }
        ];

        const formattedGuesses = dbGuesses.length > 0 ? dbGuesses.map(g => ({
            food: g.food_name,
            options: [g.option_a, g.option_b, g.option_c, g.option_d],
            correct: optionMap[g.correct_option] || 0,
            note: g.explanation || 'Kandungan nutrisi esensial bagi tubuh.'
        })) : [
            { food: 'Daun Kelor (Moringa)', options: ['Zat Besi & Vitamin A', 'Karbohidrat Tinggi', 'Lemak Jenuh', 'Glukosa'], correct: 0, note: 'Daun Kelor kaya akan Zat Besi (Fe) & Vitamin A untuk mencegah anemia & stunting!' },
            { food: 'Ikan Gabus / Bandeng', options: ['Protein & Albumin', 'Karbohidrat Murni', 'Serat Kasar', 'Kalsium Oksalat'], correct: 0, note: 'Ikan mengandung Protein & Albumin tinggi yang sangat penting bagi tumbuh kembang anak.' },
            { food: 'Telur Ayam', options: ['Kolin & Protein Hewani', 'Vitamin C', 'Serat Pektin', 'Asam Urat'], correct: 0, note: 'Telur adalah sumber Protein Hewani terjangkau berdaya cerna tinggi.' }
        ];

        return {
            tab: 'quiz',
            answers: {},
            quizSubmitted: false,
            quizScore: { score: 0, total: 0, percentage: 0 },
            
            // SUSUN PIRING SEHAT DATA
            initialItems: formattedPlateItems,
            availableItems: JSON.parse(JSON.stringify(formattedPlateItems)),
            selectedFood: null,
            draggedFoodId: null,
            categories: {
                karbohidrat: [],
                protein: [],
                sayuran: [],
                buah: []
            },
            gameChecked: false,
            gameResult: { success: false, message: '' },

            handleDragStart(evt, item) {
                this.draggedFoodId = item.id;
                evt.dataTransfer.setData('text/plain', item.id);
            },

            handleDrop(catKey) {
                const foodId = this.draggedFoodId || (this.selectedFood ? this.selectedFood.id : null);
                if (!foodId) return;

                let item = this.availableItems.find(i => i.id == foodId);
                if (item) {
                    this.availableItems = this.availableItems.filter(i => i.id != foodId);
                } else {
                    Object.keys(this.categories).forEach(k => {
                        let existing = this.categories[k].find(i => i.id == foodId);
                        if (existing) {
                            item = existing;
                            this.categories[k] = this.categories[k].filter(i => i.id != foodId);
                        }
                    });
                }

                if (item) {
                    this.categories[catKey].push(item);
                }
                this.selectedFood = null;
                this.draggedFoodId = null;
                this.gameChecked = false;
            },

            removeFromCategory(item, catKey) {
                this.categories[catKey] = this.categories[catKey].filter(i => i.id !== item.id);
                if (!this.availableItems.find(i => i.id === item.id)) {
                    this.availableItems.push(item);
                }
                this.gameChecked = false;
            },

            selectFood(item) {
                if (this.selectedFood && this.selectedFood.id === item.id) {
                    this.selectedFood = null;
                } else {
                    this.selectedFood = item;
                }
            },

            checkPiringAnswers() {
                this.gameChecked = true;
                let totalPlaced = 0;
                let correctCount = 0;
                let totalTarget = this.initialItems.length;

                Object.keys(this.categories).forEach(catKey => {
                    this.categories[catKey].forEach(item => {
                        totalPlaced++;
                        if (item.correctCat === catKey) {
                            correctCount++;
                        }
                    });
                });

                if (totalPlaced < totalTarget) {
                    this.gameResult = {
                        success: false,
                        message: `Harap tarik semua ${totalTarget} makanan ke dalam kotak kategori! (Baru ${totalPlaced}/${totalTarget} makanan dimasukkan)`
                    };
                } else if (correctCount === totalTarget) {
                    this.gameResult = {
                        success: true,
                        message: '🎉 Luar Biasa! Komposisi Piring Sehat Anda 100% Benar & Tepat!'
                    };
                } else {
                    this.gameResult = {
                        success: false,
                        message: `Jawaban kurang tepat. Ada makanan yang salah tempat. Periksa kembali dan coba lagi!`
                    };
                }
            },

            resetPiringGame() {
                this.availableItems = JSON.parse(JSON.stringify(this.initialItems));
                this.categories = { karbohidrat: [], protein: [], sayuran: [], buah: [] };
                this.selectedFood = null;
                this.draggedFoodId = null;
                this.gameChecked = false;
            },

            // TEBAK NUTRISI DATA
            tebakIndex: 0,
            tebakScore: 0,
            tebakAnswered: false,
            tebakFeedback: '',
            tebakQuestions: formattedGuesses,

            answerTebak(idx) {
                if (this.tebakAnswered) return;
                this.tebakAnswered = true;
                const current = this.tebakQuestions[this.tebakIndex];
                if (idx === current.correct) {
                    this.tebakScore += 100;
                    this.tebakFeedback = '🎉 Benar! ' + current.note;
                } else {
                    this.tebakFeedback = '❌ Kurang tepat. ' + current.note;
                }
            },

            nextTebak() {
                if (this.tebakIndex < this.tebakQuestions.length - 1) {
                    this.tebakIndex++;
                    this.tebakAnswered = false;
                    this.tebakFeedback = '';
                } else {
                    alert('Selamat! Anda telah menyelesaikan Tebak Nutrisi.');
                    this.tebakIndex = 0;
                    this.tebakAnswered = false;
                    this.tebakFeedback = '';
                }
            },

            async submitQuiz() {
                try {
                    const response = await fetch('{{ route("quiz.submit") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ answers: this.answers })
                    });
                    const data = await response.json();
                    this.quizScore = data;
                    this.quizSubmitted = true;
                } catch (e) {
                    alert('Terjadi kesalahan saat memproses kuis.');
                }
            },

            resetQuiz() {
                this.answers = {};
                this.quizSubmitted = false;
            }
        }
    }

    function contactForm() {
        return {
            form: { name: '', email: '', subject: '', message: '' },
            loading: false,
            submitted: false,

            async sendContact() {
                this.loading = true;
                try {
                    const response = await fetch('{{ route("contact.store") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(this.form)
                    });
                    if (response.ok) {
                        this.submitted = true;
                    } else {
                        alert('Gagal mengirim pesan. Silakan periksa kembali isian Anda.');
                    }
                } catch(e) {
                    alert('Terjadi kesalahan koneksi.');
                } finally {
                    this.loading = false;
                }
            }
        }
    }
</script>
@endsection
