<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'plan_id'; // Specify the primary key
    protected $fillable = [
       'plan_name',
    'plan_type',
    'plan_image',
    'no_bhk',
    'no_bathroom',
    'no_floor',
    'estimated_cost',
    'sqft'
    ];

}
