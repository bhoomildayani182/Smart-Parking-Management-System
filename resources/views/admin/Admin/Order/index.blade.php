
@extends('layouts.master')

@section('header_section')
    <h5 class="mb-0">Order</h5>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Order List</li>
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
                                <h4 class="card-title">Order List</h4>
                            </div>
                            <div class="user-list-files d-flex float-right">


                                {{--<a href="{{ route('user.create') }}" class="chat-icon-phone">--}}
                                    {{--Add Order--}}
                                {{--</a>--}}

                                <a onclick="exportdata('#datatable', 'Order_list.csv', 'csv');" href="#" class="chat-icon-phone">
                                    Excel
                                </a>


                            </div>
                        </div>

                        <div class="iq-card-body">

                            @include('alert.message')

                            <div class="table-responsive">

                                {!! Form::open(['method'=> 'POST','action'=> 'AdminOrderController@index']) !!}

                                <table  id="datatable" class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th  class="text-center">
                                            <input type="checkbox" class="checkbox-input" id="allCheck">
                                        </th>

                                        <th>Client Name</th>
                                        <!-- <th>Email</th>
                                        <th>Number</th> -->
                                        <th>Amount</th>
                                        <th>Order Products</th>
                                        <th>Files</th>
                                        <th>Order Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" name="OrdersCheck[]" class="checkbox-input Checkbox" value="{{ $order->id }}">
                                            </td>

                                            <td>{{ $order->user->name ?? '' }}</td>
                                            <!-- <td>{{ $order->user->email ?? '' }}</td>
                                            <td>{{ $order->user->mobile_number ?? '' }}</td> -->
                                            <td>{{ $order->order_price ?? '' }}</td>


                                            <td>
                                                <ul class="m-0" style="padding: inherit;">
                                                    @foreach($order->orderitems as $order_item)
                                                        <li>{{ $order_item->product_name }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>

                                            <td>
                                                <ul class="m-0" style="padding: inherit;">
                                                    @foreach($order->orderitems as $order_item)
                                                        <li>
                                                            <a style="color: #007bff" onclick="window.open('../../order_file/{{ $order_item->file ?  $order_item->file->name : '' }}')" type="button">{{ $order_item->file ?  $order_item->file->name : 'No file Available' }}</a>
                                                        </li>


                                                        {{--<li>{{ $order_item->file ? $order_item->file->name : 'No file Available' }}</li>--}}

                                                    @endforeach
                                                </ul>
                                            </td>

                                            <td>{{ $order->created_at->format('d/m/Y') }}</td>

                                            <td>
                                                @if($order->order_status == 3)
                                                    <div class="badge badge-pill badge-success">Complete</div>
                                                @elseif($order->order_status == 2)
                                                    <div class="badge badge-pill badge-info">Payment Remaining</div>
                                                @elseif($order->order_status == 1)
                                                    <div class="badge badge-pill badge-warning">Pending</div>
                                                @endif
                                            </td>


                                            <td>
                                                <div class="flex align-items-center list-user-action">

                                                    <a data-toggle="tooltip" data-placement="top" title="" data-original-title="View order" href="{{ route("order.show",$order->id) }}" ><i class="ri-file-list-line"></i></a>
                                                    <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit order" href="{{ route("order.edit",$order->id) }}" ><i class="ri-pencil-line"></i></a>

                                                    {{--<button type="submit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" class="btn-table" value="{{ $order->id }}" name="user_delete"><i class="ri-delete-bin-line"></i></button>--}}

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

//        $(document).ready(function() {
//            $('#datatable').DataTable( {
//                "scrollX": true
//            } );
//        } );


    </script>

@endsection
