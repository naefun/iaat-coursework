<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdoptionRequest;
use App\Models\Animal;
use Illuminate\Support\Facades\DB;
use Gate;

class AdoptionRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $adoptionRequestQuery = AdoptionRequest::all();
        if (Gate::denies('displayall')) {
            $adoptionRequestQuery=$adoptionRequestQuery->where('user_id', auth()->user()->id);
        }
        return view('adoption_requests.index', array('adoptionRequests'=>$adoptionRequestQuery));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $id)
    {
        //
        $animal = Animal::find($id);
        return view('adoption_requests.create',compact('animal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // form validation
        $adoption_request = $this->validate(request(), [
            'user_id' => 'required',
            'animal_id' => 'required',
        ]);

        $existing_requests = DB::table('adoption_requests')->
                where('user_id', auth()->user()->id)->
                where('animal_id', $request->input('animal_id'))->
                first();

        if ($existing_requests === null) {
            // create a Animal object and set its values from the input
            $adoption_request = new AdoptionRequest;
            $adoption_request->user_id = $request->input('user_id');
            $adoption_request->animal_id = $request->input('animal_id');
            $adoption_request->created_at = now();
            // save the Vehicle object
            $adoption_request->save();
            // generate a redirect HTTP response with a success message
            return back()->with('success', 'Adoption request has been added');
        }
        return back()->with('success', 'Adoption request not added, you have already requested to adopt this animal');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function display()
    {
        // sdd
    }

}
