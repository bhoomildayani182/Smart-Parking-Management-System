@extends('layouts.master')

@section('header_section')
    <h5 class="mb-0">Product Category Edit</h5>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product Category Edit</li>
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
                                <h4 class="card-title">Edit Product Category</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">

                            {!! Form::model($feature,['method'=> 'PATCH','action'=> ['AdminProductExtraFeaturesController@update',$feature->id],'class'=>'col-lg-12  p-0 m-0 row']) !!}

                            <div class="form-group col-lg-6">
                                {!! Form::label('name','Feature Name:') !!}
                                {!! Form::text('name', old('name'),['class'=>'form-control'.($errors->has('name') ? ' is-invalid' : null) ,'placeholder'=>"Enter Feature Name", 'autofocus', 'autocomplete'=>'feature_name','required']) !!}

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group col-lg-6">
                                {!! Form::label('price','Price:') !!}
                                {!! Form::text('price', old('price'),['class'=>'form-control'.($errors->has('price') ? ' is-invalid' : null) ,'placeholder'=>"Enter Feature Price", 'autocomplete'=>'feature_price','required']) !!}

                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group col-lg-12">
                                {!! Form::submit('Update Feature',['class'=>'btn btn-primary']) !!}
                                <a href="{{ route('feature.index') }}" class="btn iq-bg-danger">cancle</a>
                            </div>

                            {!! Form::close() !!}


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

