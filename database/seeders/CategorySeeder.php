<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            [
                'name' => 'Chest'
            ],
            [
                'name' => 'Back'
            ],
            [
                'name' => 'Shoulder'
            ],
            [
                'name' => 'Biceps'
            ],
            [
                'name' => 'Triceps'
            ],
            [
                'name' => 'Legs'
            ],
        ]);
    }
}
