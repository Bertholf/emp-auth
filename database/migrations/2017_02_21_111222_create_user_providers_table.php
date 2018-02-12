<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('empauthable')->create(config('emp-auth.auth.tables.user_oauth_providers_table'), function (Blueprint $table) {
            $table->integer('user_id');
            $table->string('provider');
            $table->string('oauth_provider_id');
            $table->timestamps();
            // Add Foreign/Unique/Index
            $table->unique(['user_id', 'provider', 'oauth_provider_id']);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('empauthable')->dropIfExists(config('emp-auth.auth.tables.user_oauth_providers_table'));
    }
}
