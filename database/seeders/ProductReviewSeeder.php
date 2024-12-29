<?php

namespace Database\Seeders;

use App\Models\ProductReview;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductReviewSeeder extends Seeder{
    public function run(): void{
        ProductReview::factory()->count(100)->state(fn(array $attribute): array => [
            "content" => fake()->paragraph(10),
            "rate" => rand(0, 5),
            "createdDate" => fake()->date("Y-m-d H:i:s"),
            "productId" => rand(1, 200),
            "customerId" => rand(1, 2)
        ])->create();
    }
}
