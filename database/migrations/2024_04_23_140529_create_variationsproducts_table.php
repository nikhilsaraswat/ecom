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
        Schema::create('variationsproducts', function (Blueprint $table) {
            $table->id();
            $table->string('product');
            $table->string('slug');
            $table->integer('category_id');
            $table->string('category_name');
            $table->integer('subcategory_id');
            $table->string('subcategory_name');
            $table->string('productshortdescription');
            $table->string('description');
            $table->string('image');
            $table->text('images');
            $table->text('tag');
            $table->integer('discount');
            $table->integer('sellingPrice');
            $table->integer('actualPrice');
            $table->integer('percentage');
            $table->string('producttype');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variationsproducts');
    }
};
