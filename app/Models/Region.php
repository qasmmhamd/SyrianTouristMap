<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
    ];

    public function translations()
    {
        return $this->hasMany(RegionTranslation::class);
    }

    public function translation()
    {
        return $this->hasOne(RegionTranslation::class)
            ->where('locale', app()->getLocale());
    }
}
