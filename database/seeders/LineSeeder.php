<?php

namespace Database\Seeders;

use App\Models\LineMachine;
use App\Models\MachineLine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpParser\Node\Stmt\Foreach_;

class LineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lines = [[
            'name' => 'OT MACHINING'
        ]];

        foreach ($lines as $line) {
            MachineLine::create($line);
        }
    }
}
