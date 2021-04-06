<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdoptionRequest;
use App\Models\Animal;
use Gate;

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
        $homeInformation = AdoptionRequest::all()->where('request_status', 'pending');
        if (Gate::denies('displayall')) {
            $homeInformation=Animal::all()->where('availability', 'available');
        }
        return view('home', array('homeInformation'=>$homeInformation));
    }
}
