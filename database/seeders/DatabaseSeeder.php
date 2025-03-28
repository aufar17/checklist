<?php

namespace Database\Seeders;

use App\Models\Hydrant;
use App\Models\Inspection;
use App\Models\Machine\Machine;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            HydrantGroupSeeder::class,
            HydrantItemSeeder::class,
            MachineItemSeeder::class,
            MachineGroupSeeder::class,
            MachineSeeder::class,
            LineSeeder::class,
            MakerSeeder::class,
        ]);
    }
}
