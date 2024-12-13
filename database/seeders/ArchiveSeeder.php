<?php

namespace Database\Seeders;

use App\Models\Archive;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ArchiveSeeder extends Seeder{
    public function run(): void{
        Archive::factory()->count(3)->state(fn(array $attribute): array => [
            "archiveDate" => fake()->date("Y-m-d")
        ])->sequence(
            fn(Sequence $sequence): array => [
                "archiveDate" => date("Y-m-d", strtotime("2020-7-12"))
            ],
            fn(Sequence $sequence): array => [
                "archiveDate" => date("Y-m-d", strtotime("2015-5-23"))
            ],
            fn(Sequence $sequence): array => [
                "archiveDate" => date("Y-m-d", strtotime("2010-12-9"))
            ]
        )->create();
    }
}
