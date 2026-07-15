@extends('admin.layout')

@section('page_title', 'Ulasan / Testimoni')

@section('content')
<div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 shadow-sm space-y-6">
    <div class="flex items-center justify-between">
        <h3 class="text-base font-bold text-slate-800 dark:text-white flex items-center gap-2">
            <i data-lucide="message-square" class="w-4.5 h-4.5 text-amber-500"></i>
            Daftar Testimoni ({{ count($testimonials) }})
        </h3>
        <a href="{{ route('admin.testimonials.create') }}" class="inline-flex items-center gap-1.5 bg-violet-600 hover:bg-violet-500 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition-all shadow-lg shadow-violet-500/10 cursor-pointer">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah Testimoni
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left border-collapse">
            <thead>
                <tr class="text-xs font-bold uppercase text-slate-400 border-b border-slate-100 dark:border-slate-800">
                    <th class="pb-3 px-4">Nama Pelanggan</th>
                    <th class="pb-3 px-4">Pesan</th>
                    <th class="pb-3 px-4">Rating</th>
                    <th class="pb-3 px-4">Status</th>
                    <th class="pb-3 px-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse($testimonials as $testimonial)
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/10">
                        <td class="py-4 px-4 font-semibold text-slate-800 dark:text-slate-200">{{ $testimonial->customer_name }}</td>
                        <td class="py-4 px-4 text-xs text-slate-400 max-w-xs">
                            <span class="line-clamp-2">{{ $testimonial->message }}</span>
                        </td>
                        <td class="py-4 px-4">
                            <div class="flex items-center gap-0.5">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-3.5 h-3.5 {{ $i <= $testimonial->rating ? 'text-amber-400 fill-amber-400' : 'text-slate-300 dark:text-slate-700 fill-slate-300 dark:fill-slate-700' }}" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                @endfor
                                <span class="ml-1 text-xs text-slate-400 font-bold">{{ $testimonial->rating }}/5</span>
                            </div>
                        </td>
                        <td class="py-4 px-4">
                            @if($testimonial->status)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-50 dark:bg-emerald-950/20 text-emerald-600 dark:text-emerald-400 text-[10px] font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 text-[10px] font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>Nonaktif
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="p-2 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-violet-600 hover:text-white transition-all text-slate-600 dark:text-slate-300">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </a>
                                <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" onsubmit="return confirm('Hapus testimoni ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-red-600 hover:text-white transition-all text-slate-600 dark:text-slate-300 cursor-pointer">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center text-slate-400 text-xs">
                            <i data-lucide="message-square" class="w-8 h-8 mx-auto mb-3 text-slate-300"></i>
                            Belum ada testimoni yang ditambahkan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
