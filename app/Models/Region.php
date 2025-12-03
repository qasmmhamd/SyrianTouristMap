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

    /**
     * كل الترجمات (عربي - إنجليزي - مستقبلاً لغات أخرى)
     */
    public function translations()
    {
        return $this->hasMany(RegionTranslation::class);
    }

    /**
     * الترجمة حسب اللغة الحالية في الموقع
     */
    public function translation()
    {
        return $this->hasOne(RegionTranslation::class)
            ->where('locale', app()->getLocale());
    }
}
