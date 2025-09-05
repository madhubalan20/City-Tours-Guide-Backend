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
        Schema::create('tour_place_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tour_place_id')->nullable();
            $table->foreign('tour_place_id')->references('id')->on('tour_places')->onDelete('cascade');
            $table->string('image', 500)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_place_images');
    }
};
