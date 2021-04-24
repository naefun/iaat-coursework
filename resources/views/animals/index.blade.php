@extends('layouts.app')
@section('content')
@guest
@else
    <div class="container">
        <div class="row justify-content-center">

            <div class="card justify-content-center">

                <div class="card-header">Animals</div>

                <div class="card-body justify-content-center table-responsive">
                    <div class="justify-content-center-row input-group">
                        <input class="search-box form-control" type="text" name="search" id="search" placeholder="Search for an animal..." />
                        <select name="animal_type" class="form-control" id="dropdown-search">
                            <option value="">Animal type...</option>
                            @foreach ($animalTypes as $animalType)
                                <option value="{{ $animalType }}">{{ $animalType }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- table start -->
                    <table class="table table-striped table-hover table-sortable">
                        <thead>
                            <tr>
                                <!-- table headers -->
                                <th scope="col">Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">DOB</th>
                                <th scope="col">Availability</th>
                                @if(Auth::user()->role == true)<th>Owner</th>@endif
                                <th id="no-sort" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($animals as $animal)
                                <tr> 
                                    <!-- table data -->
                                    <td scope="row">{{$animal['name']}}</td>
                                    <td>{{$animal['type']}}</td>
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
                                    
                                    <td>
                                        <a href="{{route('animals.show', ['animal' => $animal['id'] ] )}}" class="btn table-button">Details</a>
                                        @if(Auth::user()->role == false)
                                            <a href="{{ route('adoption_requests.create', ['animal' => $animal['id']]) }}" class="btn table-button">Create adoption request</a>
                                        @else
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endguest
@endsection