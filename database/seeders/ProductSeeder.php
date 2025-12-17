<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        for ($j = 1; $j <= 8; $j++) {
            for ($i = 1; $i <= 3; $i++) {

                $gallery = [];
                for ($ii = 0; $ii < rand(0, 7); $ii++) {
                    $gallery[] = 'assets/img/products/' . ($ii + 1) . '.jpeg';
                }
                shuffle($gallery);

                DB::table('products')->insert(
                    [
                        'title' => $title = fake()->unique()->sentence(3),
                        'slug' => str()->slug($title),
                        'category_id' => $j,
                        'price' => $price = rand(50, 1000),
                        'old_price' => fake()->randomElement([0, intval($price * 1.1)]),
                        'short_content' => fake()->paragraph(2),
                        'content' => fake()->paragraphs(3, true),
                        'image' => 'assets/img/products/' . rand(1, 8) . '.jpeg',
                        'gallery' => $gallery ? json_encode($gallery) : null,
                        'is_hit' => rand(0, 1),
                        'is_new' => rand(0, 1),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }

    }
}
