<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create("admin", function (Blueprint $table) {
            $table->id();
            $table->string("name", 255)->unique()->nullable(false);
            $table->string("email", 255)->unique()->nullable(false);
            $table->string("password", 255)->nullable(false);
            $table->rememberToken();
            $table->string("firstName", 255)->nullable(false);
            $table->string("lastName", 255)->nullable(false);
        });
    }

    public function down(): void{
        Schema::dropIfExists("admin");
    }
};
