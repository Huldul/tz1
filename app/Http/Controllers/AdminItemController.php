<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\items;
use Illuminate\Http\Request;

class AdminItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(){
        // dd($_POST);
        $getitems = $_POST;
        // dd($_FILES);
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $img = $_FILES['image']['name'];
            $uploadDir = public_path('img/');
            $uploadPath = $uploadDir . basename($img);
            
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath);
            $item = new items();
            $item->title = $getitems['title'];
            $item->price = $getitems['price'];
            $item->image = $img;
            $item->description = $getitems['description'];
            $item->inValue = $getitems['inValue'];
            $item->category = $getitems['cat'];
            $item->subcategory = $getitems['subcat'];
            if($item->save()){
                return redirect('/admin/items/create');
            }else{
                echo"что то пошло не так";
            }

        }}
        
    public function create()
    {
        $categories = Category::all();
        $subcategories = Category::all();

        return view('create', [
            'categories'=>$categories,
            'subcategories'=>$categories
        ]);
    }
    public function category(){
        // dd($_POST);
        $cat = $_POST;

        $newCat = new Category();
        $newCat->name = $cat["category_name"];
        $newCat->save();

        foreach ($cat["subcategories"] as $sub) {
            $newSub = new Category();
            $newSub->name = $sub;
            $newSub->parent_id = $newCat->id;
            $newSub->save();
        }

        return redirect('/admin/items/create');     
    }
}
