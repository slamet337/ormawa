<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\SiteSetting;
use App\Models\Modul;
use App\Models\Gallery;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\QuizQuestion;
use App\Models\PlateItem;
use App\Models\NutritionGuess;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Create Default Admin User
        User::updateOrCreate(
            ['email' => 'admin@smartedu.id'],
            [
                'name' => 'Administrator SMARTEDU',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Site Settings
        $settings = [
            'hero_badge' => 'PPK Ormawa HIMASKI UNTAD 2024',
            'hero_title' => 'SMARTEDU-NUTRICHEM',
            'hero_subtitle' => 'Model Edukasi Berbasis Teknologi dan Kimia Terapan dalam Percepatan Penurunan Stunting',
            'hero_tagline' => 'Desa Bale, Kec. Tanantovea, Donggala — Inovasi Kimia Gizi untuk Indonesia Bebas Stunting',
            'contact_email' => 'himaski.untad@gmail.com',
            'contact_phone' => '+62 822-9100-2456',
            'contact_instagram' => '@himaski_untad',
            'contact_location' => 'Desa Bale, Kecamatan Tanantovea, Kabupaten Donggala, Sulawesi Tengah',
            'about_description' => 'SMARTEDU-NUTRICHEM adalah inovasi program pengabdian masyarakat oleh Ormawa HIMASKI Universitas Tadulako. Program ini menggabungkan sains kimia terapan dan edukasi gizi praktis untuk memberdayakan ibu hamil, ibu balita, serta kader Posyandu di Desa Bale dalam upaya pencegahan stunting secara holistik.',
            'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'video_title' => 'Video Profil & Sosialisasi Edukasi Gizi SMARTEDU-NUTRICHEM',
            'stat_kader' => '35+',
            'stat_posyandu' => '5 Posyandu',
            'stat_balita' => '120+ Balita',
            'stat_modul' => '8 Modul Terbit',
        ];

        foreach ($settings as $key => $val) {
            SiteSetting::set($key, $val);
        }

        // 3. Modul Edukasi
        $moduls = [
            [
                'title' => 'Modul 1: Kimia Gizi Dasar & Mikro-Nutrisi Anti Stunting',
                'category' => 'Kimia & Nutrisi',
                'description' => 'Panduan praktis memahami peranan kalsium (Ca), zat besi (Fe), seng (Zn), dan protein hewani dalam proses tumbuh kembang janin dan balita.',
                'badge' => 'Wajib Baca',
                'cover_image' => 'https://images.unsplash.com/photo-1498837167922-ddd27525d352?auto=format&fit=crop&w=600&q=80',
                'file_url' => '#',
                'downloads_count' => 142,
            ],
            [
                'title' => 'Modul 2: Olahan Pangan Lokal Tinggi Protein Desa Bale',
                'category' => 'Resep & MP-ASI',
                'description' => 'Kumpulan resep masakan kreatif berbasis bahan lokal seperti ikan laut segar, kelapa, dan jagung yang difortifikasi secara alami.',
                'badge' => 'Populer',
                'cover_image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=600&q=80',
                'file_url' => '#',
                'downloads_count' => 98,
            ],
            [
                'title' => 'Modul 3: Buku Saku Kader Posyandu SMARTEDU',
                'category' => 'Panduan Kader',
                'description' => 'Buku pedoman deteksi dini stunting, antropometri anak, serta teknik penyuluhan gizi berbasis eksperimen sederhana bagi kader.',
                'badge' => 'Buku Saku',
                'cover_image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=600&q=80',
                'file_url' => '#',
                'downloads_count' => 210,
            ],
            [
                'title' => 'Modul 4: Hygiene Pangan & Kimia Sanitasi Rumah Tangga',
                'category' => 'Kesehatan Lingkungan',
                'description' => 'Edukasi cara pencegahan kontaminasi zat berbahaya pada makanan, pengolahan air bersih, dan pemanfaatan bahan antiseptik alami.',
                'badge' => 'Baru',
                'cover_image' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=600&q=80',
                'file_url' => '#',
                'downloads_count' => 76,
            ],
        ];

        foreach ($moduls as $m) {
            Modul::create($m);
        }

        // 4. Galeri Kegiatan
        $galleries = [
            [
                'title' => 'Sosialisasi Gizi & Kimia Terapan di Kantor Desa Bale',
                'category' => 'Sosialisasi',
                'image_path' => 'https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?auto=format&fit=crop&w=800&q=80',
                'caption' => 'Pemberian materi sains gizi kepada warga Desa Bale dan tokoh masyarakat.',
                'event_date' => '2024-07-15',
            ],
            [
                'title' => 'Pelatihan & Uji Uji Eksperimen Sederhana Kader Posyandu',
                'category' => 'Pelatihan',
                'image_path' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=800&q=80',
                'caption' => 'Kader diajarkan menguji kandungan asam dan iodium dalam pangan sehari-hari.',
                'event_date' => '2024-07-22',
            ],
            [
                'title' => 'Demo Masak MP-ASI Kreatif Berbasis Pangan Laut Lokal',
                'category' => 'Demo Masak',
                'image_path' => 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?auto=format&fit=crop&w=800&q=80',
                'caption' => 'Praktek pembuatan nugget ikan fortifikasi kalsium bersama ibu balita.',
                'event_date' => '2024-08-05',
            ],
            [
                'title' => 'Pendampingan Pengukuran Antropometri Balita Posyandu',
                'category' => 'Posyandu',
                'image_path' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=800&q=80',
                'caption' => 'Pemeriksaan rutin tinggi badan, berat badan, dan lingkar kepala anak.',
                'event_date' => '2024-08-18',
            ],
            [
                'title' => 'Pemberian Media Pembelajaran & Game Edukasi Anak',
                'category' => 'Game Edukasi',
                'image_path' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=800&q=80',
                'caption' => 'Pelaksanaan permainan tebak makanan sehat bagi anak usia dini.',
                'event_date' => '2024-08-25',
            ],
            [
                'title' => 'Foto Bersama Tim PPK Ormawa HIMASKI & Perangkat Desa',
                'category' => 'Kerja Tim',
                'image_path' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=80',
                'caption' => 'Sinergi kolaborasi mahasiswa HIMASKI UNTAD dengan pemerintah Desa Bale.',
                'event_date' => '2024-09-01',
            ],
        ];

        foreach ($galleries as $g) {
            Gallery::create($g);
        }

        // 5. Tim Pelaksana
        $teams = [
            [
                'name' => 'Ahmad Rinaldi',
                'role' => 'Ketua Tim PPK Ormawa',
                'division' => 'HIMASKI UNTAD',
                'photo' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80',
                'order' => 1,
            ],
            [
                'name' => 'Nurfadilah S.',
                'role' => 'Sekretaris & Penulis Modul',
                'division' => 'Divisi Edukasi',
                'photo' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=400&q=80',
                'order' => 2,
            ],
            [
                'name' => 'Moh. Rizky Utama',
                'role' => 'Koordinator Lapangan & Posyandu',
                'division' => 'Divisi Acara & Pendampingan',
                'photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80',
                'order' => 3,
            ],
            [
                'name' => 'Siti Mawaddah',
                'role' => 'Spesialis Pangan & Kimia Terapan',
                'division' => 'Divisi Riset & Media',
                'photo' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80',
                'order' => 4,
            ],
        ];

        foreach ($teams as $t) {
            Team::create($t);
        }

        // 6. Testimonials
        $testimonials = [
            [
                'name' => 'Ibu Rahmawati',
                'role' => 'Kader Posyandu Mawar Desa Bale',
                'content' => 'Modul SMARTEDU sangat membantu kami para kader dalam menjelaskan pentingnya zat besi dan kalsium kepada ibu-ibu hamil dengan gaya penyampaian yang mudah dipahami.',
                'rating' => 5,
                'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=200&q=80',
            ],
            [
                'name' => 'Bapak Hasim, S.Sos.',
                'role' => 'Kepala Desa Bale, Donggala',
                'content' => 'Inovasi adik-adik mahasiswa HIMASKI UNTAD memberikan dampak nyata di desa kami. Angka kesadaran gizi meningkat dan kegiatan demo masak sangat diminati warga.',
                'rating' => 5,
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=200&q=80',
            ],
            [
                'name' => 'Ibu Nurbaya',
                'role' => 'Orang Tua Balita Desa Bale',
                'content' => 'Anak saya senang sekali ikut game tebak nutrisi dari SMARTEDU! Sekarang dia jadi mau makan sayur dan ikan laut segar yang diolah kreatif.',
                'rating' => 5,
                'avatar' => 'https://images.unsplash.com/photo-1567532939604-b6b5b0db2604?auto=format&fit=crop&w=200&q=80',
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::create($t);
        }

        // 7. Quiz Questions
        $quizzes = [
            [
                'question' => 'Zat mikro apa yang sangat penting untuk mencegah anemia pada ibu hamil dan mendukung pembentukan pembuluh darah janin?',
                'option_a' => 'Zat Besi (Fe)',
                'option_b' => 'Natrium (Na)',
                'option_c' => 'Klorida (Cl)',
                'option_d' => 'Kalium (K)',
                'correct_option' => 'a',
                'explanation' => 'Zat Besi (Fe) berperan penting dalam pembentukan hemoglobin darah untuk mencegah anemia gestasional.',
            ],
            [
                'question' => 'Manakah bahan pangan lokal berikut yang kaya akan protein hewani dan asam lemak Omega-3 untuk tumbuh kembang otak anak?',
                'option_a' => 'Singkong Goreng',
                'option_b' => 'Ikan Laut Segar',
                'option_c' => 'Kerupuk Tepung',
                'option_d' => 'Es Teh Manis',
                'correct_option' => 'b',
                'explanation' => 'Ikan laut segar kaya akan Omega-3, DHA, EPA, dan protein tinggi yang ampuh mencegah stunting.',
            ],
            [
                'question' => 'Unsur kimia kalsium (Ca) dan Vitamin D bekerja sama di dalam tubuh anak untuk pertumbuhan bagian tubuh manakah?',
                'option_a' => 'Warna Mata',
                'option_b' => 'Tulang dan Gigi',
                'option_c' => 'Kuku dan Rambut',
                'option_d' => 'Kulit Luar',
                'correct_option' => 'b',
                'explanation' => 'Kalsium (Ca) dan Vitamin D esensial dalam mineralisasi matriks tulang dan densitas gigi.',
            ],
            [
                'question' => 'Berapa bulan lama waktu pemberian ASI Eksklusif yang direkomendasikan tanpa makanan tambahan pada bayi baru lahir?',
                'option_a' => '2 Bulan',
                'option_b' => '4 Bulan',
                'option_c' => '6 Bulan',
                'option_d' => '12 Bulan',
                'correct_option' => 'c',
                'explanation' => 'ASI Eksklusif diberikan selama 6 bulan pertama kehidupan sebelum diperkenalkan dengan MP-ASI.',
            ],
            [
                'question' => 'Seng / Zinc (Zn) dalam tubuh anak berfungsi utama untuk mendukung sistem apa?',
                'option_a' => 'Sistem Kekebalan Tubuh & Sintesis Sel',
                'option_b' => 'Sistem Penglihatan Malam',
                'option_c' => 'Pendengaran Telinga',
                'option_d' => 'Pencernaan Lemak Saja',
                'correct_option' => 'a',
                'explanation' => 'Zinc (Zn) penting untuk imunitas, pembelahan sel, dan regenerasi jaringan pembentuk tinggi badan.',
            ],
        ];

        foreach ($quizzes as $q) {
            QuizQuestion::create($q);
        }

        // 8. Plate Items (Susun Piring Sehat)
        $plateItems = [
            ['name' => 'Nasi', 'icon' => '🍚', 'category' => 'karbohidrat'],
            ['name' => 'Ikan', 'icon' => '🐟', 'category' => 'protein'],
            ['name' => 'Pisang', 'icon' => '🍌', 'category' => 'buah'],
            ['name' => 'Wortel', 'icon' => '🥕', 'category' => 'sayuran'],
            ['name' => 'Telur', 'icon' => '🥚', 'category' => 'protein'],
            ['name' => 'Sayur', 'icon' => '🥒', 'category' => 'sayuran'],
        ];
        foreach ($plateItems as $pi) {
            PlateItem::create($pi);
        }

        // 9. Nutrition Guess Questions (Tebak Nutrisi)
        $guesses = [
            [
                'food_name' => 'Daun Kelor (Moringa)',
                'option_a' => 'Zat Besi & Vitamin A',
                'option_b' => 'Karbohidrat Tinggi',
                'option_c' => 'Lemak Jenuh',
                'option_d' => 'Glukosa',
                'correct_option' => 'a',
                'explanation' => 'Daun Kelor kaya akan Zat Besi (Fe) & Vitamin A untuk mencegah anemia & stunting!',
            ],
            [
                'food_name' => 'Ikan Gabus / Bandeng',
                'option_a' => 'Protein & Albumin',
                'option_b' => 'Karbohidrat Murni',
                'option_c' => 'Serat Kasar',
                'option_d' => 'Kalsium Oksalat',
                'correct_option' => 'a',
                'explanation' => 'Ikan mengandung Protein & Albumin tinggi yang sangat penting bagi tumbuh kembang anak.',
            ],
            [
                'food_name' => 'Telur Ayam',
                'option_a' => 'Kolin & Protein Hewani',
                'option_b' => 'Vitamin C',
                'option_c' => 'Serat Pektin',
                'option_d' => 'Asam Urat',
                'correct_option' => 'a',
                'explanation' => 'Telur adalah sumber Protein Hewani terjangkau berdaya cerna tinggi.',
            ],
        ];
        foreach ($guesses as $g) {
            NutritionGuess::create($g);
        }
    }
}
