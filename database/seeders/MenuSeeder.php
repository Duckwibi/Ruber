<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder{
    public function run(): void{
        Menu::factory()->count(19)->state(fn(array $attribute): array => [
            "name" => "Menu",
            "url" => "#",
            "parentId" => 0,
            "level" => 1,
            "order" => 1,
            "type" => 1,
        ])->sequence(
            fn(Sequence $sequence): array => [
                "name" => "Home",
            ],
            fn(Sequence $sequence): array => [
                "name" => "Product",
                "order" => 2,
                "type" => 2,
            ],
            fn(Sequence $sequence): array => [
                "name" => "Blog",
                "order" => 3,
                "type" => 3,
            ],
            fn(Sequence $sequence): array => [
                "name" => "Account",
                "order" => 4,
                "type" => 2
            ],
            fn(Sequence $sequence): array => [
                "name" => "Login",
                "url" => "/Customer/Authenticate/LoginPage",
                "parentId" => 4,
                "level" => 2,
                "order" => 1,
            ],
            fn(Sequence $sequence): array => [
                "name" => "Register",
                "url" => "/Customer/Authenticate/RegisterPage",
                "parentId" => 4,
                "level" => 2,
                "order" => 2,
            ],
            fn(Sequence $sequence): array => [
                "name" => "Profile",
                "parentId" => 4,
                "level" => 2,
                "order" => 3,
            ],
            fn(Sequence $sequence): array => [
                "parentId" => 2,
                "level" => 2,
                "order" => 1,
            ],
            fn(Sequence $sequence): array => [
                "parentId" => 2,
                "level" => 2,
                "order" => 2,
            ],
            fn(Sequence $sequence): array => [
                "parentId" => 2,
                "level" => 2,
                "order" => 3,
            ],
            fn(Sequence $sequence): array => [
                "parentId" => 2,
                "level" => 2,
                "order" => 4,
            ],
            fn(Sequence $sequence): array => [
                "parentId" => 2,
                "level" => 2,
                "order" => 5,
            ],
            fn(Sequence $sequence): array => [
                "parentId" => 2,
                "level" => 2,
                "order" => 6,
            ],
            fn(Sequence $sequence): array => [
                "name" => "Blog Category",
                "parentId" => 3,
                "level" => 2,
                "order" => 1,
            ],
            fn(Sequence $sequence): array => [
                "parentId" => 14,
                "level" => 3,
                "order" => 1,
            ],
            fn(Sequence $sequence): array => [
                "parentId" => 14,
                "level" => 3,
                "order" => 2,
            ],
            fn(Sequence $sequence): array => [
                "parentId" => 14,
                "level" => 3,
                "order" => 3,
            ],
            fn(Sequence $sequence): array => [
                "parentId" => 14,
                "level" => 3,
                "order" => 4,
            ],
            fn(Sequence $sequence): array => [
                "parentId" => 14,
                "level" => 3,
                "order" => 5,
            ],
        )->create();
    }
}
