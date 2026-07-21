<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'store_name',
        'whatsapp',
        'whatsapp_channel',
        'whatsapp_template_single',
        'whatsapp_template_multiple',
        'whatsapp_contact_template',
        'youtube_tutorial',
        'instagram',
        'facebook',
        'discord',
        'address',
        'footer',
        'operating_hours',
        'meta_description',
        'meta_keywords',
        'logo',
        'favicon',
        'whatsapp_clicks'
    ];

    protected $casts = [
        'whatsapp_clicks' => 'integer',
    ];

    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function set($key, $value, $type = 'string')
    {
        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => $type]
        );
    }
}
