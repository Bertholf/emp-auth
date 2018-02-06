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
        echo config('common.auth.tables.user_logins_table');
        Schema::connection('empauthable')->create(config('common.auth.tables.user_logins_table'), function (Blueprint $table) {
            $table->increments('id');
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
        echo 'Created Table: '. config('common.auth.tables.user_logins_table') . PHP_EOL;
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
        Schema::connection('empauthable')->table(config('common.auth.tables.user_logins_table'), function (Blueprint $table) {
            //$table->dropForeign(config('common.auth.tables.user_logins_table') . '_user_id_foreign');
        });

        /**
         * Drop tables
         */
        Schema::connection('empauthable')->dropIfExists(config('common.auth.tables.user_logins_table'));
    }
}
