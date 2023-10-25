@extends('layouts.master')

@section('header_section')
    <h5 class="mb-0">Create Client</h5>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">create Client</li>
        </ul>
    </nav>
@endsection

@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Add Client Information</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">

                            {!! Form::open(['method'=> 'POST','action'=> ['AdminUsersController@store']]) !!}

                            <div class="form-group">
                                {!! Form::label('name','Full Name:') !!}

                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" required autofocus placeholder="Enter Name">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group">
                                {!! Form::label('email','Email:') !!}
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                {!! Form::label('mobile_number','Mobile Number:') !!}

                                <input type="text" class="form-control mb-0 @error('mobile_number') is-invalid @enderror" name="mobile_number" placeholder="Enter Mobile Number" value="{{ old('mobile_number') }}" required autocomplete="number" >
                                @error('mobile_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                {!! Form::label('password','Password:') !!}
                                <input type="password" class="form-control mb-0 @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <input type="hidden" value="1" name="is_active">


                            <div class="form-group">
                                {!! Form::submit('Create User',['class'=>'btn btn-primary']) !!}
                                <a href="{{ route('user.index') }}" class="btn iq-bg-danger">cancel</a>
                            </div>

                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection