<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      //$this->call(FirmsTableSeeder::class);
       // $this->call(UsersTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        // $this->call('CountriesSeeder');
        // $this->command->info('Seeded the countries!');
    }
}
