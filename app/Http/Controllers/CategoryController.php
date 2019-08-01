<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //return all categories

        $categories = Category:: orderby('id', 'DESC')->get();
        return view('categories.index', ['categories'=>$categories]);
//        return view('categories.index')->with(compact('categories', $categories));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('categories.index', ['categories'=>$categories]);
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
                'name' => 'string|required|unique:categories'
            ]);

            //Add Category to database
            $addCat = Category::insert([
                'name' => $data['name']
            ]);
            if($addCat){
                return redirect('categories')->with('success', 'Category '.$data['name'].' Added successfully');

            }else{
                return redirect()->back()->with('error', 'Failed to create category, please check your server connection');
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, $id=null)
    {
        //
        $category = Category::where(['id'=>$id])->first();
        return view('categories.index', ['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        if($request->isMethod('post')){
            $data = $request->all();
            $this->validate($request, [
               'name' => 'string|required|unique:categories'
            ]);

            //Update a single category
            $cat = Category::where('id',$category)->update([
                'name'=>$data['name']
            ]);
            if ($cat){
                return redirect('/categories')->with('success', 'Category: '.$data['name'].' Updated successfully');
            }else{
                return redirect()->back()->with('error', 'Category could not be updated');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, $id=null)
    {
        //
        $cate = Category::where(['id'=>$id])->delete();

        if($cate){
            return redirect()->back()->with('success', 'Category deleted successfully');
        }else{
            return redirect()->back()->with('error', 'Unable to delete category please check your server connection');
        }
    }
}
