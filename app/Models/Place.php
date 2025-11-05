<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $table = 'places';

    
    protected $primaryKey = 'place_id';

    protected $fillable = [
        'name',
        'description',
        'location',
        'region_id',
        'latitude',
        'longitude',
        'google_map_url',
        'type', // ['historical', 'entertainment', 'service']
    ];

    
    public $timestamps = true;

  
    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'region_id');
    }

    
   
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'place_id', 'place_id');
    }

   
    public function comments()
    {
        return $this->hasMany(Comment::class, 'place_id', 'place_id');
    }

    
    public function images()
    {
        return $this->hasMany(Image::class, 'place_id', 'place_id');
    }

   
    public function historicalPlace()
    {
        return $this->hasOne(HistoricalPlace::class, 'place_id', 'place_id');
    }

    
    public function entertainmentPlace()
    {
        return $this->hasOne(EntertainmentPlace::class, 'place_id', 'place_id');
    }

    
    public function servicePlace()
    {
        return $this->hasOne(ServicePlace::class, 'place_id', 'place_id');
    }

   
    public function touristPlace()
    {
        return $this->hasOne(TouristPlace::class, 'place_id', 'place_id');
    }

   
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    
    public function scopeInRegion($query, $regionId)
    {
        return $query->where('region_id', $regionId);
    }
}
