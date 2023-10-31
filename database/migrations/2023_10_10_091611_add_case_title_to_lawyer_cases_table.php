<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCaseTitleToLawyerCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lawyer_cases', function (Blueprint $table) {
            $table->string('lawyer_case');
            $table->longText('required_case');
            $table->float('judgment_amount', 18, 3)->nullable();
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
            $table->dropColumn([
                'lawyer_case',
                'required_case',
                'judgment_amount'
            ]);
        });
    }
}
