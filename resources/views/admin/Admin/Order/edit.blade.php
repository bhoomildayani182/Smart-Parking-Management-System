
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

                <div class="col-sm-12 col-lg-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Order Of Client : <span class="text-success"> {{ $order->user->name }}<span></h4>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-dark"><strong>Total Amount: </strong></span>
                                <span class="text-dark"><strong> {{ $order->order_price }}</strong></span>
                            </div>
                        </div>

                        <div class="iq-card-body">
                            {!! Form::model($order,['method'=> 'PATCH','action'=> ['AdminOrderController@update',$order->id],'class'=>'col-lg-12  p-0 m-0 row']) !!}
                            <table class="table mb-0 table-borderless">
                                <tbody>
                                    <tr>
                                        <td>Order Status

                                            @php
                                            $order_status = array('Approve Pending','Pending','Payment Remaining','Complete' );
                                            @endphp
                                            {!! Form::select('order_status',[''=>'Choose Order Status'] + $order_status , old('order_status') ,['required' => 'required','class'=>'col-lg-6 form-control' . ($errors->has('order_status') ? ' is-invalid' : null)]) !!}


                                        </td>


                                    </tr>
                                    </tbody>
                            </table>

                            <hr>



                            <hr>
                            <table class="table mb-0 table-borderless">
                                <tbody>

                                <tr><td colspan="2"><b>Product summary</b></td></tr>

                                @foreach($order->orderitems as $order_item)
                                    <tr class="border-top">
                                        <td> {{(request('page') - 1) * 10 + $loop->iteration }}. {{ $order_item->product_name }}</td>
                                        <td><span> Rs.{!! Form::text('price[]',$order_item->price,['class'=>'form-control'.($errors->has('name') ? ' is-invalid' : null) ,'placeholder'=>"Enter Product Price", 'autofocus', 'autocomplete'=>'product_price','required']) !!}</span>
                                        </td>
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
                                @endforeach

                                </tbody>

                            </table>
                                <div class="form-group col-lg-12">
                                    {!! Form::submit('Update Order',['class'=>'btn btn-primary']) !!}

                                    <a href="{{ route('order.index') }}" class="btn iq-bg-danger">cancel</a>
                                </div>

                                {!! Form::close() !!}
                        </div>

                    </div>



                    {{-- <a href="{{ url()->previous() }}" class="btn btn-primary mr-2">Update Status</a>

                    <a href="{{ url()->previous() }}" class="btn iq-bg-danger">Back</a> --}}


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
