<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPropertiesColumnToTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->unsignedBigInteger('apartment_id')
                ->after('contract_id')
                ->nullable();

            $table->unsignedBigInteger('property_id')
                ->after('contract_id')
                ->nullable();

            $table->foreign('property_id')->on('properties')->references('id')->nullOnDelete();
            $table->foreign('apartment_id')->on('apartments')->references('id')->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn([
                'property_id',
                'apartment_id',
            ]);
            $table->dropForeign([
                'property_id',
                'apartment_id',
            ]);
        });
    }
}
