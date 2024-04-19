<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReasonBackOut;

class ReasonBackOutSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ReasonBackOut::factory(5)->create();
    }
}
