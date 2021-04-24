<!-- inherite master template app.blade.php -->
@extends('layouts.app')
<!-- define the content section -->
@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="card justify-content-center">

                <div class="card-header">Add an animal</div>

                <!-- display the errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul> @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div><br /> 
                @endif
                <!-- display the success status -->
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <p>{{ \Session::get('success') }}</p>
                    </div><br /> 
                @endif

                <!-- define the form -->
                <div class="card-body justify-content-center">

                    <form class="create-form justify-content-center" method="POST"
                    action="{{url('animals') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-input justify-content-center">
                            <label>Animal name</label>
                            <input type="text" name="name"
                            placeholder="Animal name" />
                        </div>
                        <div class="form-input justify-content-center">
                            <label>Animal date of birth</label>
                            <input type="date" name="date_of_birth" />
                        </div>
                        <div class="form-input justify-content-center">
                            <label>Animal type</label>
                            <select class="form-select" name="animal_type">
                                @foreach ($values as $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-input justify-content-center">
                            <label >Description</label>
                            <textarea rows="4" cols="50" name="description">Notes about the animal</textarea>
                        </div>
                        <div class="form-input justify-content-center">
                            <label>Image</label>
                            <input type="file" name="image[]" placeholder="Image file" multiple/>
                        </div>
                        <div class="button-group justify-content-center-row">
                            <input type="submit" class="btn green-button" />
                            <input type="reset" class="btn red-button" />
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection