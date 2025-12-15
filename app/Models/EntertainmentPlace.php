<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntertainmentPlace extends Model
{
    use HasFactory;

    protected $table = 'entertainment_places';

    protected $primaryKey = 'entertainment_place_id';

    protected $fillable = [
        'place_id',
        'category',
        'menu_or_program',
    ];

    public $timestamps = true;

    
    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id', 'place_id');
    }
}
