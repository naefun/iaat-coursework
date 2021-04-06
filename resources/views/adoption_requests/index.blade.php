@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th> id</th><th> User-id</th><th> Animal-id</th><th> Request status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($adoptionRequests as $adoptionRequest)
                                    <tr>
                                        <td> {{$adoptionRequest->id}} </td>
                                        <td> {{$adoptionRequest->user_id}} </td>
                                        <td> {{$adoptionRequest->animal_id}} </td>
                                        <td> {{$adoptionRequest->request_status}} </td> 
                                        <td>
                                            <form action="{{ action([App\Http\Controllers\AdoptionRequestController::class, 'destroy'],
                                            ['adoption_request' => $adoptionRequest['id']]) }}" method="post">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button class="btn btn-danger" type="submit"> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection