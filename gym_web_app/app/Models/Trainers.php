<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainers extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'image', // default = no
        'fullname',
        'phone',
        'address', 
        'shift_m', // default = false
        'shift_e', // default = false
    ];
}
  