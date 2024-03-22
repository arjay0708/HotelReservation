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
        Schema::create('reservationTable', function (Blueprint $table) {
            $table->id('reservation_id');
            $table->string('book_code');
            $table->integer('user_id');
            $table->integer('room_id');
            $table->datetime('start_dataTime');
            $table->datetime('end_dateTime');
            $table->string('status');
            $table->string('is_archived');
            $table->integer('is_noted');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        //
    }
};
