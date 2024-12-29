<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create("menu", function (Blueprint $table): void {
            $table->id();
            $table->string("name", 255)->nullable(false);
            $table->string("url", 1000)->nullable(false);
            $table->integer("parentId")->nullable(false);
            $table->integer("level")->nullable(false);
            $table->integer("order")->nullable(false);
            $table->integer("type")->nullable(false);
        });
    }

    public function down(): void{
        Schema::dropIfExists("menu");
    }
};
