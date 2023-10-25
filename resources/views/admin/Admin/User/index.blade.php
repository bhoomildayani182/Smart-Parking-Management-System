
@extends('layouts.master')

@section('header_section')
    <h5 class="mb-0">Client List</h5>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Client List</li>
        </ul>
    </nav>
@endsection

@section('content')

    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Client List</h4>
                            </div>
                            <div class="user-list-files d-flex float-right">


                                <a href="{{ route('user.create') }}" class="chat-icon-phone">
                                    Add Client
                                </a>

                                <a onclick="exportdata('#datatable', 'Client_list.csv', 'csv');" href="#" class="chat-icon-phone">
                                    Excel
                                </a>


                            </div>
                        </div>

                        <div class="iq-card-body">

                            @if ($errors->any())
                                @foreach ($errors->all() as $error)

                                    <div class="alert alert-danger alert-dismissible fade show" role="alert"
                                         id="alert-message">
                                        Please Select The Client
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="ri-close-line" style="color:black"></i>
                                        </button>
                                    </div>

                                @endforeach
                            @endif

                            @include('alert.message')

                                <div class="table-responsive">

                                {!! Form::open(['method'=> 'POST','action'=> 'AdminUsersController@user_data_update']) !!}

                                <table  id="datatable" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                                    <thead>
                                    <tr>
                                        <th  class="text-center">
                                            <input type="checkbox" class="checkbox-input" id="allCheck">
                                        </th>
                                        <th>Name</th>
                                        <th>Mobile No.</th>
                                        <th>Email</th>
                                        <th>Active</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" name="userCheck[]" class="checkbox-input Checkbox" value="{{ $user->id }}">
                                                {{--{!! Form::checkbox('userCheck[]', $user->id ,['class'=>'form-control','checked'=>'']) !!}--}}
                                            </td>

                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->mobile_number }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if($user->is_active == 1)
                                                <span class="badge iq-bg-primary">Active</span>
                                                    @else
                                                <span class="badge iq-bg-danger">Inactive</span>
                                                @endif
                                            </td>

                                            <td>
                                                <div class="flex align-items-center list-user-action">
                                                    @if($user->is_active == 1)
                                                        <button type="submit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Deactivate Client" class="btn-table" value="{{ $user->id }}" name="user_deactivate"><i class="ri-user-unfollow-fill"></i></button>
                                                    @else
                                                        <button type="submit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Approve Client" class="btn-table" value="{{ $user->id }}" name="user_active"><i class="ri-user-follow-fill"></i></button>
                                                    @endif
                                                    <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="{{ route("user.edit",$user->id) }}" ><i class="ri-pencil-line"></i></a>

                                                    <button type="submit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" class="btn-table" value="{{ $user->id }}" name="user_delete"><i class="ri-delete-bin-line"></i></button>

                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {!! Form::close() !!}

                            </div>
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


    $('<div class="pull-right row" style="margin-right:15px">' +
            '<input type="submit" class="btn btn-primary" value="Approve Client" name="approve_user" style="color: #fff;background-color: #007bff;border-color: #007bff;line-height: 1.5;">'+
        '</div>'
        ).appendTo("#datatable_wrapper .dataTables_filter"); //example is our table id

    $(".dataTables_filter label").addClass("pull-right");


        $(function () {
            $("#alert-message").fadeTo(5000, 500).slideUp(500, function () {
                $('#alert-message').slideUp(500);
            });
        });


    </script>

@endsection