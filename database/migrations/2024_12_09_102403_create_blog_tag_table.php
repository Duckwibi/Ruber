<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create("blog_tag", function (Blueprint $table) {
            $table->id();
            $table->bigInteger("blogId")->unsigned()->nullable(false);
            $table->bigInteger("tagId")->unsigned()->nullable(false);

            $table->foreign("blogId")->references("id")->on("blog")
            ->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("tagId")->references("id")->on("tag")
            ->onUpdate("cascade")->onDelete("cascade");

            $table->unique([
                "blogId",
                "tagId"
            ]);
        });
    }

    public function down(): void{
        Schema::dropIfExists("blog_tag");
    }
};
