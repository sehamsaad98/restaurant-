<?php

namespace Database\Seeders;

use App\Models\Trader;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TraderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        
        Trader::factory()->count(10)->create();


    }
}
