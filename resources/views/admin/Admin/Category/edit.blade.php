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

                            {!! Form::model($category,['method'=> 'PATCH','action'=> ['AdminProductCategoriesController@update',$category->id],'class'=>'col-lg-12  p-0 m-0 row']) !!}

                            <div class="form-group col-lg-6">
                                {!! Form::label('name','Category:') !!}
                                {!! Form::text('name', old('name'),['class'=>'form-control'.($errors->has('name') ? ' is-invalid' : null) ,'placeholder'=>"Enter Product Category", 'autofocus', 'autocomplete'=>'category_name','required']) !!}

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group col-lg-6">
                                {!! Form::label('is_active','Status :') !!}
                                {!! Form::select('is_active',array(1=>'Active',0 => 'Not Active' ), null ,['class'=>'form-control'.($errors->has('name') ? ' is_active' : null)]) !!}
                            </div>



                            <div class="form-group col-lg-12">
                                {!! Form::submit('Update Category',['class'=>'btn btn-primary']) !!}

                                <a href="{{ route('category.index') }}" class="btn iq-bg-danger">cancel</a>
                            </div>

                            {!! Form::close() !!}


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

