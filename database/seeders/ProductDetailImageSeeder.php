<?php

namespace Database\Seeders;

use App\Models\ProductDetailImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ProductDetailImageSeeder extends Seeder{
    public function run(): void{
        ProductDetailImage::factory()->count(5)->state(fn(array $attribute): array => [
            "image" => fake()->imageUrl(),
            "order" => 1,
            "productId" => 1,
        ])->sequence(
            fn(Sequence $sequence): array => [
                "image" => "/storage/ProductDetailImageUpload/1.jpg",
                "order" => 1
            ],
            fn(Sequence $sequence): array => [
                "image" => "/storage/ProductDetailImageUpload/1-2.jpg",
                "order" => 2,
            ],
            fn(Sequence $sequence): array => [
                "image" => "/storage/ProductDetailImageUpload/9.jpg",
                "order" => 3,
            ],
            fn(Sequence $sequence): array => [
                "image" => "/storage/ProductDetailImageUpload/9-2.jpg",
                "order" => 4,
            ],
            fn(Sequence $sequence): array => [
                "image" => "/storage/ProductDetailImageUpload/9-3.jpg",
                "order" => 5,
            ],
        )->create();
    }
}
