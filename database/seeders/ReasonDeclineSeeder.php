<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\reasonDecline; 

class ReasonDeclineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        reasonDecline::factory(10)->create();
    }
}
