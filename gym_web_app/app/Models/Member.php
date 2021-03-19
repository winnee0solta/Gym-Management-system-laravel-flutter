<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'image',// default = no
        'fullname',
        'phone',
        'address',
        'verified', // default = false
        'shift_m',// default = false
        'shift_e', // default = false
        'expiration_date',// default = no
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
