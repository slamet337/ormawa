@extends('layouts.admin')

@section('title', 'Kelola Tim Pelaksana')
@section('page_header', 'Manajemen Anggota Tim PPK Ormawa')

@section('content')
<div class="space-y-8" x-data="{
    showModal: false,
    isEdit: false,
    formAction: '{{ route('admin.teams.store') }}',
    form: { name: '', role: '', division: 'HIMASKI UNTAD', photo: '' },
    selectedPhotoName: '',
    photoPreview: null,
    openAddModal() {
        this.isEdit = false;
        this.formAction = '{{ route('admin.teams.store') }}';
        this.form = { name: '', role: '', division: 'HIMASKI UNTAD', photo: '' };
        this.selectedPhotoName = '';
        this.photoPreview = null;
        this.showModal = true;
    },
    openEditModal(item) {
        this.isEdit = true;
        this.formAction = '/admin/team/' + item.id;
        this.form = {
            name: item.name || '',
            role: item.role || '',
            division: item.division || 'HIMASKI UNTAD',
            photo: item.photo || ''
        };
        this.selectedPhotoName = '';
        this.photoPreview = item.photo || null;
        this.showModal = true;
    },
    handleFileChange(event) {
        const file = event.target.files[0];
        if (file) {
            this.selectedPhotoName = file.name;
            const reader = new FileReader();
            reader.onload = (e) => {
                this.photoPreview = e.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            this.selectedPhotoName = '';
            this.photoPreview = this.form.photo || null;
        }
    }
}">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-navy-800">Daftar Anggota Tim HIMASKI UNTAD</h2>
            <p class="text-xs text-slate-500">Kelola daftar ketua, koordinator, dan mahasiswa pelaksana program di Desa Bale.</p>
        </div>
        <button type="button" @click="openAddModal()" class="px-5 py-3 rounded-xl bg-tealAccent-500 hover:bg-tealAccent-600 text-navy-950 font-extrabold text-xs uppercase tracking-wider shadow-lg flex items-center justify-center space-x-2 cursor-pointer">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah Anggota Tim</span>
        </button>
    </div>

    <!-- Teams Table -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-xs uppercase text-slate-500 font-bold">
                        <th class="py-4 px-6">Anggota</th>
                        <th class="py-4 px-6">Peran / Jabatan</th>
                        <th class="py-4 px-6">Divisi</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($teams as $t)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-3">
                                    @php
                                        $tPhoto = $t->photo ?: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80';
                                        if (!Str::startsWith($tPhoto, ['http://', 'https://'])) {
                                            $tPhoto = asset(ltrim($tPhoto, '/'));
                                        }
                                        $tAvatarFallback = 'https://ui-avatars.com/api/?name=' . urlencode($t->name) . '&background=00C9A7&color=0f172a&bold=true';
                                    @endphp
                                    <img src="{{ $tPhoto }}" alt="{{ $t->name }}" class="w-10 h-10 rounded-full object-cover shrink-0 border-2 border-tealAccent-500 shadow-sm" onerror="this.onerror=null; this.src='{{ $tAvatarFallback }}';">
                                    <span class="font-bold text-navy-800 text-sm">{{ $t->name }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 font-semibold text-teal-700 text-xs">
                                {{ $t->role }}
                            </td>
                            <td class="py-4 px-6 text-xs text-slate-600 font-medium">
                                {{ $t->division }}
                            </td>
                            <td class="py-4 px-6 text-right space-x-1.5">
                                <button type="button" @click="openEditModal({{ json_encode($t) }})" class="p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors inline-block cursor-pointer" title="Edit Anggota">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </button>

                                <form action="{{ route('admin.teams.delete', $t->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus anggota tim ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 transition-colors cursor-pointer" title="Hapus">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center text-slate-400">Belum ada anggota tim.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Form (Add & Edit) -->
    <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-navy-950/70 backdrop-blur-sm" x-transition>
        <div @click.away="showModal = false" class="bg-white rounded-3xl max-w-md w-full p-8 shadow-2xl space-y-6 relative border border-slate-100 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <h3 class="text-lg font-extrabold text-navy-800" x-text="isEdit ? 'Sunting Anggota Tim' : 'Tambah Anggota Tim'"></h3>
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
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Lengkap *</label>
                    <input type="text" name="name" x-model="form.name" required placeholder="Contoh: Moh. Rizky Utama" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Peran / Jabatan *</label>
                    <input type="text" name="role" x-model="form.role" required placeholder="Contoh: Ketua Tim PPK Ormawa" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Divisi / Asal *</label>
                    <input type="text" name="division" x-model="form.division" required placeholder="Contoh: Divisi Edukasi & Riset" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">
                </div>

                <!-- Foto Profil / Upload Options -->
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                    <label class="block text-xs font-bold uppercase text-navy-800 flex items-center space-x-1.5">
                        <i class="fa-solid fa-camera text-teal-600"></i>
                        <span>Foto Profil Anggota Tim</span>
                    </label>

                    <!-- Preview Area -->
                    <div x-show="photoPreview || form.photo" class="flex items-center space-x-3 p-2 bg-white rounded-xl border border-slate-200">
                        <img :src="photoPreview || form.photo" alt="Preview Foto" class="w-12 h-12 rounded-full object-cover border-2 border-tealAccent-500 shadow-sm shrink-0" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=Team&background=00C9A7&color=0f172a&bold=true';">
                        <div class="text-xs space-y-0.5 overflow-hidden">
                            <span class="font-bold text-navy-800 block">Pratinjau Foto</span>
                            <span x-show="selectedPhotoName" class="text-emerald-600 font-semibold text-[11px] truncate block" x-text="'File terpilih: ' + selectedPhotoName"></span>
                            <span x-show="!selectedPhotoName && form.photo" class="text-slate-500 text-[11px] truncate block" x-text="form.photo"></span>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div>
                            <span class="block text-[11px] font-bold text-slate-600 mb-1.5">Pilihan 1: Unggah Foto dari Komputer / HP</span>
                            <label class="inline-flex items-center space-x-2 px-4 py-2.5 rounded-xl bg-tealAccent-500 hover:bg-tealAccent-600 text-navy-950 font-bold text-xs uppercase cursor-pointer transition shadow-sm">
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                                <span x-text="selectedPhotoName ? 'Ganti File Foto' : 'Ambil / Unggah Foto'"></span>
                                <input type="file" name="photo_upload" accept="image/*" class="hidden" @change="handleFileChange($event)">
                            </label>
                            <div x-show="selectedPhotoName" class="mt-2 text-xs text-emerald-700 font-bold flex items-center space-x-1">
                                <i class="fa-solid fa-circle-check"></i>
                                <span x-text="'File terpilih: ' + selectedPhotoName"></span>
                            </div>
                        </div>

                        <div class="relative flex py-1 items-center">
                            <div class="flex-grow border-t border-slate-200"></div>
                            <span class="flex-shrink mx-2 text-[10px] text-slate-400 font-bold uppercase">Atau Tempelkan Link URL Foto</span>
                            <div class="flex-grow border-t border-slate-200"></div>
                        </div>

                        <div>
                            <input type="url" name="photo" x-model="form.photo" @input="if(!selectedPhotoName) photoPreview = form.photo" placeholder="https://..." class="w-full px-3.5 py-2 rounded-xl border border-slate-300 text-xs font-medium outline-none focus:border-tealAccent-500">
                        </div>
                    </div>
                </div>

                <div class="pt-4 flex justify-end space-x-3 border-t border-slate-100">
                    <button type="button" @click="showModal = false" class="px-5 py-2.5 rounded-xl bg-slate-100 text-slate-600 font-bold text-xs uppercase cursor-pointer">Batal</button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-tealAccent-500 text-navy-950 font-extrabold text-xs uppercase shadow-md cursor-pointer" x-text="isEdit ? 'Perbarui Anggota' : 'Simpan Anggota'"></button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
