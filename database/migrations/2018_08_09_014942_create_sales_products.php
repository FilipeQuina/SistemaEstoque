<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_products', function (Blueprint $table) {
            $table->integer('sales_id')->unsigned();
            $table->foreign('sales_id')->references('id')->on('sales');
            $table->integer('products_id')->unsigned();
            $table->foreign('products_id')->references('id')->on('products');
            $table->integer('quantity')->unsigned();
            $table->integer('amountItem')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_products');
    }
}
