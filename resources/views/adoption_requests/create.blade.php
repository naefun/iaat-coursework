<!-- inherite master template app.blade.php -->
@extends('layouts.app')
<!-- define the content section -->
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 ">
                <div class="card">
                    <div class="card-header">Create an new adoption request</div>
                    <!-- display the errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul> @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li> @endforeach
                            </ul>
                        </div><br /> 
                    @endif
                    <!-- display the success status -->
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <p>{{ \Session::get('success') }}</p>
                        </div><br /> 
                    @endif
                    <!-- show animal information -->
                    <div class="card-body">
                        <table class="table table-striped" border="1" >
                                <tr> <th>Animal name </th> <td> {{$animal->first()->name}}</td></tr>
                                <tr> <th>Animal date of birth </th> <td>{{$animal->first()->date_of_birth}}</td></tr>
                                <tr> <th>Animal availability </th> <td>{{$animal->first()->availability}}</td></tr>
                                <tr> <th>Adoptee </th> <td>{{$animal->first()->user_id}}</td></tr>
                                <tr> <th>Notes </th> <td style="max-width:150px;" >{{$animal->first()->description}}</td></tr>
                                <tr> <td colspan='2' ><img style="width:100%;height:100%"
                                src="{{ asset('storage/images/'.$animal->first()->image)}}"></td></tr>
                        </table>
                    </div>
                    <!-- define the form -->
                    <div class="card-body">
                        <form class="form-horizontal" method="POST"
                        action="{{url('adoption_requests') }}" enctype="multipart/form-data">
                            @csrf
                            <!-- 
                                hidden animal id
                                hidden user id
                                show animal details
                            -->
                            
                            <input type="number" name="animal_id" placeholder="Animal name" value="{{ $animal->first()->id }}" hidden />
                            <input type="number" name="user_id" placeholder="Animal name" value="{{ Auth::user()->id }}" hidden />

                            <div class="col-md-6 col-md-offset-4">
                                <input type="submit" class="btn btn-primary" value="Submit adoption request"/>
                            </div>
                            <a href="{{route('animals.index')}}" class="btn btn-primary" role="button">Back to the list</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection