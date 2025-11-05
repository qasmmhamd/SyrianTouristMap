<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'ratings';

    
    protected $primaryKey = 'rating_id';


    protected $fillable = [
        'value',
        'user_id',
        'place_id',
    ];

    
    public $timestamps = true;

    /**
     * العلاقة مع مودل User
     * كل تقييم يخص مستخدمًا واحدًا
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * العلاقة مع مودل Place
     * كل تقييم يخص مكانًا واحدًا
     */
    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id', 'place_id');
    }
}

