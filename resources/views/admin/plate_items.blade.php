@extends('layouts.admin')

@section('title', 'Kelola Item Susun Piring Sehat')
@section('page_title', 'Kelola Item Makanan Susun Piring')

@section('content')
<div x-data="plateItemManager()" class="space-y-6">

    <!-- Header Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
        <div>
            <h2 class="text-xl font-extrabold text-navy-900">Daftar Makanan (Susun Piring Sehat)</h2>
            <p class="text-xs text-slate-500 mt-1">Kelola pilihan bahan makanan dan kategori gizi yang muncul di game Susun Piring Sehat.</p>
        </div>
        <button @click="openCreateModal()" class="px-5 py-2.5 rounded-xl bg-tealAccent-500 hover:bg-tealAccent-600 text-navy-950 font-extrabold text-xs uppercase tracking-wider shadow-md transition-all flex items-center space-x-2 shrink-0 cursor-pointer">
            <i class="fa-solid fa-plus"></i>
            <span>+ Tambah Item Makanan</span>
        </button>
    </div>

    <!-- Items Grid / Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($items as $item)
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm flex items-center justify-between hover:shadow-md transition-shadow">
                <div class="flex items-center space-x-4">
                    <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center text-3xl shadow-inner border border-slate-200">
                        {{ $item->icon }}
                    </div>
                    <div>
                        <h4 class="font-extrabold text-navy-800 text-base mb-1">{{ $item->name }}</h4>
                        <span class="inline-block px-3 py-1 rounded-full text-[11px] font-extrabold uppercase tracking-wider
                            @if($item->category == 'karbohidrat') bg-amber-100 text-amber-800 border border-amber-200
                            @elseif($item->category == 'protein') bg-rose-100 text-rose-800 border border-rose-200
                            @elseif($item->category == 'sayuran') bg-emerald-100 text-emerald-800 border border-emerald-200
                            @else bg-teal-100 text-teal-800 border border-teal-200 @endif">
                            {{ ucfirst($item->category) }}
                        </span>
                    </div>
                </div>

                <div class="flex items-center space-x-2">
                    <button @click='openEditModal(@json($item))' class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-teal-50 text-slate-600 hover:text-teal-600 flex items-center justify-center transition-colors cursor-pointer" title="Edit">
                        <i class="fa-solid fa-pen text-xs"></i>
                    </button>
                    <form action="{{ route('admin.plate_items.delete', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus item makanan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-rose-50 text-slate-600 hover:text-rose-600 flex items-center justify-center transition-colors cursor-pointer" title="Hapus">
                            <i class="fa-solid fa-trash text-xs"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white p-12 rounded-2xl border border-dashed border-slate-300 text-center text-slate-400">
                <i class="fa-solid fa-utensils text-4xl mb-3 text-slate-300"></i>
                <p class="font-medium text-sm">Belum ada item makanan Susun Piring.</p>
            </div>
        @endforelse
    </div>

    <!-- Create / Edit Modal -->
    <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-navy-950/60 backdrop-blur-sm p-4" x-cloak>
        <div class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-8 shadow-2xl border border-slate-200 space-y-6">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <h3 class="font-extrabold text-navy-900 text-lg" x-text="isEdit ? 'Edit Item Makanan' : 'Tambah Item Makanan Baru'"></h3>
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
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Makanan *</label>
                    <input type="text" name="name" x-model="form.name" required placeholder="Contoh: Nasi Goreng / Ikan Bandeng" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Emoji / Ikon Makanan *</label>
                    <div class="flex items-center space-x-2 mb-2">
                        <div class="w-12 h-11 rounded-xl bg-slate-100 border border-slate-300 flex items-center justify-center text-2xl shrink-0 shadow-inner" x-text="form.icon || '🍚'"></div>
                        <input type="text" name="icon" x-model="form.icon" required placeholder="Contoh: 🍚" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">
                    </div>

                    <!-- Quick Emoji Selector Chips -->
                    <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                        <span class="block text-[11px] font-bold text-slate-600">Pilih Cepat Emoji Makanan (Klik):</span>
                        <div class="flex flex-wrap gap-1.5 text-xl">
                            <template x-for="emo in ['🍚','🍞','🌽','🥔','🍠','🐟','🥩','🍗','🥚','🥛','🦐','🦀','🥦','🥕','🥒','🥬','🍆','🍅','🍌','🍎','🍇','🥑','🍊','🍉','🍍','🥭']">
                                <button type="button" @click="form.icon = emo" 
                                        :class="form.icon === emo ? 'bg-teal-200 border-teal-500 scale-125' : 'bg-white border-slate-200 hover:bg-teal-50 hover:scale-110'" 
                                        class="w-8 h-8 rounded-lg border flex items-center justify-center transition-all cursor-pointer shadow-sm">
                                    <span x-text="emo"></span>
                                </button>
                            </template>
                        </div>
                        <p class="text-[10px] text-slate-400">Atau tekan kombinasi tombol <kbd class="px-1.5 py-0.5 bg-white border border-slate-300 rounded font-mono text-[10px]">Win + .</kbd> di keyboard Windows untuk membuka pilihan emoji lengkap.</p>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Kategori Gizi *</label>
                    <select name="category" x-model="form.category" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">
                        <option value="karbohidrat">🌾 Karbohidrat</option>
                        <option value="protein">🥩 Protein</option>
                        <option value="sayuran">🥦 Sayuran</option>
                        <option value="buah">🍎 Buah</option>
                    </select>
                </div>

                <div class="pt-4 flex justify-end space-x-3 border-t border-slate-100">
                    <button type="button" @click="showModal = false" class="px-5 py-2.5 rounded-xl bg-slate-100 text-slate-600 font-bold text-xs uppercase cursor-pointer">Batal</button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-tealAccent-500 text-navy-950 font-extrabold text-xs uppercase shadow-md cursor-pointer" x-text="isEdit ? 'Perbarui Item' : 'Simpan Item'"></button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    function plateItemManager() {
        return {
            showModal: false,
            isEdit: false,
            formAction: '',
            form: { id: null, name: '', icon: '🍚', category: 'karbohidrat' },

            openCreateModal() {
                this.isEdit = false;
                this.formAction = '{{ route("admin.plate_items.store") }}';
                this.form = { id: null, name: '', icon: '🍚', category: 'karbohidrat' };
                this.showModal = true;
            },

            openEditModal(item) {
                this.isEdit = true;
                this.formAction = '{{ url("admin/plate-items") }}/' + item.id;
                this.form = { ...item };
                this.showModal = true;
            }
        }
    }
</script>
@endsection
