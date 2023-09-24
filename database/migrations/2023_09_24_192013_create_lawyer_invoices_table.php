<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLawyerInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lawyer_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lawyer_case_id')->nullable();
            $table->string('status')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->decimal('court_fees', 10, 2)->nullable();
            $table->decimal('executor_fees', 10, 2)->nullable();
            $table->decimal('attorneys_fees', 10, 2)->nullable();
            $table->decimal('other', 10, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('lawyer_case_id')->references('id')->on('lawyer_cases');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lawyer_invoices');
    }
}
