<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create("brand", function (Blueprint $table): void {
            $table->id();
            $table->string("name", 255)->unique()->nullable(false);
            $table->string("image", 1000)->nullable(false);
        });
    }

    public function down(): void{
        Schema::dropIfExists("brand");
    }
};
