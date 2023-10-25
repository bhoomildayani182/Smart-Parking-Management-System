
@extends('layouts.master')

@section('header_section')
    <h5 class="mb-0">Order Account</h5>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Complete Order Account</li>
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
                                <h4 class="card-title">Order Account</h4>
                            </div>
                            <div class="user-list-files d-flex float-right">

                                <a onclick="exportdata('#datatable', 'Order_list.csv', 'csv');" href="#" class="chat-icon-phone">
                                    Excel
                                </a>

                            </div>
                        </div>

                        <div class="iq-card-body">

                            @include('alert.message')

                            <div class="table-responsive">

                                {!! Form::open(['method'=> 'POST','action'=> 'AdminAccountController@approve_amount']) !!}

                                <table  id="datatable" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                                    <thead>
                                    <tr>
                                        <th  class="text-center">
                                            <input type="checkbox" class="checkbox-input" id="allCheck">
                                        </th>
                                        <th>Client Name</th>
                                        <th>Email</th>
                                        <th>Number</th>
                                        <th>Order Id</th>
                                        <th>Payment Amount</th>

                                        <th>Payment Date</th>

                                        <th></th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($user_data as $user_account)

                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" name="OrdersCheck[]" class="checkbox-input Checkbox" value="{{ $user_account->id }}">
                                            </td>

                                            <td>{{ $user_account->user->name }}</td>
                                            <td>{{ $user_account->user->email }}</td>
                                            <td>{{ $user_account->user->mobile_number }}</td>
                                            <td>{{ $user_account->order_id }}</td>
                                            <td>{{ $user_account->paid_amount    }}</td>

                                            <td>{{   date('d-m-Y', strtotime($user_account->updated_at))  }}</td>

                                            <td>
                                                <div class="flex align-items-center list-user-action">

                                                    <button type="submit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Revert Order Payment" class="btn-table" value="{{ $user_account->id }}" name="revert_order_payment"><i class="ri-close-circle-line"></i></button>

                                                    <a data-toggle="tooltip" data-placement="top" title="" data-original-title="View Order Details" href="{{ route("account.show",$user_account->order_id) }}" ><i class="ri-file-list-line"></i></a>

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


        //        $('<div class="pull-right row" style="margin-right:15px">' +
        //                '<input type="submit" class="btn btn-primary" value="Approve Order" name="approve_user" style="color: #fff;background-color: #007bff;border-color: #007bff;line-height: 1.5;">'+
        //                '</div>'
        //        ).appendTo("#datatable_wrapper .dataTables_filter"); //example is our table id

        $(".dataTables_filter label").addClass("pull-right");


        $(function () {
            $("#alert-message").fadeTo(5000, 500).slideUp(500, function () {
                $('#alert-message').slideUp(500);
            });
        });


    </script>

@endsection