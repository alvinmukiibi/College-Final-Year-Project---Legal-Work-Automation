<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('firm.admin.roles', ['roles'=>Role::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('firm.admin.roles');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'firm_id' =>'required|numeric'
        ]);
        $role = new Role();
        $role->name  = $request->get('name');
        $role->description = $request->get('description');
        $role->firm_id = $request->get('firm_id');
        $role->save();
        return redirect()->back()->with(['success'=> 'Role Has Been Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roles=Role::find($id);
        return view('firm.admin.roles')->with('role',$roles);

        //$roles = Roles::where(['firm_id'=>auth()->user()->firm_id])->get();
        //return view('firm.admin.roles')->with("roles", $roles);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
//
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);


        $role = [
            'name' => $data["name"],
            'description' => $data["description"],
            'id' => $request->input('id'),
        ];
        $role = new Role();
        $role->role = $role;
        $edited = $role->saveRole();
        if($edited){
            return redirect()->back()->with("success", "Updated Successfully");
        }else{
            return redirect()->back()->with("error", "Failed to Edit");
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
