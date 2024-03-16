<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;
    protected $table = 'role_user';
    public $timestamps = false;

    protected $fillable = [
        'roles_id',
        'users_id',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'users_id');
    }
    public function role(){
        return $this->belongsTo(Roles::class, 'roles_id');
    }
}
