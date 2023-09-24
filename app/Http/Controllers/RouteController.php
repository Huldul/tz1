<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\items;

class RouteController extends Controller
{
    public function main(){
        $items = items::all();
        // dd($items);
        return view("MainPage", [
            'items'=>$items,
        ]);
    }
    public function routePage($id){
        $item = items::find($id);
        return view('item',[
            'item'=>$item,
        ]);
    }
}
