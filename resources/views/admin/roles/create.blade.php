@extends('layouts.master')
@section('title') @lang('translation.create-product') @endsection
@section('css')
<link href="{{ URL::asset('build/libs/dropzone/dropzone.css') }}" rel="stylesheet">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Ecommerce @endslot
@slot('title') Create Product @endslot
@endcomponent

{{-- {!!
    Form::open([
        'url' => 'foo/bar',
        'id' => 'needs-validation'
        ])
    !!} --}}


<form id="" autocomplete="off" class="needs-validation" novalidate method="post" action="{{ route('userRole.store') }}">
    @csrf
    <div class="row">
        <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">


                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Truck Name</label>
                                        <input type="text" class="form-control" id="basiInput" placeholder="Ex. GJ-0135A">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">TDN</label>
                                        <input type="text" class="form-control" id="basiInput" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="basiInput" class="form-label">Adhar/Licence</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="inputGroupFile01">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Mobile</label>
                                        <input type="text" class="form-control" id="basiInput" placeholder="Ex. 9874561230">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row col-xxl-12 col-md-12">
                                        <label for="basiInput" class="form-label">No. Per</label>
                                        <div class="col-md-3">

                                                <input type="text" class="form-control" id="basiInput" placeholder="Ex. 1">
                                        </div>
                                         <div class="col-md-1">

                                                <label for="basiInput" class="form-label">+</label>

                                        </div>
                                        <div class="col-md-3">

                                                <!-- <label for="basiInput" class="form-label">+</label> -->
                                                <input type="text" class="form-control" id="basiInput" placeholder="Ex. 1">
                                        </div>
                                        <div class="col-md-1">

                                                <label for="basiInput" class="form-label">=</label>

                                        </div>
                                        <div class="col-md-4">

                                                <!-- <label for="basiInput" class="form-label">+</label> -->
                                                <input type="text" class="form-control" id="basiInput" placeholder="Ex. 3">
                                        </div>
                                      <!--   <input type="text" class="form-control" id="basiInput" placeholder="Ex. 9874561230"> -->
                                    </div>
                                </div>

                                <!--end col-->
                                <div class="col-md-6">
                                    <div>
                                        <label for="exampleInputtime" class="form-label">Time</label>
                                        <input type="time" class="form-control" id="exampleInputtime">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="exampleInputdate" class="form-label">Date</label>
                                        <input type="date" class="form-control" id="exampleInputdate">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                     <label for="exampleInputdate" class="form-label">Truck Model</label>
                                    <div class="input-group">

                                        <select class="form-select" id="inputGroupSelect01">
                                            <option selected>Choose...</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Parking Allotment</label>
                                        <input type="text" class="form-control" id="basiInput">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Payment</label>
                                        <div class="input-group">
                                            <span class="input-group-text">₹</span>
                                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                     <label for="exampleInputdate" class="form-label">Mode Of Payment</label>
                                    <div class="input-group">

                                        <select class="form-select" id="inputGroupSelect01">
                                            <option selected>Choose...</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>

                                <!--end col-->
                               <div class="col-lg-12">
                                        <div class="text-start">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                            </div>
                            <!--end row-->
                        </div>

                        {{-- <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">Drive Name</label>
                                <input type="text" class="form-control" id="product-title-input" value="" name="name" placeholder="Enter role name" required>
                                <div class="invalid-feedback">Please Enter a product title.</div>
                            </div>

                        </div>

                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">Truck Number</label>
                                <input type="text" class="form-control" id="product-title-input" value="" name="name" placeholder="Enter role name" required>
                                <div class="invalid-feedback">Please Enter a product title.</div>
                            </div>

                        </div> --}}


                        {{-- <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">Role Name</label>
                                <input type="text" class="form-control" id="product-title-input" value="" placeholder="Enter role name" required>
                                <div class="invalid-feedback">Please Enter a product title.</div>
                            </div>
                        </div> --}}


                    </div>
                </div>
                <!-- end card -->


                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Submit</button>
                </div>
        </div>
        <!-- end col -->


    </div>
    <!-- end row -->
</form>


@endsection
@section('script')
<script src="{{ URL::asset('build/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>

<script src="{{ URL::asset('build/libs/dropzone/dropzone-min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/ecommerce-product-create.init.js') }}"></script>

<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection

