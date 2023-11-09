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
                ->nullable()
                ->default(false);

            $table->boolean('with_balcony')
                ->nullable()
                ->default(false);

            $table->boolean('with_elevator')
                ->nullable()
                ->default(false);

            $table->boolean('with_pool')
                ->nullable()
                ->default(false);

            $table->integer('parking')
                ->nullable()
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
