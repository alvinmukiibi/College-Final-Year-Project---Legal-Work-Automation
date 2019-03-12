<?php

use App\Department;
use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            ['name' => 'Information Technology Department','code'=>'IT','HOD'=>'John Doe'],
        ];

        foreach ($departments as $department){
            Department::create($department);
        }
    }
}
