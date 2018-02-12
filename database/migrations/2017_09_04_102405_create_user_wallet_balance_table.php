<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserWalletBalanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('empauthable')->create(config('emp-auth.wallet.tables.user_wallet_balance_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->decimal('amount', 19, 2);
            $table->string('currency');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('empauthable')->drop(config('emp-auth.auth.tables.user_wallet_balance_table'));
    }
}
