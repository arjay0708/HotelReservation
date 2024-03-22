<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
        Schema::create('usertable', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('photos');
            $table->string('lastname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('extention')->nullable();
            $table->string('email');
            $table->string('phoneNumber')->nullable();
            $table->date('birthday')->nullable();
            $table->string('age')->nullable();
            $table->string('password');
            $table->integer('is_active');
            $table->integer('is_admin');
            $table->tinyInteger('email_verified')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        //
    }
};
