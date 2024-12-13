<?php

namespace Database\Seeders;

use App\Models\BlogTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class BlogTagSeeder extends Seeder{
    public function run(): void{
        BlogTag::factory()->count(10)->state(fn(array $attribute): array => [
            "blogId" => 1,
            "tagId" => 1,
        ])->sequence(
            fn(Sequence $sequence): array => [],
            fn(Sequence $sequence): array => ["blogId" => 2],
            fn(Sequence $sequence): array => ["blogId" => 3],
            fn(Sequence $sequence): array => ["blogId" => 4],
            fn(Sequence $sequence): array => ["blogId" => 5],
            fn(Sequence $sequence): array => ["blogId" => 6],
            fn(Sequence $sequence): array => ["blogId" => 7],
            fn(Sequence $sequence): array => ["blogId" => 8],
            fn(Sequence $sequence): array => ["blogId" => 9],
            fn(Sequence $sequence): array => ["blogId" => 10]
        )->create();
    }
}
