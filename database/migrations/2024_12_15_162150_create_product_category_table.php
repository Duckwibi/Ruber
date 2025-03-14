<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create("product_category", function (Blueprint $table): void {
            $table->id();
            $table->string("name", 255)->unique()->nullable(false);
            $table->bigInteger("menuId")->unsigned()->nullable(false);

            $table->foreign("menuId")->references("id")->on("menu")
            ->onUpdate("cascade")->onDelete("cascade");
        });
    }

    public function down(): void{
        Schema::dropIfExists("product_category");
    }
};
