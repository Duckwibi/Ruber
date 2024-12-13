<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder{
    public function run(): void{
        Blog::factory()->count(50)->state(fn(array $attribute): array => [
            "title" => fake()->randomElement([
                "Easy Fixes for Home Decor",
                "How to Make your Home a Showplace",
                "Stunning Furniture with Aesthetic Appeal",
                "How To Choose The Right Sectional Sofa"
            ]),
            "content" => fake()->paragraph(100),
            "isService" => false,
            "createdDate" => fake()->date("Y-m-d H:i:s"),
            "image" => fake()->randomElement([
                "/storage/BlogImageUpload/1.jpg",
                "/storage/BlogImageUpload/2.jpg",
                "/storage/BlogImageUpload/3.jpg",
                "/storage/BlogImageUpload/4.jpg",
                "/storage/BlogImageUpload/5.jpg",
                "/storage/BlogImageUpload/6.jpg",
                "/storage/BlogImageUpload/7.jpg",
            ]),
            "blogCategoryId" => rand(1, 5),
            "adminId" => rand(1, 2)
        ])->create();
    }
}
