<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if(view()->exists('backend.'.str_replace('backend/template/','',$request->path()))){
            return view('backend.'.str_replace('backend/template/','',$request->path()));
        }
        return view('backend.pages-404');
    }
}
