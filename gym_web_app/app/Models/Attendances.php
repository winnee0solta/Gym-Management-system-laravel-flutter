<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendances extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'type', //  trainer or membero
        'trainer_id',//default = 0
        'member_id',//default = 0
        'status', // PRESENT or ABSENT
    ];
} 