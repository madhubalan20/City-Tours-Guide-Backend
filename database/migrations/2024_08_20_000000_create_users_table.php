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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile_no')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('hash_password');
            $table->unsignedBigInteger('user_group_id')->nullable();
            $table->foreign('user_group_id')->references('id')->on('user_groups');
            $table->rememberToken();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')->on('currency_types');
            $table->unsignedBigInteger('audio_id')->nullable();
            $table->foreign('audio_id')->references('id')->on('audio_types');
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->enum('active_status', ['0','1'])->default(1);
            $table->enum('verify_status', ['0','1'])->default(0);
            $table->enum('delete_account_status', ['0','1'])->default(1);
            $table->integer('verify_code')->nullable();
            $table->date('update_date')->nullable();
            $table->string('device_id')->nullable();
            $table->string('one_signal_id')->nullable();
            $table->string('push_token', 600)->nullable();
            $table->string('device_brand', 100)->nullable();
            $table->string('device_model', 100)->nullable();
            $table->string('device_SDK', 100)->nullable();
            $table->string('device_manufacture', 100)->nullable();
            $table->string('app_release', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
