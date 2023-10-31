<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketReplyAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_reply_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_reply_id');
            $table->string('path')->nullable();
            $table->string('file_name')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ticket_reply_id')->references('id')->on('ticket_replies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_reply_attachments');
    }
}
