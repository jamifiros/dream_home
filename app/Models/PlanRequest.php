<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'plot_size',
        'work_location',
        'no_bhk',
        'no_bathrooms',
        'no_floors',
        'requirements',
        'additional_info',
        'model_id',
        'plot_image',
        'estimated_cost',
       
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'model_id');
    }

    public function project()
    {
        return $this->belongsTo(project::class);
    }
}


