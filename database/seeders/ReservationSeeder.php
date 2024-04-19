<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;

class ReservationSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Reservation::factory(5)->create();
    }
}