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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable()->default('text');
            $table->string('slug', 100)->nullable()->default('text');
            $table->text('description');
            $table->string('image', 100)->nullable()->default('text');
            $table->integer('price')->nullable()->default(0);
            $table->integer('stock')->nullable()->default(0);
            $table->unsignedBigInteger('category_id')->nullable()->default(0);

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
