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
            $table->string('color')->default('')->after('count');
            $table->string('xs')->default(0)->after('color');
            $table->string('s')->default(0)->after('xs');
            $table->string('m')->default(0)->after('s');
            $table->string('l')->default(0)->after('m');
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
            $table->dropColumn('color');
            $table->dropColumn('xs');
            $table->dropColumn('s');
            $table->dropColumn('m');
            $table->dropColumn('l');
        });
    }
}
