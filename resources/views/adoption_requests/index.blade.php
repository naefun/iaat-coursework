@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card justify-content-center">

                <div class="card-header">Adoption requests</div>

                <div class="card-body justify-content-center">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <input class="max-width-70 form-control" type="text" name="search" id="search" placeholder="Search for a request..." />
                    <table class="table table-striped table-hover table-sortable">
                        <thead>
                            <tr>
                                <th scope="col"> Requesters name</th>
                                <th scope="col"> Animal name</th>
                                <th scope="col"> Request status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($adoptionRequests as $adoptionRequest)
                                <tr>
                                    @foreach($people as $person)
                                        @if($person->id == $adoptionRequest->user_id)
                                            <td scope="row"> {{$person->name}} </td>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection