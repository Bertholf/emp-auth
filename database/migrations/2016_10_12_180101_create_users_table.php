<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('empauthable')->create(config('common.profile.tables.users_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_first');
            $table->string('name_last');
            $table->string('name_display')->nullable(); // What shows based on privacy settings
            $table->string('name_slug'); // Username
            $table->string('email');
            $table->string('password')->nullable();
            $table->tinyInteger('status')->default(1)->unsigned();
            $table->string('confirmation_code')->nullable();
            $table->boolean('confirmed')->default(config('common.users.confirm_email') ? false : true);
            $table->boolean('verified')->default(0); // Human Verified
            $table->string('language')->nullable();
            $table->string('timezone')->default('UTC');
            $table->integer('referring_user_id')->unsigned()->nullable(); // Who referred them?
            $table->integer('timeline_id')->default(0)->unsigned();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            // Add Foreign/Unique/Index
            $table->unique('name_slug', 'users_name_slug_unique');
            $table->unique('email', 'users_email_unique');
            $table->foreign('referring_user_id')->references('id')->on(config('common.profile.tables.users_table'))->onDelete('restrict')->onUpdate('restrict');
        });
        echo 'Created Table: '. config('common.profile.tables.users_table') . PHP_EOL;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('empauthable')->dropIfExists(config('common.profile.tables.users_table'));
    }
}
