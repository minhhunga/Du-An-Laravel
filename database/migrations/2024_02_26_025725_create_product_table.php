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
        Schema::create('product', function (Blueprint $table) {
              $table->id();
        $table->unsignedBigInteger('id_user');
        $table->string('name');
        $table->string('price');
        $table->unsignedBigInteger('id_category');
        $table->unsignedBigInteger('id_brand');
        $table->string('status');
        $table->string('sale');
        $table->string('company');
        $table->string('img'); 
        $table->string('detail');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
