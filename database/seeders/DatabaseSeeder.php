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
            ProductCategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
            ProductDetailImageSeeder::class,
            ProductReviewSeeder::class,
            PriceFilterSeeder::class,
            CartSeeder::class,
            WishlistSeeder::class,
            CouponCodeSeeder::class,
            OrderSeeder::class,
            OrderDetailSeeder::class,
        ]);
    }
}
