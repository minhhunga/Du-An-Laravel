<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::table('user', function (Blueprint $table) {
             $table->string('phone')->after('Password')->nullable();
             $table->string('address')->after('phone')->nullable();
             $table->integer('id_country')->after('address')->nullable();
             $table->string('avatar')->after('id_country')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {
            //
        });
    }
};
