<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use     Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;


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
            $single_role = Role::where(['id'=>$key])->first();
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
    public function edit($role=null)
    {
        //
        $roles = Role::all();
        $permissions = Permission::all();
        $single_role = Role::where(['id'=>$role])->first();

        return view('roles.edit', ['single_role'=>$single_role, 'roles'=>$roles, 'permissions'=>$permissions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role, $id=null)
    {
        //
        if($request->isMethod('post')){
            $data = $request->all();

            $this->validate($request, [
                'name' => 'required|max:15',
                'permissions' => 'required'
            ]);

            $update_role = DB::table('roles')->where(['id'=>$id])->update([
                'name' => $data['name']
            ]);
            if($update_role){
                return redirect('/roles')->with('success', 'Permission '.$data['name'].' Updated successfully');
            }else{
                return redirect('/roles')->with('error', 'Failed to update this permission, please make sure you are connected to the server');
            }
//            $input = $request->except(['permissions']);
//
//            $permissions = $request['permissions'];
////            $rrrel = json_decode(json_encode($input));
////            echo "<pre>"; print_r($rrrel); die();
//            //save role name
//            $role->update($input);
//
//            //all permissions
//            $p_all = Permission::all();
//            foreach ($p_all as $perm){
//                $role->revokePermissionTo($perm);
//            }
//            //Looping through selected permissions
//            foreach ($permissions as $permission){
//                //get corresponding form permission in the db
//                $perm = Permission::where('id', $permission)->firstOrFail();
//                $role->givePermissionTo($perm);
//            }
//
//            return redirect('/roles')->with('success', 'Role updated successfully');

        }
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
        $del_role = DB::table('roles')->where(['id'=>$id])->delete();
        if($del_role){
            return redirect()->back()->with('success', 'Role deleted successfully');
        }else{
            return redirect()->back()->with('error', 'Could not delete role at this moment, check that you are connected to the server.');
        }

    }
}
