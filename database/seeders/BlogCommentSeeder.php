<?php

namespace Database\Seeders;

use App\Models\BlogComment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogCommentSeeder extends Seeder{
    public function run(): void{
        BlogComment::factory()->count(100)->state(fn(array $attribute): array => [
            "content" => fake()->paragraph(10),
            "createdDate" => fake()->date("Y-m-d H:i:s"),
            "blogId" => rand(1, 50),
            "customerId" => rand(1, 2)
        ])->create();
    }
}
