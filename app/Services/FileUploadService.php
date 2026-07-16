<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadService
{
    private string $uploadPath = 'img';

    public function upload(UploadedFile $file, string $prefix = '', string $directory = null): string
    {
        $directory = $directory ?? $this->uploadPath;
        
        $filename = $this->generateFileName($file, $prefix);
        
        // Use Laravel's Storage facade for better file handling
        $file->move(public_path($directory), $filename);
        
        return $filename;
    }

    public function delete(string $filename, string $directory = null): bool
    {
        $directory = $directory ?? $this->uploadPath;
        $filePath = public_path($directory . '/' . $filename);
        
        if (File::exists($filePath)) {
            return File::delete($filePath);
        }
        
        return false;
    }

    public function replace(UploadedFile $newFile, ?string $oldFileName, string $prefix = '', string $directory = null): string
    {
        // Delete old file if exists
        if ($oldFileName) {
            $this->delete($oldFileName, $directory);
        }
        
        // Upload new file
        return $this->upload($newFile, $prefix, $directory);
    }

    private function generateFileName(UploadedFile $file, string $prefix = ''): string
    {
        $prefix = $prefix ? $prefix . '_' : '';
        $extension = $file->getClientOriginalExtension();
        $randomString = Str::random(8);
        
        return time() . '_' . $prefix . $randomString . '.' . $extension;
    }

    public function getFileUrl(string $filename, string $directory = null): string
    {
        $directory = $directory ?? $this->uploadPath;
        return asset($directory . '/' . $filename);
    }

    public function fileExists(string $filename, string $directory = null): bool
    {
        $directory = $directory ?? $this->uploadPath;
        return File::exists(public_path($directory . '/' . $filename));
    }
}