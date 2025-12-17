<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['title' => 'Men', 'slug' => 'men', 'parent_id' => 0],
            ['title' => 'Women', 'slug' => 'women', 'parent_id' => 0],
            ['title' => 'Children', 'slug' => 'children', 'parent_id' => 0],
            ['title' => 'Dogs', 'slug' => 'dogs', 'parent_id' => 0],
            ['title' => 'Cats', 'slug' => 'cats', 'parent_id' => 0],
            ['title' => 'Gold Glamur', 'slug' => 'gold-glamur', 'parent_id' => 2],
            ['title' => 'Strong power', 'slug' => 'strong-power', 'parent_id' => 1],
            ['title' => 'Funny bunny', 'slug' => 'funny-bunny', 'parent_id' => 3],
        ]);
    
    }
}
