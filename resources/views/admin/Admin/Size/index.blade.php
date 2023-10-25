@extends('layouts.master')

@section('header_section')
    <h5 class="mb-0">Product Extra Size</h5>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product Extra Size</li>
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
                                <h4 class="card-title">Product Size</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">

                            @include('alert.message')

                            <div class="table-responsive">

                                {!! Form::open(['method'=> 'POST','action'=> 'AdminProductSizeController@size_update']) !!}

                                <table  id="datatable" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                                    <thead>
                                    <tr style="text-align:center">
                                        <th>No.</th>
                                        <th>Size Name</th>
                                        <th>Height</th>
                                        <th>Width</th>
                                        <th>Weight</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($size as $size)
                                        <tr style="text-align: center">
                                            <td>{{ $size->id }}</td>
                                            <td>{{ $size->name }}</td>
                                            <td>{{ $size->height }}</td>
                                            <td>{{ $size->width }}</td>
                                            <td>{{ $size->weight }}</td>
                                            <td>
                                                @if($size->is_active == 1)
                                                    <span class="badge iq-bg-primary">Active</span>
                                                @else
                                                    <span class="badge iq-bg-danger">Inactive</span>
                                                @endif
                                            </td>

                                            <td>
                                                <div class="flex align-items-center list-user-action">

                                                    @if($size->is_active == 1)
                                                        <button type="submit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Deactivate Size" class="btn-table" value="{{ $size->id }}" name="size_deactivate"><i class="ri-user-unfollow-fill"></i></button>
                                                    @else
                                                        <button type="submit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Approve Size" class="btn-table" value="{{ $size->id }}" name="size_active"><i class="ri-user-follow-fill"></i></button>
                                                    @endif

                                                    <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="{{ route("size.edit",$size->id) }}" ><i class="ri-pencil-line"></i></a>

                                                    <button type="submit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" class="btn-table" value="{{ $size->id }}" name="size_delete"><i class="ri-delete-bin-line"></i></button>

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
                <div class="col-sm-12 col-lg-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Add Product Size</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">

                            {!! Form::open(['method'=> 'POST','action'=> ['AdminProductSizeController@store'],'class'=>'col-lg-12  p-0 m-0 row']) !!}

                            <div class="form-group col-lg-3">
                                {!! Form::label('name','Size Name:') !!}
                                {!! Form::text('name', old('name'),['class'=>'form-control'.($errors->has('name') ? ' is-invalid' : null) ,'placeholder'=>"Enter Size Name", 'autocomplete'=>'size_name','required']) !!}

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>



                            <div class="form-group col-lg-3">
                                {!! Form::label('height','Height:') !!}
                                {!! Form::text('height', old('height'),['class'=>'form-control'.($errors->has('height') ? ' is-invalid' : null) ,'placeholder'=>"Enter Product Height", 'autocomplete'=>'size_height']) !!}

                                @error('height')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>


                            <div class="form-group col-lg-3">
                                {!! Form::label('width','Width:') !!}
                                {!! Form::text('width', old('width'),['class'=>'form-control'.($errors->has('width') ? ' is-invalid' : null) ,'placeholder'=>"Enter Product Width", 'autocomplete'=>'size_width']) !!}

                                @error('width')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group col-lg-3">
                                {!! Form::label('weight','Weight:') !!}
                                {!! Form::text('weight', old('weight'),['class'=>'form-control'.($errors->has('weight') ? ' is-invalid' : null) ,'placeholder'=>"Enter Product Weight", 'autocomplete'=>'size_weight']) !!}

                                @error('weight')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group col-lg-12">
                                {!! Form::submit('Create Product Size',['class'=>'btn btn-primary']) !!}
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