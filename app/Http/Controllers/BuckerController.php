<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\items;
use App\Models\Bucket;

class BuckerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    private function bucket_add($id){
        $bucket = Bucket::where('user_id', Auth::user()->id)->first();
        $items = unserialize($bucket->items_id);
        $items[] = $id;
        $seritems = serialize($items);
        $bucket->items_id = $seritems;
        $bucket->save();
    }
    
    public function add($id){

        $item = items::find($id);

        if (!$item) {
            return redirect('/bucket')->with('message', 'Товар с указанным id не найден');
        }

        $bucket = Bucket::where('user_id', Auth::user()->id)->first();
    
        if (!$bucket) {
            $bucket = new Bucket();
            $bucket->user_id = Auth::user()->id;
            $bucket->items_id = serialize([$id]);
            $bucket->save();
        } else {
            $items = unserialize($bucket->items_id);
    
            if (is_array($items) && in_array($id, $items)) {
                return redirect('/item/' . $id)->with('message', 'Такой товар уже есть в корзине');
            }
            $items[] = $id;
            $seritems = serialize($items);
    
            $bucket->items_id = $seritems;
            $bucket->save();
        }
    
        return redirect('/item/' . $id);
    }
    
    public function bucket(){
        $bucket = Bucket::where('user_id', Auth::user()->id)->first();
    
        if ($bucket) {
            $items_id = unserialize($bucket->items_id);
            $items = [];
    
            if (is_array($items_id)) {
                foreach ($items_id as $item_id) {
                    $items[] = items::where('id', $item_id)->first();
                }
            } else {
                $items = items::where('id', $items_id)->first();  
            }
    
            return view('bucket', [
                'items' => $items,
                'nullB' => 0
            ]);
        } else {
            return view('bucket', [
                'nullB' => 1
            ]);
        }
    }
    
    

    public function delete($id){
        $bucket = Bucket::where('user_id', Auth::user()->id)->first();
    
        if (!$bucket) {
            return redirect('/bucket')->with('message', 'Корзина не найдена');
        }
    
        $items_id = unserialize($bucket->items_id);
    
        if (is_array($items_id)) {
            $filteredItems = array_filter($items_id, function($item) use ($id) {
                return $item != $id;
            });
    
            $bucket->items_id = serialize($filteredItems);
            $bucket->save();
    
            return redirect('/bucket')->with('message', 'Элемент удален из корзины');
        } else {
            return redirect('/bucket')->with('message', 'Не удалось обработать корзину');
        }
    }
    
}