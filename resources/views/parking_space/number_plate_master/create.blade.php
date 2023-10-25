@extends('layouts.master')
@section('title') @lang('translation.create-product') @endsection
@section('css')
<link href="{{ URL::asset('build/libs/dropzone/dropzone.css') }}" rel="stylesheet">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Matser @endslot
@slot('title') Create Number Plate @endslot
@endcomponent

{!! Form::open([
    'route' => 'number-plate.store',
    'method' => 'post',
    'class' => 'needs-validation',
    "autocoumplete" => "off"]
) !!}

    @csrf
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">

                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('group_of_letter', 'State Latter', ['class' => 'form-label']) !!}

                                    {!! Form::text('group_of_letter', "", ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('state', 'State Name', ['class' => 'form-label']) !!}
                                    {!! Form::select('state', $states, null, ['id' => 'state-select', 'placeholder' => 'Select State','class' => 'form-select','required']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('city_number', 'City Number', ['class' => 'form-label']) !!}

                                    {!! Form::text('city_number', "", ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('city', 'City Name', ['class' => 'form-label']) !!}
                                    {!! Form::select('city', [], null, ['id' => 'city-select', 'placeholder' => 'Select City','class' => 'form-select','required']) !!}
                                </div>
                            </div>

                            {{-- <div class="col-md-6">
                                {!! Form::label('status', 'Status', ['class' => 'form-label'])  !!}

                                {!! Form::select('status', ['ACTIVE' => 'Active', 'INACTIVE' => 'Inactive'], null, ['placeholder' => 'Select a status', 'class' => "form-select", 'id' => 'inputGroupSelect01', 'required']); !!}
                            </div> --}}
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
    // $(document).ready(function () {
    //     // Retrieve the state and city data from the backend
    //     var states = @json($states);
    //     var cities = @json($cities);

    //     // Get the state and city select elements
    //     var stateSelect = $('#state-select');
    //     var citySelect = $('#city-select');

    //     // Event listener for state select change
    //     stateSelect.on('change', function () {
    //         var selectedStateId = $(this).val();

    //         // Filter the cities based on the selected state ID
    //         var filteredCities = cities.filter(function (city) {
    //             return city.state_id == selectedStateId;
    //         });

    //         // Generate the city options HTML
    //         var cityOptionsHtml = '<option value="">Select City</option>';
    //         filteredCities.forEach(function (city) {
    //             cityOptionsHtml += '<option value="' + city.id + '">' + city.name + '</option>';
    //         });

    //         // Update the city select options
    //         citySelect.html(cityOptionsHtml);
    //     });
    // });



</script>

<script>
    $(document).ready(function () {
        // Retrieve the state and city data from the backend
        var states = @json($states);
        var cities = @json($cities);

        // Get the state and city select elements
        var stateSelect = $('#state-select');
        var citySelect = $('#city-select');

        // Function to populate the city select input based on the selected state
        function populateCities(selectedStateId, selectedCityId = null) {
            // Filter the cities based on the selected state ID
            var filteredCities = cities.filter(function (city) {
                return city.state_id == selectedStateId;
            });

            // Generate the city options HTML
            var cityOptionsHtml = '<option value="">Select City</option>';
            filteredCities.forEach(function (city) {
                var selected = (city.id == selectedCityId) ? 'selected' : '';
                cityOptionsHtml += '<option value="' + city.id + '" ' + selected + '>' + city.name + '</option>';
            });

            // Update the city select options
            citySelect.html(cityOptionsHtml);
        }

        // Event listener for state select change
        stateSelect.on('change', function () {
            var selectedStateId = $(this).val();
            populateCities(selectedStateId);
        });

        // Get the selected state and city IDs from the backend
        var selectedStateId = '{{ isset($selectedStateId) ? $selectedStateId : null  }}';
        var selectedCityId = '{{ isset($selectedCityId) ? $selectedCityId : null  }}';

        // Populate the cities based on the selected state
        populateCities(selectedStateId, selectedCityId);
    });
</script>

@endsection
