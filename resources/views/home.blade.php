@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table>
                        {{ __('You are logged in!') }}
                        {{-- if the user is a regular user --}}
                        @if(Auth::user()->role == false)
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>DOB</th>
                                    <th>Availability</th>
                                    <th colspan="3">Action</th>
                                </tr>
                            </thead>
                            @foreach($homeInformation as $info)
                                    <tr>
                                        <td>{{$info['name']}}</td>
                                        <td>{{$info['date_of_birth']}}</td>
                                        <td>{{$info['availability']}}</td>
                                        <td><a href="{{ route('animals.show', ['animal' => $info['id'] ] ) }}" class="btn btnprimary">Details</a></td>
                                        <td><a href="{{ route('adoption_requests.create', ['animal' => $info['id']]) }}" class="btn btnwarning">Create adoption request</a></td>
                                    </tr>
                            @endforeach
                        {{-- if the user is an admin --}}
                        @else
                            <thead>
                                <tr>
                                    <th> Requesters name</th><th> Animal name</th><th> Request status</th><th> Actions</th>
                                </tr>
                            </thead>
                            @foreach($homeInformation as $info)
                                <tr>
                                    @foreach($people as $person)
                                        @if($person->id == $info->user_id)
                                            <td> {{$person->name}} </td>
                                        @endif
                                    @endforeach
                                    @foreach($animals as $animal)
                                        @if($animal->id == $info->animal_id)
                                            <td> {{$animal->name}} </td>
                                        @endif
                                    @endforeach
                                    <td> {{$info->request_status}} </td> 
                                    <td> 
                                        <form action="{{ action([App\Http\Controllers\AdoptionRequestController::class, 'update'],
                                        ['adoption_request' => $info['id']]) }}" method="post"> 
                                            @method('PATCH')
                                            @csrf
                                            <input name="request_status" type="hidden" value="approved">
                                            <button class="btn btn-danger" type="submit"> Accept request</button>
                                        </form>
                                        <form action="{{ action([App\Http\Controllers\AdoptionRequestController::class, 'update'],
                                        ['adoption_request' => $info['id']]) }}" method="post"> 
                                            @method('PATCH')
                                            @csrf
                                            <input name="request_status" type="hidden" value="denied">
                                            <button class="btn btn-danger" type="submit"> Deny request</button>
                                        </form>
                                        {{--
                                        <form action="{{ action([App\Http\Controllers\AdoptionRequestController::class, 'destroy'],
                                        ['adoption_request' => $info['id']]) }}" method="post">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button class="btn btn-danger" type="submit"> Delete</button>
                                        </form>
                                        --}}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
