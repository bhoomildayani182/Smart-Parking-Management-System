@extends('layouts.master')
@section('title') @lang('translation.create-product') @endsection
@section('css')
<link href="{{ URL::asset('build/libs/dropzone/dropzone.css') }}" rel="stylesheet">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Master @endslot
@slot('title') Create Parking Slots @endslot
@endcomponent

{!! Form::open([
    'route' => 'parking_slots.store',
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
                                    {!! Form::label('zone', 'Parking Zone', ['class' => 'form-label']) !!}

                                    {!! Form::select('zone', $zone, null,['placeholder' => 'Select a zone', 'class' => 'form-select', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('section', 'Parking Section', ['class' => 'form-label']) !!}

                                    {!! Form::select('section', $section, null,['placeholder' => 'Select a section', 'class' => 'form-select', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                {!! Form::label('parking_slot', 'Parking Slot', ['class' => 'form-label'])  !!}

                                {!! Form::number('parking_slot', null, ['placeholder' => 'Enter number of slots in parking', 'class' => "form-control",'required']); !!}
                            </div>

                            <div class="col-md-6">
                                {!! Form::label('name', 'Parking Name', ['class' => 'form-label'])  !!}

                                {!! Form::text('name', "", ['placeholder' => 'Name of Parking', 'class' => "form-control",'required']); !!}
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
@endsection
