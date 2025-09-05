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
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('tour_id')->nullable();
            $table->foreign('tour_id')->references('id')->on('tour_places')->onDelete('cascade');
            $table->integer('coupon_type')->nullable();
            $table->string('type')->nullable();
            $table->string('coupon_code')->nullable();
            $table->string('percentage')->nullable();
            $table->integer('maximum_discount_amount')->nullable();
            $table->integer('minimum_order_amount')->nullable();
            $table->integer('flat_amount')->nullable();
            $table->date('validate_day')->nullable();
            $table->text(column: 'description')->nullable();
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
        Schema::dropIfExists('promo_codes');
    }
};
