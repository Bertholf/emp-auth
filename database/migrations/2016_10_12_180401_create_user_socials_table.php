<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSocialsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('empauthable')->create(config('empauthable.users_logins_table'), function (Blueprint $table) {
			$table->increments('id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->string('provider', 32);
			$table->string('provider_id');
			$table->string('token')->nullable();
			$table->string('avatar')->nullable();
			$table->string('username')->nullable();
			$table->timestamps();
			// Add Foreign/Unique/Index
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
		echo 'Created Table: '. config('empauthable.users_logins_table') . PHP_EOL;
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		/**
		 * Remove Foreign/Unique/Index
		 */
		Schema::connection('empauthable')->table(config('empauthable.users_logins_table'), function (Blueprint $table) {
			$table->dropForeign(config('empauthable.users_logins_table') . '_user_id_foreign');
		});

		/**
		 * Drop tables
		 */
		Schema::connection('empauthable')->dropIfExists(config('empauthable.users_logins_table'));
	}
}
