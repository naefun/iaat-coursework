@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="card justify-content-center">
            
            <div class="card-header">{{ __('Dashboard') }}</div>

            <div class="card-body justify-content-center">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
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

                <input class="search-box form-control" type="text" name="search" id="search" placeholder="Search..." />
                <table class="table table-striped table-hover table-sortable">
                    {{-- if the user is a public user --}}
                    @if(Auth::user()->role == false)
                        <thead>
                            <tr>
                                {{-- headings --}}
                                <th scope="col">Name</th>
                                <th scope="col">DOB</th>
                                <th scope="col">Availability</th>
                                <th id="no-sort" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($homeInformation as $info)
                                    <tr>
                                        {{-- data --}}
                                        <td scope="row">{{$info['name']}}</td>
                                        <td>{{$info['date_of_birth']}}</td>
                                        <td>{{$info['availability']}}</td>
                                        <td>
                                            <a href="{{ route('animals.show', ['animal' => $info['id'] ] ) }}" class="btn table-button">Details</a>
                                            <a href="{{ route('adoption_requests.create', ['animal' => $info['id']]) }}" class="btn table-button">Create adoption request</a>
                                        </td>
                                    </tr>
                            @endforeach
                        </tbody>
                    {{-- if the user is a staff user --}}
                    @else
                        <thead>
                            <tr>
                                {{-- headings --}}
                                <th scope="col"> Requesters name</th>
                                <th scope="col"> Animal name</th>
                                <th scope="col"> Request status</th>
                                <th id="no-sort" scope="col"> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($homeInformation as $info)
                                <tr>
                                    {{-- data --}}
                                    @foreach($people as $person)
                                        @if($person->id == $info->user_id)
                                            <td scope="row"> {{$person->name}} </td>
                                        @endif
                                    @endforeach
                                    @foreach($animals as $animal)
                                        @if($animal->id == $info->animal_id)
                                            <td> {{$animal->name}} </td>
                                        @endif
                                    @endforeach
                                    <td> {{$info->request_status}} </td> 
                                    <td class="flex-row action-buttons"> 
                                        <form action="{{ action([App\Http\Controllers\AdoptionRequestController::class, 'update'],
                                        ['adoption_request' => $info['id']]) }}" method="post"> 
                                            @method('PATCH')
                                            @csrf
                                            <input name="request_status" type="hidden" value="approved">
                                            <button class="btn green-button" type="submit">Accept</button>
                                        </form>
                                        <form action="{{ action([App\Http\Controllers\AdoptionRequestController::class, 'update'],
                                        ['adoption_request' => $info['id']]) }}" method="post"> 
                                            @method('PATCH')
                                            @csrf
                                            <input name="request_status" type="hidden" value="denied">
                                            <button class="btn red-button" type="submit">Deny</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endif
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
