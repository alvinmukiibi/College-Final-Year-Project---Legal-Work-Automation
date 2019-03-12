<?php

use App\Repository\UserRepository;
use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class UsersTableSeeder extends Seeder
{
    protected  $users;

    public function  __construct(UserRepository $users)
    {
       $this->users = $users;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = $this->users->createUser([
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'password' => bcrypt('test'),
            'user_name' => 'johndoe',
            'contact' => '+256700000000',
            'department_id' => 1,
            'firm_id' => 1,

        ], Role::find(1));
        Log::info($user);
    }
}
