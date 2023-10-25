@extends('layouts.master')
@section('title') @lang('translation.create-product') @endsection
@section('css')
<link href="{{ URL::asset('build/libs/dropzone/dropzone.css') }}" rel="stylesheet">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Master @endslot
@slot('title') Create Parking @endslot
@endcomponent

{!! Form::open([
    'route' => 'parking.store',
    'method' => 'post',
    'class' => 'needs-validation',
    "autocomplete" => "off",
    'enctype' => 'multipart/form-data',
]) !!}

    @csrf
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('parking_name', 'Parking Name', ['class' => 'form-label']) !!}
                                    
                                    {!! Form::text('parking_name', "", ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('address', 'Address', ['class' => 'form-label']) !!}
                                    
                                    {!! Form::text('address', "", ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('country_id', 'Country Name', ['class' => 'form-label']) !!}

                                    {!! Form::select('country_id', ["8" => "India"] , "India", ['class' => 'form-select', 'id' => 'inputGroupSelect01', 'required', "disabled"]) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('state_id', 'State Name', ['class' => 'form-label']) !!}

                                    {!! Form::select('state_id', $states, null, ['id' => 'state-select', 'placeholder' => 'Select State','class' => 'form-select','required']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('city_id', 'City Name', ['class' => 'form-label']) !!}

                                    {!! Form::select('city_id', [], null, ['id' => 'city-select', 'placeholder' => 'Select City','class' => 'form-select','required']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('pincode', 'Pincode', ['class' => 'form-label']) !!}
                                    
                                    {!! Form::text('pincode', null, ['class' => 'form-control', 'required', 'pattern' => "[0-9]{6}",  'maxlength' => "6"]) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('manager_name', 'Manager Name', ['class' => 'form-label']) !!}
                                    
                                    {!! Form::text('manager_name', "", ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('manager_mobile_number', 'Manager Mobile Number', ['class' => 'form-label']) !!}
                                    
                                    {!! Form::number('manager_mobile_number', null, ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('manager_email', 'Manager Email', ['class' => 'form-label']) !!}
                                    
                                    {!! Form::email('manager_email', null, ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                {!! Form::label('document_type', 'Select Document Type', ['class' => 'form-label'])  !!}

                                {!! Form::select('document_type', $document_type, null, ['placeholder' => 'Select Document type', 'class' => "form-select", 'required']); !!}
                            </div>

                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('document_number', 'Enter Document Number', ['class' => 'form-label']) !!}
                                    
                                    {!! Form::text('document_number', "", ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                {!! Form::label('document', 'Upload Document', ['class' => 'form-label']) !!}

                                {!! Form::file('document', ['class' => 'form-control', 'required']) !!}
                            </div>

                            <div class="col-md-6">
                                {!! Form::label('status', 'Status', ['class' => 'form-label'])  !!}

                                {!! Form::select('status', ['ACTIVE' => 'Active', 'INACTIVE' => 'Inactive'], null, ['placeholder' => 'Select a status', 'class' => "form-select", 'id' => 'inputGroupSelect01', 'required']); !!}
                            </div>
 
                            <div class="mt-1 text-danger">
                                @if($errors->any())
                                    {{ implode('', $errors->all(':message')) }}
                                @endif
                            </div>
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
    $(document).ready(function () {
        // Retrieve the state and city data from the backend
        var states = @json($states);
        var cities = @json($cities);

        // Get the state and city select elements
        var stateSelect = $('#state-select');
        var citySelect = $('#city-select');

        // Event listener for state select change
        stateSelect.on('change', function () {
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
    });
</script>
@endsection

