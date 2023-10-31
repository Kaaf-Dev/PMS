<?php

use App\Models\Contract;
use App\Models\ContractApartment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrateCostToContractApartments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contract_apartments', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();

            $contracts = Contract::all();

            foreach ($contracts as $contract) {
                $contractApartment = ContractApartment::where('contract_id', $contract->id)->first();
                if ($contractApartment) {
                    $contractApartment->cost = $contract->getRawOriginal('cost');
                    $contractApartment->save();
                }
            }

            Schema::enableForeignKeyConstraints();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contract_apartments', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();

            $contracts = Contract::all();

            foreach ($contracts as $contract) {
                $totalCost = ContractApartment::where('contract_id', $contract->id)->sum('cost');

                $contract->cost = $totalCost;
                $contract->save();
            }

            Schema::enableForeignKeyConstraints();
        });
    }
}
