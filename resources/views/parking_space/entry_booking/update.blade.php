@extends('layouts.master')
@section('title') @lang('translation.create-product') @endsection
@section('css')
<link href="{{ URL::asset('build/libs/dropzone/dropzone.css') }}" rel="stylesheet">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Master @endslot
@slot('title') Booking @endslot
@endcomponent

{!! Form::model($entry_booking ,[
    'route' => ['entry-booking.update', $entry_booking->id],
    'method' => 'put',
    'class' => 'needs-validation',
    "autocomplete" => "off",
    "enctype" => "multipart/form-data"
]) !!}

    @csrf
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div>
                                    {!! Form::label('slot_id', 'Select Slot', ['class' => 'form-label']) !!}

                                    {!! Form::select('slot_id', $slots, old('slot_id'), ['class' => 'form-select','required', 'id' => 'slot']) !!}
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div>
                                    {!! Form::label('vehicle_model_id', 'Select Vehicle Model', ['class' => 'form-label']) !!}

                                    {!! Form::select('vehicle_model_id', $vehicle_models, old('vehicle_model_id'), ['class' => 'form-select', 'id' => 'vehicle','required']) !!}
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div>
                                    {!! Form::label('price', 'Price', ['class' => 'form-label']) !!}

                                    {!! Form::text('price', old('price'), ['class' => 'form-control', 'required', 'disabled']) !!}
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div>
                                    {!! Form::label('vehicle_number', 'Enter Vehicle Number', ['class' => 'form-label']) !!}

                                    {!! Form::text('vehicle_number', $entry_booking->vehicle->vehicle_number, ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div>
                                    {!! Form::label('parking_space_id', 'Select Parking Space', ['class' => 'form-label']) !!}

                                    {!! Form::select('parking_space_id', $parking_space, old('parking_space_id'), ['class' => 'form-select','required']) !!}
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div>
                                    {!! Form::label('payment_mode', 'Select Payment Mode', ['class' => 'form-label']) !!}

                                    {!! Form::select('payment_mode', $payment_mode, old('payment_mode'), ['class' => 'form-select', 'required']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="font-size-18 text-dark mb-4">Enter Driver Details: </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div>
                                    {!! Form::label('driver_name', 'Enter Name', ['class' => 'form-label']) !!}

                                    {!! Form::text('driver_name', $entry_booking->driver->name, ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div>
                                    {!! Form::label('driver_mobile', 'Enter Mobile Number', ['class' => 'form-label']) !!}

                                    {!! Form::number('driver_mobile', $entry_booking->driver->mobile, ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div>
                                    {!! Form::label('driver_address', 'Enter Address', ['class' => 'form-label']) !!}

                                    {!! Form::text('driver_address', $entry_booking->driver->address, ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div>
                                    {!! Form::label('driver_state_id', 'Select State', ['class' => 'form-label']) !!}

                                    {!! Form::select('driver_state_id', $states, array_search($entry_booking->driver->state, $states), ['class' => ['form-select', 'state-select'], 'required', 'id' => 'driver_state']) !!}
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div>
                                    {!! Form::label('driver_city_id', 'Select City', ['class' => 'form-label']) !!}

                                    {!! Form::select('driver_city_id', [], null, ['class' => ['form-select', 'city-select'], 'required', 'id' => 'driver_city']) !!}
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div>
                                    {!! Form::label('driver_document_type', 'Select Document Type', ['class' => 'form-label']) !!}

                                    {!! Form::select('driver_document_type', $document_type, $entry_booking->driver->document_type, ['placeholder' => 'Select Document Type','class' => 'form-select', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div>
                                    {!! Form::label('driver_document_number', 'Enter Document Number', ['class' => 'form-label']) !!}

                                    {!! Form::text('driver_document_number', $entry_booking->driver->document_number, ['placeholder' => 'Enter Document Number','class' => 'form-control', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div>
                                    {!! Form::label('driver_document', 'Upload Document', ['class' => 'form-label']) !!}
                                    
                                    {!! Form::file('driver_document', ['class' => 'form-control']) !!}
                                    <a href="{{ asset('storage/'. $entry_booking->driver->document_file_id) }}" target="_blank">View File</a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="font-size-18 text-dark mb-2">Enter Cleaner Details: </h4>
                                <button type="button" id="add_row" class="btn btn-soft-success mb-4"><i class="ri-add-circle-line align-middle me-1"></i>Add Cleaner</button>
                            </div>
                        </div>

                        <div id="cleanerRows">
                            @foreach ($cleaners as $cleaner)
                                <div class="row" id={{"row".(string)$loop->iteration-1}}>

                                    {!! Form::text('cleaner_id[]', $cleaner->id, ['class' => 'form-control', 'required', "hidden"]) !!}

                                    <div class="col-md-6 mb-4">
                                        <div>
                                            {!! Form::label('name[]', 'Enter Name', ['class' => 'form-label']) !!}
        
                                            {!! Form::text('name[]', $cleaner->name, ['class' => 'form-control', 'required']) !!}
                                        </div>
                                    </div>
        
                                    <div class="col-md-6 mb-4">
                                        <div>
                                            {!! Form::label('mobile[]', 'Enter Mobile Number', ['class' => 'form-label']) !!}
        
                                            {!! Form::number('mobile[]', $cleaner->mobile, ['class' => 'form-control', 'required']) !!}
                                        </div>
                                    </div>
        
                                    <div class="col-md-4 mb-4">
                                        <div>
                                            {!! Form::label('address[]', 'Enter Address', ['class' => 'form-label']) !!}
        
                                            {!! Form::text('address[]', $cleaner->address, ['class' => 'form-control', 'required']) !!}
                                        </div>
                                    </div>
        
                                    <div class="col-md-4 mb-4">
                                        <div>
                                            {!! Form::label('state_id[]', 'Select State', ['class' => 'form-label']) !!}
        
                                            {!! Form::select('state_id[]', $states, array_search($cleaner->state, $states), ['class' => ['form-select', 'state-select'], 'required']) !!}
                                        </div>
                                    </div>
        
                                    <div class="col-md-4 mb-4">
                                        <div>
                                            {!! Form::label('city_id[]', 'Select City', ['class' => 'form-label']) !!}
        
                                            {!! Form::select('city_id[]', [], null, ['class' => ['form-select', 'city-select'], 'required', 'id' => "city".(string)$loop->iteration-1]) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div>
                                            {!! Form::label('document_type[]', 'Select Document Type', ['class' => 'form-label']) !!}
        
                                            {!! Form::select('document_type[]', $document_type, $cleaner->document_type, ['class' => 'form-select', 'required']) !!}
                                        </div>
                                    </div>
        
                                    <div class="col-md-4 mb-4">
                                        <div>
                                            {!! Form::label('document_number[]', 'Enter Document Number', ['class' => 'form-label']) !!}
        
                                            {!! Form::text('document_number[]', $cleaner->document_number, ['class' => 'form-control', 'required']) !!}
                                        </div>
                                    </div>
        
                                    <div class="col-md-3 mb-4">
                                        <div>
                                            {!! Form::label('document['. $cleaner->id . ']', 'Upload Document', ['class' => 'form-label']) !!}
                                            
                                            {!! Form::file('document['. $cleaner->id . ']', ['class' => 'form-control']) !!}
                                            <a href="{{ asset('storage/'. $cleaner->document_file_id) }}" target="_blank">View File</a>
                                        </div>
                                    </div>

                                    <div class="col-md-1 mb-4">
                                        <label class="form-label d-block w-100 h-25"></label>

                                        <button type="button " class="delete_row btn btn-soft-danger"><i class="ri-close-circle-line align-middle me-1"></i></button>
                                    </div>
                                </div>
                            @endforeach
                            <div class="row" id={{"row".count($cleaners)}}></div>
                        </div>
                        <div class="mt-1 text-danger">
                            @if($errors->any())
                                {{ implode('', $errors->all(':message')) }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-end mb-3">
                {!! Form::submit('Submit', ['class' => 'btn btn-success w-sm']); !!}
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
<script>

$(document).ready(function(){
    // console.log("sdfd");
    // Retrieve the state and city data from the backend
    var states = @json($states);
    var cities = @json($cities);
    var driver = @json($entry_booking->driver);
    var cleaners = @json($cleaners);
    // console.log(driver)
    // Get the state and city select elements
    var stateSelect = $('#driver_state');
    var citySelect = $('#driver_city');

    var selectedStateId = $.grep(Object.keys(states), function(key) {
        return states[key] === driver["state"];
    });

    // Filter the cities based on the selected state ID
    var filteredCities = cities.filter(function (city) {
        return city.state_id == selectedStateId;
    });
    // Generate the city options HTML
    var cityOptionsHtml = '';
    filteredCities.forEach(function (city) {
        if(driver["city"] == city.name) {
            cityOptionsHtml += '<option value="' + city.id + '" selected>' + city.name + '</option>';
        } else {
            cityOptionsHtml += '<option value="' + city.id + '">' + city.name + '</option>';
        }
    });
    // Update the city select options
    citySelect.html(cityOptionsHtml);

    // select cities for cleaner
    for(let i = 0; i < cleaners.length; i++) {
        var citySelect = $('#city'+i);
        console.log(cleaners[i]);
        var selectedStateId = $.grep(Object.keys(states), function(key) {
            return states[key] === cleaners[i]["state"];
        });

        // Filter the cities based on the selected state ID
        var filteredCities = cities.filter(function (city) {
            return city.state_id == selectedStateId;
        });
        // Generate the city options HTML
        var cityOptionsHtml = '';
        filteredCities.forEach(function (city) {
            if(cleaners[i]["city"] == city.name) {
                cityOptionsHtml += '<option value="' + city.id + '" selected>' + city.name + '</option>';
            } else {
                cityOptionsHtml += '<option value="' + city.id + '">' + city.name + '</option>';
            }
        });
        // Update the city select options
        citySelect.html(cityOptionsHtml);
    }


    var html = `<div class="row">
                    <div class="col-md-6 mb-4">
                        <div>
                            <label for="name[]" class="form-label">Enter Cleaner Name</label>

                            <input placeholder="Enter Cleaner Name" class="form-control" required="" name="name[]" type="text" value="" id="name[]">
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div>
                            <label for="mobile[]" class="form-label">Enter Cleaner Mobile Number</label>

                            <input placeholder="Enter Mobile Number" class="form-control" required="" name="mobile[]" type="number" id="mobile[]">
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div>
                            <label for="address[]" class="form-label">Enter Cleaner Address</label>

                            <input placeholder="Enter Address" class="form-control" required="" name="address[]" type="text" value="" id="address[]">
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div>
                            <label for="state_id[]" class="form-label">Select Cleaner State</label>

                            <select class="form-select state-select" required="" id="state_id[]" name="state_id[]"></select>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div>
                            <label for="city_id[]" class="form-label">Select Cleaner City</label>

                            <select class="form-select city-select" required="" id="city_id[]" name="city_id[]"><option selected="selected" value="">Select City</option></select>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div>
                            <label for="document_type[]" class="form-label">Select Document Type</label>

                            <select class="form-select" required="" id="document_type[]" name="document_type[]"><option value="Adharcard">Aadhar Card</option><option value="DrivingLicense">Driving License</option></select>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div>
                            <label for="document_number[]" class="form-label">Enter Document Number</label>

                            <input class="form-control" required="" name="document_number[]" type="text" id="document_number[]">
                        </div>
                    </div>

                    <div class="col-md-3 mb-4">
                        <div>
                            <label for="new_document[]" class="form-label">Upload Document</label>

                            <input placeholder="Upload Document" class="form-control" required name="new_document[]" type="file" id="new_document[]">
                        </div>
                    </div>

                    <div class="col-md-1 mb-4">
                        <label class="form-label d-block w-100 h-25"></label>

                        <button type="button " class="delete_row btn btn-soft-danger"><i class="ri-close-circle-line align-middle me-1"></i></button>
                    </div>
                </div>`;

    var i= cleaners.length;
    $("#add_row").click(function(){
        $('#row'+i).html(html);

        const stateElement = $("#row"+i).find(".state-select");
        var cityOptionsHtml = '<option value="">Select State</option>';
        $.each(states, function(key, value) {
            cityOptionsHtml += '<option value="' + key + '">' + value + '</option>';
        })
        stateElement.html(cityOptionsHtml);
        $('#cleanerRows').append('<div id="row'+(i+1)+'"></div>');
        i++; 
        var stateSelect = $('.state-select');
    });

    $(document).on('click', '.delete_row', function(){
        $(this).parent().parent().remove();
    });


    // Get the state and city select elements
    var stateSelect = $('.state-select');
    // Event listener for state select change
    $(document).on('change', '.state-select', function () {

        var citySelect = $(this).parent().parent().next().find('.city-select');

        var selectedStateId = $(this).val();

        // Filter the cities based on the selected state ID
        var filteredCities = cities.filter(function (city) {
            return city.state_id == selectedStateId;
        });

        // Generate the city options HTML
        var cityOptionsHtml = '';
        filteredCities.forEach(function (city) {
            cityOptionsHtml += '<option value="' + city.id + '">' + city.name + '</option>';
        });

        // Update the city select options
        citySelect.html(cityOptionsHtml);
    });

    $('#vehicle').change(function () {
        var vehicle = $(this).val();
        var slot = $('#slot').val();
        if(slot && vehicle){
            fetchPricing(slot, vehicle);
        }
    });

    $('#slot').change(function () {
        var slot = $(this).val();
        var vehicle = $('#vehicle').val();
        if(slot && vehicle){
            fetchPricing(slot, vehicle);
        }
    });

    function fetchPricing(slot, vehicle){
        if(slot && vehicle){
            $.ajax({
                url: '/slot-pricing/get-price/' + vehicle + '/' + slot,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    var price = $('#price').val(response.price)
                    var slot_price_id = $('#slot_price_id').val(response.id)
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }
    }

});

</script>
@endsection

