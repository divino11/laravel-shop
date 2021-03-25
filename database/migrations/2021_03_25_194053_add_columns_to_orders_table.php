<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('firstname')->after('name')->nullable();
            $table->string('lastname')->after('firstname')->nullable();
            $table->string('city')->after('lastname')->nullable();
            $table->string('house')->after('city')->nullable();
            $table->string('building')->after('house')->nullable();
            $table->string('room')->after('building')->nullable();
            $table->string('type_delivery')->after('room')->nullable();
            $table->string('type_pay')->after('type_delivery')->nullable();
            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('firstname');
            $table->dropColumn('lastname');
            $table->dropColumn('city');
            $table->dropColumn('house');
            $table->dropColumn('building');
            $table->dropColumn('room');
            $table->dropColumn('type_delivery');
            $table->dropColumn('type_pay');
            $table->string('name')->after('status')->nullable();
        });
    }
}
