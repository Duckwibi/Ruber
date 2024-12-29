<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create("product_review", function (Blueprint $table): void {
            $table->id();
            $table->string("content", 1000)->nullable(false);
            $table->integer("rate")->nullable(false);
            $table->dateTime("createdDate")->nullable(false);
            $table->bigInteger("productId")->unsigned()->nullable(false);
            $table->bigInteger("customerId")->unsigned()->nullable(false);

            $table->foreign("productId")->references("id")->on("product")
            ->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("customerId")->references("id")->on("customer")
            ->onUpdate("cascade")->onDelete("cascade");
        });
    }

    public function down(): void{
        Schema::dropIfExists("product_review");
    }
};
