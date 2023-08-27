<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenanceInvoiceAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_invoice_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('maintenance_invoice_id');
            $table->string('path');
            $table->string('file_name');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('maintenance_invoice_id')->references('id')->on('maintenance_invoices')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maintenance_invoice_attachments');
    }
}
