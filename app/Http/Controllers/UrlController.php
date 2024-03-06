<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    public function index(Request $request){
        $counter = 0;
        $urls = Url::where('user_id',$request->user()->id)->get();
        return view('dashboard',['urls'=>$urls,'counter'=>$counter]);
    }
    public function store(Request $request){
        $link = Url::create([
            'name'=>$request->name,
            'link'=>$request->link,
            'user_id'=>$request->user()->id,
            'short_link'=>Str::random(8)
        ]);
        return redirect()->back();

    }
    public function destroy(Url $url){
        $url->delete();
        return redirect()->back();
    }
    public function redirect_counter(string $code){

        $url =Url::where('short_link',$code)->first();
        $url->update(['count'=> $url->count +1]);
//        dd($url->link);
        return redirect($url->link);
    }
}
