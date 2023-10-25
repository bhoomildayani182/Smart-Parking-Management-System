@extends('layouts.master')

@section('header_section')
    <h5 class="mb-0">User Account</h5>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Account</li>
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
                                <h4 class="card-title">User Account</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">

                            {!! Form::model($user_account,['method'=> 'PATCH','action'=> ['AdminAccountController@update',$user_account->id],'class'=>'col-lg-12  p-0 m-0 row']) !!}





                            <div class="form-group col-lg-6">
                                {!! Form::label('remaining_amount','Total Amount:') !!}
                                {!! Form::text('remaining_amount', null,['class'=>'form-control'.($errors->has('remaining_amount') ? ' is-invalid' : null) ,'placeholder'=>"Total Amount",'required','disabled']) !!}

                                @error('total_amount')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group col-lg-6">
                                {!! Form::label('new_paid_amount','Paid Amount:') !!}
                                {!! Form::text('new_paid_amount', old('new_paid_amount'),['class'=>'form-control'.(Session::has('message') ? ' is-invalid' : null) ,'placeholder'=>"Paid Amount", 'autofocus', 'required']) !!}


                                @error('new_paid_amount')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                @if(Session::has('message'))

                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ Session::get('message') }}</strong>
                                    </span>

                                @endif

                            </div>


                            <div class="form-group col-lg-12">
                                {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}

                                <a href="{{ url()->previous() }}" class="btn iq-bg-danger">Back</a>
                            </div>

                            {!! Form::close() !!}


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

