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
        Schema::create('purchase_tours', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->integer('tour_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->string('tour_image', 500)->nullable();
            $table->string('tour_name')->nullable();
            $table->string('country_name')->nullable();
            $table->string('state_name')->nullable();
            $table->string('city_name')->nullable();
            $table->text('tour_description')->nullable();
            $table->text('tour_know_before_you_go')->nullable();
            $table->integer('demo_price')->nullable();
            $table->integer('offer_percentage')->nullable();
            $table->integer('price')->nullable();
            $table->text('json_url')->nullable();
            $table->dateTime('geo_json_updated_date_time')->nullable();
            $table->enum('geo_json_update_status', ['0','1'])->default(0);
            $table->enum('purchase_status', ['0','1'])->default(0);
            $table->string('purchase_type', 20)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_tours');
    }
};
