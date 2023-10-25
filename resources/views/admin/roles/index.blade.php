@extends('layouts.master')
@section('title') @lang('translation.starter')  @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Setting @endslot
@slot('title') User - Role  @endslot
@endcomponent

<div class="row" id="contactList">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center border-0">
                <h5 class="card-title mb-0 flex-grow-1">All Orders</h5>
                <div class="flex-shrink-0">
                    <div class="flax-shrink-0 hstack gap-2">
                        <button class="btn btn-primary">Today's Orders</button>
                        <button class="btn btn-soft-info">Past Orders</button>
                    </div>
                </div>
            </div>

            {!! Form::open(['route' => 'items.filter', 'method' => 'GET', 'id' => 'filter-form']) !!}

            <div class="card-body border border-dashed border-end-0 border-start-0">
                <div class="row g-2">
                    <div class="col-xl-4 col-md-6">
                        <div class="search-box">
                            <input type="text" class="form-control search" placeholder="Search to orders..." name="name">
                            <i class="ri-search-line search-icon"></i>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xl-3 col-md-6">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="ri-calendar-2-line"></i></span>
                            <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y" data-range-date="true" placeholder="Select date" id="range-datepicker" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xl-2 col-md-4">
                        <select class="form-control" data-choices data-choices-search-false name="idType" id="idType">
                            <option value="all">Select Type</option>
                            <option value="Buy">Buy</option>
                            <option value="Sell">Sell</option>
                        </select>
                    </div>
                    <!--end col-->
                    <div class="col-xl-2 col-md-4">
                        <select class="form-control" data-choices data-choices-search-false name="idStatus" id="idStatus">
                            <option value="all">Select Status</option>
                            <option value="Successful">Successful</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>
                    <!--end col-->
                    <div class="col-xl-1 col-md-4">
                        {{ Form::submit('Filter',['class' => "btn btn-success w-100"]) }}
                        {{-- <button class="btn btn-success w-100" onclick="filterData();">Filters</button> --}}
                    </div>
                </div>
                <!--end row-->
            </div>

            {!! Form::close() !!}


    <div id="filter-results">
        <!-- Results will be dynamically updated here -->
        {{-- @include('admin.roles.index1') --}}
    </div>



        </div>
        <!--end card-->



    </div>
    <!--end col-->
</div>
<!--end row-->


@endsection
@section('script')
<script src="{{ URL::asset('build/js/app.js') }}"></script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
<script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script>
 $(document).ready(function() {

         setTimeout(function() {
                $('#myAlert'). removeClass("show");
            }, 1000); // 10 seconds in milliseconds
        });




    $(document).ready(function () {

        $(document).on('click', '.pagination a', function (event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetchItems(page);
            });

            page = 1;

        // Handle form submission via AJAX
        $('#filter-form').submit(function (event) {

            event.preventDefault();

            var formData = $(this).serialize();

            // alert(formData);

            $.ajax({
                // url: '{{ route('items.filter') }}',
                url: '{{ route('items.filter') }}?page=' + page,
                method: 'GET',
                data: formData,
                success: function (response) {
                    $('#filter-results').html(response);
                }
            });
        });
    });
</script>

@endsection
