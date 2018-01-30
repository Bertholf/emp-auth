<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersNotificationToken extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('empauthable')->create(config('empauthable.users_notification_token_table'), function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->text('token');
			$table->timestamps();
			// Add Foreign/Unique/Index
			$table->foreign('user_id')->references('id')->on(config('empauthable.users_notification_token_table'))->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('empauthable')->table(config('empauthable.users_notification_token_table'), function (Blueprint $table) {
			Schema::connection('diydifm')->dropIfExists(config('actor.users_settings_table'));
		});
	}
}
