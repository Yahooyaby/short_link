<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlsStoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Url;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UrlController extends Controller
{
    public function index(Request $request):View
    {
        if($request->user()->is_admin){
            $urls = Url::all();
        }
        else {
            $urls = Url::where('user_id', $request->user()->id)->get();
        }
        return view('urls',['urls'=>$urls,'is_admin'=>$request->user()->is_admin]);
    }
    public function store(UrlsStoreRequest $request) :RedirectResponse
    {

        $request->user()->urls()->create([
            'name' => $request->name,
            'link' => $request->link,
            'user_id' => $request->user()->id,
            'short_link' => Str::random(8)
        ]);
        return redirect()->back();

    }
    public function destroy(Url $url, Request $request):RedirectResponse
    {
        if ($request->user()->is_admin){
            $url->delete();
        }
        elseif ($request->user()->id === $url->user_id){
            $url->delete();
        }
        return redirect()->back();
    }
    public function redirect_counter(string $code)
    {
        $url =Url::where('short_link',$code)->first();
        if(!$url){
         return   redirect()->route('urls.index')->with('failure','Такой сслыки не существует');
        }
        $url->update(['count' => $url->count +1]);
        return redirect($url->link);
    }
}
