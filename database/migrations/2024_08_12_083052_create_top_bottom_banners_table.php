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
        Schema::create('top_bottom_banners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->unsignedBigInteger('tour_id')->nullable();
            $table->foreign('tour_id')->references('id')->on('tour_places');
            $table->text('url')->nullable();
            $table->string('type')->nullable();
            $table->integer('file_type')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('image', 500)->nullable();
            $table->text('vedio_url')->nullable();
            $table->integer('position')->nullable();
            $table->integer('arrangement')->nullable();
            $table->enum('status', ['0','1'])->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('top_bottom_banners');
    }
};
