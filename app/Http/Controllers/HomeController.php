<?php

namespace App\Http\Controllers;

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
        // $data = Promethee::proses();

        return view('home');
    }

    public function proses()
    {
        $result = Promethee::proses();

        return view('proses.index')->with(collect($result)->toArray());
    }
}
