<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
class DepartmentsController extends Controller
{
    public function showDepartments(Request $request){
        $departments = Department::where(['firm_id'=>auth()->user()->firm_id])->get();
        return view('firm.admin.departments')->with("departments", $departments);

    }
    public function addDepartment(Request $request){
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        $dept = new Department;
        $dept->dept = $data;
        $save = $dept->addDepartment();
        if($save){
            return redirect()->back()->with("success", "Department Added Successfully");

        }else{
            return redirect()->back()->with("error", "Failed to Add");

        }


    }
    public function getDepartment(Department $department){

        return redirect()->back()->with("department", $department);

    }
    public function editDepartment(Request $request){

        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);


        $dept = [
            'name' => $data["name"],
            'description' => $data["description"],
            'id' => $request->input('id'),
        ];
        $department = new Department;
        $department->dept = $dept;
        $edited = $department->saveDepartment();
        if($edited){
            return redirect()->back()->with("success", "Updated Successfully");
        }else{
            return redirect()->back()->with("error", "Failed to Edit");
        }

    }
}
