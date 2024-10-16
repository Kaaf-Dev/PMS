<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contract_id')
                ->nullable();
            $table->string('no')
                ->nullable();
            $table->unsignedBigInteger('type')
                ->nullable();
            $table->foreign('type')->references('id')->on('invoice_types')->nullOnDelete();
            $table->float('amount', '8', '2');
            $table->timestamp('date')->nullable();
            $table->timestamp('due')->nullable();
            $table->string('notes')
                ->nullable();
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('invoices');
    }
}
