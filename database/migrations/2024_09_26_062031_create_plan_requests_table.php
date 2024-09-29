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
        Schema::create('plan_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->string('plot_size');
            $table->string('work_location');
            $table->integer('no_bhk');
            $table->integer('no_bathrooms');
            $table->integer('no_floors');
            $table->longText('requirements'); // Long text field
            $table->longText('additional_info')->nullable();
            $table->foreignId('model_id')->constrained('plans')->onDelete('cascade'); // Specify plan_id here
            $table->string('plot_image')->nullable(); // Nullable field
            $table->decimal('estimated_cost', 10, 2)->nullable(); // Nullable field
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_requests');
    }
};
