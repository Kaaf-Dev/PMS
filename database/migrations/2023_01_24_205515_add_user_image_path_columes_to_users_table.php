<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserImagePathColumesToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->longText('user_image_path')->nullable();
            $table->string('whatsapp_phone')->nullable();
            $table->string('user_type');
            $table->longText('cpr_image_path')->nullable();
            $table->longText('merchant_image_path')->nullable();
            $table->longText('iban_image_path')->nullable();
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
                'user_image_path',
                'whatsapp_phone',
                'user_type',
                'cpr_image_path',
                'merchant_image_path',
                'iban_image_path',
            ]);
        });
    }
}
