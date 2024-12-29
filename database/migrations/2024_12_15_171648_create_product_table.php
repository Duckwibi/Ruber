<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create("product", function (Blueprint $table): void {
            $table->id();
            $table->string("name", 255)->nullable(false);
            $table->integer("quantity")->nullable(false);
            $table->double("price")->nullable(false);
            $table->integer("sale")->nullable(false);
            $table->text("content")->nullable(false);
            $table->text("description")->nullable(false);
            $table->string("image", 1000)->nullable(false);
            $table->string("imageHover", 1000)->nullable(false);
            $table->dateTime("createdDate")->nullable(false);
            $table->bigInteger("productCategoryId")->unsigned()->nullable(false);
            $table->bigInteger("brandId")->unsigned()->nullable(false);

            $table->foreign("productCategoryId")->references("id")->on("product_category")
            ->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("brandId")->references("id")->on("brand")
            ->onUpdate("cascade")->onDelete("cascade");
        });
    }

    public function down(): void{
        Schema::dropIfExists("product");
    }
};
