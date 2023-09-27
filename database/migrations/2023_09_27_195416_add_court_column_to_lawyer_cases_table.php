<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCourtColumnToLawyerCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lawyer_cases', function (Blueprint $table) {
            $table->unsignedBigInteger('court_id')
                ->after('id')
                ->nullable();

            $table->foreign('court_id')->references('id')->on('courts')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lawyer_cases', function (Blueprint $table) {
            $table->dropForeign([
                'court_id',
            ]);
            $table->dropColumn([
                'court_id',
            ]);
        });
    }
}
