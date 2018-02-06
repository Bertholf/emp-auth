<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Auth
        $this->command->info('SEEDER GROUP: Auth');
        $this->call(UserTableSeeder::class);


        // Completed
		$this->command->info('ALL DONE!');

        Model::reguard();
    }
}
