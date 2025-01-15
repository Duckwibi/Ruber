<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create("order", function (Blueprint $table): void{
            $table->id();
            $table->string("subId")->nullable(false);
            $table->dateTime("createdDate")->nullable(false);
            $table->boolean("isPaid")->nullable(false);
            $table->boolean("isApproved")->nullable(false);
            $table->boolean("isFromCart")->nullable(false);
            $table->integer("sale")->nullable(false);
            $table->string("firstName", 255)->nullable(false);
            $table->string("lastName", 255)->nullable(false);
            $table->string("phone", 10)->nullable(false);
            $table->string("province", 255)->nullable(false);
            $table->string("district", 255)->nullable(false);
            $table->string("ward", 255)->nullable(false);
            $table->string("street", 1000)->nullable(false);
            $table->string("note", 1000)->nullable(false);
            $table->text("paymentUrl")->nullable(false);
            $table->bigInteger("customerId")->unsigned()->nullable(false);

            $table->foreign("customerId")->references("id")->on("customer")
            ->onUpdate("cascade")->onDelete("cascade");
        });
    }

    public function down(): void{
        Schema::dropIfExists("order");
    }
};
