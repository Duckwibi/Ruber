<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder{
    public function run(): void{
        Cart::factory()->count(3)->state(fn(array $attribute): array => [
            "customerId" => 1,
            "productId" => 1,
            "quantity" => 3,
            "createdDate" => date("Y-m-d H:i:s")
        ])->sequence(
            fn(Sequence $sequence): array => [],
            fn(Sequence $sequence): array => ["productId" => 2],
            fn(Sequence $sequence): array => ["productId" => 3],
        )->create();
    }
}
