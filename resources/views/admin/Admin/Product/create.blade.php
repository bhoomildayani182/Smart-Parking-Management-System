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
                <div class="col-sm-12 col-lg-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Add Client Information</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">



                            {!! Form::open(['method'=> 'POST','action'=> ['AdminProductsController@store'],'class'=>'col-lg-12  p-0 m-0 row']) !!}

                                <div class="form-group col-lg-6">
                                    {!! Form::label('name','Product Name:') !!}
                                    {!! Form::text('name', old('name'),['class'=>'form-control'.($errors->has('category_id') ? ' is-invalid' : null) ,'placeholder'=>"Enter Product Name", 'autofocus', 'autocomplete'=>'name','required']) !!}

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>


                                <div class="form-group col-lg-6">
                                    {!! Form::label('category_id','Category:') !!}

                                    {!! Form::select('category_id',[''=>'Choose Category'] + $categories , old('category_id') ,['required' => 'required','class'=>'form-control' . ($errors->has('category_id') ? ' is-invalid' : null)]) !!}

                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6">
                                    {!! Form::label('price','Price:') !!}
                                    {!! Form::text('price', old('price'),['pattern'=>"[0-9]+([\.,][0-9]+)?",'class'=>'form-control'.($errors->has('price') ? ' is-invalid' : null) ,'placeholder'=>"Enter Product Price", 'autocomplete'=>'price','required']) !!}

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="form-group col-lg-6">
                                    {!! Form::label('quantity','Quantity:') !!}
                                    {!! Form::text('quantity', old('quantity'),['class'=>'form-control'.($errors->has('quantity') ? ' is-invalid' : null) ,'placeholder'=>"Enter Product Quantity",'required']) !!}

                                    @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="form-group col-lg-6">
                                    {!! Form::label('size_id','Size:') !!}

                                    {!! Form::select('size_id',[''=>'Choose Product Size'] + $sizes , old('category_id') ,['class'=>'form-control' . ($errors->has('size_id') ? ' is-invalid' : null)]) !!}

                                    @error('size_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6">
                                    {!! Form::label('extrafeature_id','Extra Feature:') !!}

                                    {!! Form::select('extrafeature_id',[''=>'Choose Extra Feature'] + $extraFeatures , old('extrafeature_id') ,['class'=>'form-control' . ($errors->has('extrafeature_id') ? ' is-invalid' : null)]) !!}

                                    @error('extrafeature_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6">
                                    {!! Form::label('description','Description:') !!}
                                    {!! Form::text('description', old('description'),['class'=>'form-control'.($errors->has('description') ? ' is-invalid' : null) ,'placeholder'=>"Enter Product Description"]) !!}

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="form-group col-lg-6">
                                    {!! Form::label('remark','Remark:') !!}
                                    {!! Form::text('remark', old('remark'),['class'=>'form-control'.($errors->has('remark') ? ' is-invalid' : null) ,'placeholder'=>"Enter Product Remark"]) !!}

                                    @error('remark')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>


                            <div class="form-group col-lg-12">
                                {!! Form::submit('Create Product',['class'=>'btn btn-primary']) !!}
                                <a href="{{ route('product.index') }}" class="btn iq-bg-danger">cancel</a>
                            </div>

                            {!! Form::close() !!}


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection