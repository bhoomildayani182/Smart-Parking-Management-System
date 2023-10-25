@extends('layouts.master')
@section('title') @lang('translation.create-product') @endsection
@section('css')
<link href="{{ URL::asset('build/libs/dropzone/dropzone.css') }}" rel="stylesheet">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Master @endslot
@slot('title') Create City @endslot
@endcomponent

{!! Form::open([
    'route' => 'city.store',
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
                                    {!! Form::label('name', 'City Name', ['class' => 'form-label']) !!}

                                    {!! Form::text('name', "", ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('state_id', 'State Name', ['class' => 'form-label']) !!}

                                    {!! Form::select('state_id', $state, null,['placeholder' => 'Select a State', 'class' => 'form-select', 'id' => 'inputGroupSelect01', 'required']) !!}
                                </div>
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
@endsection

