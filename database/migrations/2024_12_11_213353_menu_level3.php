<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        DB::unprepared("
            create or replace view menu_level3 as 
                select * from menu where level = 3
        ");
    }

    public function down(): void{
        DB::unprepared("drop view if exists menu_level3");
    }
};
