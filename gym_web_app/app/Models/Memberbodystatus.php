<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memberbodystatus extends Model
{
    use HasFactory;
    protected $fillable = [
        'member_id',
        'weight',
        'height',
        'chest',
        'stomach',
        'biceps',
        'thighs',
    ];
} 