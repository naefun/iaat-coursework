@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card justify-content-center">

                <div class="card-header">Dashboard</div>

                <div class="card-body justify-content-center">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th> Requesters name</th><th> Animal name</th><th> Request status</th>
                                {{--@if(Auth::user()->role == true)<th> Actions</th>@endif--}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($adoptionRequests as $adoptionRequest)
                                <tr>
                                    @foreach($people as $person)
                                        @if($person->id == $adoptionRequest->user_id)
                                            <td> {{$person->name}} </td>
                                        @endif
                                    @endforeach
                                    @foreach($animals as $animal)
                                        @if($animal->id == $adoptionRequest->animal_id)
                                            <td> {{$animal->name}} </td>
                                        @endif
                                    @endforeach
                                    <td class="request-status"> 
                                        {{$adoptionRequest->request_status}} 
                                        @if($adoptionRequest->request_status == "approved")
                                            <div class="status-circle green-circle"></div>
                                        @elseif($adoptionRequest->request_status == "denied")
                                            <div class="status-circle red-circle"></div>
                                        @else
                                            <div class="status-circle"></div>
                                        @endif
                                    </td> 

                                    {{--
                                    @if(Auth::user()->role == true)
                                        <td>
                                            <form action="{{ action([App\Http\Controllers\AdoptionRequestController::class, 'update'],
                                            ['adoption_request' => $adoptionRequest['id']]) }}" method="post"> 
                                                @method('PATCH')
                                                @csrf
                                                <input name="request_status" type="hidden" value="approved">
                                                <button class="btn btn-danger" type="submit"> Accept request</button>
                                            </form>
                                            <form action="{{ action([App\Http\Controllers\AdoptionRequestController::class, 'update'],
                                            ['adoption_request' => $adoptionRequest['id']]) }}" method="post"> 
                                                @method('PATCH')
                                                @csrf
                                                <input name="request_status" type="hidden" value="denied">
                                                <button class="btn btn-danger" type="submit"> Deny request</button>
                                            </form>
                                            <form action="{{ action([App\Http\Controllers\AdoptionRequestController::class, 'destroy'],
                                            ['adoption_request' => $adoptionRequest['id']]) }}" method="post">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button class="btn btn-danger" type="submit"> Delete</button>
                                            </form>
                                        </td>
                                    @endif
                                    --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection