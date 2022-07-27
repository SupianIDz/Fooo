<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() : void
    {
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@fiber.com',
            'password' => bcrypt('admin'),
        ]);

        $this->call([
            MarkerSeeder::class,
            TubeSeeder::class,
        ]);
    }
}
