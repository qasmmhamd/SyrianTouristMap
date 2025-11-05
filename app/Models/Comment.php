<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $primaryKey = 'comment_id';

    protected $fillable = [
        'content',
        'date',
        'user_id',
        'place_id',
    ];

    public $timestamps = true;

    /**
     * العلاقة مع مودل User
     * كل تعليق يخص مستخدمًا واحدًا
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * العلاقة مع مودل Place
     * كل تعليق يخص مكانًا واحدًا
     */
    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id', 'place_id');
    }
}
