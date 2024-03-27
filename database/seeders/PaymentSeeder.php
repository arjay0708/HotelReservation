<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Example data for payment table
        DB::table('payment')->insert([
            'payment_id' => Str::random(10),
            'amount' => '100.00',
            'customer_email' => 'customer@example.com',
            'payment_status' => 'completed',
            'payment_method' => 'credit_card',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
}
}
