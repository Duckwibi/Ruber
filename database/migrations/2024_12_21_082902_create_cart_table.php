<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create("cart", function (Blueprint $table): void{
            $table->id();
            $table->bigInteger("customerId")->unsigned()->nullable(false);
            $table->bigInteger("productId")->unsigned()->nullable(false);
            $table->integer("quantity")->nullable(false);
            $table->dateTime("createdDate")->nullable(false);

            $table->foreign("productId")->references("id")->on("product")
            ->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("customerId")->references("id")->on("customer")
            ->onUpdate("cascade")->onDelete("cascade");

            $table->unique([
                "customerId",
                "productId"
            ]);
        });
    }

    public function down(): void{
        Schema::dropIfExists("cart");
    }
};
