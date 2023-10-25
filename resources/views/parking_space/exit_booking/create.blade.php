@extends('layouts.master')
@section('title') @lang('translation.create-product') @endsection
@section('css')
<link href="{{ URL::asset('build/libs/dropzone/dropzone.css') }}" rel="stylesheet">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Master @endslot
@slot('title') Exit Booking @endslot
@endcomponent

{!! Form::open([
    'route' => 'exit-booking.store',
    'method' => 'post',
    'class' => 'needs-validation',
    "autocomplete" => "off"
]) !!}

@csrf
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="live-preview">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div>
                                {!! Form::label('vehicle_number', 'Enter Vehicle Number', ['class' => 'form-label']) !!}

                                {!! Form::text('vehicle_number', "", ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div>
                                {!! Form::label('extra_time', 'Extra Time', ['class' => 'form-label']) !!}

                                {!! Form::select('extra_time', $extra_time , null, ['placeholder' => 'Select Extra Time', 'class' => 'form-select', 'required', 'readonly']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div>
                                {!! Form::label('extra_amount', 'Extra Amount', ['class' => 'form-label']) !!}

                                {!! Form::text('extra_amount', "", ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row gy-3" id="data">
                    </div>
                </div>
            </div>
        </div>
        <div class="text-end mb-3">
            {!! Form::submit('Submit', ['class' => 'btn btn-success w-sm', 'id' => 'submit-btn', 'disabled']); !!}
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                    <div class="row mb-4">
                        <h6 class="mb-3 fw-bold text-uppercase text-center">Total Amount</h6>
                        <div class="text-muted d-flex justify-content-center" id="vehicle_details">
                            <h1 class="mb-3 fw-bold text-uppercase text-center" id="total_amount">0</h1>
                            <h1 class="mb-3 fw-bold text-uppercase text-center">&#8377;</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}


@endsection
@section('script')
<script src="{{ URL::asset('build/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>

<script src="{{ URL::asset('build/libs/dropzone/dropzone-min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/ecommerce-product-create.init.js') }}"></script>

<script src="{{ URL::asset('build/js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/humanize-duration/3.22.0/humanize-duration.min.js"></script> --}}
<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">  
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>  
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>  
<script>
    
    $(document).ready(function(){
 
        $('#vehicle_number').autocomplete({
            source: function(request, response) {
                const apiEndpoint = '/get-number-plates/' + request.term.toUpperCase();
                $.ajax({
                    url: apiEndpoint,
                    type: 'GET',
                    success: function(data) {
                        response(data.data.number_plates);
                    },
                    error: function(error) {
                        console.log('Error fetching number plate suggestions from the API:', error);
                    }
                });
            },
            minLength: 1,
            select: function(event, ui) {
                const selectedNumberPlate = ui.item.value.toUpperCase();
                getBooking(selectedNumberPlate);
            }
        })

        function getBooking(selectedNumberPlate) {
            $.ajax({
                url: '/get-booking/' + selectedNumberPlate,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if(response.data.length == 0) {
                        $('#data').html("")
                        $('#extra_time').val("")
                        $('#submit-btn').attr('disabled');
                    } else {

                        let html = `
                                <div class="col-md-4">
                                    <div>
                                        <label class="form-label">Slot</label>
                                        <input class="form-control" disabled type="text" value="${response.data.entry_booking.slot.start_time} - ${response.data.entry_booking.slot.end_time} - ${response.data.entry_booking.slot.duration}" id="price">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div>
                                        <label class="form-label">Vehicle Model</label>
                                        <input class="form-control" disabled type="text" value="${response.data.entry_booking.vehicle_model.company_name} - ${response.data.entry_booking.vehicle_model.maker_name}" id="price">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div>
                                        <label class="form-label">Price</label>
                                        <input class="form-control" disabled type="text" value="${response.data.entry_booking.price}" id="price">
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between col-md-12 mt-4">
                                    <h4 class="font-size-18 text-dark mb-0">Driver Details: </h4>
                                </div>
                                <div class="col-md-4">
                                    <div>
                                        <label class="form-label">Name</label>
                                        <input class="form-control" disabled type="text" value="${response.data.entry_booking.driver.name}" id="price">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div>
                                        <label class="form-label">Mobile Number</label>
                                        <input class="form-control" disabled type="text" value="${response.data.entry_booking.driver.mobile}" id="price">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div>
                                        <label class="form-label">Address</label>
                                        <input class="form-control" disabled type="text" value="${response.data.entry_booking.driver.address}" id="price">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div>
                                        <label class="form-label">State</label>
                                        <input class="form-control" disabled type="text" value="${response.data.entry_booking.driver.state}" id="price">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div>
                                        <label class="form-label">City</label>
                                        <input class="form-control" disabled type="text" value="${response.data.entry_booking.driver.city}" id="price">
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between col-md-12 mt-4">
                                    <h4 class="font-size-18 text-dark mb-0">Cleaner Details: </h4>
                                </div>
                        `;
                    
                        response.data.cleaners.forEach(element => {
                            html += `
                            <div class="col-md-4">
                                    <div>
                                        <label class="form-label">Name</label>
                                        <input class="form-control" disabled type="text" value="${element.name}" id="price">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div>
                                        <label class="form-label">Mobile Number</label>
                                        <input class="form-control" disabled type="text" value="${element.mobile}" id="price">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div>
                                        <label class="form-label">Address</label>
                                        <input class="form-control" disabled type="text" value="${element.address}" id="price">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div>
                                        <label class="form-label">State</label>
                                        <input class="form-control" disabled type="text" value="${element.state}" id="price">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div>
                                        <label class="form-label">City</label>
                                        <input class="form-control" disabled type="text" value="${element.city}" id="price">
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                            `
                        });

                        $('#data').html(html)

                        // const timeDifference = new Date() - new Date(response.data.entry_booking.date + " " + response.data.entry_booking.slot.end_time);
    
                        // const humanizedDiff = humanizeDuration(timeDifference, {
                        //     round: true,
                        //     largest: 4
                        // }); 
    
                        // $('#extra_time').val(humanizedDiff)
                        $('#submit-btn').removeAttr('disabled');
                        $('#total_amount').text(response.data.entry_booking.price);
                    }

                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }
    });

</script>
@endsection