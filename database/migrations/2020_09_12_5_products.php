<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->bigInteger('sizeId')->unsigned();
            $table->foreign('sizeId')->references('id')->on('sizes');
            $table->bigInteger('type')->unsigned();
            $table->foreign('type')->references('id')->on('types');
            $table->bigInteger('subType')->unsigned();
            $table->foreign('subType')->references('id')->on('types');
            $table->string('color');
            $table->decimal('price', 4, 2);
            $table->integer('stock');
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
