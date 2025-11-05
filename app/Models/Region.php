<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $table = 'regions';

    protected $primaryKey = 'region_id';

    protected $fillable = [
        'name',
        'description',
    ];

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
