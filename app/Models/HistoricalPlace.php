<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricalPlace extends Model
{
    use HasFactory;

    protected $table = 'historical_places';
    protected $primaryKey = 'historical_place_id';
    protected $fillable = ['place_id', 'era', 'architectural_style', 'history_information'];
    public $timestamps = true;

    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id', 'place_id');
    }
}
