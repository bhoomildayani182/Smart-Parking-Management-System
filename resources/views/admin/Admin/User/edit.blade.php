@extends('layouts.master')

@section('header_section')
    <h5 class="mb-0">Client Edit</h5>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Client Edit</li>
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
                                <h4 class="card-title">User Edit</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">

                            {!! Form::model($user,['method'=> 'PATCH','action'=> ['AdminUsersController@update', $user->id]]) !!}

                                <div class="form-group">
                                    {!! Form::label('name','Full Name:') !!}
                                    {!! Form::text('name', null ,['class'=>'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('email','Email:') !!}
                                    {!! Form::email('email', null ,['class'=>'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('mobile_number','Mobile Number:') !!}
                                    {!! Form::text('mobile_number', null ,['class'=>'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('password','Update Password:') !!}
                                    {!! Form::password('password', ['class'=>'form-control']) !!}
                                </div>


                                <div class="form-group">
                                   {!! Form::submit('Edit User',['class'=>'btn btn-primary']) !!}
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