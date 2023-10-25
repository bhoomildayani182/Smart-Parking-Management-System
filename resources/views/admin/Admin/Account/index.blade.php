
@extends('layouts.master')

@section('header_section')
    <h5 class="mb-0">User Account</h5>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Account</li>
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
                                <h4 class="card-title">User Account</h4>
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

                                {!! Form::open(['method'=> 'POST','action'=> 'AdminOrderController@index']) !!}

                                {{--<table  id="datatable" class="table table-striped table-bordered mt-4 display" role="grid" aria-describedby="user-list-page-info">--}}
                                <table id="example" class="table table-striped table-bordered mt- display" style="width:100%">
                                    <thead>
                                    <tr>
                                        {{--<th  class="text-center">--}}
                                            {{--<input type="checkbox" class="checkbox-input" id="allCheck">--}}
                                        {{--</th>--}}
                                        <th>Client Name</th>
                                        <th>Email</th>
                                        <th>Number</th>
                                        <th>Total Amount</th>
                                        <th>Pending Amount</th>
                                        <th>Paid Amount</th>
                                        {{--<th></th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($user_data as $user_account)

                                        <tr>
                                            {{--<td class="text-center">--}}
                                                {{--<input type="checkbox" name="OrdersCheck[]" class="checkbox-input Checkbox" value="{{ $user_account->id }}">--}}
                                            {{--</td>--}}

                                            <td>{{ $user_account->user->name ?? '' }}</td>
                                            <td>{{ $user_account->user->email ?? '' }}</td>
                                            <td>{{ $user_account->user->mobile_number ?? '' }}</td>
                                            <td>{{ $user_account->total_amount ?? '' }}</td>
                                            <td>{{ $user_account->remaining_amount ?? '' }}</td>
                                            <td>{{ $user_account->paid_amount ?? '' }}</td>
                                            {{--<th></th>--}}
                                        </tr>



                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Client Name</th>
                                        <th>Email</th>
                                        <th>Number</th>
                                        <th>Total Amount</th>
                                        <th>Pending Amount</th>
                                        <th>Paid Amount</th>
                                    </tr>
                                    </tfoot>
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
    <script>
        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#example tfoot th').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );

            // DataTable
            var table = $('#example').DataTable({
                initComplete: function () {
                    // Apply the search
                    this.api().columns().every( function () {
                        var that = this;

                        $( 'input', this.footer() ).on( 'keyup change clear', function () {
                            if ( that.search() !== this.value ) {
                                that
                                        .search( this.value )
                                        .draw();
                            }
                        } );
                    } );
                }
            });

        } );
    </script>

@endsection