<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;   
    
    protected $fillable = [
        'center_id',
        'author_id',
        'name'
    ];

    public function center(){
        return $this->belongsTo(Center::class, 'center_id');
    }

}
