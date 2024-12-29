<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create("blog_comment", function (Blueprint $table): void {
            $table->id();
            $table->string("content", 1000)->nullable(false);
            $table->dateTime("createdDate")->nullable(false);
            
            $table->bigInteger("blogId")->unsigned()->nullable(false);
            $table->bigInteger("customerId")->unsigned()->nullable(false);

            $table->foreign("blogId")->references("id")->on("blog")
            ->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("customerId")->references("id")->on("customer")
            ->onUpdate("cascade")->onDelete("cascade");
        });
    }

    public function down(): void{
        Schema::dropIfExists("blog_comment");
    }
};
