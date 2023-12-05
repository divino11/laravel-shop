<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_product', function (Blueprint $table) {
            $table->dropColumn(['order_height', 'order_size']);
        });

        Schema::table('order_product', function (Blueprint $table) {
            $table->unsignedBigInteger('order_size');
            $table->unsignedBigInteger('order_color');
            $table->unsignedBigInteger('quantity');

            $table->foreign('order_size')
                ->references('id')
                ->on('sizes')
                ->onDelete('cascade');
            $table->foreign('order_color')
                ->references('id')
                ->on('colors')
                ->onDelete('cascade');
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
            $table->dropColumn([
                'order_size',
                'order_color',
                'quantity'
            ]);
        });
    }
};
