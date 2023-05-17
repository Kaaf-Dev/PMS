<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalColumnsToApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apartments', function (Blueprint $table) {
            $table->boolean('with_electricity')
                ->default(false);

            $table->boolean('with_balcony')
                ->default(false);

            $table->boolean('with_elevator')
                ->default(false);

            $table->boolean('with_pool')
                ->default(false);

            $table->integer('parking')
                ->default(0);

            $table->integer('furniture')
                ->nullable(); // 1 full    2 semi    3 none

            $table->integer('floors')
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
                'with_electricity',
                'with_balcony',
                'with_elevator',
                'with_pool',
                'parking',
                'furniture',
                'floors',
            ]);
        });
    }
}
