@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="card justify-content-center">

                <div class="card-header">Animal details</div>

                <div class="card-body justify-content-center">
                    <!-- data table -->
                    <table class="show-table table table-striped">
                        <!-- table headers -->
                        <tr> <th class="end-text half-width">Animal name </th> <td class="half-width"> {{$animal['name']}}</td></tr>
                        <tr> <th class="end-text half-width">Animal date of birth </th> <td class="half-width">{{$animal->date_of_birth}}</td></tr>
                        <tr> <th class="end-text half-width">Animal availability </th> <td class="half-width">{{$animal->availability}}</td></tr>
                        
                        <tr> 
                            <th class="end-text half-width">Adoptee </th>  
                            <td class="half-width">                                       
                                @foreach($people as $person)
                                    @if($person->id == $animal['user_id'])
                                        {{$person->name }}
                                    @endif
                                @endforeach
                            </td>
                        </tr>

                        <tr class="justify-content-center full-width-row"> <th class="center-text full-width-row">Notes </th><td class="center-text full-width-row">{{$animal->description}}</td></tr>
                        
                        <!-- table data -->
                        <tr> 
                            <td class="full-width-row">
                                <div class="justify-content-center-row carrousel-container">
                                    <button class="carrousel-button carrousel-button-left" id="move-left"><i class="fas fa-chevron-circle-left"></i></button>
                                        {{-- parse the comma separated array of image names and display them --}}
                                        @foreach (explode(',', $animal->image) as $img)
                                            @if ($img != "")              
                                                <img class="full-width full-height carrousel-image image-hide" src="{{ asset('storage/images/'.$img)}}">
                                            @endif
                                        @endforeach
                                    <button class="carrousel-button carrousel-button-right" id="move-right"><i class="fas fa-chevron-circle-right"></i></button>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <div class="button-group justify-content-center-row">
                        <a href="{{route('animals.index')}}" class="btn plain-button" role="button">Back to the list</a>
                        <!-- allows public user to submit adoption request -->
                        @if(Auth::user()->role == false)
                            <a href="{{ route('adoption_requests.create', ['animal' => $animal['id']]) }}" class="btn plain-button">Create adoption request</a>
                        @else
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection