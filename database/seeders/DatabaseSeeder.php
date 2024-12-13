<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{
    public function run(): void{
        $this->call([
            CustomerSeeder::class,
            MenuSeeder::class,
            AdminSeeder::class,
            BlogCategorySeeder::class,
            TagSeeder::class,
            ArchiveSeeder::class,
            BlogSeeder::class,
            BlogCommentSeeder::class,
            BlogTagSeeder::class,
        ]);
    }
}
