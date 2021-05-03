<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\User;
use Gate;
use Auth;
use DB;


class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (!Auth::check()) {
            // The user is logged in...
            return redirect('login');
        }
        $animals = Animal::all();
        $people = User::all();
        $animalTypes = Animal::getAnimalTypes();
        if (Gate::denies('displayall')) {
            $animals=$animals->where('availability', 'available');
        }
        return view('animals.index', compact('animals', 'people', 'animalTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (!Auth::check()) {
            // The user is logged in...
            return redirect('login');
        }
        // gathers all enum options for the animal type so they can be used to generate the options on the form
        $values = Animal::getAnimalTypes();

        return view('animals.create',compact('values'));
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
        if (!Auth::check()) {
            // The user is logged in...
            return redirect('login');
        }
        // form validation
        $animal = $this->validate(request(), [
            'name' => 'required',
            'date_of_birth' => 'required|date',
            'image' => 'sometimes',
            'image.*' => 'mimes:jpeg,png,jpg,gif,svg|max:500',
            'animal_type' => 'required',
        ]);
        
        //Handles the uploading of multiple images by storing each image locally and sending a comma separated value string of all image names to the database
        if ($request->hasFile('image')){
            $images = "";
            // iterates through the given images
            foreach ($request->image as $file) {
                //Gets the filename with the extension
                $fileNameWithExt = $file->getClientOriginalName();
                //just gets the filename
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //Just gets the extension
                $extension = $file->getClientOriginalExtension();
                //Gets the filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                //add image names to string for easy storage in the database
                $images = $images . $fileNameToStore . ",";
                //Uploads the image
                $path = $file->storeAs('public/images', $fileNameToStore);
            }
        }
        else {
            $images = 'noimage.jpg';
        }

        // create a Animal object and set its values from the input
        $animal = new Animal;
        $animal->name = $request->input('name');
        $animal->date_of_birth = $request->input('date_of_birth');
        $animal->type = $request->input('animal_type');
        $animal->description = $request->input('description');
        $animal->image = $images;
        $animal->created_at = now();
        // save the animal object
        $animal->save();
        // generate a redirect HTTP response with a success message
        return back()->with('success', 'Animal has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Auth::check()) {
            // The user is logged in...
            return redirect('login');
        }
        //
        $animal = Animal::find($id);
        $people = User::all();
        return view('animals.show',compact('animal', 'people'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::check()) {
            // The user is logged in...
            return redirect('login');
        }
        //
        $animal = Animal::find($id);
        return view('animals.edit',compact('animal'));
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
        if (!Auth::check()) {
            // The user is logged in...
            return redirect('login');
        }
        //
        $animal = Animal::find($id);
        $this->validate(request(), [
            'name' => 'required',
            'availability' => 'required'
        ]);
        $animal->name = $request->input('name');
        $animal->date_of_birth = $request->input('date_of_birth');
        $animal->description = $request->input('description');
        $animal->availability = $request->input('availability');
        $animal->updated_at = now();

        //Handles the uploading of the image
        if ($request->hasFile('image')){
            //Gets the filename with the extension
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            //just gets the filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Just gets the extension
            $extension = $request->file('image')->getClientOriginalExtension();
            //Gets the filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Uploads the image
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        $animal->image = $fileNameToStore;
        $animal->save();
        return redirect('animals');
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
        if (!Auth::check()) {
            // The user is logged in...
            return redirect('login');
        }
        $animal = Animal::find($id);
        $animal->delete();
        return redirect('animals');
    }
}
