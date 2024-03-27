<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class reasonBackOutTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reason_back_out_table')->insert([
            [
                'reservation_id' => 1,
                'user_id' => 1,
                'reason' => 'No availability',
                'set_by_admin' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more records as needed
        ]);
    }
}
