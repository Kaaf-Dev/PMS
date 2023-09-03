<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldsToLawyerCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lawyer_cases', function (Blueprint $table) {
            $table->string('first_side')->nullable();
            $table->string('second_side')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->decimal('collected_amount', 10, 2)->nullable();
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
                'first_side',
                'second_side',
                'amount',
                'collected_amount',
            ]);
        });
    }
}
