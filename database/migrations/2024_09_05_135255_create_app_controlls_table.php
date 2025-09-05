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
        Schema::create('app_controlls', function (Blueprint $table) {
            $table->id();
            $table->string('razorpay_merchant_id')->nullable();
            $table->string('razorpay_merchant_key')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('name')->nullable();
            $table->string('splash_image')->nullable();
            $table->text('address')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('tech_support_number')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('office_timing', 500)->nullable();
            $table->string('tech_support_url', 500)->nullable();
            $table->string('purchase_validate_date')->nullable();
            $table->string('contact_email')->nullable();
            $table->text('mapbox_access_token')->nullable();
            $table->text('privacy_policy')->nullable();
            $table->text('term_conditions')->nullable();
            $table->text('contact_us')->nullable();
            $table->text('about_us')->nullable();
            $table->integer('splash_time_sec')->nullable();
            $table->string('android_version_code')->nullable();
            $table->string('android_version_name')->nullable();
            $table->string('email_footer_content')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_controlls');
    }
};
