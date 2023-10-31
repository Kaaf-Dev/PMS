<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnsToLawyerCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lawyer_cases', function (Blueprint $table) {
            $table->string('status')->nullable();
            $table->string('case_no')->nullable();

            $table->dropColumn([
                'subject',
                'needed_action',
                'action',
                'court_date',
                'decision_details',
                'attorneys_fees',
                'court_fees',
            ]);
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
                'status',
                'case_no',
            ]);

            $table->string('subject')->nullable();
            $table->string('needed_action')->nullable();
            $table->string('action')->nullable();
            $table->timestamp('court_date')->nullable();
            $table->string('decision_details')->nullable();
            $table->decimal('attorneys_fees', 10, 2)->nullable();
            $table->decimal('court_fees', 10, 2)->nullable();

        });
    }
}
