<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create("blog", function (Blueprint $table): void {
            $table->id();
            $table->string("title", 255)->nullable(false);
            $table->text("content")->nullable(false);
            $table->boolean("isService")->nullable(false);
            $table->dateTime("createdDate")->nullable(false);
            $table->string("image", 1000)->nullable(false);

            $table->bigInteger("blogCategoryId")->unsigned()->nullable(false);
            $table->bigInteger("adminId")->unsigned()->nullable(false);
            
            $table->foreign("blogCategoryId")->references("id")->on("blog_category")
            ->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("adminId")->references("id")->on("admin")
            ->onUpdate("cascade")->onDelete("cascade");
        });
    }

    public function down(): void{
        Schema::dropIfExists("blog");
    }
};
