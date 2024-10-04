<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id', 'client_id', 'payment_method', 'status','amount',
    ];

    // Relationship with the Project model
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    // Relationship with the Client model
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
