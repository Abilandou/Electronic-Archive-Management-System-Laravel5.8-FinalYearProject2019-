<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use HasRoles;
use HasPermissions;


class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $permissions = Permission::all();
        // $permissions = json_decode(json_encode($permissions));
        // echo "<pre>"; print_r($permissions); die;
        return view('roles.index', ['permissions'=>$permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('roles.index');
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
            $this->validate($request, [
                'name'=>'required'
            ]);

            $name = $request['name'];
            $permission = new Permission();
            $permission->name = $name;

            //Get the roles selected
            $roles = $request['roles'];
            //save the permission
            $permission->save();

            //Check if role is not empty and assign it to the permission
            if(!empty($request['roles'])){
                foreach ($roles as $role){
                    $role_id = Role::where(['id'=>$role])->first();
                    $permission = Permission::where(['name'=>$name])->first();
                    $role_id->givePermissionTo($permission);
                }
            }
            if($permission){
                return redirect('/roles')->with('success', 'Permission: '.$data['name'].' Added successfully');

            }else{
                return redirect('/roles')->with('error', 'Unable to add permission, please make sure you are connected to the server.');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit($permission=null)
    {
        //
         $single_perm = DB::table('permissions')->where(['id'=>$permission])->first();
//         $single_perm = json_decode(json_encode($single_perm));
//         echo "<pre>"; print_r($single_perm); die();
         $roles = Role::all();

         return view('permissions.edit', ['single_perm'=>$single_perm, 'roles'=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission, $id=null)
    {
        //
        if($request->isMethod('post')){
            $data = $request->all();
//            $data = json_decode(json_encode($data));
//            echo "<pre>"; print_r($data); die();

            //Validate the name
            $this->validate($request, [
                'name' => 'required',
                'roles' => 'required'
            ]);
//            $input = $request->except(['roles']);
//            $roles = $request['roles'];
//
//            //save permission name
//            $permission->update($input);
//
//            //all roles
//            $role_all = Role::all();
//            foreach ($role_all as $rol){
//                $permission->removeRole($rol);
//            }
//
//            //Looping through selected roless
//            foreach ($roles as $role) {
//                //get corresponding form permission in the db
//                $rol = Role::where('id', $role)->firstOrFail();
//                $permission->givePermissionTo($rol);
//            }
//
//            return redirect('/roles')->with('success', 'Permission updated successfully');

            $update_perm = DB::table('permissions')->where(['id'=>$id])->update([
                'name' => $data['name']
            ]);
            if($update_perm){
                return redirect('/roles')->with('success', 'Permission '.$data['name'].' Updated successfully');
            }else{
                return redirect('/roles')->with('error', 'Failed to update this permission, please make sure you are connected to the server');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission, $id=null)
    {
        //
        $del_perm = DB::table('permissions')->where(['id'=>$id])->delete();
        if($del_perm){
            return redirect('/roles')->with('success', 'Permission deleted successfully');
        }else{
            return redirect('/roles')->with('error', 'Failed to delete permission make sure you are connected to the server');
        }
    }
}
