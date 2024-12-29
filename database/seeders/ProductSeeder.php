<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder{
    public function run(): void{
        Product::factory()->count(200)->state(fn(array $attribute): array => [
            "name" => fake()->name(),
            "quantity" => 5,
            "price" => rand(1000000, 9000000),
            "sale" => rand(0, 100),
            "content" => fake()->paragraph(20),
            "description" => fake()->paragraph(50),
            "image" => fake()->imageUrl(),
            "imageHover" => fake()->imageUrl(),
            "createdDate" => fake()->date("Y-m-d H:i:s"),
            "productCategoryId" => rand(1, 6),
            "brandId" => rand(1, 5)
        ])->sequence(
            fn(Sequence $sequence): array => [
                "name" => "Zunkel Schwarz",
                "image" => "/storage/ProductImageUpload/1.jpg",
                "imageHover" => "/storage/ProductImageUpload/1-2.jpg",
            ],
            fn(Sequence $sequence): array => [
                "name" => "Namaste Vase",
                "image" => "/storage/ProductImageUpload/2.jpg",
                "imageHover" => "/storage/ProductImageUpload/2-2.jpg",
            ],
            fn(Sequence $sequence): array => [
                "name" => "Chair Oak Matt Lacquered",
                "image" => "/storage/ProductImageUpload/3.jpg",
                "imageHover" => "/storage/ProductImageUpload/3-2.jpg",
            ],
            fn(Sequence $sequence): array => [
                "name" => "Pillar Dining Table Round",
                "image" => "/storage/ProductImageUpload/4.jpg",
                "imageHover" => "/storage/ProductImageUpload/4-2.jpg",
            ],
            fn(Sequence $sequence): array => [
                "name" => "Amp Pendant Light Large",
                "image" => "/storage/ProductImageUpload/5.jpg",
                "imageHover" => "/storage/ProductImageUpload/5-2.jpg",
            ],
            fn(Sequence $sequence): array => [
                "name" => "Dining Table",
                "image" => "/storage/ProductImageUpload/6.jpg",
                "imageHover" => "/storage/ProductImageUpload/6-2.jpg",
            ],
            fn(Sequence $sequence): array => [
                "name" => "Mags Sofa 2.5 Seater",
                "image" => "/storage/ProductImageUpload/7.jpg",
                "imageHover" => "/storage/ProductImageUpload/7-2.jpg",
            ],
            fn(Sequence $sequence): array => [
                "name" => "Spinning pendant lamp",
                "image" => "/storage/ProductImageUpload/8.jpg",
                "imageHover" => "/storage/ProductImageUpload/8-2.jpg",
            ],
            fn(Sequence $sequence): array => [
                "name" => "Bora Armchair",
                "image" => "/storage/ProductImageUpload/9.jpg",
                "imageHover" => "/storage/ProductImageUpload/9-2.jpg",
            ],
            fn(Sequence $sequence): array => [
                "name" => "Panton Dining Table",
                "image" => "/storage/ProductImageUpload/10.jpg",
                "imageHover" => "/storage/ProductImageUpload/10-2.jpg",
            ],
            fn(Sequence $sequence): array => [
                "name" => "Kittchen Table",
                "image" => "/storage/ProductImageUpload/11.jpg",
                "imageHover" => "/storage/ProductImageUpload/11-2.jpg",
            ],
            fn(Sequence $sequence): array => [
                "name" => "Mundo Sofa With Cushion",
                "image" => "/storage/ProductImageUpload/12.jpg",
                "imageHover" => "/storage/ProductImageUpload/12-2.jpg",
            ],
        )->create();
    }
}
