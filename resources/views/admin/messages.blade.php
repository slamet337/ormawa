@extends('layouts.admin')

@section('title', 'Pesan Masuk')
@section('page_header', 'Kotak Masuk Pesan Pengunjung')

@section('content')
<div class="space-y-6">

    <div>
        <h2 class="text-xl font-extrabold text-navy-800">Daftar Pesan & Konsultasi Masuk</h2>
        <p class="text-xs text-slate-500">Pesan dari masyarakat, kader Posyandu, atau pihak mitra yang dikirimkan melalui formulir kontak.</p>
    </div>

    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="divide-y divide-slate-100">
            @forelse($messages as $msg)
                <div class="p-6 hover:bg-slate-50/60 transition-colors flex flex-col md:flex-row md:items-start justify-between gap-4">
                    <div class="space-y-2 max-w-3xl">
                        <div class="flex items-center space-x-3">
                            <span class="font-extrabold text-navy-800 text-sm">{{ $msg->name }}</span>
                            <span class="px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-600 text-[11px] font-mono">{{ $msg->email }}</span>
                            @if($msg->phone)
                                <span class="px-2.5 py-0.5 rounded-full bg-teal-50 text-teal-700 text-[11px] font-mono"><i class="fa-brands fa-whatsapp"></i> {{ $msg->phone }}</span>
                            @endif
                        </div>

                        @if($msg->subject)
                            <div class="text-xs font-bold text-teal-600">Subjek: {{ $msg->subject }}</div>
                        @endif

                        <p class="text-xs text-slate-700 leading-relaxed bg-slate-50 p-4 rounded-2xl border border-slate-100">
                            {{ $msg->message }}
                        </p>

                        <div class="text-[10px] text-slate-400 font-medium">
                            Diterima pada: {{ $msg->created_at->format('d M Y, H:i') }} ({{ $msg->created_at->diffForHumans() }})
                        </div>
                    </div>

                    <div>
                        <form action="{{ route('admin.messages.delete', $msg->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3.5 py-2 rounded-xl bg-rose-50 text-rose-600 text-xs font-bold hover:bg-rose-100 transition-colors flex items-center space-x-1">
                                <i class="fa-solid fa-trash text-xs"></i>
                                <span>Hapus Pesan</span>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="py-16 text-center text-slate-400">
                    <i class="fa-regular fa-envelope-open text-4xl mb-3 text-slate-300 block"></i>
                    Belum ada pesan masuk.
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection
