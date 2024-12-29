<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create("order_detail", function (Blueprint $table): void{
            $table->id();
            $table->bigInteger("orderId")->unsigned()->nullable(false);
            $table->bigInteger("productId")->unsigned()->nullable(false);
            $table->integer("quantity")->nullable(false);
            $table->double("price")->nullable(false);
            $table->dateTime("createdDate")->nullable(false);

            $table->foreign("orderId")->references("id")->on("order")
            ->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("productId")->references("id")->on("product")
            ->onUpdate("cascade")->onDelete("cascade");

            $table->unique([
                "orderId",
                "productId"
            ]);
        });
    }

    public function down(): void{
        Schema::dropIfExists("order_detail");
    }
};
