<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\Searchable;

class Game extends Model
{
    use Searchable;
    
    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'banner',
        'description',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
