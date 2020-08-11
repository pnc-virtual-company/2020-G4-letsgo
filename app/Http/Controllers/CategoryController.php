<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;
use App\Category;
use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(auth::id());
        $categories = Category::all();
        return view('Categorys.categoryView', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::id() == 1) {
            $category = new Category;
            $request->validate([
                'category' => 'required|unique:categories,name',
            ]);
            $category->name = $request->get('category');
            $category->save();
            return back();
        }
    }

    /**
     * Get date to compair if it's already has in datebase
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function existCategory(Request $request)
    {
        $category = $request->get('result');
        if ($request->ajax()) {
            $categoryData = DB::table('categories')->where('name', $category)->get();
            return $categoryData;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function editCategory(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->category;
        $category->save();
        return back();
    }

    /**
     * Remove categories.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */

    public function removeCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        return back();
    }
}
