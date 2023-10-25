@extends('layouts.master')

@section('header_section')
    <h5 class="mb-0">Product Category</h5>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product Category</li>
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
                                <h4 class="card-title">Product Category</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">

                            @if ($errors->any())
                                @foreach ($errors->all() as $error)

                                    <div class="alert alert-danger alert-dismissible fade show" role="alert"
                                         id="alert-message">
                                        Please Select The Product
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="ri-close-line" style="color:black"></i>
                                        </button>
                                    </div>

                                @endforeach
                            @endif

                            @include('alert.message')

                            <div class="table-responsive">

                                {!! Form::open(['method'=> 'POST','action'=> 'AdminProductCategoriesController@category_update']) !!}

                                <table  id="datatable" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                                <thead>
                                    <tr style="text-align:center">
                                        <th>No.</th>
                                        <th>Category Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($categories as $category)
                                        <tr style="text-align: center">
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                @if($category->is_active == 1)
                                                    <span class="badge iq-bg-primary">Active</span>
                                                @else
                                                    <span class="badge iq-bg-danger">Inactive</span>
                                                @endif
                                            </td>

                                            <td>
                                                <div class="flex align-items-center list-user-action">
                                                    @if($category->is_active == 1)
                                                        <button type="submit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Deactivate Category" class="btn-table" value="{{ $category->id }}" name="category_deactivate"><i class="ri-user-unfollow-fill"></i></button>
                                                    @else
                                                        <button type="submit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Approve Category" class="btn-table" value="{{ $category->id }}" name="category_active"><i class="ri-user-follow-fill"></i></button>
                                                    @endif
                                                    <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="{{ route("category.edit",$category->id) }}" ><i class="ri-pencil-line"></i></a>

                                                    <button type="submit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" class="btn-table" value="{{ $category->id }}" name="category_delete"><i class="ri-delete-bin-line"></i></button>

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
                                <h4 class="card-title">Add Product Category</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">

                            {!! Form::open(['method'=> 'POST','action'=> ['AdminProductCategoriesController@store'],'class'=>'col-lg-12  p-0 m-0 row']) !!}

                            <div class="form-group col-lg-6">
                                {!! Form::label('name','Category:') !!}
                                {!! Form::text('name', old('name'),['class'=>'form-control'.($errors->has('name') ? ' is-invalid' : null) ,'placeholder'=>"Enter Product Category", 'autofocus', 'autocomplete'=>'category_name','required']) !!}

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <input type="hidden" name="is_active" value="1">

                            <div class="form-group col-lg-12">
                                {!! Form::submit('Create Product Category   ',['class'=>'btn btn-primary']) !!}
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
