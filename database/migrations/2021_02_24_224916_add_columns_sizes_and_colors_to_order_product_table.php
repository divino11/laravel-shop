<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsSizesAndColorsToOrderProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_product', function (Blueprint $table) {
            $table->string('order_height')->default('')->after('product_id');
            $table->string('order_size')->default('')->after('order_height');
            $table->string('order_price')->default('')->after('order_size');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_product', function (Blueprint $table) {
            $table->dropColumn('order_height');
            $table->dropColumn('order_size');
            $table->dropColumn('order_price');
        });
    }
}
