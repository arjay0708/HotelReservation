<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserVerify;

class UserVerifySeeder extends Seeder
{
    public function run()
    {
        UserVerify::factory()->count(5)->create();
    }
}
