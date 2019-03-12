<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'admin'],
            ['name' => 'lawyer'],
            ['name' => 'partner'],
            ['name' => 'finance'],
        ];

        foreach ($roles as $role){
            Role::create($role);
        }
    }
}
