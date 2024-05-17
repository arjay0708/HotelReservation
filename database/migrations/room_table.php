<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roomTable', function (Blueprint $table) {
            $table->id('room_id');
            $table->string('photos');
            $table->string('room_number');
            $table->string('floor');
            $table->string('type_of_room');
            $table->string('number_of_bed');
            $table->string('details');
            $table->string('max_person');
            $table->float('price_per_hour');
            $table->integer('is_available');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        //
    }
};
