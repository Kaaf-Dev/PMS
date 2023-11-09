<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsDirectPaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions_direct_pays', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('transaction_id');
            $table->foreign('transaction_id')->references('id')->on('payment_transactions')->cascadeOnDelete();
            $table->string('gatewayEntryPoint');
            $table->float('amount',18,3);
            $table->string('authenticationStatus');
            $table->string('currency');
            $table->string('merchantAmount');
            $table->string('merchantCategoryCode');
            $table->string('FAILURE');
            $table->longText('response_decoded');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions_direct_pays');
    }
}
