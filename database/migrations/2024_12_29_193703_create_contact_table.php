<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create("contact", function (Blueprint $table): void{
            $table->id();
            $table->string("name", 255)->nullable(false);
            $table->string("email", 255)->nullable(false);
            $table->string("message", 2000)->nullable(false);
            $table->dateTime("createdDate")->nullable(false);
        });
    }

    public function down(): void{
        Schema::dropIfExists("contact");
    }
};
