@extends('layouts.master')

@section('header_section')
    <h5 class="mb-0">Product Size Edit</h5>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product Size Edit</li>
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
                                <h4 class="card-title">Edit Product Size</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">

                            {!! Form::model($size,['method'=> 'PATCH','action'=> ['AdminProductSizeController@update',$size->id],'class'=>'col-lg-12  p-0 m-0 row']) !!}

                            <div class="form-group col-lg-12">
                                {!! Form::label('name','Size Name:') !!}
                                {!! Form::text('name', old('name'),['class'=>'form-control'.($errors->has('name') ? ' is-invalid' : null) ,'placeholder'=>"Enter Size Name", 'autofocus', 'autocomplete'=>'size_name','required']) !!}

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>



                            <div class="form-group col-lg-12">
                                {!! Form::label('height','Height:') !!}
                                {!! Form::text('height', old('height'),['class'=>'form-control'.($errors->has('height') ? ' is-invalid' : null) ,'placeholder'=>"Enter Product Height", 'autocomplete'=>'size_height']) !!}

                                @error('height')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>


                            <div class="form-group col-lg-12">
                                {!! Form::label('width','Width:') !!}
                                {!! Form::text('width', old('width'),['class'=>'form-control'.($errors->has('width') ? ' is-invalid' : null) ,'placeholder'=>"Enter Product Width", 'autocomplete'=>'size_width']) !!}

                                @error('width')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group col-lg-12">
                                {!! Form::label('weight','Weight:') !!}
                                {!! Form::text('weight', old('weight'),['class'=>'form-control'.($errors->has('weight') ? ' is-invalid' : null) ,'placeholder'=>"Enter Product Weight", 'autocomplete'=>'size_weight']) !!}

                                @error('weight')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group col-lg-12">
                                {!! Form::label('is_active','Status :') !!}
                                {!! Form::select('is_active',array(1=>'Active',0 => 'Not Active' ), null ,['class'=>'form-control'.($errors->has('name') ? ' is_active' : null)]) !!}
                            </div>

                            <div class="form-group col-lg-12">
                                {!! Form::submit('Update Size',['class'=>'btn btn-primary']) !!}
                                <a href="{{ route('size.index') }}" class="btn iq-bg-danger">cancel</a>
                            </div>

                            {!! Form::close() !!}


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

