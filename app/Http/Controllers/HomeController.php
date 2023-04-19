<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
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
    public function index()
    {
        $dep = DB::select('select * from V_EXECUTOR t');
        $data = DB::select('select * from ZUTLENT.NBT_ZURCHIL_YARALTAITORMOZ');
        return view('home',compact('data','dep'));

    }
}
