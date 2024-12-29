<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create("price_filter", function (Blueprint $table): void {
            $table->id();
            $table->string("name", 255)->nullable(false);
            $table->double("min")->nullable(false);
            $table->double("max")->nullable(false);
            $table->integer("order")->nullable(false);
        });
    }

    public function down(): void{
        Schema::dropIfExists("price_filter");
    }
};
