<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Services\GameService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class GameController extends Controller
{
    public function __construct(private GameService $gameService) {}

    public function index()
    {
        $search = request('search');
        $status = request('status');
        $sort = request('sort', 'latest');

        $games = Game::query()
            ->search($search, ['name', 'description'])
            ->filterByStatus($status);

        if ($sort === 'oldest') {
            $games = $games->oldest();
        } else {
            $games = $games->latest();
        }

        $games = $games->get();

        return view('admin.games.index', compact('games', 'search', 'status', 'sort'));
    }

    public function create()
    {
        return view('admin.games.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            
            // Generate slug dari nama game
            $slug = Str::slug($request->name);
            
            // Cek apakah game dengan nama tersebut sudah ada
            if (Game::where('slug', $slug)->exists()) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'name' => 'Game dengan nama tersebut sudah ada.'
                ]);
            }

            $data = $validated;
            $data['slug'] = $slug;
            $data['status'] = $request->has('status');

            if ($request->hasFile('thumbnail')) {
                $data['thumbnail'] = $this->uploadFile($request->file('thumbnail'), 'thumb');
            }

            if ($request->hasFile('banner')) {
                $data['banner'] = $this->uploadFile($request->file('banner'), 'banner');
            }

            Game::create($data);
            $this->gameService->clearCache();

            return redirect()->route('admin.games.index')->with('success', 'Game berhasil ditambahkan.');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Merge _form_type ke dalam input data
            $inputData = $request->all();
            $inputData['_form_type'] = 'create';
            
            return redirect()->route('admin.games.index')
                ->withErrors($e->errors())
                ->withInput($inputData);
        }
    }

    public function edit(Game $game)
    {
        return view('admin.games.edit', compact('game'));
    }

    public function update(Request $request, Game $game)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            
            // Generate slug dari nama game
            $slug = Str::slug($request->name);
            
            // Cek apakah game dengan nama tersebut sudah ada (kecuali milik game ini sendiri)
            if (Game::where('slug', $slug)->where('id', '!=', $game->id)->exists()) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'name' => 'Game dengan nama tersebut sudah ada.'
                ]);
            }

            $data = $validated;
            $data['slug'] = $slug;
            $data['status'] = $request->has('status');

            if ($request->hasFile('thumbnail')) {
                $this->deleteFile($game->thumbnail);
                $data['thumbnail'] = $this->uploadFile($request->file('thumbnail'), 'thumb');
            }

            if ($request->hasFile('banner')) {
                $this->deleteFile($game->banner);
                $data['banner'] = $this->uploadFile($request->file('banner'), 'banner');
            }

            $game->update($data);
            $this->gameService->clearGameCache($game->slug);

            return redirect()->route('admin.games.index')->with('success', 'Game berhasil diperbarui.');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            
            // Merge _form_type ke dalam input data  
            $inputData = $request->all();
            $inputData['_form_type'] = 'edit';
            $inputData['_edit_id'] = $game->id;
            
            return redirect()->route('admin.games.index')
                ->withErrors($e->errors())
                ->withInput($inputData);
        }
    }

    public function destroy(Game $game)
    {
        $this->deleteFile($game->thumbnail);
        $this->deleteFile($game->banner);
        
        $slug = $game->slug;
        $game->delete();
        
        $this->gameService->clearGameCache($slug);

        return redirect()->route('admin.games.index')->with('success', 'Game berhasil dihapus.');
    }

    private function uploadFile($file, $prefix)
    {
        $targetDir = public_path('img');
        if (!File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }
        $filename = time() . '_' . $prefix . '_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
        $file->move($targetDir, $filename);
        return $filename;
    }

    private function deleteFile($filename)
    {
        if ($filename && File::exists(public_path('img/' . $filename))) {
            File::delete(public_path('img/' . $filename));
        }
    }
}