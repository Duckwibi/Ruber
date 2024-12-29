<?php

namespace Database\Seeders;

use App\Models\Wishlist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class WishlistSeeder extends Seeder{
    public function run(): void{
        Wishlist::factory()->count(3)->state(fn(array $attribute): array => [
            "customerId" => 1,
            "productId" => 1,
            "createdDate" => fake()->date("Y-m-d H:i:s")
        ])->sequence(
            fn(Sequence $sequence): array => [],
            fn(Sequence $sequence): array => ["productId" => 2],
            fn(Sequence $sequence): array => ["productId" => 3],
        )->create();
    }
}
