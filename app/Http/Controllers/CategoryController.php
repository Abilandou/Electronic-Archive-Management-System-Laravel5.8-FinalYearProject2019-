<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        //return all categories

        $categories = Category::orderby('id', 'ASC')->paginate(10);
//        return response()->json($categories);
        return view('categories.index', ['categories'=>$categories]);
//        return view('categories.index')->with(compact('categories', $categories));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
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
     * @param \App\Category $category
     * @return void
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return Response
     */
    public function edit(Category $category, $id=null)
    {
        //
        $category = Category::where(['id'=>$id])->first();
        $categories = Category::all();
//        if(!$category){
//            abort(404);
//        }
        return view('categories.edit', ['category'=>$category, 'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Category $category
     * @return Response
     * @throws ValidationException
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
     * @return Response
     */
    public function destroy(Category $category, $id=null)
    {
        //
        $cate = Category::where(['id'=>$id])->delete();

        if($cate){
            return redirect()->back()->with('success', 'Category deleted successfully');
        }else if(!$cate) {
            abort(404);
        }else{
            return redirect()->back()->with('error', 'Unable to delete category please check your server connection');
        }
    }
}
