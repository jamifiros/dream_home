<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'type_id',
        'type',
        'status'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function planRequest()
    {
        return $this->hasOne(PlanRequest::class, 'id', 'type_id');
    }

    public function designRequest()
    {
        return $this->hasOne(DesignRequest::class, 'id', 'type_id');
    }

    public function project()
    {
        return $this->hasOne(Project::class);
    }
}

