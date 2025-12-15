<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'region_id',
        'locale',
        'name',
        'description',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
