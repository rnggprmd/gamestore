<?php

use Illuminate\Support\Facades\File;

if (!function_exists('get_image_url')) {
    /**
     * Helper untuk mendapatkan URL gambar publik secara aman.
     *
     * @param string|null $path
     * @param string|null $default
     * @return string|null
     */
    function get_image_url(?string $path, ?string $default = null): ?string
    {
        if (empty($path)) {
            return $default;
        }

        // Jika path sudah berupa URL lengkap
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        $cleanPath = ltrim($path, '/');

        // Cek jika path berawalan 'img/'
        if (str_starts_with($cleanPath, 'img/')) {
            if (File::exists(public_path($cleanPath))) {
                return asset($cleanPath);
            }
            $filenameOnly = substr($cleanPath, 4);
            if (File::exists(public_path('img/' . $filenameOnly))) {
                return asset('img/' . $filenameOnly);
            }
        }

        // Cek lokasi standar public_path('img/' . $cleanPath)
        if (File::exists(public_path('img/' . $cleanPath))) {
            return asset('img/' . $cleanPath);
        }

        // Cek langsung public_path($cleanPath)
        if (File::exists(public_path($cleanPath))) {
            return asset($cleanPath);
        }

        // Cek di public_path('storage/' . $cleanPath)
        if (File::exists(public_path('storage/' . $cleanPath))) {
            return asset('storage/' . $cleanPath);
        }

        // Jika file belum di-upload tetapi variabel path ada
        // Kembalikan asset URL yang valid
        if (str_starts_with($cleanPath, 'img/')) {
            return asset($cleanPath);
        }

        return asset('img/' . $cleanPath);
    }
}
