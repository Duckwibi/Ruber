<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create("blog", function (Blueprint $table) {
            $table->id();
            $table->string("title", 255)->nullable(false);
            $table->text("Content")->nullable(false);
            $table->dateTime("createdDate")->nullable(false);
            $table->boolean("isService")->nullable(false);
        });
    }

    public function down(): void{
        Schema::dropIfExists("blog");
    }
};
