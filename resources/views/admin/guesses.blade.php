@extends('layouts.admin')

@section('title', 'Kelola Soal Tebak Nutrisi')
@section('page_title', 'Kelola Soal Tebak Nutrisi Pangan Lokal')

@section('content')
<div x-data="guessManager()" class="space-y-6">

    <!-- Header Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
        <div>
            <h2 class="text-xl font-extrabold text-navy-900">Daftar Soal Tebak Nutrisi Pangan</h2>
            <p class="text-xs text-slate-500 mt-1">Kelola pertanyaan tebak gizi bahan makanan lokal Desa Bale.</p>
        </div>
        <button @click="openCreateModal()" class="px-5 py-2.5 rounded-xl bg-tealAccent-500 hover:bg-tealAccent-600 text-navy-950 font-extrabold text-xs uppercase tracking-wider shadow-md transition-all flex items-center space-x-2 shrink-0 cursor-pointer">
            <i class="fa-solid fa-plus"></i>
            <span>+ Tambah Soal Tebak Nutrisi</span>
        </button>
    </div>

    <!-- Guesses List -->
    <div class="space-y-4">
        @forelse($guesses as $index => $g)
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-4 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-start space-x-3">
                        <span class="w-8 h-8 rounded-xl bg-teal-100 text-teal-700 font-extrabold text-xs flex items-center justify-center shrink-0 mt-0.5">
                            {{ $index + 1 }}
                        </span>
                        <div>
                            <h4 class="font-extrabold text-navy-800 text-base">
                                @if(\Illuminate\Support\Str::contains(strtolower($g->food_name), ['manakah', 'apa', 'bagaimana', 'mengapa', 'berapa', 'sebutkan']) || \Illuminate\Support\Str::contains($g->food_name, '?'))
                                    {{ $g->food_name }}
                                @else
                                    Manakah kandungan nutrisi utama pada: <span class="text-teal-600">{{ $g->food_name }}</span>?
                                @endif
                            </h4>
                            @if($g->explanation)
                                <p class="text-xs text-slate-500 mt-1 bg-slate-50 p-2.5 rounded-xl border border-slate-200">
                                    💡 <strong>Penjelasan Gizi:</strong> {{ $g->explanation }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center space-x-2 shrink-0">
                        <button @click='openEditModal(@json($g))' class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-teal-50 text-slate-600 hover:text-teal-600 flex items-center justify-center transition-colors cursor-pointer" title="Edit">
                            <i class="fa-solid fa-pen text-xs"></i>
                        </button>
                        <form action="{{ route('admin.guesses.delete', $g->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus soal ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-rose-50 text-slate-600 hover:text-rose-600 flex items-center justify-center transition-colors cursor-pointer" title="Hapus">
                                <i class="fa-solid fa-trash text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Choices Badges -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2 pt-2 border-t border-slate-100 text-xs">
                    <div class="p-2.5 rounded-xl border {{ $g->correct_option == 'a' ? 'bg-emerald-50 border-emerald-300 text-emerald-800 font-bold' : 'bg-slate-50 border-slate-200 text-slate-600' }}">
                        A. {{ $g->option_a }} @if($g->correct_option == 'a') ✓ @endif
                    </div>
                    <div class="p-2.5 rounded-xl border {{ $g->correct_option == 'b' ? 'bg-emerald-50 border-emerald-300 text-emerald-800 font-bold' : 'bg-slate-50 border-slate-200 text-slate-600' }}">
                        B. {{ $g->option_b }} @if($g->correct_option == 'b') ✓ @endif
                    </div>
                    <div class="p-2.5 rounded-xl border {{ $g->correct_option == 'c' ? 'bg-emerald-50 border-emerald-300 text-emerald-800 font-bold' : 'bg-slate-50 border-slate-200 text-slate-600' }}">
                        C. {{ $g->option_c }} @if($g->correct_option == 'c') ✓ @endif
                    </div>
                    <div class="p-2.5 rounded-xl border {{ $g->correct_option == 'd' ? 'bg-emerald-50 border-emerald-300 text-emerald-800 font-bold' : 'bg-slate-50 border-slate-200 text-slate-600' }}">
                        D. {{ $g->option_d }} @if($g->correct_option == 'd') ✓ @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white p-12 rounded-2xl border border-dashed border-slate-300 text-center text-slate-400">
                <i class="fa-solid fa-lightbulb text-4xl mb-3 text-slate-300"></i>
                <p class="font-medium text-sm">Belum ada soal Tebak Nutrisi.</p>
            </div>
        @endforelse
    </div>

    <!-- Create / Edit Modal -->
    <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-navy-950/60 backdrop-blur-sm p-4" x-cloak>
        <div class="bg-white rounded-3xl max-w-xl w-full p-6 sm:p-8 shadow-2xl border border-slate-200 space-y-6 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <h3 class="font-extrabold text-navy-900 text-lg" x-text="isEdit ? 'Edit Soal Tebak Nutrisi' : 'Tambah Soal Tebak Nutrisi'"></h3>
                <button type="button" @click="showModal = false" class="text-slate-400 hover:text-rose-500 text-xl font-bold">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form :action="formAction" method="POST" class="space-y-4">
                @csrf
                <template x-if="isEdit">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Pertanyaan / Nama Pangan *</label>
                    <input type="text" name="food_name" x-model="form.food_name" required placeholder="Tulis pertanyaan lengkap atau nama bahan makanan (misal: Daun Kelor)" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Pilihan A *</label>
                        <input type="text" name="option_a" x-model="form.option_a" required placeholder="Jawaban A" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 text-xs font-medium outline-none focus:border-tealAccent-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Pilihan B *</label>
                        <input type="text" name="option_b" x-model="form.option_b" required placeholder="Jawaban B" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 text-xs font-medium outline-none focus:border-tealAccent-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Pilihan C *</label>
                        <input type="text" name="option_c" x-model="form.option_c" required placeholder="Jawaban C" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 text-xs font-medium outline-none focus:border-tealAccent-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Pilihan D *</label>
                        <input type="text" name="option_d" x-model="form.option_d" required placeholder="Jawaban D" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 text-xs font-medium outline-none focus:border-tealAccent-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Pilihan Kunci Jawaban Benar *</label>
                    <select name="correct_option" x-model="form.correct_option" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">
                        <option value="a">A</option>
                        <option value="b">B</option>
                        <option value="c">C</option>
                        <option value="d">D</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Penjelasan Manfaat Gizi (Opsional)</label>
                    <textarea name="explanation" x-model="form.explanation" rows="2" placeholder="Penjelasan mengenai kandungan nutrisi pangan tersebut..." class="w-full px-4 py-2 rounded-xl border border-slate-300 text-xs font-medium outline-none focus:border-tealAccent-500"></textarea>
                </div>

                <div class="pt-4 flex justify-end space-x-3 border-t border-slate-100">
                    <button type="button" @click="showModal = false" class="px-5 py-2.5 rounded-xl bg-slate-100 text-slate-600 font-bold text-xs uppercase cursor-pointer">Batal</button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-tealAccent-500 text-navy-950 font-extrabold text-xs uppercase shadow-md cursor-pointer" x-text="isEdit ? 'Perbarui Soal' : 'Simpan Soal'"></button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    function guessManager() {
        return {
            showModal: false,
            isEdit: false,
            formAction: '',
            form: { id: null, food_name: '', option_a: '', option_b: '', option_c: '', option_d: '', correct_option: 'a', explanation: '' },

            openCreateModal() {
                this.isEdit = false;
                this.formAction = '{{ route("admin.guesses.store") }}';
                this.form = { id: null, food_name: '', option_a: '', option_b: '', option_c: '', option_d: '', correct_option: 'a', explanation: '' };
                this.showModal = true;
            },

            openEditModal(g) {
                this.isEdit = true;
                this.formAction = '{{ url("admin/guesses") }}/' + g.id;
                this.form = { ...g };
                this.showModal = true;
            }
        }
    }
</script>
@endsection
