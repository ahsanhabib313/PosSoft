<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('manufacture')->nullable();
            $table->string('productName')->nullable();
            $table->string('photo')->nullable();
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('company_id')->nullable();
            $table->double('productWeight')->nullable();
            $table->string('productWeightUnit')->nullable();
            $table->double('buyingPrice')->nullable();
            $table->double('retailPrice')->nullable();
            $table->double('wholesalePrice')->nullable();
            $table->double('quantity')->nullable();   
            $table->string('productQuantityUnit')->nullable();   
            $table->integer('alertQuantity')->nullable();
            $table->bigInteger('barCode')->nullable();
            $table->date('expireDate')->nullable();
            $table->date('produceDate')->nullable();
            $table->double('retailProfit')->nullable();
            $table->double('wholesaleProfit')->nullable();

            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
