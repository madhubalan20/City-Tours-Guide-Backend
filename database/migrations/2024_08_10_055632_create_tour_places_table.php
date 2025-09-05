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
        Schema::create('tour_places', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->unsignedBigInteger('state_id')->nullable();
            $table->foreign('state_id')->references('id')->on('states');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->string('title')->nullable();
            $table->string('duration_time')->nullable();
            $table->integer('audio_point')->nullable();
            $table->integer('tour_stops')->nullable();
            $table->integer('demo_price')->nullable();
            $table->integer('offer_percentage')->nullable();
            $table->integer('price')->nullable();
            $table->integer('tour_type')->nullable();
            $table->string('json_url')->nullable();
            $table->text('description')->nullable();
            $table->text('know_before_you_go')->nullable();
            $table->enum('status', ['0','1'])->default(1);
            $table->enum('free_tour_status', ['0','1'])->default(0);
            $table->date('free_tour_validate_date')->nullable();
            $table->string('preview_image', 500)->nullable();
            $table->string('error_message', 600)->nullable();
            $table->dateTime('create_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /** 
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_places');
    }
};
