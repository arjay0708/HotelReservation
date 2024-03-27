<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class reasonDeclineTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reason_decline_table')->insert([
            'reservation_id' => 1,
            'user_id' => 1,
            'reason' => 'No availability',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
