@extends('layouts.admin')

@section('title', 'Kelola Modul Edukasi')
@section('page_header', 'Manajemen Modul Edukasi Digital')

@section('content')
<div class="space-y-8" x-data="modulsManager()">

    <!-- Header Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-navy-800">Katalog Modul & Buku Saku</h2>
            <p class="text-xs text-slate-500">Tambah, sunting, atau unggah berkas PDF modul edukasi untuk masyarakat Desa Bale.</p>
        </div>
        <button type="button" @click="openAddModal()" class="px-5 py-3 rounded-xl bg-tealAccent-500 hover:bg-tealAccent-600 text-navy-950 font-extrabold text-xs uppercase tracking-wider shadow-lg flex items-center justify-center space-x-2 cursor-pointer">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah Modul Baru</span>
        </button>
    </div>

    <!-- Moduls Data Table -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-xs uppercase text-slate-500 font-bold">
                        <th class="py-4 px-6">Modul</th>
                        <th class="py-4 px-6">Kategori</th>
                        <th class="py-4 px-6">Label Badge</th>
                        <th class="py-4 px-6 text-center">Diunduh</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($moduls as $m)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-3">
                                    @php
                                        $mCover = $m->cover_image ?: 'https://images.unsplash.com/photo-1498837167922-ddd27525d352?auto=format&fit=crop&w=600&q=80';
                                        if (!Str::startsWith($mCover, ['http://', 'https://'])) {
                                            $mCover = asset(ltrim($mCover, '/'));
                                        }
                                    @endphp
                                    <img src="{{ $mCover }}" alt="{{ $m->title }}" class="w-12 h-12 rounded-xl object-cover shrink-0 border border-slate-200" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1498837167922-ddd27525d352?auto=format&fit=crop&w=600&q=80';">
                                    <div>
                                        <div class="font-bold text-navy-800 text-sm">{{ $m->title }}</div>
                                        <div class="text-xs text-slate-400 line-clamp-1 max-w-md">{{ $m->description }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6 font-medium text-slate-600">
                                <span class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-700 text-xs">
                                    {{ $m->category }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                @if($m->badge)
                                    <span class="px-2.5 py-1 rounded-full bg-teal-50 text-teal-700 font-bold text-xs">
                                        {{ $m->badge }}
                                    </span>
                                @else
                                    <span class="text-slate-300 text-xs">-</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center font-bold text-navy-800">
                                {{ $m->downloads_count }}x
                            </td>
                            <td class="py-4 px-6 text-right space-x-1.5">
                                <!-- Download Button -->
                                <a href="{{ route('modul.download', $m->id) }}" target="_blank" class="p-2 rounded-lg bg-slate-100 text-slate-700 hover:bg-teal-50 hover:text-teal-600 transition-colors inline-block" title="Pratinjau / Unduh">
                                    <i class="fa-solid fa-download text-xs"></i>
                                </a>

                                <!-- Edit Button -->
                                <button type="button" @click="openEditModal({{ json_encode($m) }})" class="p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors inline-block cursor-pointer" title="Edit Modul">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </button>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.moduls.delete', $m->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus modul ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 transition-colors cursor-pointer" title="Hapus Modul">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-slate-400">Belum ada data modul. Klik tombol "Tambah Modul Baru" untuk mengunggah.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modul Form Modal (Add & Edit) -->
    <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-navy-950/70 backdrop-blur-sm" x-transition>
        <div @click.away="!isUploading && (showModal = false)" class="bg-white rounded-3xl max-w-xl w-full p-8 shadow-2xl space-y-6 relative border border-slate-100 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <h3 class="text-lg font-extrabold text-navy-800" x-text="isEdit ? 'Sunting Modul Edukasi' : 'Tambah Modul Edukasi Baru'"></h3>
                <button type="button" @click="showModal = false" :disabled="isUploading" class="text-slate-400 hover:text-slate-600 cursor-pointer disabled:opacity-50">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <form :action="formAction" method="POST" enctype="multipart/form-data" @submit="submitFormWithProgress($event)" class="space-y-4">
                @csrf
                <template x-if="isEdit">
                    <input type="hidden" name="_method" value="PUT">
                </template>
                
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Judul Modul *</label>
                    <input type="text" name="title" x-model="form.title" required placeholder="Contoh: Modul 5: Menu Gizi Ibu Hamil" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">
                            Kategori * <span class="text-[10px] text-teal-600 font-normal">(Pilih / ketik baru)</span>
                        </label>
                        <input type="text" name="category" x-model="form.category" required list="category_list_modul" placeholder="Ketik atau pilih..." class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">
                        
                        <datalist id="category_list_modul">
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}"></option>
                            @endforeach
                        </datalist>

                        <!-- Quick Choice Chips -->
                        <div class="mt-2 flex flex-wrap gap-1">
                            @foreach($categories as $cat)
                                <button type="button" @click="form.category = '{{ $cat }}'" class="text-[10px] px-2 py-0.5 rounded-md bg-slate-100 hover:bg-teal-100 hover:text-teal-800 text-slate-600 font-medium transition-colors cursor-pointer">
                                    + {{ $cat }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Label Badge (Opsional)</label>
                        <input type="text" name="badge" x-model="form.badge" placeholder="Contoh: Terpopuler, Baru" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Deskripsi Singkat</label>
                    <textarea name="description" x-model="form.description" rows="3" placeholder="Rangkuman isi modul edukasi..." class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium outline-none focus:border-tealAccent-500"></textarea>
                </div>

                <!-- PILIH GAMBAR SAMPUL (COVER IMAGE) -->
                <div x-data="{ coverName: '', pdfName: '', pdfSizeError: false }" class="space-y-4">
                    <div class="p-4 rounded-2xl bg-teal-50/60 border border-teal-200/80 space-y-3">
                        <label class="block text-xs font-extrabold uppercase text-navy-900 flex items-center space-x-2">
                            <i class="fa-solid fa-image text-teal-600 text-base"></i>
                            <span>Pilih Gambar Sampul (Cover Image)</span>
                        </label>

                        <div class="space-y-3">
                            <div>
                                <span class="block text-[11px] font-bold text-slate-700 mb-1.5">Pilih File Foto dari Laptop / Komputer:</span>
                                <label class="inline-flex items-center space-x-2 px-4 py-2.5 rounded-xl bg-tealAccent-500 hover:bg-tealAccent-600 text-navy-950 font-extrabold text-xs uppercase cursor-pointer transition shadow-sm">
                                    <i class="fa-solid fa-image"></i>
                                    <span x-text="coverName ? 'Ganti Sampul' : 'Pilih Foto Sampul'"></span>
                                    <input type="file" name="cover_image_upload" accept="image/*" class="hidden" @change="coverName = $event.target.files[0] ? $event.target.files[0].name : ''">
                                </label>
                                <div x-show="coverName" class="mt-2 text-xs text-emerald-700 font-bold flex items-center space-x-1">
                                    <i class="fa-solid fa-check-circle"></i>
                                    <span x-text="'File terpilih: ' + coverName"></span>
                                </div>
                            </div>

                            <div class="relative flex py-1 items-center">
                                <div class="flex-grow border-t border-slate-200"></div>
                                <span class="flex-shrink mx-2 text-[10px] text-slate-400 font-bold uppercase">Atau Tempelkan URL Gambar</span>
                                <div class="flex-grow border-t border-slate-200"></div>
                            </div>

                            <div>
                                <input type="url" name="cover_image" x-model="form.cover_image" placeholder="https://..." class="w-full px-3.5 py-2 rounded-xl bg-white border border-slate-300 text-xs font-medium outline-none focus:border-tealAccent-500">
                            </div>
                        </div>
                    </div>

                    <!-- UNGGAH BERKAS PDF / DOKUMEN -->
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-3">
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1" x-text="isEdit ? 'Ganti Berkas Modul (Opsional)' : 'Unggah Berkas Modul'"></label>
                        <p class="text-[11px] text-slate-500 mb-2 font-medium">(Format PDF, DOC, DOCX, PPT, ZIP, RAR, MP4 — Maksimal 512 MB)</p>
                        
                        <label class="inline-flex items-center space-x-2 px-4 py-2.5 rounded-xl bg-white border border-slate-300 hover:bg-slate-100 text-navy-900 font-bold text-xs uppercase cursor-pointer transition shadow-sm">
                            <i class="fa-solid fa-file-pdf text-rose-500 text-sm"></i>
                            <span x-text="pdfName ? 'Ganti Berkas' : 'Pilih Berkas Modul'"></span>
                            <input type="file" name="file_upload" accept=".pdf,.doc,.docx,.ppt,.pptx,.zip,.rar,.xls,.xlsx,.mp4" class="hidden" @change="
                                if ($event.target.files[0]) {
                                    pdfName = $event.target.files[0].name;
                                    if ($event.target.files[0].size > 512 * 1024 * 1024) {
                                        pdfSizeError = true;
                                        alert('Perhatian: Ukuran file melebihi 512 MB (' + ($event.target.files[0].size / (1024*1024)).toFixed(1) + ' MB). Harap gunakan file < 512 MB agar tidak timeout saat diunggah.');
                                    } else {
                                        pdfSizeError = false;
                                    }
                                } else {
                                    pdfName = '';
                                    pdfSizeError = false;
                                }
                            ">
                        </label>
                        <div x-show="pdfName" class="mt-2 text-xs font-bold flex items-center space-x-1" :class="pdfSizeError ? 'text-rose-600' : 'text-emerald-700'">
                            <i :class="pdfSizeError ? 'fa-solid fa-triangle-exclamation' : 'fa-solid fa-check-circle'"></i>
                            <span x-text="'File terpilih: ' + pdfName"></span>
                        </div>

                        <!-- ATAU TEMPELKAN LINK GOOGLE DRIVE -->
                        <div class="relative flex py-1 items-center pt-2">
                            <div class="flex-grow border-t border-slate-200"></div>
                            <span class="flex-shrink mx-2 text-[10px] text-slate-400 font-bold uppercase">Atau Gunakan Link Berkas (Google Drive / Cloud)</span>
                            <div class="flex-grow border-t border-slate-200"></div>
                        </div>

                        <div>
                            <input type="url" name="file_url" x-model="form.file_url" placeholder="https://drive.google.com/file/d/... atau link direct" class="w-full px-3.5 py-2 rounded-xl bg-white border border-slate-300 text-xs font-medium outline-none focus:border-tealAccent-500">
                            <span class="text-[10px] text-slate-500 mt-1 block">💡 <b>Tips:</b> Jika berkas PDF/Video sangat besar (di atas 30MB), simpan di Google Drive dan tempelkan linknya di sini agar proses simpan <b>instan (0 detik)</b> tanpa tergantung kecepatan upload internet.</span>
                        </div>
                    </div>
                </div>

                <!-- REALTIME UPLOAD PROGRESS BAR -->
                <div x-show="isUploading" class="p-4 rounded-2xl bg-teal-50/80 border border-teal-200 space-y-2.5" x-transition>
                    <div class="flex items-center justify-between text-xs font-bold text-teal-900">
                        <span x-text="uploadStatusText" class="flex items-center space-x-2">
                            <i class="fa-solid fa-spinner animate-spin text-teal-600"></i>
                        </span>
                        <span x-text="uploadProgress + '%'" class="font-extrabold text-teal-700"></span>
                    </div>
                    <div class="w-full bg-slate-200 rounded-full h-3 overflow-hidden shadow-inner">
                        <div class="bg-gradient-to-r from-tealAccent-500 to-emerald-500 h-3 rounded-full transition-all duration-300" :style="'width: ' + uploadProgress + '%'"></div>
                    </div>
                </div>

                <div class="pt-4 flex justify-end space-x-3 border-t border-slate-100">
                    <button type="button" @click="showModal = false" :disabled="isUploading" class="px-5 py-2.5 rounded-xl bg-slate-100 text-slate-600 font-bold text-xs uppercase cursor-pointer disabled:opacity-50">Batal</button>
                    <button type="submit" :disabled="isUploading" class="px-6 py-2.5 rounded-xl bg-tealAccent-500 hover:bg-tealAccent-600 text-navy-950 font-extrabold text-xs uppercase shadow-md cursor-pointer disabled:opacity-50 inline-flex items-center space-x-2">
                        <template x-if="isUploading">
                            <span class="inline-flex items-center space-x-2">
                                <i class="fa-solid fa-spinner animate-spin"></i>
                                <span x-text="uploadProgress + '% Mengunggah...'"></span>
                            </span>
                        </template>
                        <template x-if="!isUploading">
                            <span x-text="isEdit ? 'Perbarui Modul' : 'Simpan Modul'"></span>
                        </template>
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
function modulsManager() {
    return {
        showModal: false,
        isEdit: false,
        isUploading: false,
        uploadProgress: 0,
        uploadStatusText: '',
        formAction: '{{ route('admin.moduls.store') }}',
        form: { title: '', category: 'Kimia & Nutrisi', badge: '', description: '', cover_image: '', file_url: '' },
        openAddModal() {
            this.isEdit = false;
            this.isUploading = false;
            this.uploadProgress = 0;
            this.uploadStatusText = '';
            this.formAction = '{{ route('admin.moduls.store') }}';
            this.form = { title: '', category: 'Kimia & Nutrisi', badge: '', description: '', cover_image: '', file_url: '' };
            this.showModal = true;
        },
        openEditModal(item) {
            this.isEdit = true;
            this.isUploading = false;
            this.uploadProgress = 0;
            this.uploadStatusText = '';
            this.formAction = '/admin/modul/' + item.id;
            this.form = {
                title: item.title || '',
                category: item.category || 'Kimia & Nutrisi',
                badge: item.badge || '',
                description: item.description || '',
                cover_image: item.cover_image || '',
                file_url: item.file_url || ''
            };
            this.showModal = true;
        },
        compressCoverAndSubmit(formElement) {
            const coverInput = formElement.querySelector('input[name="cover_image_upload"]');
            const file = coverInput && coverInput.files[0];
            
            if (file && file.type.startsWith('image/')) {
                this.uploadStatusText = 'Mengompres gambar sampul...';
                const reader = new FileReader();
                reader.onload = (e) => {
                    const img = new Image();
                    img.onload = () => {
                        const canvas = document.createElement('canvas');
                        let width = img.width;
                        let height = img.height;
                        const maxDim = 1200;
                        if (width > maxDim || height > maxDim) {
                            if (width > height) {
                                height = Math.round((height * maxDim) / width);
                                width = maxDim;
                            } else {
                                width = Math.round((width * maxDim) / height);
                                height = maxDim;
                            }
                        }
                        canvas.width = width;
                        canvas.height = height;
                        const ctx = canvas.getContext('2d');
                        ctx.drawImage(img, 0, 0, width, height);
                        canvas.toBlob((blob) => {
                            const formData = new FormData(formElement);
                            if (blob) {
                                formData.set('cover_image_upload', blob, file.name);
                            }
                            this.sendAjaxUpload(formData);
                        }, 'image/jpeg', 0.82);
                    };
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                const formData = new FormData(formElement);
                this.sendAjaxUpload(formData);
            }
        },
        submitFormWithProgress(e) {
            e.preventDefault();
            this.isUploading = true;
            this.uploadProgress = 0;
            this.compressCoverAndSubmit(e.target);
        },
        sendAjaxUpload(formData) {
            const xhr = new XMLHttpRequest();
            this.uploadStatusText = 'Menyiapkan pengiriman berkas...';

            xhr.upload.addEventListener('progress', (event) => {
                if (event.lengthComputable) {
                    const percent = Math.round((event.loaded / event.total) * 100);
                    this.uploadProgress = percent;
                    const loadedMB = (event.loaded / (1024 * 1024)).toFixed(1);
                    const totalMB = (event.total / (1024 * 1024)).toFixed(1);
                    if (percent < 100) {
                        this.uploadStatusText = 'Mengunggah ke server... ' + percent + '% (' + loadedMB + ' MB / ' + totalMB + ' MB)';
                    } else {
                        this.uploadStatusText = 'Unggahan 100% selesai. Memproses & menyimpan data...';
                    }
                }
            });

            xhr.addEventListener('load', () => {
                if (xhr.status >= 200 && xhr.status < 400) {
                    this.uploadStatusText = 'Berhasil disimpan! Memuat ulang...';
                    window.location.reload();
                } else if (xhr.status === 503) {
                    this.isUploading = false;
                    alert('Server Domainesia membatasi durasi upload (Error 503 Timeout).\n\nJika berkas PDF Anda di atas 30MB, harap gunakan file PDF yang telah dikompres (misal: di bawah 20MB) agar pengunggahan cepat & sukses.');
                } else {
                    this.isUploading = false;
                    alert('Gagal menyimpan modul (Kode ' + xhr.status + '). Silakan coba unggah kembali.');
                }
            });

            xhr.addEventListener('error', () => {
                this.isUploading = false;
                alert('Koneksi terputus saat mengunggah berkas. Harap periksa jaringan internet Anda.');
            });

            xhr.open('POST', this.formAction);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.send(formData);
        }
    };
}
</script>
@endsection
