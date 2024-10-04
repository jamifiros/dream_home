<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

             // Foreign key to client table
             $table->unsignedBigInteger('client_id');
             $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
 
            
            // Foreign key to project_request table (one-to-one relationship)
            $table->unsignedBigInteger('project_request_id');
            $table->foreign('project_request_id')->references('id')->on('project_requests')->onDelete('cascade');

            // Foreign key to staff table
            $table->unsignedBigInteger('assigned_staff_id')->nullable();
            $table->foreign('assigned_staff_id')->references('id')->on('staff')->onDelete('set null');
            $table->enum('status',[ 'pending', 'in_progress', 'completed','terminated'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
