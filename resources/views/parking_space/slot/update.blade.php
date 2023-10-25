@extends('layouts.master')
@section('title') @lang('translation.create-product') @endsection
@section('css')
<link href="{{ URL::asset('build/libs/dropzone/dropzone.css') }}" rel="stylesheet">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Matser @endslot
@slot('title') Update Slot @endslot
@endcomponent


{!! Form::model($slot ,[
    'route' => ['slot.update', $slot->id],
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
                                    {!! Form::label('start_time', 'Start Time', ['class' => 'form-label']) !!}
                                    {!! Form::time('start_time', old('start_time'), ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('end_time', 'End Time', ['class' => 'form-label']) !!}
                                    {!! Form::time('end_time', old('end_time'), ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('duration', 'Duration', ['class' => 'form-label']) !!}
                                    {!! Form::text('duration', old('duration'), ['class' => 'form-control', 'disabled']) !!}
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
