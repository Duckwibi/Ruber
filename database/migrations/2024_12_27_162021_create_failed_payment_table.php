<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create("failed_payment", function (Blueprint $table): void{
            $table->id();
            $table->dateTime("createdDate")->nullable(false);
            $table->string("amount")->nullable(false);
            $table->string("bankCode", 255)->nullable(false);
            $table->string("bankTranNo", 255)->nullable(false);
            $table->string("cardType", 255)->nullable(false);
            $table->string("orderInfo", 255)->nullable(false);
            $table->string("payDate")->nullable(false);
            $table->string("responseCode", 255)->nullable(false);
            $table->string("tmnCode", 255)->nullable(false);
            $table->string("transactionNo", 255)->nullable(false);
            $table->string("transactionStatus", 255)->nullable(false);
            $table->string("txnRef", 255)->nullable(false);
            $table->boolean("isRefunded")->nullable(false);
        });
    }
    public function down(): void{
        Schema::dropIfExists("failed_payment");
    }
};
