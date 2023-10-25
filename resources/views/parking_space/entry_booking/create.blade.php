@extends('layouts.master')
@section('title') @lang('translation.create-product') @endsection
@section('css')
<link href="{{ URL::asset('build/libs/dropzone/dropzone.css') }}" rel="stylesheet">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Master @endslot
@slot('title') Entry Booking @endslot
@endcomponent

{!! Form::open([
    'route' => 'entry-booking.store',
    'method' => 'post',
    'class' => 'needs-validation',
    "autocomplete" => "off",
    'enctype' => 'multipart/form-data'
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
                                    {!! Form::label('vehicle_number', 'Enter Vehicle Number', ['class' => 'form-label']) !!}

                                    {!! Form::text('vehicle_number', null, ['placeholder' => 'Enter Vehicle Number','class' => 'form-control', 'required']) !!}
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div>
                                    {!! Form::label('parking_space_id', 'Select Parking Space', ['class' => 'form-label']) !!}

                                    {!! Form::select('parking_space_id', $parking_space, null, ['placeholder' => 'Select Parking Space','class' => 'form-select','required']) !!}
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div>
                                    {!! Form::label('payment_mode', 'Select Payment Mode', ['class' => 'form-label']) !!}

                                    {!! Form::select('payment_mode', $payment_mode, null, ['placeholder' => 'Select Payment Mode','class' => 'form-select', 'required']) !!}
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div>
                                    {!! Form::label('slot_id', 'Select Slot', ['class' => 'form-label']) !!}

                                    {!! Form::select('slot_id', $slots, null, ['placeholder' => 'Select Parking Slots','class' => 'form-select','required', 'id' => 'slot']) !!}
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div>
                                    {!! Form::label('vehicle_model_id', 'Select Vehicle Model', ['class' => 'form-label']) !!}

                                    {!! Form::select('vehicle_model_id', $vehicle_models, null, ['placeholder' => 'Select Vehicle Model','class' => 'form-select', 'id' => 'vehicle','required']) !!}
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div>
                                    {!! Form::label('price', 'Price', ['class' => 'form-label']) !!}

                                    {!! Form::text('price', "", ['class' => 'form-control', 'required', 'disabled']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="font-size-18 text-dark mb-4">Enter Driver Details: </h4>
                            </div>
                        </div>
                        <div class="row" id="driver_details">
                            {!! Form::text('old_driver_id', "" , ['class' => 'form-control', "hidden"]) !!}
                            <div class="col-md-6 mb-4">
                                <div>
                                    {!! Form::label('name[]', 'Enter Name', ['class' => 'form-label']) !!}

                                    {!! Form::text('name[]', "", ['placeholder' => 'Enter Name', 'class' => 'form-control', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div>
                                    {!! Form::label('mobile[]', 'Enter Mobile Number', ['class' => 'form-label']) !!}

                                    {!! Form::number('mobile[]', null, ['placeholder' => 'Enter Mobile Number', 'class' => 'form-control', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div>
                                    {!! Form::label('address[]', 'Enter Address', ['class' => 'form-label']) !!}

                                    {!! Form::text('address[]', "", ['placeholder' => 'Enter Address', 'class' => 'form-control', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div>
                                    {!! Form::label('state_id[]', 'Select State', ['class' => 'form-label']) !!}

                                    {!! Form::select('state_id[]', $states, null, ['placeholder' => 'Select State','class' => ['form-select', 'state-select'], 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div>
                                    {!! Form::label('city_id[]', 'Select City', ['class' => 'form-label']) !!}

                                    {!! Form::select('city_id[]', [], null, ['placeholder' => 'Select City','class' => ['form-select', 'city-select'], 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div>
                                    {!! Form::label('document_type[]', 'Select Document Type', ['class' => 'form-label']) !!}

                                    {!! Form::select('document_type[]', $document_type, null, ['placeholder' => 'Select Document Type','class' => 'form-select', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div>
                                    {!! Form::label('document_number[]', 'Enter Document Number', ['class' => 'form-label']) !!}

                                    {!! Form::text('document_number[]', null, ['placeholder' => 'Enter Document Number','class' => 'form-control', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div id="document_btn">
                                    {!! Form::label('document[]', 'Upload Document', ['class' => 'form-label']) !!}
                                    
                                    {!! Form::file('document[]', ['placeholder' => 'Upload Document', 'class' => 'form-control', 'required']) !!}
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
                            <div class="row" id="row0"></div>
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
                {!! Form::submit('Submit', ['class' => 'btn btn-success w-sm', 'id' => "submit"]); !!}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                        <div class="row mb-4">
                            <div class="text-muted" id="vehicle_details">

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
<script>
    
    $(document).ready(function(){
    // Retrieve the state and city data from the backend
    var states = @json($states);
    var cities = @json($cities);
    var vehicle_models = @json($vehicle_models);

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

                            <select class="form-select" required="" id="document_type[]" name="document_type[]"><option selected="selected" value="">Select Document Type</option><option value="Adharcard">Aadhar Card</option><option value="DrivingLicense">Driving License</option></select>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div>
                            <label for="document_number[]" class="form-label">Enter Document Number</label>

                            <input placeholder="Enter Document Number" class="form-control" required="" name="document_number[]" type="text" id="document_number[]">
                        </div>
                    </div>

                    <div class="col-md-3 mb-4">
                        <div>
                            <label for="document[]" class="form-label">Upload Document</label>

                            <input placeholder="Upload Document" class="form-control" required="" name="document[]" type="file" id="document[]">
                        </div>
                    </div>

                    <div class="col-md-1 mb-4">
                        <label class="form-label d-block w-100 h-25"></label>

                        <button type="button " class="delete_row btn btn-soft-danger"><i class="ri-close-circle-line align-middle me-1"></i></button>
                    </div>
                </div>`;

    var i=0;
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
        var cityOptionsHtml = '<option value="">Select City</option>';
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

    $('#vehicle_number').on('keydown', function (e) {
        if(e.which !== 8){
            var inputVal = $(this).val().toUpperCase().replace(/\s+/g, ''); 
    
            if (inputVal.length >= 2 && inputVal.length < 3) {
                inputVal = inputVal.slice(0, 2) + '-' + inputVal.slice(2);
            }
    
            if (inputVal.length == 5 && !(parseInt(inputVal[4]) >= 0 && parseInt(inputVal[4]) <= 9)) {
                inputVal = inputVal.slice(0, 3) + '0' + inputVal.slice(3,4) + '-' + inputVal.slice(4);
            }
    
            if (inputVal.length >= 5 && inputVal.length < 6) {
                inputVal = inputVal.slice(0, 5) + '-' + inputVal.slice(5);
            }
    
            if (inputVal.length >= 8 && inputVal.length < 9) {
                inputVal = inputVal.slice(0, 8) + '-' + inputVal.slice(8);
            }
    
            $(this).val(inputVal);
        }
    });

    let vehicle_details = $('#vehicle_details');
    var vehicle_response;
    $('#vehicle_number').on('input', function (e) {

        var inputVal = $(this).val();
        var pattern  = new RegExp('^[A-Z]{2}[-][0-9]{1,2}[-][A-Z]{1,2}[-][0-9]{3,4}$')

        if(pattern.test(inputVal)){
            $.ajax({
                url: '/get-vehicle/' + inputVal,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    vehicle_response = response.data;
                    let details_string = `
                        <div>
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-3 fw-bold text-uppercase">Vehicle Details</h6>
                                <button type="button" class="btn btn-soft-success btn-sm" id="addVehicle"><i class="ri-add-circle-line align-middle me-1"></i>Fill Vehicle Details</button>
                            </div>
                            <ul class="ps-4 vstack gap-2">
                                <li>Vehicle Number: ${response.data.vehicle.vehicle_number}</li>
                                <li>Vehicle Model: ${vehicle_models[response.data.vehicle.vehicle_model_id]}</li>
                            </ul>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-3 fw-bold text-uppercase">Driver Details</h6>
                            <button type="button" class="btn btn-soft-success btn-sm" id="addDriver"><i class="ri-add-circle-line align-middle me-1"></i>Fill Driver Details</button>
                        </div>
                        <ul class="ps-4 vstack gap-2">
                            <li>Driver Name: ${response.data.vehicle.driver.name}</li>
                            <li>Driver Mobile Number: ${response.data.vehicle.driver.mobile}</li>
                            <li>Driver Address: ${response.data.vehicle.driver.address}</li>
                            <li>Driver state: ${response.data.vehicle.driver.state}</li>
                            <li>Driver City: ${response.data.vehicle.driver.city}</li>
                        </ul>

                        <div class="d-flex justify-content-between">
                            <h6 class="mb-3 fw-bold text-uppercase">Cleaner Details</h6>
                            <button type="button" class="btn btn-soft-success btn-sm" id="addCleaner"><i class="ri-add-circle-line align-middle me-1"></i>Fill Cleaner Details</button>
                        </div>`;

                    $.each(response.data.cleaners, function(index, value){
                        details_string += `
                            <h6 class="mb-3 fw-semi-bold text-uppercase">Cleaner ${index + 1}</h6>
                            <ul class="ps-4 vstack gap-2">
                                <li>Cleaner Name: ${value.name}</li>
                                <li>Cleaner Mobile Number: ${value.mobile}</li>
                                <li>Cleaner Address: ${value.address}</li>
                                <li>Cleaner state: ${value.state}</li>
                                <li>Cleaner City: ${value.city}</li>
                            </ul>   
                        `;
                    })
                    
                    vehicle_details.html($(details_string))
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }
    });

    $(document).on('click', '#addVehicle', function(){
        $('#vehicle_number').val(vehicle_response.vehicle.vehicle_number)
        $('#vehicle').val(vehicle_response.vehicle.vehicle_model_id)
    });

    $(document).on('click', '#addDriver', function(){

        const stateId = Object.keys(states).find(function(key) {
            return states[key] === vehicle_response.vehicle.driver.state;
        });

        const cityId = cities.find(function(item) {
            return item.name === vehicle_response.vehicle.driver.city;
        });

        $("input[name='name[]']").eq(0).val(vehicle_response.vehicle.driver.name);
        $("input[name='mobile[]']").eq(0).val(vehicle_response.vehicle.driver.mobile);
        $("input[name='address[]']").eq(0).val(vehicle_response.vehicle.driver.address);
        $("select[name='state_id[]']").eq(0).val(stateId);
        $("select[name='document_type[]']").eq(0).val(vehicle_response.vehicle.driver.document_type);
        $("input[name='document_number[]']").eq(0).val(vehicle_response.vehicle.driver.document_number);
        $('#document_btn').html(`
                                <label class="form-label">Document</label>
                                <div class="flex-shrink-0">
                                    <a type="button" class="w-100 btn btn-soft-primary" href="http://localhost:8000/storage/${vehicle_response.vehicle.driver.document_file_id}" target="_blank"><i class="ri-file-list-3-line align-middle"></i> View Document</a>
                                </div>`);
        $("input[name='old_driver_id']").val(vehicle_response.vehicle.driver.id);
 
        $("input[name='name[]']").eq(0).prop("disabled", true);
        $("input[name='mobile[]']").eq(0).prop("disabled", true);
        $("input[name='address[]']").eq(0).prop("disabled", true);
        $("select[name='state_id[]']").eq(0).prop("disabled", true);
        $("select[name='document_type[]']").eq(0).prop("disabled", true);
        $("input[name='document_number[]']").eq(0).prop("disabled", true);


        var filteredCities = cities.filter(function (city) {
            return city.state_id == stateId;
        });

        var cityOptionsHtml = '';
        filteredCities.forEach(function (city) {
            if(vehicle_response.vehicle.driver.city == city.name) {
                cityOptionsHtml += '<option value="' + city.id + '" selected>' + city.name + '</option>';
            } else {
                cityOptionsHtml += '<option value="' + city.id + '">' + city.name + '</option>';
            }
        });

        $("select[name='city_id[]']").eq(0).html(cityOptionsHtml);
        $("select[name='city_id[]']").eq(0).prop("disabled", true);
    });

    $(document).on('click', '#addCleaner', function(){
        var oldCleaner = ''
        $.each(vehicle_response.cleaners, function(index, value){
            oldCleaner += `<div class="row">
                            <input class="form-control" required="" hidden="" name="old_cleaner_id[]" type="text" value=${value.id}>
                            <div class="col-md-6 mb-4">
                                <div>
                                    <label class="form-label">Cleaner Name</label>

                                    <input class="form-control" required="" disabled type="text" value=${value.name}>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div>
                                    <label class="form-label">Cleaner Mobile Number</label>

                                    <input class="form-control" required="" disabled type="number" value=${value.mobile}>
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div>
                                    <label class="form-label">Cleaner Address</label>

                                    <input class="form-control" required="" disabled type="text" value=${value.address}>
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div>
                                    <label class="form-label">Cleaner State</label>

                                    <input class="form-control" type="text" disabled required="" value=${value.state}>
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div>
                                    <label class="form-label">Cleaner City</label>

                                    <input class="form-control" type="text" disabled required="" value=${value.city}></input>
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div>
                                    <label class="form-label">Document Type</label>

                                    <input class="form-control" type="text" required="" disabled value=${value.document_type}></input>
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div>
                                    <label class="form-label">Document Number</label>

                                    <input class="form-control" required="" type="text" disabled value=${value.document_number}>
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="form-label">Document</label>
                                <div class="flex-shrink-0">
                                    <a type="button" class="w-100 btn btn-soft-primary" href="http://localhost:8000/storage/${value.document_file_id}" target="_blank"><i class="ri-file-list-3-line align-middle"></i> View Document</a>
                                </div>
                            </div>
                        </div>`;
        });
        $('#cleanerRows').html(oldCleaner);
    });
});

</script>
@endsection