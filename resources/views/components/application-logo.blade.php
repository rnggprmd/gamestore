@php
    $setting = \Illuminate\Support\Facades\Cache::remember('site_settings_global', 3600, fn() => \App\Models\Setting::first());
    $logoUrl = ($setting && $setting->logo && file_exists(public_path('img/' . $setting->logo)))
        ? asset('img/' . $setting->logo)
        : asset('img/logo gamestore.png');
@endphp
<img src="{{ $logoUrl }}" alt="{{ $setting->store_name ?? 'Gamestore' }} Logo" {{ $attributes->merge(['class' => 'object-contain']) }}>


