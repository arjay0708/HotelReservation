<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class user_verify extends Seeder
{
    public function run()
    {
        // Example data for user_verify table
        DB::table('user_verify')->insert([
            'user_id' => 1, // Assuming you have a user with ID 1
            'token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // You can add more entries as needed
    }
}
