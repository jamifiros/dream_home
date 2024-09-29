<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'model_id',
        'work_location',
        'requirements',
        'additional_info',
        'estimated_budget',
        
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function design()
    {
        return $this->belongsTo(Design::class, 'model_id');
    }
}
