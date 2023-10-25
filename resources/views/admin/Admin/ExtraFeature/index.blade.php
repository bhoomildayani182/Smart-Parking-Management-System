@extends('layouts.master')

@section('header_section')
    <h5 class="mb-0">Product Extra Feature</h5>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product Extra Feature</li>
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
                                <h4 class="card-title">Product Extra Feature</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">

                            @include('alert.message')

                            <div class="table-responsive">

                                {!! Form::open(['method'=> 'POST','action'=> 'AdminProductExtraFeaturesController@feature_update']) !!}

                                <table  id="datatable" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                                    <thead>
                                    <tr style="text-align:center">
                                        <th>No.</th>
                                        <th>Feature Name</th>
                                        <td>Price</td>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($extraFeatures as $extraFeature)
                                        <tr style="text-align: center">
                                            <td>{{ $extraFeature->id }}</td>
                                            <td>{{ $extraFeature->name }}</td>
                                            <td>{{ $extraFeature->price }}</td>
                                            <td>
                                                <div class="flex align-items-center list-user-action">

                                                    <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="{{ route("feature.edit",$extraFeature->id) }}" ><i class="ri-pencil-line"></i></a>

                                                    <button type="submit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" class="btn-table" value="{{ $extraFeature->id }}" name="feature_delete"><i class="ri-delete-bin-line"></i></button>

                                                </div>
                                            </td>
                                        </tr>

                                    @empty

                                    @endforelse


                                    </tbody>
                                </table>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Add Product Feature</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">

                            {!! Form::open(['method'=> 'POST','action'=> ['AdminProductExtraFeaturesController@store'],'class'=>'col-lg-12  p-0 m-0 row']) !!}

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
                                {!! Form::submit('Create Feature',['class'=>'btn btn-primary']) !!}
                            </div>

                            {!! Form::close() !!}


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>

        var table = $('#datatable').DataTable();


        $(function () {
            $("#alert-message").fadeTo(5000, 500).slideUp(500, function () {
                $('#alert-message').slideUp(500);
            });
        });


    </script>

@endsection