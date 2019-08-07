<?php

namespace App\Http\Controllers;

use App\Faculty;
//use http\Client\Curl\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        // showing users to system administrator, show all users who are system admins of faculties
         $auth_user_status = Auth::user()->maintainer;

         //Return logged in user's id
        $auth_user_id = Auth::user()->id;

        // Return the logged in user's faculty id
        $auth_user_fac_id = Auth::user()->faculty_id;

        // Return all roles
        $roles = Role::all();

        // Return a single user here
        $single_user = DB::table('users')->where(['id' => $auth_user_id])->first();

        // Return faculties
        $faculties = DB::table('faculties')->get();

        //Get all departments whose faculty id is same as that of the system admin
        $departments = DB::table('departments')->where(['faculty_id'=>$auth_user_fac_id])->get();

         if($auth_user_status == '1'){
             $users = DB::table('users')->where(['is_admin'=>'1'])->get();
             foreach ($users as $key => $val) {
                 $faculty_name = Faculty::where(['id' => $val->faculty_id])->first();
                 $users[$key]->faculty_name = $faculty_name;
             }
             foreach ($users as $key => $val) {
                 $department_name = Faculty::where(['id' => $val->department_id])->first();
                 $users[$key]->department_name = $department_name;
             }

             return view('users.index')->with(compact('users', 'departments', 'single_user', 'faculties', 'roles'));
//             return view('users.index', ['users' => $users, 'departments'=>$departments, 'single_user' => $single_user, 'faculties' => $faculties]);
         }else {

             $users = DB::table('users')->where(['faculty_id'=> $auth_user_fac_id])->orderBy('id', 'DESC')->paginate(10);
             foreach ($users as $key => $val) {
                 $faculty_name = Faculty::where(['id' => $val->faculty_id])->first();
                 $users[$key]->faculty_name = $faculty_name;
             }

             foreach ($users as $key => $val) {
                 $department_name = Faculty::where(['id' => $val->department_id])->first();
                 $users[$key]->department_name = $department_name;
             }

             // Get the currently logged in user faculty id
             foreach ($users as $key => $value){
                 $fac_id = DB::table('users')->where(['faculty_id'=>$auth_user_fac_id])->first();
                 $users[$key]->fac_id = $fac_id;
             }
             return view('users.index')->with(compact('users', 'single_user', 'faculties', 'departments', 'roles'));
//             return view('users.index', ['users' => $users, 'single_user' => $single_user, 'faculties' => $faculties, 'departments'=>$departments]);
         }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $roles = Role::all();
        $faculties = DB::table('faculties')->get();
        $auth_user_status = Auth::user()->maintainer;
        if($auth_user_status == '1') {
            return view('users.create', ['roles' => $roles, 'faculties' => $faculties]);
        }else{
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        //
        if($request->isMethod('post')) {
            $data = $request->all();
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'faculty_id' => 'required',
                'is_admin' => 'required',
            ]);
//            store the data
            $userAdd = DB::table('users')->insert([
                'name'=>$data['name'],
                'email'=>$data['email'],
                'password'=>Hash::make($data['password']),
                'faculty_id'=>$data['faculty_id'],
                'is_admin'=>$data['is_admin']
            ]);
            if($userAdd){
                return redirect('/users')->with('success', 'Admin Added to faculty: '.$data['faculty_id'].' Successfully');
            }else{
                return redirect()->back()->with('error', 'Unable to add Administrator to faculty'.$data['faculty_id'].' Please make sure your server is connected');
            }
        }
    }



    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        //
        $user_delete = User::where(['id'=>$id])->delete();
        if($user_delete){
            return redirect('/users')->with('success', 'User deleted successfully');
        }else{
            return redirect('/users')->with('error', 'Unable to delete user, please make sure you are connected to the server');
        }
    }

    public function profile()
    {
        return view('users.profile');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function addFacultyUsers(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //validate the input
            $this->validate($request, [
                'name'=> 'required|unique:users',
                'email'=> 'required|unique:users|email',
                'faculty_id'=>'required',
                'department_id'=>'required',
                'password'=> 'required|min:6|confirmed',
                'role'=> 'required'
            ]);

            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->faculty_id = $request->input('faculty_id');
            $user->department_id = $request->input('department_id');
            $user->save();

            $role = $request->input('role');
            $role_r = Role::where('id', $role)->firstOrFail();
            $user->assignRole($role_r);

            if($user){
                return redirect('/users')->with('success', 'User added successfully');
            }else{
                return redirect('/users')->with('error', 'Failed to add user, please make sure you are connected to the server');
            }


//            $data['password'] = Hash::make($data['password']);
////            $data->faculty_id => $data['faculty_id'];
//            $user = User::create($data);
//            $user->assignRole($data['role']);
//
//            //Redirect to users page
//            if($user){
//                return redirect('/users')->with('success', 'User added successfully');
//            }else{
//                return redirect('/users')->with('error', 'Failed to add user check that you are connected to the database');
//            }


            // perform add
//            $addUser = DB::table('users')->insert([
//                'name'=>$data['name'],
//                'email'=>$data['email'],
//                'password'=> Hash::make($data['password']),
//                'faculty_id'=>$data['faculty_id'],
//                'department_id'=>$data['department_id'],
//            ]);
//            if($addUser){
//                return redirect('/users')->with('success', 'User added to Faculty Successfully');
//            }else{
//                return redirect('/users')->with('error', 'Failed to add user to faculty, make sure you are connected to the server');
//            }
        }
    }
}
