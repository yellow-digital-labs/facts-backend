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
            $table->string('contact', 15)->unique()->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('contact_verified_at')->nullable();
            $table->string('password');
            $table->enum('food_status', ['not applied','pending','approved','rejected'])->default('not applied');
            $table->enum('accommodation_status', ['not applied','pending','approved','rejected'])->default('not applied');
            $table->enum('cabs_status', ['not applied','pending','approved','rejected'])->default('not applied');
            $table->enum('tickets_status', ['not applied','pending','approved','rejected'])->default('not applied');
            $table->enum('shop_status', ['not applied','pending','approved','rejected'])->default('not applied');
            $table->rememberToken();
            $table->integer('available_points')->default(0);
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
