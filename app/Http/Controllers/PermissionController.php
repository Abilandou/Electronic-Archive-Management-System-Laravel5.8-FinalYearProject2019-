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

            $addPerm = DB::table('permissions')->insert([
                'name'=>$data['name'],
                'guard_name'=>$data['guard_name']
            ]);

            if($addPerm){
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
    public function edit(Permission $permission, $id=null)
    {
        //
        // $single_perm = DB::table('permissions')->where(['id'=>$id])->first();
        // return view('roles.index', ['single_perm'=>$single_perm]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        //
        if($request->isMethod('post')){
            $data = $request->all();

            //Validate the name
            $this->validate($request, [
                'name' => 'required'
            ]);

            $updatePerm = DB::table('permissions')->update([
                'name' => $data['name']
            ]);
            if($updatePerm){
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
        $delperm = DB::table('permissions')->where(['id'=>$id])->delete();
        if($delperm){
            return redirect('/roles')->with('sucess', 'Permission deleted successfully');
        }else{
            return redirect('/roles')->with('error', 'Failed to delete permission make sure you are connected to the server');
        }
    }
}
