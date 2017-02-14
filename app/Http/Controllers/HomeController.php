<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function search(Request $request)
    {
      $query = $request->input('query');
      $type = $request->input('type');

      $url = config('api.spotify.search').'?'.http_build_query(['q'=>$query, 'type'=>$type]);

      $data = json_decode(file_get_contents($url), true);

      $results = $data[$type.'s']['items'];

      return view('results', compact('results', 'query', 'type'));
    }
}
