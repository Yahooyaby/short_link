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
        $urlQuery = Url::query()->when($request->user()->cannot('viewAny',Url::class), function ($query) use ($request) {
            $query->where('user_id', $request->user()->id);
        }, function ($query) use ($request) {
            $query->when($request->users, function ($query) use ($request) {
                $query->whereIn('user_id', $request->users);
            });
        });
        if($request->sub_link){
            $urlQuery->where('link','like','%'.$request->sub_link.'%');
        }

        if($request->sort){
            $urlQuery->orderBy('count','desc');
        }

        return view('urls',[
            'urls' => $urlQuery->get(),
            'users' => User::all()
        ]);
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
    public function destroy(Request $request, Url $url ):RedirectResponse
    {
        $this->authorize('delete',$url);
            $url->delete();

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
