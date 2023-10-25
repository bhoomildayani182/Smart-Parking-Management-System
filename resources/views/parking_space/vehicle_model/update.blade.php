@extends('layouts.master')
@section('title') @lang('translation.create-product') @endsection
@section('css')
<link href="{{ URL::asset('build/libs/dropzone/dropzone.css') }}" rel="stylesheet">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Matser @endslot
@slot('title') Update Vehicle Model @endslot
@endcomponent


{!! Form::model($vehicleModel ,[
    'route' => ['vehicle-models.update', $vehicleModel->id],
    'method' => 'put',
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
                                    {!! Form::label('maker_name', 'Model Name', ['class' => 'form-label']) !!}
                                    {!! Form::text('maker_name', old('maker_name'), ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('model_number', 'Model Number', ['class' => 'form-label']) !!}
                                    {!! Form::text('model_number', old('model_number'), ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('company_name', 'Company Name', ['class' => 'form-label']) !!}
                                    {!! Form::text('company_name', old('company_name'), ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('type', 'Type', ['class' => 'form-label']) !!}
                                    {!! Form::text('type', old('type'), ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('year', 'Year', ['class' => 'form-label']) !!}
                                    {!! Form::text('year', old('year'), ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('description', 'Description', ['class' => 'form-label']) !!}
                                    {!! Form::text('description', old('description'), ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                {!! Form::label('status', 'Status', ['class' => 'form-label'])  !!}
                                {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], old('status'), ['placeholder' => 'Select a status', 'class' => "form-select", 'id' => 'inputGroupSelect01', 'required']); !!}
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

@endsection
