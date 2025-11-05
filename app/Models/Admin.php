<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admins';
    protected $primaryKey = 'admin_id';

    protected $fillable = [
        'username',
        'super_admin_id',
        'password',
    ];

    protected $hidden = ['password'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed', 
               ];
    }

    public $timestamps = true;

    public function managePlaces()
    {
    }
    public function superAdmin()
{
    return $this->belongsTo(SuperAdmin::class, 'super_admin_id', 'super_admin_id');
}

}
