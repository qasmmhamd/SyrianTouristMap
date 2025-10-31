<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    // اسم الجدول
    protected $table = 'regions';

    // اسم المفتاح الأساسي
    protected $primaryKey = 'region_id';

    // الأعمدة القابلة للتعبئة
    protected $fillable = [
        'name',
        'description',
    ];

    // إلغاء timestamps لأن الجدول لا يحتوي على created_at و updated_at
    public $timestamps = false;

    /**
     * العلاقة مع مودل Place
     * المنطقة تحتوي على العديد من الأماكن
     */
    public function places()
    {
        return $this->hasMany(Place::class, 'region_id', 'region_id');
    }
}
