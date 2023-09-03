<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLawyerCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lawyer_cases', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('lawyer_id')->nullable();
            $table->unsignedBigInteger('contract_id')->nullable();

            $table->string('subject')->nullable();
            $table->string('needed_action')->nullable();
            $table->string('action')->nullable();
            $table->timestamp('court_date')->nullable();
            $table->string('decision')->nullable();
            $table->string('decision_details')->nullable();
            $table->decimal('attorneys_fees', 10, 2)->nullable();
            $table->decimal('court_fees', 10, 2)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('lawyer_id')->references('id')->on('lawyers');
            $table->foreign('contract_id')->references('id')->on('contracts');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lawyer_cases');
    }
}
