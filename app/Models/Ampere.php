<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ampere extends Model
{
    use HasFactory;
    protected $table='a_unit';
    protected $fillable = [
        'ampere'
        
    ];

}
