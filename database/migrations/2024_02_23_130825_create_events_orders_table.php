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
        Schema::create('events_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_user_id');
            $table->unsignedBigInteger('event_user_id');
            $table->unsignedBigInteger('event_id');
            $table->integer('no_of_booking')->default(0);
            $table->float('booking_unit_amount', 7, 2)->default(0);
            $table->float('applicable_tax_amount', 7, 2)->default(0);
            $table->float('booking_total_amount', 7, 2)->default(0);
            $table->integer('points_used')->default(0);
            $table->float('booking_payable_amount', 7, 2)->default(0);
            $table->string('status');
            $table->timestamps();

            $table->foreign('booking_user_id')->references('id')->on('users');
            $table->foreign('event_user_id')->references('id')->on('users');
            $table->foreign('event_id')->references('id')->on('events');
            $table->index('booking_user_id');
            $table->index('event_user_id');
            $table->index('event_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events_orders');
    }
};
