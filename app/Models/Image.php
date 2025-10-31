<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';
    protected $primaryKey = 'image_id';
    protected $fillable = ['place_id', 'url'];
    public $timestamps = true;

    // 🔗 كل صورة تخص مكانًا واحدًا
    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id', 'place_id');
    }
}
