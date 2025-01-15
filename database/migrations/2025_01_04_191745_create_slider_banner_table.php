<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create("slider_banner", function (Blueprint $table): void{
            $table->id();
            $table->string("image", 1000)->nullable(false);
            $table->string("url", 1000)->nullable(false);
            $table->string("subTitle", 255)->nullable(false);
            $table->string("title", 255)->nullable(false);
            $table->string("description", 1000)->nullable(false);
            $table->integer("order")->nullable(false);
        });
    }

    public function down(): void{
        Schema::dropIfExists("slider_banner");
    }
};
