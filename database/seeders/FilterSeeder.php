<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('filter_groups')->insert([
            ['id' => 1, 'title' => 'Color'],
            ['id' => 2, 'title' => 'Size'],
            ['id' => 3, 'title' => 'Thematic'],
        ]);

        DB::table('category_filters')->insert([
            ['category_id' => 1, 'filter_group_id' => 1],
            ['category_id' => 1, 'filter_group_id' => 2],
            ['category_id' => 2, 'filter_group_id' => 1],
            ['category_id' => 2, 'filter_group_id' => 2],
            ['category_id' => 2, 'filter_group_id' => 3],
            ['category_id' => 3, 'filter_group_id' => 1],
            ['category_id' => 3, 'filter_group_id' => 2],
            ['category_id' => 5, 'filter_group_id' => 2],
            ['category_id' => 5, 'filter_group_id' => 3],
        ]);

        DB::table('filters')->insert([
            ['id' => 1, 'title' => 'Green', 'filter_group_id' => 1],
            ['id' => 2, 'title' => 'White', 'filter_group_id' => 1],
            ['id' => 3, 'title' => 'Red', 'filter_group_id' => 1],
            ['id' => 4, 'title' => 'Yellow', 'filter_group_id' => 1],
            ['id' => 5, 'title' => 'Blue', 'filter_group_id' => 1],
            ['id' => 6, 'title' => 'Mixed', 'filter_group_id' => 1],
            ['id' => 7, 'title' => 'Small', 'filter_group_id' => 2],
            ['id' => 8, 'title' => 'Medium', 'filter_group_id' => 2],
            ['id' => 9, 'title' => 'Large', 'filter_group_id' => 2],
            ['id' => 10, 'title' => 'For kids', 'filter_group_id' => 3],
            ['id' => 11, 'title' => 'Home decor', 'filter_group_id' => 3],
            ['id' => 12, 'title' => 'New Year', 'filter_group_id' => 3],
        ]);

        DB::table('filter_products')->insert([
            // category 1
            ['filter_id' => 1, 'product_id' => 1, 'filter_group_id' => 1],
            ['filter_id' => 1, 'product_id' => 2, 'filter_group_id' => 1],
            ['filter_id' => 1, 'product_id' => 4, 'filter_group_id' => 1],
            ['filter_id' => 1, 'product_id' => 6, 'filter_group_id' => 1],
            ['filter_id' => 1, 'product_id' => 7, 'filter_group_id' => 1],
            ['filter_id' => 1, 'product_id' => 9, 'filter_group_id' => 1],
            ['filter_id' => 1, 'product_id' => 10, 'filter_group_id' => 1],
            ['filter_id' => 2, 'product_id' => 5, 'filter_group_id' => 1],
            ['filter_id' => 2, 'product_id' => 8, 'filter_group_id' => 1],
            ['filter_id' => 10, 'product_id' => 1, 'filter_group_id' => 3],
            ['filter_id' => 10, 'product_id' => 2, 'filter_group_id' => 3],
            ['filter_id' => 10, 'product_id' => 4, 'filter_group_id' => 3],
            ['filter_id' => 11, 'product_id' => 2, 'filter_group_id' => 3],
            ['filter_id' => 12, 'product_id' => 5, 'filter_group_id' => 3],

            // category 2
            ['filter_id' => 1, 'product_id' => 11, 'filter_group_id' => 1],
            ['filter_id' => 1, 'product_id' => 12, 'filter_group_id' => 1],
            ['filter_id' => 1, 'product_id' => 14, 'filter_group_id' => 1],
            ['filter_id' => 2, 'product_id' => 15, 'filter_group_id' => 1],
            ['filter_id' => 2, 'product_id' => 18, 'filter_group_id' => 1],
            ['filter_id' => 5, 'product_id' => 11, 'filter_group_id' => 1],
            ['filter_id' => 6, 'product_id' => 12, 'filter_group_id' => 1],
            ['filter_id' => 8, 'product_id' => 14, 'filter_group_id' => 2],
            ['filter_id' => 9, 'product_id' => 15, 'filter_group_id' => 2],

            // category 4
            ['filter_id' => 1, 'product_id' => 21, 'filter_group_id' => 1],
            ['filter_id' => 1, 'product_id' => 22, 'filter_group_id' => 1],
            ['filter_id' => 1, 'product_id' => 24, 'filter_group_id' => 1],
            ['filter_id' => 5, 'product_id' => 21, 'filter_group_id' => 1],
            ['filter_id' => 6, 'product_id' => 22, 'filter_group_id' => 1],
            ['filter_id' => 8, 'product_id' => 24, 'filter_group_id' => 2],
            ['filter_id' => 9, 'product_id' => 23, 'filter_group_id' => 2],
        ]);
    }
}
