<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCostColumnForContractApartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contract_apartment', function (Blueprint $table) {
            $table->float('cost', '8', '2')
                ->default(0)
                ->after('apartment_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contract_apartment', function (Blueprint $table) {
            $table->dropColumn([
                'cost',
            ]);
        });
    }
}
