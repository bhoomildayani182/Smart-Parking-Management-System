
@extends('layouts.master')

@section('header_section')
    <h5 class="mb-0">Order</h5>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Order Single</li>
        </ul>
    </nav>
@endsection

@section('content')

    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-lg-4">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Order Detail</h4>
                            </div>
                        </div>

                        <div class="iq-card-body">

                            <table class="table mb-0 table-borderless">
                                <tbody>
                                    <tr>
                                        <td>Client Name</td>
                                        <td class="text-right">{{ $order->user->name }}</td>
                                    </tr>

                                    <tr>
                                        <td>Order Status</td>

                                        @if($order->order_status == 3)
                                            <td class="text-success text-right">Complete</td>
                                        @elseif($order->order_status == 2)
                                            <td class="text-info text-right">Payment Remaining</td>
                                        @elseif($order->order_status == 1)
                                            <td class="text-warning text-right">Pending</td>
                                        @elseif($order->order_status == 0)
                                            <td class="text-danger text-right">Approve Pending</td>
                                        @endif

                                    </tr>

                                    <tr>
                                        <td>Payment Status</td>

                                        @if($order->payment_status == 1)
                                            <td class="text-success text-right">Complete</td>
                                        @else
                                            <td class="text-danger text-right">Remaining</td>
                                        @endif

                                    </tr>




                                    </tbody>
                            </table>

                            <hr>

                            <div class="d-flex justify-content-between">
                                <span class="text-dark"><strong>Total</strong></span>
                                <span class="text-dark"><strong>{{ $order->order_price }}</strong></span>
                            </div>

                            <hr>
                            {{--<a id="place-order" href="javascript:void();" type="button" class="btn btn-primary d-block mt-1 next">Place order</a>--}}

                            {{--<button type="submit" class="btn btn-primary mr-2">Submit</button>--}}
                            {{--<a href="{{ route(); }}" class="btn btn-primary mr-2">Update Status</a>--}}

                            <a href="{{ url()->previous() }}" class="btn iq-bg-danger">Back</a>

                        </div>

                    </div>

                </div>

                <div class="col-sm-12 col-lg-8">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Order Product</h4>
                            </div>
                        </div>

                        <div class="iq-card-body">

                            <table class="table mb-0 table-borderless">
                                <tbody>

                                <tr><td colspan="2"><b>Product summary</b></td></tr>
                                @foreach($order->orderitems as $order_item)
                                    <tr class="border-top">
                                        <td> {{$loop->iteration }}. {{ $order_item->product_name }}</td>
                                        <td class="text-right">{{ "Rs. ".$order_item->price }}</td>
                                    </tr>

                                    <tr>

                                        <td>
                                            <a style="color: #007bff" onclick="window.open('order_file/{{ $order_item->file ?  $order_item->file->name : '' }}')" type="button">{{ $order_item->file ?  $order_item->file->name : 'No file Available' }}</a>
                                        </td>



                                        <td  class="text-right">Quantity : {{ $order_item->quantity }}</td>
                                    </tr>

                                    <tr>
                                        <td >Feature: {{ $order_item->extrafeature ? $order_item->extrafeature->name : '' }}</td>
                                        <td  class="text-right">Size: {{ $order_item->size_id }}</td>
                                    </tr>
                                    @if(isset($order_item->height))
                                    <tr class="">
                                        <td>Height &  Width : {{ $order_item->height }} x {{ $order_item->width }}</td>
                                        <td class="text-right"></td>
                                    </tr>
                                    @endif
                                    {{-- <tr class="">
                                        <td>Height &  Width : 12 x 10</td>
                                        <td class="text-right">weight : 1</td>
                                    </tr> --}}
                                @endforeach
                                </tbody>
                            </table>

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
