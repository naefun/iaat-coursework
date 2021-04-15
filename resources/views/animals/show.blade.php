@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="card justify-content-center">

                <div class="card-header">Animal details</div>

                <div class="card-body justify-content-center">
                    <table class="show-table table table-striped">
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
                        <tr> <td class="full-width-row"><img class="full-width full-height"
                            src="{{ asset('storage/images/'.$animal->image)}}"></td></tr>
                    </table>
                    <div class="button-group justify-content-center-row">
                        <a href="{{route('animals.index')}}" class="btn plain-button" role="button">Back to the list</a>
                        @if(Auth::user()->role == false)
                            <a href="{{ route('adoption_requests.create', ['animal' => $animal['id']]) }}" class="btn plain-button">Create adoption request</a>
                        @else
                            {{--
                            <td><a href="{{ route('animals.edit', ['animal' => $animal['id']]) }}" class="btn btnwarning">Edit</a></td>
                            <td>
                                <form action="{{ route('animals.destroy', ['animal' => $animal['id']]) }}" method="post">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                            --}}
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection