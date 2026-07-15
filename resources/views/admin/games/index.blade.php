@extends('admin.layout')

@section('page_title', 'Manajemen Game')

@section('content')
<div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 shadow-sm space-y-6">
    <div class="flex items-center justify-between">
        <h3 class="text-base font-bold text-slate-800 dark:text-white flex items-center gap-2">
            <i data-lucide="gamepad-2" class="w-4.5 h-4.5 text-violet-500"></i>
            Daftar Game ({{ count($games) }})
        </h3>
        <a href="{{ route('admin.games.create') }}" class="inline-flex items-center gap-1.5 bg-violet-600 hover:bg-violet-500 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition-all shadow-lg shadow-violet-500/10 cursor-pointer">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah Game
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left border-collapse">
            <thead>
                <tr class="text-xs font-bold uppercase text-slate-400 border-b border-slate-100 dark:border-slate-800 pb-3">
                    <th class="pb-3 px-4">Thumbnail</th>
                    <th class="pb-3 px-4">Nama Game</th>
                    <th class="pb-3 px-4">Slug</th>
                    <th class="pb-3 px-4">Status</th>
                    <th class="pb-3 px-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse($games as $game)
                    <tr class="text-slate-600 dark:text-slate-300 hover:bg-slate-50/50 dark:hover:bg-slate-800/10">
                        <td class="py-4 px-4">
                            @if($game->thumbnail && file_exists(public_path('img/' . $game->thumbnail)))
                                <img src="{{ asset('img/' . $game->thumbnail) }}" alt="{{ $game->name }}" class="w-12 h-12 rounded-xl object-cover border border-slate-200 dark:border-slate-800">
                            @else
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-violet-600 to-indigo-700 flex items-center justify-center text-white text-[10px] font-bold">
                                    No Image
                                </div>
                            @endif
                        </td>
                        <td class="py-4 px-4 font-semibold text-slate-800 dark:text-slate-200">{{ $game->name }}</td>
                        <td class="py-4 px-4 text-xs font-mono text-slate-400">{{ $game->slug }}</td>
                        <td class="py-4 px-4">
                            @if($game->status)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-50 dark:bg-emerald-950/20 text-emerald-600 dark:text-emerald-400 text-[10px] font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 text-[10px] font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    Nonaktif
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.games.edit', $game->id) }}" class="p-2 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-violet-600 hover:text-white transition-all text-slate-600 dark:text-slate-300">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </a>
                                
                                <form action="{{ route('admin.games.destroy', $game->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus game ini beserta seluruh produknya?')">
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
                            <i data-lucide="gamepad-2" class="w-8 h-8 mx-auto mb-3 text-slate-300"></i>
                            Belum ada game yang ditambahkan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
