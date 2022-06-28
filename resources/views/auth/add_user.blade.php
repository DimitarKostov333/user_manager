@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-12">
                <a href="{{ url('/') }}">< Go Back</a>
                <hr/>
                <h1>Add Users</h1>
                <p>Add a new user below.</p>
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
                <form action="{{ url('users') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name')  }}" required/>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Surname</label>
                        <input type="text" class="form-control" name="surname" value="{{ old('surname')  }}" required/>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">South African ID Number</label>
                        <input type="number" class="form-control" name="personal_id_number" value="{{ old('personal_id_number')  }}" required/>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mobile Number</label>
                        <input type="number" class="form-control" name="mobile_number" value="{{ old('mobile_number')  }}" required/>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email')  }}" required/>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Birth Date</label>
                        <input type="text" class="form-control datepicker" value="{{ old('birth_date')  }}" name="birth_date" required/>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Language</label>
                        <select class="form-control" name="language">
                            <option value="">Please select your preferred language</option>
                            @foreach($languages as $language )
                                <option value="{{ $language->langEN }}">{{ $language->langEN }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="password" required/>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" required/>
                    </div>
                    <button type="submit" class="btn btn-primary">Add User</button>
                    <button type="reset" class="btn btn-danger float-right">Clear All Form Fields</button>
                </form>
            </div>
        </div>
    </div>
@endsection
