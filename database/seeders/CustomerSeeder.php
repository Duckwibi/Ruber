<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder{
    public function run(): void{
        Customer::factory()->count(2)->state(fn(array $attribute): array => [
            "name" => fake()->name(),
            "email" => fake()->email(),
            "password" => Hash::make("1234"),
            "firstName" => fake()->firstName(),
            "lastName" => fake()->lastName()
        ])->sequence(
            fn(Sequence $sequence): array => [
                "name" => "DucTran",
                "email" => "bluefoxna@gmail.com"
            ],
            fn(Sequence $sequence): array => [
                "name" => "TranDuc",
                "email" => "greenfoxna@gmail.com"
            ]
        )->create();
    }
}
