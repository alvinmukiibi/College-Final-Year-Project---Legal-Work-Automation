<?php

use App\Repository\UserRepository;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;



class UsersTableSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     public function run()
     {
          factory(User::class, 1)->create();
     }

   /* protected $user;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * Run the database seeds.
     *
     * @return void


    public function run()
    {
        $user = $this->users->createUser([

            'email' => 'john@doe.com',
            'password' => bcrypt('test'),

        ], Role::find(1));
        Log::info($user);

    }
*/
}



