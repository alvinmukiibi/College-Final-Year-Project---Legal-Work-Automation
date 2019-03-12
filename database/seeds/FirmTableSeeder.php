<?php

use App\Firm;
use Illuminate\Database\Seeder;

class FirmTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $firms = [
            ['name' => 'OSH Advocates',
                'contact'=>'000000000',
                'dateOfRegistration'=>'4/9/2019',
                'website'=>'www.osh.com',
                'description'=>'The best firm to handle your cases',
                'address'=>'Nakasero Kampala'
            ],
        ];

        foreach ($firms as $firm){
            Firm::create($firm);
        }
    }
}
