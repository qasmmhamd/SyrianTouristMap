<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntertainmentPlace extends Model
{
    use HasFactory;

    // اسم الجدول
    protected $table = 'entertainment_places';

    // اسم المفتاح الأساسي
    protected $primaryKey = 'entertainment_place_id';

    // الأعمدة القابلة للتعبئة
    protected $fillable = [
        'place_id',
        'category',
        'menu_or_program',
    ];

    // تفعيل timestamps لأن الجدول يحتوي على created_at و updated_at
    public $timestamps = true;

    /**
     * العلاقة مع مودل Place
     * كل EntertainmentPlace ينتمي إلى Place واحد
     */
    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id', 'place_id');
    }
}
