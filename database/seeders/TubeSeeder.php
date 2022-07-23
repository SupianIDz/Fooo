<?php

namespace Database\Seeders;

use App\Models\Tube;
use Illuminate\Database\Seeder;

class TubeSeeder extends Seeder
{
    public function run()
    {
        Tube::factory()->count(2)->create();
    }
}
