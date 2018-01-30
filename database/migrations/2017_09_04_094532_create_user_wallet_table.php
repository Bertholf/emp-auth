<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserWalletTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('empauthable')->create(config('empauthable.user_wallet_table'), function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->string('type');
			$table->string('hash');
			$table->text('credential');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('empauthable')->drop(config('empauthable.user_wallet_table'));
	}
}
