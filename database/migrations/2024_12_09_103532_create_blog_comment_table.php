<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create("blog_comment", function (Blueprint $table) {
            $table->id();
            $table->string("content", 255)->nullable(false);
            $table->dateTime("createdDate")->nullable(false);
            $table->bigInteger("customerId")->unsigned()->nullable(false);

            $table->foreign("customerId")->references("id")->on("customer")
            ->onUpdate("cascade")->onDelete("cascade");
        });
    }

    public function down(): void{
        Schema::dropIfExists("blog_comment");
    }
};
