@extends('layouts.admin')

@section('title', 'Kelola Soal Kuis Gizi')
@section('page_header', 'Manajemen Pertanyaan Kuis Gizi & Kimia')

@section('content')
<div class="space-y-8" x-data="{
    showModal: false,
    showDetailModal: false,
    selectedDetail: null,
    isEdit: false,
    formAction: '{{ route('admin.quizzes.store') }}',
    form: { question: '', option_a: '', option_b: '', option_c: '', option_d: '', correct_option: 'a', explanation: '' },
    openAddModal() {
        this.isEdit = false;
        this.formAction = '{{ route('admin.quizzes.store') }}';
        this.form = { question: '', option_a: '', option_b: '', option_c: '', option_d: '', correct_option: 'a', explanation: '' };
        this.showModal = true;
    },
    openEditModal(item) {
        this.isEdit = true;
        this.formAction = '/admin/quiz/' + item.id;
        this.form = {
            question: item.question || '',
            option_a: item.option_a || '',
            option_b: item.option_b || '',
            option_c: item.option_c || '',
            option_d: item.option_d || '',
            correct_option: item.correct_option || 'a',
            explanation: item.explanation || ''
        };
        this.showModal = true;
    },
    openDetailModal(sub) {
        this.selectedDetail = sub;
        this.showDetailModal = true;
    }
}">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-navy-800">Daftar Pertanyaan Kuis Edukasi</h2>
            <p class="text-xs text-slate-500">Pertanyaan ini ditampilkan pada Game Kuis Gizi Interaktif di halaman depan.</p>
        </div>
        <button type="button" @click="openAddModal()" class="px-5 py-3 rounded-xl bg-tealAccent-500 hover:bg-tealAccent-600 text-navy-950 font-extrabold text-xs uppercase tracking-wider shadow-lg flex items-center justify-center space-x-2 cursor-pointer">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah Pertanyaan Baru</span>
        </button>
    </div>

    <!-- Quiz List -->
    <div class="space-y-4">
        @forelse($quizzes as $index => $q)
            <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm flex flex-col md:flex-row md:items-start justify-between gap-4">
                <div class="space-y-3 max-w-3xl">
                    <div class="flex items-start space-x-3">
                        <span class="w-6 h-6 rounded-lg bg-tealAccent-500 text-navy-950 font-extrabold text-xs flex items-center justify-center shrink-0 mt-0.5">
                            {{ $index + 1 }}
                        </span>
                        <h4 class="font-bold text-navy-800 text-sm leading-snug">{{ $q->question }}</h4>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs pl-9">
                        <div class="p-2 rounded-lg border {{ strtolower($q->correct_option) === 'a' ? 'bg-emerald-50 border-emerald-300 font-bold text-emerald-800' : 'bg-slate-50 border-slate-200 text-slate-600' }}">
                            A. {{ $q->option_a }} {{ strtolower($q->correct_option) === 'a' ? '✓ (Jawaban Benar)' : '' }}
                        </div>
                        <div class="p-2 rounded-lg border {{ strtolower($q->correct_option) === 'b' ? 'bg-emerald-50 border-emerald-300 font-bold text-emerald-800' : 'bg-slate-50 border-slate-200 text-slate-600' }}">
                            B. {{ $q->option_b }} {{ strtolower($q->correct_option) === 'b' ? '✓ (Jawaban Benar)' : '' }}
                        </div>
                        <div class="p-2 rounded-lg border {{ strtolower($q->correct_option) === 'c' ? 'bg-emerald-50 border-emerald-300 font-bold text-emerald-800' : 'bg-slate-50 border-slate-200 text-slate-600' }}">
                            C. {{ $q->option_c }} {{ strtolower($q->correct_option) === 'c' ? '✓ (Jawaban Benar)' : '' }}
                        </div>
                        <div class="p-2 rounded-lg border {{ strtolower($q->correct_option) === 'd' ? 'bg-emerald-50 border-emerald-300 font-bold text-emerald-800' : 'bg-slate-50 border-slate-200 text-slate-600' }}">
                            D. {{ $q->option_d }} {{ strtolower($q->correct_option) === 'd' ? '✓ (Jawaban Benar)' : '' }}
                        </div>
                    </div>

                    @if($q->explanation)
                        <div class="text-[11px] text-slate-500 italic pl-9">
                            <strong>Penjelasan:</strong> {{ $q->explanation }}
                        </div>
                    @endif
                </div>

                <div class="flex items-center space-x-1">
                    <button type="button" @click="openEditModal({{ json_encode($q) }})" class="p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 text-xs font-bold transition-colors cursor-pointer" title="Edit Soal">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>

                    <form action="{{ route('admin.quizzes.delete', $q->id) }}" method="POST" onsubmit="return confirm('Hapus pertanyaan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 text-xs font-bold transition-colors cursor-pointer" title="Hapus Soal">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="py-12 text-center text-slate-400 bg-white rounded-3xl border border-dashed border-slate-300">
                Belum ada pertanyaan kuis.
            </div>
        @endforelse
    </div>

    <!-- Modal Form (Add & Edit) -->
    <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-navy-950/70 backdrop-blur-sm" x-transition>
        <div @click.away="showModal = false" class="bg-white rounded-3xl max-w-xl w-full p-8 shadow-2xl space-y-6 relative border border-slate-100">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <h3 class="text-lg font-extrabold text-navy-800" x-text="isEdit ? 'Sunting Pertanyaan Kuis' : 'Tambah Pertanyaan Kuis Baru'"></h3>
                <button type="button" @click="showModal = false" class="text-slate-400 hover:text-slate-600 cursor-pointer">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <form :action="formAction" method="POST" class="space-y-4">
                @csrf
                <template x-if="isEdit">
                    <input type="hidden" name="_method" value="PUT">
                </template>
                
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Pertanyaan / Soal *</label>
                    <textarea name="question" x-model="form.question" rows="2" required placeholder="Tuliskan pertanyaan gizi atau kimia..." class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500"></textarea>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Pilihan A *</label>
                        <input type="text" name="option_a" x-model="form.option_a" required class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs font-medium">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Pilihan B *</label>
                        <input type="text" name="option_b" x-model="form.option_b" required class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs font-medium">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Pilihan C *</label>
                        <input type="text" name="option_c" x-model="form.option_c" required class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs font-medium">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Pilihan D *</label>
                        <input type="text" name="option_d" x-model="form.option_d" required class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs font-medium">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Kunci Jawaban Benar *</label>
                    <select name="correct_option" x-model="form.correct_option" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">
                        <option value="a">A</option>
                        <option value="b">B</option>
                        <option value="c">C</option>
                        <option value="d">D</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Penjelasan Singkat (Opsional)</label>
                    <textarea name="explanation" x-model="form.explanation" rows="2" placeholder="Penjelasan kenapa jawaban tersebut benar..." class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500"></textarea>
                </div>

                <div class="pt-4 flex justify-end space-x-3 border-t border-slate-100">
                    <button type="button" @click="showModal = false" class="px-5 py-2.5 rounded-xl bg-slate-100 text-slate-600 font-bold text-xs uppercase cursor-pointer">Batal</button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-tealAccent-500 text-navy-950 font-extrabold text-xs uppercase shadow-md cursor-pointer" x-text="isEdit ? 'Perbarui Soal' : 'Simpan Soal'"></button>
                </div>
            </form>
        </div>
    </div>

    <!-- SECTION 2: LAPORAN & HISTORI HASIL KUIS PENGUNJUNG -->
    <div class="pt-8 border-t border-slate-200 space-y-6">
        <div>
            <h2 class="text-xl font-extrabold text-navy-800 flex items-center space-x-2">
                <i class="fa-solid fa-chart-user text-tealAccent-600"></i>
                <span>Laporan & Log Hasil Kuis Pengunjung</span>
            </h2>
            <p class="text-xs text-slate-500 mt-1">Daftar riwayat nilai kuis yang telah dikerjakan oleh warga / pengunjung website.</p>
        </div>

        <!-- Summary Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center space-x-4">
                <div class="w-12 h-12 rounded-xl bg-teal-100 text-teal-700 flex items-center justify-center text-xl shrink-0 font-extrabold">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <span class="text-xs text-slate-400 font-bold uppercase block">Total Pengisi Kuis</span>
                    <span class="text-2xl font-extrabold text-navy-900">{{ count($submissions) }} Warga</span>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center space-x-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-xl shrink-0 font-extrabold">
                    <i class="fa-solid fa-square-poll-vertical"></i>
                </div>
                <div>
                    <span class="text-xs text-slate-400 font-bold uppercase block">Rata-Rata Nilai</span>
                    <span class="text-2xl font-extrabold text-emerald-700">{{ count($submissions) > 0 ? round($submissions->avg('percentage')) : 0 }}%</span>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center space-x-4">
                <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-xl shrink-0 font-extrabold">
                    <i class="fa-solid fa-trophy"></i>
                </div>
                <div>
                    <span class="text-xs text-slate-400 font-bold uppercase block">Nilai Tertinggi</span>
                    <span class="text-2xl font-extrabold text-amber-600">{{ count($submissions) > 0 ? $submissions->max('percentage') : 0 }}%</span>
                </div>
            </div>
        </div>

        <!-- Table Submissions Log -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-700">
                    <thead class="bg-slate-50 border-b border-slate-200 font-extrabold text-navy-900 uppercase text-[11px] tracking-wider">
                        <tr>
                            <th class="py-3.5 px-6">#</th>
                            <th class="py-3.5 px-6">Jenis Permainan</th>
                            <th class="py-3.5 px-6">Nama Pengunjung / Inisial</th>
                            <th class="py-3.5 px-6">Tanggal & Waktu</th>
                            <th class="py-3.5 px-6 text-center">Skor Soal</th>
                            <th class="py-3.5 px-6 text-center">Persentase Nilai</th>
                            <th class="py-3.5 px-6 text-center">Status Pemahaman</th>
                            <th class="py-3.5 px-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium">
                        @forelse($submissions as $index => $sub)
                            <tr class="hover:bg-slate-50/70 transition-colors">
                                <td class="py-4 px-6 font-bold text-slate-400">{{ $index + 1 }}</td>
                                <td class="py-4 px-6 whitespace-nowrap">
                                    @if(($sub->game_type ?? 'quiz') === 'piring')
                                        <span class="px-2.5 py-1 rounded-lg bg-teal-100 text-teal-800 font-extrabold text-xs inline-flex items-center space-x-1">
                                            <span>🍽️ Susun Piring Sehat</span>
                                        </span>
                                    @elseif(($sub->game_type ?? 'quiz') === 'tebak')
                                        <span class="px-2.5 py-1 rounded-lg bg-amber-100 text-amber-900 font-extrabold text-xs inline-flex items-center space-x-1">
                                            <span>📊 Tebak Nutrisi</span>
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-lg bg-blue-100 text-blue-900 font-extrabold text-xs inline-flex items-center space-x-1">
                                            <span>🧠 Kuis Gizi</span>
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-full bg-navy-800 text-tealAccent-400 flex items-center justify-center font-extrabold text-xs">
                                            {{ strtoupper(substr($sub->visitor_name ?? 'P', 0, 1)) }}
                                        </div>
                                        <div>
                                            <span class="font-extrabold text-navy-800 block text-sm">{{ $sub->visitor_name ?? 'Pengunjung Posyandu' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-slate-500 whitespace-nowrap">
                                    <i class="fa-regular fa-clock text-slate-400 mr-1"></i>
                                    {{ $sub->created_at ? $sub->created_at->format('d M Y - H:i') : '-' }}
                                </td>
                                <td class="py-4 px-6 text-center font-extrabold text-navy-800 whitespace-nowrap">
                                    {{ $sub->score }} / {{ $sub->total_questions }} Soal
                                </td>
                                <td class="py-4 px-6 text-center whitespace-nowrap">
                                    <span class="px-3 py-1 rounded-full font-extrabold text-xs {{ $sub->percentage >= 80 ? 'bg-emerald-100 text-emerald-800' : ($sub->percentage >= 50 ? 'bg-amber-100 text-amber-800' : 'bg-rose-100 text-rose-800') }}">
                                        {{ $sub->percentage }}%
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center whitespace-nowrap">
                                    @if($sub->percentage >= 80)
                                        <span class="px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 font-bold border border-emerald-200">Paham Gizi</span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-lg bg-amber-50 text-amber-700 font-bold border border-amber-200">Perlu Edukasi</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end space-x-2">
                                        <button type="button" @click='openDetailModal(@json($sub))' class="p-2 rounded-xl bg-teal-50 text-teal-700 hover:bg-teal-100 transition-colors cursor-pointer" title="Lihat Detail Jawaban">
                                            <i class="fa-solid fa-eye text-xs"></i>
                                        </button>
                                        <form action="{{ route('admin.quizzes.deleteSubmission', $sub->id) }}" method="POST" onsubmit="return confirm('Hapus data riwayat kuis ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-xl bg-slate-100 hover:bg-rose-50 text-slate-500 hover:text-rose-600 transition-colors cursor-pointer" title="Hapus Log">
                                                <i class="fa-solid fa-trash text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-8 text-center text-slate-400">
                                    Belum ada pengunjung yang mengisi kuis / game edukasi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Detail Answers Modal -->
    <div x-show="showDetailModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-navy-950/70 backdrop-blur-sm" x-transition>
        <div @click.away="showDetailModal = false" class="bg-white rounded-3xl max-w-2xl w-full p-6 sm:p-8 shadow-2xl space-y-6 relative border border-slate-100 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <div>
                    <span class="text-xs font-bold text-teal-600 uppercase tracking-wider block" x-text="'Detail Log: ' + (selectedDetail?.game_type === 'piring' ? '🍽️ Susun Piring Sehat' : (selectedDetail?.game_type === 'tebak' ? '📊 Tebak Nutrisi' : '🧠 Kuis Gizi'))"></span>
                    <h3 class="text-lg font-extrabold text-navy-900" x-text="selectedDetail?.visitor_name || 'Pengunjung Posyandu'"></h3>
                </div>
                <button type="button" @click="showDetailModal = false" class="text-slate-400 hover:text-slate-600 cursor-pointer">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <div class="space-y-3">
                <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-between text-xs font-bold">
                    <span>Skor: <strong class="text-navy-900 font-extrabold" x-text="(selectedDetail?.score || 0) + ' / ' + (selectedDetail?.total_questions || 0)"></strong></span>
                    <span>Persentase: <strong class="text-teal-700 font-extrabold" x-text="(selectedDetail?.percentage || 0) + '%'"></strong></span>
                    <span>Waktu: <strong class="text-slate-600" x-text="selectedDetail?.created_at ? (new Date(selectedDetail.created_at)).toLocaleString('id-ID') : '-'"></strong></span>
                </div>

                <h4 class="font-extrabold text-navy-800 text-xs uppercase tracking-wider pt-2">Rincian Pertanyaan & Jawaban:</h4>
                <div class="space-y-2.5 max-h-[50vh] overflow-y-auto pr-1">
                    <template x-for="(ans, idx) in (selectedDetail?.answers_json || [])" :key="idx">
                        <div class="p-4 rounded-2xl border text-xs space-y-1.5" :class="ans.correct ? 'bg-emerald-50/80 border-emerald-300 text-emerald-950' : 'bg-rose-50/80 border-rose-300 text-rose-950'">
                            <div class="flex items-start justify-between gap-3 font-extrabold">
                                <span x-text="ans.question || ('Soal ' + (idx + 1))"></span>
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] uppercase font-extrabold shrink-0" :class="ans.correct ? 'bg-emerald-600 text-white' : 'bg-rose-600 text-white'" x-text="ans.correct ? 'BENAR' : 'SALAH'"></span>
                            </div>
                            <div class="text-[11px] text-slate-700 space-y-0.5">
                                <p>Jawaban Pengunjung: <strong class="uppercase text-navy-900" x-text="ans.user_ans || '(Tidak diisi)'"></strong> | Jawaban Seharusnya: <strong class="uppercase text-emerald-700" x-text="ans.correct_ans"></strong></p>
                                <p x-show="ans.explanation" class="text-slate-600 font-medium pt-0.5">
                                    💡 <strong>Penjelasan:</strong> <span x-text="ans.explanation"></span>
                                </p>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <div class="pt-4 flex justify-end border-t border-slate-100">
                <button type="button" @click="showDetailModal = false" class="px-6 py-2.5 rounded-xl bg-navy-800 text-white font-bold text-xs uppercase cursor-pointer">Tutup</button>
            </div>
        </div>
    </div>

</div>
@endsection
