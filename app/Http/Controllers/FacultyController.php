<?php

namespace App\Http\Controllers;

use App\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $faculties = Faculty::get();
        return view('faculties.index', ['faculties' =>$faculties]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $faculties = Faculty::get();
        // return view('faculties.faculties', ['faculties' => $faculties]);
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
            // $data = json_decode(json_encode($data));
            // echo "<pre>"; print_r($data); die;
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
        return view('faculties.edit', ['faculty' => $fac]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
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
        }else{
            return redirect()->back()->with('error', 'Sorry could not delete faculty, please make sure you are connected to the server');
        }
    }
}
