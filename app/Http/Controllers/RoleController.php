<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use HasRoles;
use HasPermissions;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
//        $roles = Role::all();
        $roles = DB::table('roles')->get();
        foreach ($roles as $key => $value) {
            $permission_name = DB::table('role_has_permissions')->where(['role_id'=>$value->id])->first();
            $roles[$key]->permission_name = $permission_name;
            # code...
        }
        $permissions = DB::table('permissions')->get();
//        $permissions = Permission::all();
        // return response()->json($roles);

        return view('roles.index', ['roles'=>$roles, 'permissions'=>$permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Get All permissions
        $permissions = DB::table('permissions')->get();
        return view('roles.index', ['permissions'=>$permissions]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if($request->isMethod('post')){
            $data = $request->all();

            //Validate Permissions
            $this->validate($request, [
                'name' => 'required|unique:roles,name',
                'permissions' => 'required',
            ]);

            $role = Role::create(['name' => $request->input('name')]);
            $role->syncPermissions($request->input('permissions'));
            return redirect('/roles')->with('success', 'Role '.$data['name'].' Added successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role, $id=null)
    {
        //
        $single_role = DB::table('roles')->where(['id'=>$id])->first();
        return view('roles.index', ['single_role'=>$single_role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role, $id=null)
    {
        //
        $delrole = DB::table('roles')->where(['id'=>$id])->delete();
        if($delrole){
            return redirect()->back()->with('success', 'Role deleted successfully');
        }else{
            return redirect()->back()->with('error', 'Could not delete role at this moment, check that you are connected to the server.');
        }

    }
}
