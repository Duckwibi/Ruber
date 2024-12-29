<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create("coupon_code", function (Blueprint $table): void{
            $table->id();
            $table->string("name", 64)->unique()->nullable(false);
            $table->integer("sale")->nullable(false);
            $table->dateTime("expiredDate")->nullable(false);
        });
    }

    public function down(): void{
        Schema::dropIfExists("coupon_code");
    }
};
