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
        Schema::create('design_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade'); // Foreign key referencing clients
            $table->foreignId('model_id')->constrained('designs')->onDelete('cascade'); // Foreign key referencing designs
            $table->string('work_location');
            $table->longText('requirements'); // Requirements field
            $table->longText('additional_info')->nullable();
            $table->decimal('estimated_cost', 10, 2)->nullable(); // Nullable field
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('design_requests');
    }
};
