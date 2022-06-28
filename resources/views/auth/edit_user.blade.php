@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a href="{{ url('/') }}">< Go Back</a>
                <hr/>
                <h1>Edit Users</h1>
                <p>Edit {{ $allUsersDetails->name . " " . $allUsersDetails->surname }}'s profile below.</p>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <p><strong>Opps Something went wrong</strong></p>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <form action="{{ route('users.update',$allUsersDetails->id) }}" method="post">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $allUsersDetails->name ?? '' }}" required/>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Surname</label>
                        <input type="text" class="form-control" name="surname" value="{{ $allUsersDetails->surname ?? '' }}" required/>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">South African ID Number</label>
                        <input type="number" class="form-control" name="personal_id_number" value="{{ $allUsersDetails->personal_id_number ?? '' }}" minlength="10" maxlength="13"/>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mobile Number</label>
                        <input type="number" class="form-control" name="mobile_number" value="{{ $allUsersDetails->mobile_number ?? '' }}" minlength="8" maxlength="10"/>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $allUsersDetails->email ?? '' }}" required/>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Birth Date</label>
                        <input type="text" class="form-control datepicker" name="birth_date" value="{{ $allUsersDetails->birth_date ?? '' }}"/>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Language</label>
                        <select class="form-control" name="language">
                            <option value="{{ $allUsersDetails->language ?? '' }}">{{ $allUsersDetails->language ?? '' }}</option>
                            @if($languages)
                                @foreach($languages as $language )
                                    <option value="{{ $language->langEN }}">{{ $language->langEN }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="password" />
                    </div>
                    <button type="submit" class="btn btn-primary">Edit User</button>
                    <button type="reset" class="btn btn-danger float-right">Clear All Form Fields</button>
                </form>
            </div>
        </div>
    </div>
@endsection
