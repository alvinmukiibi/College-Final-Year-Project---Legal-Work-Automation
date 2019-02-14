<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class FirmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('firms')->insert([
        //     'id' => '3',
        //     'firm_id' => 'LA23',
        //     'name' => 'hjb ',
        //     'email' => 'fff ',
        //     'contact1' => '45678',
        //     'contact2' => '56789',
        //     'password' => 'iujbknd',
        //     'country' => 'ojnd',
        //     'area' => 'oishnd',
        //     'city' => 'iudhjbn',
        //     'street_address' => 'ughbd',
        //     'motto' => 'iohknd',
        //     'avatar' => 'oihjd',
        //     'website' => 'jufnf fijfn',
        //     'description' => 'uygiuf iuh',
        //     'activity_flag' => 'active',
        //     'verification_flag' => 'verified'
           
        // ]);
        factory(App\Firms::class, 20)->create();
        // factory(App\Firms::class, 10)->create()->each(function ($firm) {
        //     $firm->firms()->save(factory(App\Firms::class)->make());
        // });
    }
}
