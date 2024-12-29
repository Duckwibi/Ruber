<?php

namespace Database\Seeders;

use App\Models\CouponCode;
use App\MyFunction\Utilities;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class CouponCodeSeeder extends Seeder{
    public function run(): void{
        CouponCode::factory()->count(3)->state(fn(array $attribute): array => [
            "name" => Utilities::getRandomKey(64),
            "sale" => rand(0, 100),
            "expiredDate" => date("Y-m-d H:i:s", strtotime("+30 minutes"))
        ])->create();
    }
}
