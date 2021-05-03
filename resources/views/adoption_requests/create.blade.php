{{-- view used to create an adoption request --}}

<!-- inherit master template app.blade.php -->
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
                    <table class="table show-table table-striped" >
                            <tr> <th class="end-text half-width">Animal name </th> <td class="half-width"> {{$animal->first()->name}}</td></tr>
                            <tr> <th class="end-text half-width">Animal date of birth </th> <td class="half-width">{{$animal->first()->date_of_birth}}</td></tr>
                            <tr> <th class="end-text half-width">Animal availability </th> <td class="half-width">{{$animal->first()->availability}}</td></tr>
                            <tr> <th class="end-text half-width">Adoptee </th> <td class="half-width">{{$animal->first()->user_id}}</td></tr>
                            <tr class="justify-content-center full-width-row"> <th class="center-text full-width-row">Notes </th><td class="center-text full-width-row">{{$animal->first()->description}}</td></tr>
                            <tr> 
                                <td class="full-width-row">
                                    <div class="justify-content-center-row carrousel-container">
                                        <button class="carrousel-button carrousel-button-left" id="move-left"><i class="fas fa-chevron-circle-left"></i></button>
                                            {{-- iterate through image names and display the corresponding images --}}
                                            @foreach (explode(',', $animal->first()->image) as $img)
                                                @if ($img != "")              
                                                    <img class="full-width full-height carrousel-image image-hide" src="{{ asset('storage/images/'.$img)}}">
                                                @endif
                                            @endforeach
                                        <button class="carrousel-button carrousel-button-right" id="move-right"><i class="fas fa-chevron-circle-right"></i></button>
                                    </div>
                                </td>
                            </tr>
                    </table>
                </div>

                <!-- define the form to submit adoption requests -->
                <div class="card-body justify-content-center">
                    <form class="form-horizontal" method="POST"
                    action="{{url('adoption_requests') }}" enctype="multipart/form-data">
                        {{-- @csrf is used to ensure a csrf token is used to prevent cross-site request forgery --}}
                        @csrf
                        <input type="number" name="animal_id" placeholder="Animal name" value="{{ $animal->first()->id }}" hidden />
                        <input type="number" name="user_id" placeholder="Animal name" value="{{ Auth::user()->id }}" hidden />
                        <div class="button-group justify-content-center-row">
                            <a href="{{route('animals.index')}}" class="btn plain-button" role="button">Back to the list</a>
                            <input type="submit" class="btn plain-button" value="Submit adoption request"/>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>

    </div>
@endsection