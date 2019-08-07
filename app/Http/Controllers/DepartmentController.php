<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use DB;
use App\Faculty;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $departments = Department::orderby('id', 'ASC')->paginate(10);
//        return response()->json($departments);

        // Return faculty name from departments table based on foreign key constraints.(foreign key=faculty_id )
        foreach ($departments as $key => $val){
            $faculty_name = Faculty::where(['id'=>$val->faculty_id])->first();
            $departments[$key]->faculty_name = $faculty_name;
        }
        $faculties = DB::table('faculties')->get();

        $faculty =  Department::with('faculty')->get();

        return view('departments.index', ['departments'=>$departments, 'faculties'=>$faculties, 'faculty'=>$faculty]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('departments.index');
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
            return redirect('/departments')->with('success', 'Department:  '.$data['name'].' added successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Department $department
     * @return Response
     */
    public function show($department=null)
    {
        //
        $dept = Department::where(['id'=>$department])->first();
        if(!$dept){
            abort(404);
        }
//        return response()->json($dept);
        return view('departments.show', ['department'=>$dept]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Department $department
     * @return void
     */
    public function edit($department=null)
    {
        //
        $dept = Department::where(['id'=>$department])->first();
        if(!$dept){
            abort(404);
        }

        $faculties = Faculty::all();
        return view('departments.edit', ['department'=>$dept, 'faculties'=>$faculties]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Department $department
     * @return void
     * @throws ValidationException
     */
    public function update(Request $request, Department $department, $id=null)
    {
        //
        if($request->isMethod('post')){
            $data = $request->all();
            // Validate inputs
            $this->validate($request, [
               'name'=> 'required',
                'faculty_id' => 'required'
            ]);

            //Update single department
            $update = Department::where(['id'=>$id])->update([
                'name' => $data['name'],
                'description' => $data['description'],
                'faculty_id' => $data['faculty_id']
            ]);
            if($update) {
                return redirect('departments')->with('success', 'Department: ' . $data['name'] . ' Updated successfully');
            }else{
                return redirect()->back()->with('error', 'Unable to update '.$data['name'].' please check your server connection');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Department $department
     * @return void
     */
    public function destroy($department=null)
    {
        //delete a single department
        $deldept = Department::where(['id'=>$department])->delete();
        if($deldept){
            return redirect()->back()->with('success', 'Department deleted successfully');
        }else if(!$deldept){
            abort(404);
        }else{
            return redirect()->back()->with('error', 'Could not delete department, Make sure you are connected to the server');
        }
    }
}
