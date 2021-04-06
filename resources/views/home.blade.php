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
                        @else
                            <thead>
                                <tr>
                                    <th> id</th><th> User-id</th><th> Animal-id</th><th> Request status</th>
                                </tr>
                            </thead>
                            @foreach($homeInformation as $info)
                                <tr>
                                    <td> {{$info->id}} </td>
                                    <td> {{$info->user_id}} </td>
                                    <td> {{$info->animal_id}} </td>
                                    <td> {{$info->request_status}} </td> 
                                    <td>
                                        <form action="{{ action([App\Http\Controllers\AdoptionRequestController::class, 'destroy'],
                                        ['adoption_request' => $info['id']]) }}" method="post">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button class="btn btn-danger" type="submit"> Delete</button>
                                        </form>
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
