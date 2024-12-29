<?php

namespace Database\Seeders;

use App\Models\PriceFilter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class PriceFilterSeeder extends Seeder{
    public function run(): void{
        PriceFilter::factory()->count(9)->state(fn(array $attribute): array => [
            "name" => fake()->name(),
            "min" => 0,
            "max" => 1000000,
            "order" => 1,
        ])->sequence(
            fn(Sequence $sequence): array => [
                "name" => "0 VND - 1.000.000 VND",
            ],
            fn(Sequence $sequence): array => [
                "name" => "1.000.000 VND - 2.000.000 VND",
                "min" => 1000000,
                "max" => 2000000,
                "order" => 2,
            ],
            fn(Sequence $sequence): array => [
                "name" => "2.000.000 VND - 3.000.000 VND",
                "min" => 2000000,
                "max" => 3000000,
                "order" => 3,
            ],
            fn(Sequence $sequence): array => [
                "name" => "3.000.000 VND - 4.000.000 VND",
                "min" => 3000000,
                "max" => 4000000,
                "order" => 4,
            ],
            fn(Sequence $sequence): array => [
                "name" => "4.000.000 VND - 5.000.000 VND",
                "min" => 4000000,
                "max" => 5000000,
                "order" => 5,
            ],
            fn(Sequence $sequence): array => [
                "name" => "5.000.000 VND - 6.000.000 VND",
                "min" => 5000000,
                "max" => 6000000,
                "order" => 6,
            ],
            fn(Sequence $sequence): array => [
                "name" => "6.000.000 VND - 7.000.000 VND",
                "min" => 6000000,
                "max" => 7000000,
                "order" => 7,
            ],
            fn(Sequence $sequence): array => [
                "name" => "7.000.000 VND - 8.000.000 VND",
                "min" => 7000000,
                "max" => 8000000,
                "order" => 8,
            ],
            fn(Sequence $sequence): array => [
                "name" => "8.000.000 VND - 9.000.000 VND",
                "min" => 8000000,
                "max" => 9000000,
                "order" => 9,
            ]
        )->create();
    }
}
