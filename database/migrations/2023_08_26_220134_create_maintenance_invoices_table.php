<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenanceInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_invoices', function (Blueprint $table) {
            $table->id();
            $table->uuid('ticket_id')->nullable();
            $table->unsignedBigInteger('maintenance_company_id')->nullable();
            $table->string('no')->nullable();
            $table->string('status');
            $table->decimal('maintenance_amount',10, 2);
            $table->decimal('amount', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('SET NULL');
            $table->foreign('maintenance_company_id')->references('id')->on('maintenance_companies')->onDelete('SET NULL');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maintenance_invoices');
    }
}
