<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UrlController extends Controller
{
    public function index(Request $request):View
    {
        $urls = Url::where('user_id',$request->user()->id)->get();
        return view('urls',['urls'=>$urls]);
    }
    public function store(Request $request) :RedirectResponse
    {
        $request->validate([
            'name'=>['required','unique:urls,name','max:255'],
            'link'=>['required','unique:urls,link']
        ]);
//        $link = Url::create([
//            'name'=>$request->name,
//            'link'=>$request->link,
//            'user_id'=>$request->user()->id,
//            'short_link'=>Str::random(8)
//        ]);
        $request->user()->urls()->create([
            'name'=>$request->name,
            'link'=>$request->link,
            'user_id'=>$request->user()->id,
            'short_link'=>Str::random(8)
        ]);
        return redirect()->back();

    }
    public function destroy(Url $url):RedirectResponse
    {
        $url->delete();
        return redirect()->back();
    }
    public function redirect_counter(string $code)
    {
        $url =Url::where('short_link',$code)->first();
        if($url){
         return   redirect()->route('urls')->with('success','Такой сслыки не существует');
        }
        $url->update(['count'=> $url->count +1]);
//        dd($url->link);
        return redirect($url->link);
    }
}
