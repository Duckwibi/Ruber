<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\MyFunction\Utilities;
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
            "lastName" => fake()->lastName(),
            "loginKey" => Utilities::getRandomKey(64),
        ])->sequence(
            fn(Sequence $sequence): array => [
                "name" => "DucTran",
                "email" => "greenfoxna@gmail.com"
            ],
            fn(Sequence $sequence): array => [
                "name" => "TranDuc",
                "email" => "blackfoxna@gmail.com"
            ]
        )->create();
    }
}
