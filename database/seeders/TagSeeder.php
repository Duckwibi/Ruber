<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder{
    public function run(): void{
        Tag::factory()->count(10)->state(fn(array $attribute): array => [
            "name" => fake()->name()
        ])->sequence(
            fn(Sequence $sequence): array => ["name" => "Baber"],
            fn(Sequence $sequence): array => ["name" => "Baby"],
            fn(Sequence $sequence): array => ["name" => "Needs"],
            fn(Sequence $sequence): array => ["name" => "Beauty"],
            fn(Sequence $sequence): array => ["name" => "Cosmetic"],
            fn(Sequence $sequence): array => ["name" => "Electric"],
            fn(Sequence $sequence): array => ["name" => "Fashion"],
            fn(Sequence $sequence): array => ["name" => "Mimimal"],
            fn(Sequence $sequence): array => ["name" => "Simple"],
            fn(Sequence $sequence): array => ["name" => "Sport"],
        )->create();
    }
}
