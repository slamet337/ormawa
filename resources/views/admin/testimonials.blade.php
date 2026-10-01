@extends('layouts.admin')

@section('title', 'Kelola Testimoni')
@section('page_header', 'Manajemen Testimoni & Suara Warga')

@section('content')
<div class="space-y-8" x-data="{
    showModal: false,
    isEdit: false,
    formAction: '{{ route('admin.testimonials.store') }}',
    form: { name: '', role: '', content: '', rating: 5, avatar: '' },
    openAddModal() {
        this.isEdit = false;
        this.formAction = '{{ route('admin.testimonials.store') }}';
        this.form = { name: '', role: '', content: '', rating: 5, avatar: '' };
        this.showModal = true;
    },
    openEditModal(item) {
        this.isEdit = true;
        this.formAction = '/admin/testimonial/' + item.id;
        this.form = {
            name: item.name || '',
            role: item.role || '',
            content: item.content || '',
            rating: item.rating || 5,
            avatar: item.avatar || ''
        };
        this.showModal = true;
    }
}">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-navy-800">Testimoni Kepala Desa & Warga</h2>
            <p class="text-xs text-slate-500">Kelola ulasan, kesan, dan pesan apresiasi dari warga Desa Bale.</p>
        </div>
        <button type="button" @click="openAddModal()" class="px-5 py-3 rounded-xl bg-tealAccent-500 hover:bg-tealAccent-600 text-navy-950 font-extrabold text-xs uppercase tracking-wider shadow-lg flex items-center justify-center space-x-2 cursor-pointer">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah Testimoni</span>
        </button>
    </div>

    <!-- Testimonials List -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($testimonials as $t)
            <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm flex flex-col justify-between space-y-4">
                <div class="space-y-3">
                    <div class="flex text-amber-400 text-xs space-x-1">
                        @for($i=0; $i < $t->rating; $i++)
                            <i class="fa-solid fa-star"></i>
                        @endfor
                    </div>
                    <p class="text-slate-700 text-xs leading-relaxed italic">"{{ $t->content }}"</p>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <img src="{{ $t->avatar ?: 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=200&q=80' }}" alt="{{ $t->name }}" class="w-9 h-9 rounded-full object-cover border-2 border-tealAccent-500">
                        <div>
                            <h4 class="font-bold text-navy-800 text-xs">{{ $t->name }}</h4>
                            <p class="text-[10px] text-slate-500">{{ $t->role }}</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-1">
                        <button type="button" @click="openEditModal({{ json_encode($t) }})" class="p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors cursor-pointer" title="Edit Testimoni">
                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                        </button>

                        <form action="{{ route('admin.testimonials.delete', $t->id) }}" method="POST" onsubmit="return confirm('Hapus testimoni ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 transition-colors cursor-pointer" title="Hapus">
                                <i class="fa-solid fa-trash text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center text-slate-400 bg-white rounded-3xl border border-dashed border-slate-300">
                Belum ada testimoni.
            </div>
        @endforelse
    </div>

    <!-- Modal Form (Add & Edit) -->
    <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-navy-950/70 backdrop-blur-sm" x-transition>
        <div @click.away="showModal = false" class="bg-white rounded-3xl max-w-md w-full p-8 shadow-2xl space-y-6 relative border border-slate-100 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <h3 class="text-lg font-extrabold text-navy-800" x-text="isEdit ? 'Sunting Testimoni' : 'Tambah Testimoni Baru'"></h3>
                <button type="button" @click="showModal = false" class="text-slate-400 hover:text-slate-600 cursor-pointer">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <form :action="formAction" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <template x-if="isEdit">
                    <input type="hidden" name="_method" value="PUT">
                </template>
                
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Tokoh / Warga *</label>
                    <input type="text" name="name" x-model="form.name" required placeholder="Ibu Rahmawati" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Peran / Status *</label>
                    <input type="text" name="role" x-model="form.role" required placeholder="Kader Posyandu Mawar Desa Bale" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Isi Testimoni / Pesan *</label>
                    <textarea name="content" x-model="form.content" rows="3" required placeholder="Kesan dan pesan mengenai program SMARTEDU..." class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Rating Bintang (1 - 5) *</label>
                    <select name="rating" x-model="form.rating" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">
                        <option value="5">5 Bintang (Sangat Puas)</option>
                        <option value="4">4 Bintang (Puas)</option>
                        <option value="3">3 Bintang (Cukup)</option>
                    </select>
                </div>

                <!-- Foto Avatar Options -->
                <div x-data="{ selectedAvatarName: '' }" class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                    <label class="block text-xs font-bold uppercase text-navy-800 flex items-center space-x-1.5">
                        <i class="fa-solid fa-user-circle text-teal-600"></i>
                        <span>Foto Profil / Avatar</span>
                    </label>

                    <div class="space-y-3">
                        <div>
                            <span class="block text-[11px] font-bold text-slate-600 mb-1.5">Pilihan 1: Unggah Foto dari Komputer / HP</span>
                            <label class="inline-flex items-center space-x-2 px-4 py-2.5 rounded-xl bg-tealAccent-500 hover:bg-tealAccent-600 text-navy-950 font-bold text-xs uppercase cursor-pointer transition shadow-sm">
                                <i class="fa-solid fa-camera"></i>
                                <span x-text="selectedAvatarName ? 'Ganti Foto' : 'Ambil Foto / Unggah Foto'"></span>
                                <input type="file" name="avatar_upload" accept="image/*" class="hidden" @change="selectedAvatarName = $event.target.files[0] ? $event.target.files[0].name : ''">
                            </label>
                            <div x-show="selectedAvatarName" class="mt-2 text-xs text-emerald-700 font-bold flex items-center space-x-1">
                                <i class="fa-solid fa-check-circle"></i>
                                <span x-text="'Foto terpilih: ' + selectedAvatarName"></span>
                            </div>
                        </div>

                        <div class="relative flex py-1 items-center">
                            <div class="flex-grow border-t border-slate-200"></div>
                            <span class="flex-shrink mx-2 text-[10px] text-slate-400 font-bold uppercase">Atau Tempelkan Link URL Foto</span>
                            <div class="flex-grow border-t border-slate-200"></div>
                        </div>

                        <div>
                            <input type="url" name="avatar" x-model="form.avatar" placeholder="https://..." class="w-full px-3.5 py-2 rounded-xl border border-slate-300 text-xs font-medium outline-none focus:border-tealAccent-500">
                        </div>
                    </div>
                </div>

                <div class="pt-4 flex justify-end space-x-3 border-t border-slate-100">
                    <button type="button" @click="showModal = false" class="px-5 py-2.5 rounded-xl bg-slate-100 text-slate-600 font-bold text-xs uppercase cursor-pointer">Batal</button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-tealAccent-500 text-navy-950 font-extrabold text-xs uppercase shadow-md cursor-pointer" x-text="isEdit ? 'Perbarui Testimoni' : 'Simpan Testimoni'"></button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
