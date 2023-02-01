<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApartmentDetailsColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apartments', function (Blueprint $table) {

            $table->string('type')
                ->after('id')
                ->nullable();

            $table->float('cost', 8, 2)
                ->after('name')
                ->nullable();

            $table->unsignedFloat('area', 8, 2)
                ->nullable();

            $table->unsignedBigInteger('rooms_count')
                ->nullable();

            $table->unsignedBigInteger('bathrooms_count')
                ->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apartments', function (Blueprint $table) {
            $table->dropColumn([
                'type',
                'cost',
                'area',
                'rooms_count',
                'bathrooms_count',
            ]);
        });
    }
}
