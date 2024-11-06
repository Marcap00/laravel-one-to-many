<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            "Frontend",
            "Backend",
            "Fullstack",
            "Mobile",
            "Desktop",
            "Database",
            "Testing",
            "CyberSec",
        ];

        foreach ($names as $name) {
            Type::create([
                'name' => $name,
            ]);
        }
    }
}