<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    /**
     * اسم الجدول في قاعدة البيانات
     */
    protected $table = 'places';

    /**
     * المفتاح الأساسي
     */
    protected $primaryKey = 'place_id';

    /**
     * الأعمدة القابلة للتعبئة
     */
    protected $fillable = [
        'name',
        'description',
        'location',
        'region_id',
        'type', // ['historical', 'entertainment', 'service']
    ];

    /**
     * تفعيل التواريخ التلقائية (created_at, updated_at)
     */
    public $timestamps = true;

    // ============================================
    // 🔗 العلاقات بين الجداول
    // ============================================

    /**
     * كل مكان ينتمي إلى منطقة واحدة
     */
    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'region_id');
    }

    /**
     * كل مكان له عدة تقييمات
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'place_id', 'place_id');
    }

    /**
     * كل مكان له عدة تعليقات
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'place_id', 'place_id');
    }

    /**
     * كل مكان له عدة صور
     */
    public function images()
    {
        return $this->hasMany(Image::class, 'place_id', 'place_id');
    }

    /**
     * كل مكان له بيانات تاريخية واحدة (إذا كان type = historical)
     */
    public function historicalPlace()
    {
        return $this->hasOne(HistoricalPlace::class, 'place_id', 'place_id');
    }

    /**
     * كل مكان له بيانات ترفيهية واحدة (إذا كان type = entertainment)
     */
    public function entertainmentPlace()
    {
        return $this->hasOne(EntertainmentPlace::class, 'place_id', 'place_id');
    }

    /**
     * كل مكان له بيانات خدمية واحدة (إذا كان type = service)
     */
    public function servicePlace()
    {
        return $this->hasOne(ServicePlace::class, 'place_id', 'place_id');
    }

    /**
     * العلاقة مع TouristPlace (إن كانت مستخدمة لديك)
     */
    public function touristPlace()
    {
        return $this->hasOne(TouristPlace::class, 'place_id', 'place_id');
    }

    // ============================================
    // ⚙️ Scopes (مرشحات جاهزة)
    // ============================================

    /**
     * فلترة حسب النوع (historical, entertainment, service)
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * فلترة حسب المنطقة
     */
    public function scopeInRegion($query, $regionId)
    {
        return $query->where('region_id', $regionId);
    }
}
