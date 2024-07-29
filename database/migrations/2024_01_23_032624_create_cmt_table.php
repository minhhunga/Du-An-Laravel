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
        Schema::create('cmt', function (Blueprint $table) {
            $table->id();
            $table->string('cmt');
            $table->unsignedInteger('id_blog');
            $table->unsignedInteger('id_user');
            $table->string('avatar');
            $table->string('name');
            $table->unsignedInteger('level')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cmt');
    }
};
