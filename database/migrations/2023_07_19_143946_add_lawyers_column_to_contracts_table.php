<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLawyersColumnToContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->unsignedBigInteger('lawyer_id')->after('user_id')->nullable();
            $table->foreign('lawyer_id')->references('id')->on('lawyers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropForeign(['lawyer_id']);
            $table->dropColumn('lawyer_id');
        });
    }
}
