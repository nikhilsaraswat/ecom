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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product');
            $table->string('slug');
            $table->integer('category_id_subcategory_id_array');
            $table->string('productshortdescription');
            $table->string('description');
            $table->string('image');
            $table->text('images');
            $table->text('tag');
            $table->integer('sellingPrice');
            $table->integer('actualPrice');
            $table->integer('percentage');
            $table->string('producttype');
            //new
            $table->string('preordraft');
            $table->string('virtual');
            $table->string('downloadable');
            $table->string('fromdate');
            $table->string('todate');
            $table->string('producturl');
            $table->string('buttontext');
            $table->string('sku');
            $table->string('stockmanagement');
            $table->string('stockstatus');
            $table->string('soldind');
            $table->string('initnostock');
            $table->string('wtkg');
            $table->string('product_dimension_array');
            $table->string('productship');
            $table->string('upsell');
            $table->string('xsell');
            $table->string('groupsell');
            $table->string('attributes_array');
            $table->string('purchasenote');
            $table->string('menuorder');
            $table->string('facebooksync');
            $table->string('facebookdescription');
            $table->string('facebookimage');
            $table->string('customimage');
            $table->string('customeimageurl');
            $table->string('facebookprice');
            $table->string('productvariation_array');
            $table->string('statustype');
            $table->string('visiblity_array');
            $table->string('publishimorcustom_array');
            $table->string('cat_visibility');
            $table->string('featured');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
