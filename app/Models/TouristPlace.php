<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TouristPlace extends Model
{
    use HasFactory;

    protected $table = 'tourist_places';
    protected $primaryKey = 'tourist_place_id';
    protected $fillable = [
        'place_id',
        'entry_fee',
        'opening_hours',
    ];
    public $timestamps = true;

   
    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id', 'place_id');
    }
}
