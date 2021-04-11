@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="card justify-content-center">

                <div class="card-header">Animals</div>

                <div class="card-body justify-content-center table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">DOB</th>
                                <th scope="col">Availability</th>
                                @if(Auth::user()->role == true)<th>Owner</th>@endif
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($animals as $animal)
                                <tr> 
                                    <th scope="row">{{$animal['name']}}</th>
                                    <td>{{$animal['date_of_birth']}}</td>
                                    <td>{{$animal['availability']}}</td>
                                    @if(Auth::user()->role == true)
                                        @if($animal['user_id'] == null)
                                            <td></td>
                                        @else
                                            @foreach($people as $person)
                                                @if($person->id == $animal['user_id'])
                                                    <td> {{$person->name }} </td>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endif
                                    <td><a href="{{route('animals.show', ['animal' => $animal['id'] ] )}}" class="btn table-button">Details</a></td>
                                    @if(Auth::user()->role == false)
                                        <td><a href="{{ route('adoption_requests.create', ['animal' => $animal['id']]) }}" class="btn table-button">Create adoption request</a></td>
                                    @else
                                        {{--
                                        <td><a href="{{ route('animals.edit', ['animal' => $animal['id']]) }}" class="btn btnwarning">Edit</a></td>
                                        <td>
                                            <form action="{{ action([App\Http\Controllers\AnimalController::class, 'destroy'],
                                            ['animal' => $animal['id']]) }}" method="post">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button class="btn btn-danger" type="submit"> Delete</button>
                                            </form>
                                        </td>
                                        --}}
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection