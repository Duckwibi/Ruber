<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder{
    public function run(): void{
        Brand::factory()->count(5)->state(fn(array $attribute): array => [
            "name" => fake()->name(),
            "image" => fake()->imageUrl()
        ])->sequence(
            fn(Sequence $sequence): array => [
                "name" => "Blash",
                "image" => "/storage/BrandImageUpload/1.jpg"
            ],
            fn(Sequence $sequence): array => [
                "name" => "Minimal",
                "image" => "/storage/BrandImageUpload/2.jpg"
            ],
            fn(Sequence $sequence): array => [
                "name" => "Money Magazine",
                "image" => "/storage/BrandImageUpload/3.jpg"
            ],
            fn(Sequence $sequence): array => [
                "name" => "Beat Sound",
                "image" => "/storage/BrandImageUpload/4.jpg"
            ],
            fn(Sequence $sequence): array => [
                "name" => "Redbox",
                "image" => "/storage/BrandImageUpload/5.jpg"
            ],
        )->create();
    }
}
