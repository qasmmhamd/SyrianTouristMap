<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SuperAdmin extends Authenticatable
{
    use  HasApiTokens,HasFactory;

    protected $table = 'super_admins';
    protected $primaryKey = 'super_admin_id';

    protected $fillable = [
        'name',
         'email',
        'password',
        
    ];

    protected $hidden = ['password'];
    public $timestamps = true;

    // 🔗 العلاقة مع Admin (إدارة المدراء)
    public function admins()
    {
        return $this->hasMany(Admin::class, 'super_admin_id', 'super_admin_id');
    }
    
}
