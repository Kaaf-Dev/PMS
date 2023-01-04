<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTenantFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')
                ->after('name')
                ->unique();

            $table->string('cpr')
                ->after('name');

            $table->string('gender')->nullable();
            $table->string('phone')->nullable();
            $table->string('blood')->nullable();
            $table->dateTime('date_of_berth')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'username',
                'cpr',
                'phone',
                'blood',
                'date_of_berth',
            ]);
        });
    }
}
