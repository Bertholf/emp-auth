<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMetaTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::connection('empauthable')->create(config('empauthable.users_metas_table'), function (Blueprint $table) {
			$table->increments('id');
			$table->integer('field_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->text('value');
			$table->timestamps();
		});
		echo 'Created Table: ' . config('empauthable.users_metas_table') .';'. PHP_EOL;
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('empauthable')->dropIfExists(config('empauthable.users_metas_table'));
	}
}
