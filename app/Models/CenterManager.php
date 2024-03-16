<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CenterManager extends Model
{
    use HasFactory;   
    
    protected $fillable = [
        'center_id',
        'manager_id',
    ];

}
