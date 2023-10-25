
@extends('layouts.master')

@section('header_section')
    <h5 class="mb-0">Order</h5>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('order.index') }}">Order List</a></li>
            <li class="breadcrumb-item active" aria-current="page">New Order</li>

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
                                <h4 class="card-title">New Order List</h4>
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

                                {!! Form::open(['method'=> 'POST','action'=> 'AdminOrderController@order_update']) !!}

                                <table  id="datatable" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                                    <thead>
                                    <tr>
                                        <th  class="text-center">
                                            <input type="checkbox" class="checkbox-input" id="allCheck">
                                        </th>

                                        <th>Client Name</th>
                                        <th>Amount</th>
                                        <th>Order Products</th>
                                        <th>Files</th>
                                        <th>Size</th>
                                        <th>Height X Width</th>
                                        <th>Feature</th>
                                        <th>Order Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" name="OrdersList[]" class="checkbox-input Checkbox" value="{{ $order->id }}">
                                            </td>

                                            <td>{{ $order->user->name }}</td>
                                            <td>{{ $order->order_price }}</td>


                                            <td>
                                                <ul class="m-0">
                                                    @foreach($order->orderitems as $order_item)
                                                        <li>{{ $order_item->product_name }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>

                                            <td>
                                                <ul class="m-0">
                                                    @foreach($order->orderitems as $order_item)
                                                        <li>
                                                            <a style="color: #007bff" onclick="window.open('../../order_file/{{ $order_item->file ?  $order_item->file->name : '' }}')" type="button">{{ $order_item->file ?  $order_item->file->name : 'No file Available' }}</a>

                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </td>

                                            <td>
                                                @foreach($order->orderitems as $order_item)
                                                    <li>{{ $order_item->product_size ? $order_item->product_size->name : '' }}</li>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($order->orderitems as $order_item)
                                                    @if ($order_item->height != '')
                                                        @php
                                                            $x = "X";
                                                        @endphp
                                                    @else
                                                        @php
                                                            $x = "";
                                                         @endphp
                                                    @endif
                                                    <li>{{ $order_item->height."".$x."".$order_item->width }}</li>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($order->orderitems as $order_item)
                                                    <li>{{ $order_item->extrafeature ? $order_item->extrafeature->name : '' }}</li>
                                                @endforeach

                                            </td>

                                            <td>{{ $order->created_at->format('d/m/Y') }}</td>

                                            <td>
                                                <div class="flex align-items-center list-user-action">


                                                    <button type="submit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Accept Order" class="btn btn-table" value="{{ $order->id }}" name="order_single">Accept Order</button>

                                                    <a data-toggle="tooltip" data-placement="top" title="" data-original-title="View order" href="{{ route("order.show",$order->id) }}" ><i class="ri-file-list-line"></i></a>


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
                        '<input type="submit" class="btn btn-primary" value="Accept Order" name="order_accept_all" style="color: #fff;background-color: #007bff;border-color: #007bff;line-height: 1.5;">'+
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
