<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $table = 'places';

    protected $fillable = [
        'region_id',
        'latitude',
        'longitude',
        'google_map_url',
        'image_url',
        'type', // ['historical', 'entertainment', 'service']
    ];

    public $timestamps = true;

    /* =========================
       العلاقات الأساسية
    ========================= */

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    /* =========================
       العلاقات حسب النوع
    ========================= */

    public function historicalPlace()
    {
        return $this->hasOne(HistoricalPlace::class);
    }

    public function entertainmentPlace()
    {
        return $this->hasOne(EntertainmentPlace::class);
    }

    public function servicePlace()
    {
        return $this->hasOne(ServicePlace::class);
    }

    public function touristPlace()
    {
        return $this->hasOne(TouristPlace::class);
    }

    /* =========================
       ✅ علاقات الترجمة
    ========================= */

    // كل الترجمات
    public function translations()
    {
        return $this->hasMany(PlaceTranslation::class);
    }

    // الترجمة حسب لغة الموقع
    public function translation()
    {
        return $this->hasOne(PlaceTranslation::class)
            ->where('locale', app()->getLocale());
    }

    /* =========================
       ✅ Scopes (كما هي عندك)
    ========================= */

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeInRegion($query, $regionId)
    {
        return $query->where('region_id', $regionId);
    }
}
