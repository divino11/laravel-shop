<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsWithPDFToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('a4_file')->nullable()->after('status');
            $table->string('plotter_file')->nullable()->after('a4_file');
            $table->string('description_file')->nullable()->after('plotter_file');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('a4_file');
            $table->dropColumn('plotter_file');
            $table->dropColumn('description_file');
        });
    }
}
