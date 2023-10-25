@extends('layouts.master')
@section('title') @lang('translation.create-product') @endsection
@section('css')
<link href="{{ URL::asset('build/libs/dropzone/dropzone.css') }}" rel="stylesheet">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Master @endslot
@slot('title') Create Sloat Pricing @endslot
@endcomponent

{!! Form::open([
    'route' => 'slots-pricing.store',
    'method' => 'post',
    'class' => 'needs-validation',
    "autocoumplete" => "off"
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
                                    {!! Form::label('slot_id', 'Slot', ['class' => 'form-label']) !!}

                                    {!! Form::select('slot_id', $slot, null, ['id' => 'slot-select', 'placeholder' => 'Select Slot','class' => 'form-select','required']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('vehicle_model_id', 'Vehicle Model', ['class' => 'form-label']) !!}

                                    {!! Form::select('vehicle_model_id', $vehicle_model, null, ['id' => 'vehicle-select', 'placeholder' => 'Select Vehicle','class' => 'form-select','required']) !!}
                                </div>
                            </div>

                            @php
                                $weekdays = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');

                            @endphp

                            <div class="col-md-12">
                                <table class="w-100">
                                    <thead>
                                        <tr>
                                            <th>
                                                Day
                                            </th>
                                            <th>
                                                Price
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($weekdays as  $value)
                                        <tr>
                                            <td>
                                                {{-- <div class="col-md-6">
                                                    <div> --}}
                                                        {!! Form::label('day', $value, ['class' => 'form-label']) !!}

                                                        {!! Form::hidden('day['.$value.']', $value, ['class' => 'form-control', 'required','disable']) !!}
                                                    {{-- </div>
                                                </div> --}}
                                            </td>
                                            <td>
                                                {{-- <div class="col-md-6">
                                                    <div>
                                                        {!! Form::label('price', 'price', ['class' => 'form-label']) !!} --}}

                                                        {!! Form::text('price['.$value.']', 0.00, ['class' => 'form-control', 'required']) !!}
                                                    {{-- </div>
                                                </div> --}}
                                            </td>
                                        <tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
{{-- <script>
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
</script> --}}
@endsection

