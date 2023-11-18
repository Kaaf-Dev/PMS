<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemTypeColumeToPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->string('item_type')->default(1);
            $table->string('owner_cpr')->nullable();
            $table->string('owner_phone')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('document_no')->nullable();
            $table->string('register_year')->nullable();
            $table->string('register_number')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn([
                'item_type',
                'owner_cpr',
                'owner_phone',
                'owner_name',
                'document_no',
                'register_year',
                'register_number',
            ]);
        });
    }
}
