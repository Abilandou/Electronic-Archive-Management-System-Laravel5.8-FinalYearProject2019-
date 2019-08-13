<?php

namespace App\Http\Controllers;

use App\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public  function __construct()

    {

        // $this->middleware('permission:post-list');
//        $this->middleware('role:vice', ['only' => ['index']]);

//        $this->middleware('permission:create', ['only' => ['create','store']]);
//
//        $this->middleware('permission:edit', ['only' => ['edit','update']]);
//
//        $this->middleware('permission:delete', ['only' => ['destroy']]);

    }


    public function index()
    {
        //Show faculties only for system maintainers

        $auth_user_status = Auth::user()->maintainer;
        if($auth_user_status == '1') {
//            $faculties = Faculty::orderby('id', 'ASC')->paginate(10);
            $faculties = Faculty::orderby('id', 'ASC')->get();
      //        return response()->json($faculties);
            return view('faculties.index', ['faculties' => $faculties]);
        }else{
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("faculties.index");
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
            //validate input
            $this->validate($request, [
                'name' => 'required|unique:faculties'
            ]);

            //Add faculty name to database
            $addFac = Faculty::insert([
                    'name' => $data['name'],
                    'description' => $data['description']
            ]);

            if($addFac){
                return redirect('/faculties')->with('success', 'Faculty '.$data['name'].' added successfully');
            }else{
                return redirect()->back()->with('error', 'Sorry could not add faculty, please make sure you are connected to the server');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function show($faculty=null)
    {
        //
        $fac = Faculty::where(['id'=>$faculty])->first();
        if(!$fac){
            abort(404);
        }
//        return response()->json($fac);
        return view('faculties.show', ['faculty'=>$fac]);



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function edit($faculty=null)
    {
        //
        $fac = Faculty::where(['id'=>$faculty])->first();
        if(!$fac){
            abort(404);
        }
//        return response()->json($fac);
        return view('faculties.edit', ['faculty' => $fac]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param null $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id=null)
    {
        //
        if($request->isMethod('post')){
            $data = $request->all();
            $this->validate($request, [
                'name' => 'required',
            ]);

        //Update a single faculty
            $fac = Faculty::where(['id'=>$id])->update([
                        'name' => $data['name'],
                        'description' => $data['description'],
            ]);
//            return response()->json($fac);
            if($fac){
                return redirect('/faculties')->with('success', 'Faculty '.$data['name'].' Updated successfully');
            }else{
                return redirect()->back()->with('error', 'Sorry could not update faculty, please make sure you are connected to the server');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function destroy($id=null)
    {
        //get single matched by id
        $faculty = Faculty::where(['id'=>$id])->delete();
        if($faculty){
            return redirect('/faculties')->with('success', 'Faculty deleted successfully');
        }else if(!$faculty) {
            abort(404);
        }else{
            return redirect()->back()->with('error', 'Sorry could not delete faculty, please make sure you are connected to the server');
        }
    }
}
