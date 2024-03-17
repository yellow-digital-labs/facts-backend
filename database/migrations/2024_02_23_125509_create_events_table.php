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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('event_categories_id');
            $table->string('event_name', 100);
            $table->datetime('event_start_datetime');
            $table->datetime('event_end_datetime');
            $table->text('event_description');
            $table->string('event_primary_image');
            $table->string('event_location');
            $table->string('event_contact', 15);
            $table->integer('event_available_tickets')->default(0);
            $table->integer('event_remaining_tickets')->default(0);
            $table->integer('event_ticket_amount')->default(0);
            $table->integer('event_ticket_discount_amount')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('event_categories_id')->references('id')->on('m_event_categories');
            $table->index('user_id');
            $table->index('event_categories_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
