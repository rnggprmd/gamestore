@extends('admin.layout')

@section('page_title', 'Manajemen Banner')

@section('content')
<div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 shadow-sm space-y-6">
    <div class="flex items-center justify-between">
        <h3 class="text-base font-bold text-slate-800 dark:text-white flex items-center gap-2">
            <i data-lucide="image" class="w-4.5 h-4.5 text-pink-500"></i>
            Daftar Banner ({{ count($banners) }})
        </h3>
        <a href="{{ route('admin.banners.create') }}" class="inline-flex items-center gap-1.5 bg-violet-600 hover:bg-violet-500 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition-all shadow-lg shadow-violet-500/10 cursor-pointer">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah Banner
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left border-collapse">
            <thead>
                <tr class="text-xs font-bold uppercase text-slate-400 border-b border-slate-100 dark:border-slate-800">
                    <th class="pb-3 px-4">Preview</th>
                    <th class="pb-3 px-4">Judul</th>
                    <th class="pb-3 px-4">Subtitle</th>
                    <th class="pb-3 px-4">Status</th>
                    <th class="pb-3 px-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse($banners as $banner)
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/10">
                        <td class="py-4 px-4">
                            @if($banner->image && file_exists(public_path('img/' . $banner->image)))
                                <img src="{{ asset('img/' . $banner->image) }}" alt="{{ $banner->title }}" class="w-24 h-14 rounded-xl object-cover border border-slate-200 dark:border-slate-800">
                            @else
                                <div class="w-24 h-14 rounded-xl bg-gradient-to-br from-violet-600 to-indigo-700 flex items-center justify-center text-white text-[10px] font-bold">
                                    No Image
                                </div>
                            @endif
                        </td>
                        <td class="py-4 px-4 font-semibold text-slate-800 dark:text-slate-200">{{ $banner->title }}</td>
                        <td class="py-4 px-4 text-xs text-slate-400 max-w-xs truncate">{{ $banner->subtitle }}</td>
                        <td class="py-4 px-4">
                            @if($banner->status)
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
                                <a href="{{ route('admin.banners.edit', $banner->id) }}" class="p-2 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-violet-600 hover:text-white transition-all text-slate-600 dark:text-slate-300">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </a>
                                <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Hapus banner ini?')">
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
                            <i data-lucide="image" class="w-8 h-8 mx-auto mb-3 text-slate-300"></i>
                            Belum ada banner yang ditambahkan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
