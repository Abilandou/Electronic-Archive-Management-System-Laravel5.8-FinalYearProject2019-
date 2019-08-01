<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use DB;
use App\Faculty;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


        $departments = Department::orderby('id', 'DESC')->paginate(2);
        foreach ($departments as $key => $val){
            $faculty_name = Faculty::where(['id'=>$val->faculty_id])->first();
            $departments[$key]->faculty_name = $faculty_name;
        }
        $faculties = DB::table('faculties')->get();
//        foreach ($departments as $department)
//            $dept_id = $department->id;
//
//            $faculty = DB::table('departments')->
//            join('faculties', 'departments.faculty_id', '=', 'faculties.id')->
//            where(['faculty_id'=>$dept_id])->first();

        $faculty =  Department::with('faculty')->get();

        return view('departments.index', ['departments'=>$departments, 'faculties'=>$faculties, 'faculty'=>$faculty]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('departments.index');
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
                'name' => 'required|unique:departments'
            ]);

            $department = new Department();
            $department->name = $data['name'];
            $department->description = $data['description'];
            $department->faculty_id = $data['faculty_id'];
            $department->save();
            return redirect('/departments')->with('success', 'Department '.$data['name'].' added successfully');


//            //Get all faculties
//            $faculties = DB::table('faculties')->get();
//            foreach ($faculties as $faculty)
//                $faculty_id = $faculty;
//
//
//            //Add Department name to database
//            $addDept = Department::insert([
//                    'name' => $data['name'],
//                    'description' => $data['description'],
//
//                    $faculty_id->faculty_id = $data['faculty_id']
//            ]);

//            if($addDept){
//                return redirect('/departments')->with('success', 'Department '.$data['name'].' added successfully');
//            }else{
//                return redirect()->back()->with('error', 'Sorry could not add Department, please make sure you are connected to the server');
//            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $Department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $Department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $Department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $Department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
    }
}
