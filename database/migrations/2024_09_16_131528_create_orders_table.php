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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_string')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('coupon_id')->nullable();
            $table->string('coupon_code')->nullable();
            $table->integer('coupon_amount')->nullable();
            $table->integer('sub_total')->nullable();
            $table->integer('overall_total')->nullable();
            $table->dateTime('purchase_date')->nullable();
            $table->dateTime('expiry_date')->nullable();
            $table->string('razorpay_id')->nullable();
            $table->string('razorpay_payment_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('payment_message')->nullable();
            $table->string('message')->nullable();
            $table->integer('payment_status')->default(null);
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
        Schema::dropIfExists('orders');
    }
};
