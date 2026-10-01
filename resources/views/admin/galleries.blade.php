@extends('layouts.admin')

@section('title', 'Kelola Galeri Kegiatan')
@section('page_header', 'Manajemen Foto & Dokumentasi Kegiatan')

@section('content')
<div class="space-y-8" x-data="{
    showModal: false,
    isEdit: false,
    formAction: '{{ route('admin.galleries.store') }}',
    form: { title: '', category: 'Sosialisasi', event_date: '', image_path: '', caption: '' },
    openAddModal() {
        this.isEdit = false;
        this.formAction = '{{ route('admin.galleries.store') }}';
        this.form = { title: '', category: 'Sosialisasi', event_date: '', image_path: '', caption: '' };
        this.showModal = true;
    },
    openEditModal(item) {
        this.isEdit = true;
        this.formAction = '/admin/gallery/' + item.id;
        this.form = {
            title: item.title || '',
            category: item.category || 'Sosialisasi',
            event_date: item.event_date || '',
            image_path: item.image_path || '',
            caption: item.caption || ''
        };
        this.showModal = true;
    }
}">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-navy-800">Album Foto Kegiatan Posyandu & Edukasi</h2>
            <p class="text-xs text-slate-500">Kelola dokumentasi sosialisasi, pelatihan kader, dan demo masak di Desa Bale.</p>
        </div>
        <button type="button" @click="openAddModal()" class="px-5 py-3 rounded-xl bg-tealAccent-500 hover:bg-tealAccent-600 text-navy-950 font-extrabold text-xs uppercase tracking-wider shadow-lg flex items-center justify-center space-x-2 cursor-pointer">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah Foto Baru</span>
        </button>
    </div>

    <!-- Gallery Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($galleries as $g)
            <div class="bg-white rounded-3xl overflow-hidden border border-slate-200/80 shadow-sm flex flex-col justify-between group">
                <div>
                    <div class="h-48 overflow-hidden relative bg-slate-100">
                        @php
                            $gImg = $g->image_path ?: 'https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?auto=format&fit=crop&w=800&q=80';
                            if (!Str::startsWith($gImg, ['http://', 'https://'])) {
                                $gImg = asset(ltrim($gImg, '/'));
                            }
                        @endphp
                        <img src="{{ $gImg }}" alt="{{ $g->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?auto=format&fit=crop&w=800&q=80';">
                        <div class="absolute top-3 left-3 bg-navy-800/80 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase">
                            {{ $g->category }}
                        </div>
                    </div>
                    <div class="p-5 space-y-2">
                        <h4 class="font-bold text-navy-800 text-sm leading-snug">{{ $g->title }}</h4>
                        <p class="text-xs text-slate-500">{{ $g->caption }}</p>
                        @if($g->event_date)
                            <div class="text-[10px] text-teal-600 font-semibold">
                                <i class="fa-regular fa-calendar mr-1"></i> {{ date('d M Y', strtotime($g->event_date)) }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="p-4 bg-slate-50 border-t border-slate-100 flex items-center justify-end space-x-2">
                    <button type="button" @click="openEditModal({{ json_encode($g) }})" class="px-3 py-1.5 rounded-lg bg-blue-50 text-blue-600 text-xs font-bold hover:bg-blue-100 flex items-center space-x-1 transition-colors cursor-pointer">
                        <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                        <span>Edit</span>
                    </button>

                    <form action="{{ route('admin.galleries.delete', $g->id) }}" method="POST" onsubmit="return confirm('Hapus foto ini dari galeri?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-1.5 rounded-lg bg-rose-50 text-rose-600 text-xs font-bold hover:bg-rose-100 flex items-center space-x-1 transition-colors cursor-pointer">
                            <i class="fa-solid fa-trash text-[10px]"></i>
                            <span>Hapus</span>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center text-slate-400 bg-white rounded-3xl border border-dashed border-slate-300">
                Belum ada foto galeri. Klik tombol "Tambah Foto Baru" di atas.
            </div>
        @endforelse
    </div>

    <!-- Modal Form (Add & Edit) -->
    <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-navy-950/70 backdrop-blur-sm" x-transition>
        <div @click.away="showModal = false" class="bg-white rounded-3xl max-w-lg w-full p-8 shadow-2xl space-y-6 relative border border-slate-100">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <h3 class="text-lg font-extrabold text-navy-800" x-text="isEdit ? 'Sunting Foto Galeri' : 'Tambah Foto Galeri Baru'"></h3>
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
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Judul Foto / Kegiatan *</label>
                    <input type="text" name="title" x-model="form.title" required placeholder="Sosialisasi Gizi Posyandu Desa Bale" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">
                            Kategori * <span class="text-[10px] text-teal-600 font-normal">(Pilih / ketik baru)</span>
                        </label>
                        <input type="text" name="category" x-model="form.category" required list="category_list_gallery" placeholder="Ketik atau pilih..." class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">
                        
                        <datalist id="category_list_gallery">
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}"></option>
                            @endforeach
                        </datalist>

                        <div class="mt-2 flex flex-wrap gap-1">
                            @foreach($categories as $cat)
                                <button type="button" @click="form.category = '{{ $cat }}'" class="text-[10px] px-2 py-0.5 rounded-md bg-slate-100 hover:bg-teal-100 hover:text-teal-800 text-slate-600 font-medium transition-colors cursor-pointer">
                                    + {{ $cat }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Tanggal Kegiatan</label>
                        <input type="date" name="event_date" x-model="form.event_date" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">URL Gambar (Image Link)</label>
                    <input type="url" name="image_path" x-model="form.image_path" placeholder="https://images.unsplash.com/..." class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">
                </div>

                <div x-data="{ selectedGalleryImg: '' }">
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5" x-text="isEdit ? 'Ganti Gambar dari Komputer (Opsional)' : 'Atau Unggah Gambar dari Komputer'"></label>
                    <label class="inline-flex items-center space-x-2 px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 border border-slate-300 text-navy-900 font-bold text-xs uppercase cursor-pointer transition shadow-sm">
                        <i class="fa-solid fa-cloud-arrow-up text-teal-600 text-sm"></i>
                        <span x-text="selectedGalleryImg ? 'Ganti File Gambar' : 'Pilih File Gambar'"></span>
                        <input type="file" name="image_upload" accept="image/*" class="hidden" @change="selectedGalleryImg = $event.target.files[0] ? $event.target.files[0].name : ''">
                    </label>
                    <div x-show="selectedGalleryImg" class="mt-2 text-xs text-emerald-700 font-bold flex items-center space-x-1">
                        <i class="fa-solid fa-check-circle"></i>
                        <span x-text="'Gambar terpilih: ' + selectedGalleryImg"></span>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Keterangan / Caption</label>
                    <textarea name="caption" x-model="form.caption" rows="2" placeholder="Keterangan singkat kegiatan..." class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500"></textarea>
                </div>

                <div class="pt-4 flex justify-end space-x-3 border-t border-slate-100">
                    <button type="button" @click="showModal = false" class="px-5 py-2.5 rounded-xl bg-slate-100 text-slate-600 font-bold text-xs uppercase cursor-pointer">Batal</button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-tealAccent-500 text-navy-950 font-extrabold text-xs uppercase shadow-md cursor-pointer" x-text="isEdit ? 'Perbarui Foto' : 'Simpan Foto'"></button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
