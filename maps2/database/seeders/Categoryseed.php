<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Categoryseed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Category::factory(5)->create();

           \App\Models\Category::factory(3)->create();

           \App\Models\Category::factory()->create([
            'name' => ['sport','food','box']
            
        ]);
    }
}
