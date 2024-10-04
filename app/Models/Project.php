<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'project_request_id', 'assigned_staff_id', 'status'];


    // Define the relationship with the ProjectRequest model (one-to-one)
    public function projectRequest()
    {
        return $this->belongsTo(ProjectRequest::class);
    }
    

      // Define the relationship with the Client model (one-to-many)
      public function client()
      {
          return $this->belongsTo(Client::class);
      }

   
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'assigned_staff_id');
    }
    public function payment()
    {
        return $this->hasOne(Payment::class, 'project_id');
    }
}
