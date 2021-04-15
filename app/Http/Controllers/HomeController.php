<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdoptionRequest;
use App\Models\Animal;
use App\Models\User;
use Gate;
use Auth;

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
        if (!Auth::check()) {
            // The user is logged in...
            return redirect('login');
        }
        $homeInformation = AdoptionRequest::all()->where('request_status', 'pending');
        $people = User::all();
        $animals = Animal::all();
        if (Gate::denies('displayall')) {
            $homeInformation=Animal::all()->where('availability', 'available');
        }
        return view('home', compact('homeInformation', 'people', 'animals'));
    }
}
