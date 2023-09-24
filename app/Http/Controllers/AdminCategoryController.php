<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class AdminCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getSubcategories($category){
        $subcategories = Category::where('parent_id', $category)->get();
        return response()->json($subcategories);
    }
    public function create()
    {
        response()->json(Category::all());
        return view('create');
    }
    public function delete()
    {
        // dd($_POST);
        $cat = Category::find($_POST['cat']);
        $cat->delete();
        return redirect('/admin/items/create');
    }
    
}
