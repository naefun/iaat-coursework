<!-- inherite master template app.blade.php -->
@extends('layouts.app')
<!-- define the content section -->
@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="card justify-content-center">

                <div class="card-header">Create a new adoption request</div>
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
                @elseif (\Session::has('nosuccess'))
                    <div class="alert alert-nosuccess">
                        <p>{{ \Session::get('nosuccess') }}</p>
                    </div><br />
                @endif

                <!-- show animal information -->
                <div class="card-body justify-content-center">
                    <table class="table show-table" >
                            <tr> <th class="end-text half-width">Animal name </th> <td class="half-width"> {{$animal->first()->name}}</td></tr>
                            <tr> <th class="end-text half-width">Animal date of birth </th> <td class="half-width">{{$animal->first()->date_of_birth}}</td></tr>
                            <tr> <th class="end-text half-width">Animal availability </th> <td class="half-width">{{$animal->first()->availability}}</td></tr>
                            <tr> <th class="end-text half-width">Adoptee </th> <td class="half-width">{{$animal->first()->user_id}}</td></tr>
                            <tr> <th class="center-text">Notes </th></tr><tr> <td class="table-description">{{$animal->first()->description}}</td></tr>
                            <tr> <td class="full-width"><img class="full-width full-height"
                            src="{{ asset('storage/images/'.$animal->first()->image)}}"></td></tr>
                    </table>
                </div>

                <!-- define the form -->
                <div class="card-body justify-content-center">
                    <form class="form-horizontal" method="POST"
                    action="{{url('adoption_requests') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- 
                            hidden animal id
                            hidden user id
                            show animal details
                        -->
                        
                        <input type="number" name="animal_id" placeholder="Animal name" value="{{ $animal->first()->id }}" hidden />
                        <input type="number" name="user_id" placeholder="Animal name" value="{{ Auth::user()->id }}" hidden />

                        <div class="col-md-6 col-md-offset-4">
                            <a href="{{route('animals.index')}}" class="btn btn-primary" role="button">Back to the list</a>
                            <input type="submit" class="btn btn-primary" value="Submit adoption request"/>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>

    </div>
@endsection