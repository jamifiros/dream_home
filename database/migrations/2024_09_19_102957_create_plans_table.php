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
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('plan_id');
            $table->string('plan_name', 255);
            $table->string('plan_type', 255);
            $table->string('plan_image', 255);
            $table->integer('no_bhk');
            $table->integer('no_bathroom');
            $table->integer('no_floor');
            $table->integer('sqft');
            $table->string('estimated_cost', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
