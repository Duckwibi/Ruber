<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder{
    public function run(): void{
        Menu::factory()->count(9)->state([
            "name" => "Menu",
            "url" => "#",
            "parentId" => 0,
            "level" => 1,
            "order" => 1,
            "type" => 1,
        ])->sequence(
            [
                "name" => "Home",
                "order" => 1,
                "type" => 4,
            ],
            [
                "name" => "Product",
                "order" => 2,
                "type" => 2,
            ],
            [
                "name" => "Blog",
                "order" => 3,
                "type" => 3,
            ],
            [
                "name" => "Account",
                "order" => 4,
                "type" => 2,
            ],
            [
                "name" => "Register",
                "url" => "/Customer/Authenticate/RegisterPage",
                "parentId" => 4,
                "level" => 2,
                "order" => 1,
            ],
            [
                "name" => "Login",
                "url" => "/Customer/Authenticate/LoginPage",
                "parentId" => 4,
                "level" => 2,
                "order" => 2,
            ],
            [
                "name" => "Profile",
                "parentId" => 4,
                "level" => 2,
                "order" => 3,
            ],
            [
                "name" => "Demo1",
                "parentId" => 7,
                "level" => 3,
                "order" => 1,
            ],
            [
                "name" => "Demo2",
                "parentId" => 7,
                "level" => 3,
                "order" => 2,
            ],
        )->create();
    }
}
