<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder{
    public function run(): void{
        BlogCategory::factory()->count(5)->state(fn(array $attribute): array => [
            "name" => fake()->name(),
            "menuId" => 11
        ])->sequence(
            fn(Sequence $sequence): array => [
                "name" => "Dinning & Kitchen",
            ],
            fn(Sequence $sequence): array => [
                "name" => "Funiture",
                "menuId" => 12
            ],
            fn(Sequence $sequence): array => [
                "name" => "Home Décor",
                "menuId" => 13
            ],
            fn(Sequence $sequence): array => [
                "name" => "Life Style",
                "menuId" => 14
            ],
            fn(Sequence $sequence): array => [
                "name" => "Office",
                "menuId" => 15
            ]
        )->create();
    }
}
