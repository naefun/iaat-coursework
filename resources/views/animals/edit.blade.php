{{-- view allows for editing of animal entries, not used but kept in-case it is implemented further down the line --}}

@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-header">Edit and update the animal</div> 
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br />
                    @endif
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <p>{{ \Session::get('success') }}</p>
                        </div><br />
                    @endif
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ route('animals.update', ['animal' =>
                        $animal['id']]) }}" enctype="multipart/form-data" >
                            @method('PATCH')
                            {{-- @csrf is used to ensure a csrf token is used to prevent cross-site request forgery --}}
                            @csrf
                            <div class="col-md-8">
                                <label>Animal name</label>
                                <input type="text" name="name" value="{{$animal->name}}"/>
                            </div>
                            <div class="col-md-8">
                                <label>Animal date of birth</label>
                                <input type="date" name="date_of_birth" value="{{$animal->date_of_birth}}" />
                            </div>
                            <div class="col-md-8">
                                <label >Description</label>
                                <textarea rows="4" cols="50" name="description">{{$animal->description}}</textarea>
                            </div>
                            <div class="col-md-8">
                                <label>Image</label>
                                <input type="file" name="image" />
                            </div>
                            <div class="col-md-6 col-md-offset-4">
                                <input type="submit" class="btn btn-primary" />
                                <input type="reset" class="btn btn-primary" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection