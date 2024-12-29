<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder{
    public function run(): void{
        ProductCategory::factory()->count(6)->state(fn(array $attribute): array => [
            "name" => fake()->name(),
            "menuId" => 8
        ])->sequence(
            fn(Sequence $sequence): array => [
                "name" => "Bed & Bath"
            ],
            fn(Sequence $sequence): array => [
                "name" => "Furniture",
                "menuId" => 9
            ],
            fn(Sequence $sequence): array => [
                "name" => "Home Décor",
                "menuId" => 10
            ],
            fn(Sequence $sequence): array => [
                "name" => "Lighting",
                "menuId" => 11
            ],
            fn(Sequence $sequence): array => [
                "name" => "Office",
                "menuId" => 12
            ],
            fn(Sequence $sequence): array => [
                "name" => "Outdoor",
                "menuId" => 13
            ]
        )->create();
    }
}
