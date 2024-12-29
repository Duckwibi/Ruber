<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create("product_detail_image", function (Blueprint $table): void {
            $table->id();
            $table->string("image", 1000)->nullable(false);
            $table->integer("order")->nullable(false);
            $table->bigInteger("productId")->unsigned()->nullable(false);

            $table->foreign("productId")->references("id")->on("product")
            ->onUpdate("cascade")->onDelete("cascade");
        });
    }

    public function down(): void{
        Schema::dropIfExists("product_detail_image");
    }
};
