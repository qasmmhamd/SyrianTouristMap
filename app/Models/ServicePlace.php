<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePlace extends Model
{
    use HasFactory;

    protected $table = 'service_places';
    protected $primaryKey = 'service_place_id';
    protected $fillable = ['place_id', 'service_type', 'working_hours', 'contact'];
    public $timestamps = true;

    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id', 'place_id');
    }
}
