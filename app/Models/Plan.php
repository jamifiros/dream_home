<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_name',
        'plan_type',
        'plan_image',
        'no_bhk',
        'no_bathroom',
        'no_floor',
        'sqft',
        'estimated_cost',
    ];

    public function planRequests()
    {
        return $this->hasMany(PlanRequest::class, 'model_id');
    }
}

