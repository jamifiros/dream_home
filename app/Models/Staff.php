<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'age',
        'profile_image',
        'gender',
        'contact',
        'pincode',
        'post',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
