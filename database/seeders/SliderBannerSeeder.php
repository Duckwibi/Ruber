<?php

namespace Database\Seeders;

use App\Models\SliderBanner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class SliderBannerSeeder extends Seeder{
    public function run(): void{
        SliderBanner::factory()->count(3)->state(fn(array $attribute): array => [
            "image" => fake()->imageUrl(),
            "url" => "#",
            "subTitle" => "20%OFF.END MONDAY",
            "title" => fake()->title(),
            "description" => "Save up to $500 on outdoor packages",
            "order" => 1
        ])->sequence(
            fn(Sequence $sequence): array => [
                "image" => "/storage/SliderBannerImageUpload/1.jpg",
                "title" => "Chair Collection"
            ],
            fn(Sequence $sequence): array => [
                "image" => "/storage/SliderBannerImageUpload/2.jpg",
                "title" => "Interior lighting",
                "order" => 2
            ],
            fn(Sequence $sequence): array => [
                "image" => "/storage/SliderBannerImageUpload/3.jpg",
                "title" => "Home office",
                "order" => 3
            ]
        )->create();
    }
}
