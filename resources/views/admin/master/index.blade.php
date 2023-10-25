@extends('layouts.master')
@section('title') @lang('translation.starter')  @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Setting @endslot
@slot('title') User - Role  @endslot
@endcomponent

<div class="row" id="contactList">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center border-0">
                <h5 class="card-title mb-0 flex-grow-1">All Orders</h5>
                <div class="flex-shrink-0">
                    <div class="flax-shrink-0 hstack gap-2">
                        <button class="btn btn-primary">Today's Orders</button>
                        <button class="btn btn-soft-info">Past Orders</button>
                    </div>
                </div>
            </div>
            <div class="card-body border border-dashed border-end-0 border-start-0">
                <div class="row g-2">
                    <div class="col-xl-4 col-md-6">
                        <div class="search-box">
                            <input type="text" class="form-control search" placeholder="Search to orders...">
                            <i class="ri-search-line search-icon"></i>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xl-3 col-md-6">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="ri-calendar-2-line"></i></span>
                            <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y" data-range-date="true" placeholder="Select date" id="range-datepicker" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xl-2 col-md-4">
                        <select class="form-control" data-choices data-choices-search-false name="idType" id="idType">
                            <option value="all">Select Type</option>
                            <option value="Buy">Buy</option>
                            <option value="Sell">Sell</option>
                        </select>
                    </div>
                    <!--end col-->
                    <div class="col-xl-2 col-md-4">
                        <select class="form-control" data-choices data-choices-search-false name="idStatus" id="idStatus">
                            <option value="all">Select Status</option>
                            <option value="Successful">Successful</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>
                    <!--end col-->
                    <div class="col-xl-1 col-md-4">
                        <button class="btn btn-success w-100" onclick="filterData();">Filters</button>
                    </div>
                </div>
                <!--end row-->
            </div>
            <div class="card-body">
                <div class="table-responsive table-card">
                    <table class="table align-middle table-nowrap" id="customerTable">
                        <thead class="table-light text-muted">
                            <tr>
                                <th scope="col" >
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                    </div>
                                </th>
                                <th class="sort" data-sort="time" scope="col">Date</th>
                                <th class="sort" data-sort="currency_name" scope="col">Name</th>
                                <th class="sort" data-sort="type" scope="col">Type</th>
                                <th class="sort" data-sort="quantity_value" scope="col">Quantity</th>
                                <th class="sort" data-sort="or_val" scope="col">Order Value</th>
                                <th class="sort" data-sort="sort-avg_price" scope="col">Avg Price</th>
                                <th class="sort" data-sort="sort-price" scope="col">Price</th>
                                <th class="sort" data-sort="status" scope="col">Status</th>
                            </tr>
                        </thead>
                        <!--end thead-->
                        <tbody class="list form-check-all">
                            @foreach ($roles as $key => $value)
                            {{-- {{ dd($value) }} --}}
                                <tr>
                                    <td scope="col" >
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="cardtableCheck">
                                            <label class="form-check-label" for="cardtableCheck"></label>
                                        </div>
                                    </td>
                                    <td class="order_date time" data-timestamp="1641945600">02 Jan, 2022 <small class="text-muted">03:45PM</small></td>
                                    <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#VZ001</a></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <img src="{{URL::asset('build/images/svg/crypto-icons/btc.svg')}}" alt="" class="avatar-xxs" />
                                            </div>
                                            <a href="javascript:void(0);" class="flex-grow-1 ms-2 currency_name">Bitcoin (BTC)</a>
                                        </div>
                                    </td>
                                    <td class="type text-success">{{  $value->name }}</td>
                                    <td class="quantity_value">08</td>
                                    <td class="order_value or_val" data-orderval="370683.20">$3,70,683.20</td>
                                    <td class="avg_price sort-avg_price" data-av-price="46154.30">$46,154.30</td>
                                    <td class="price sort-price" data-price="46335.40">$46,335.40</td>
                                    <td class="status"><span class="badge badge-soft-success text-uppercase">Successful</span></td>
                                </tr>

                            @endforeach

                            <!--end tr-->

                        </tbody>
                    </table>
                    <!--end table-->
                    <div class="noresult" style="display: none">
                        <div class="text-center">
                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px"></lord-icon>
                            <h5 class="mt-2">Sorry! No Result Found</h5>
                            <p class="text-muted mb-0">We've searched more than 150+ orders We did not find any orders for you search.</p>
                        </div>
                    </div>
                </div>


                {!! $roles->withQueryString()->links('admin.paginate') !!}

            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
</div>
<!--end row-->


@endsection
@section('script')
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
