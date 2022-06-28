@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>Manage Users</h1>
                <a href="{{ url('users/create') }}" class="btn btn-success ">Add Users</a>
                <br/><br/>
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
                <form id="userTable">
                    @csrf
                    <div>
                        <table id="userManagementTable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Surname</th>
                                    <th>ID Number</th>
                                    <th>Mobile No.</th>
                                    <th>Email</th>
                                    <th>Birth Date</th>
                                    <th>Language</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allUsersDetails as $user)
                                    <tr>
                                        <th>{{ $user->name }}</th>
                                        <th>{{ $user->surname }}</th>
                                        <th>{{ $user->personal_id_number }}</th>
                                        <th>{{ $user->mobile_number }}</th>
                                        <th>{{ $user->email }}</th>
                                        <th>{{ $user->birth_date }}</th>
                                        <th>{{ $user->language }}</th>
                                        <th><a href="{{ url('/users/'.$user->id.'/edit') }}" class="btn btn-info">Edit Profile</a></th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
