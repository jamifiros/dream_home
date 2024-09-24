<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

     // Specify the fillable fields
     protected $fillable = [
        'user_id',
        'post',
        'pincode',
        'place',
        'landmark',
        'contact',
        'id_proof_type',
        'id_proof',
        'profile_image',
    ];

    // Define the one-to-one relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
