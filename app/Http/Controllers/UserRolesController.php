<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
class UserRolesController extends Controller
{


    public function viewRoles(Request $request){

        $roles = Role::where(['firm_id' => auth()->user()->firm_id])->paginate(5);
        return view('firm.admin.roles')->with(['roles' => $roles]);

    }
    public function addRole(Request $request){
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);
        $role = new Role;
        $role->data = $data;
        $role->addRole();
        return redirect()->back()->with('success', "Role Added Successfully!! ");

    }
    public function getRole(Role $role){
        return redirect()->back()->with('role', $role);
    }
    public function editRole(Request $request){
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);


        $rol = [
            'name' => $data["name"],
            'description' => $data["description"],
            'id' => $request->input('id'),
        ];

        $role = new Role;
        $role->role = $rol;
        $edited = $role->saveRole();
        if($edited){
            return redirect()->back()->with("success", "Updated Successfully");
        }else{
            return redirect()->back()->with("error", "Failed to Edit");
        }
    }

}
