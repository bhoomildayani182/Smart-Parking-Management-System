@extends('layouts.master')
@section('title') @lang('translation.starter')  @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Master @endslot
@slot('title') Parking Slots  @endslot
@endcomponent

<div class="row" id="contactList">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center border-0">
                <h5 class="card-title mb-0 flex-grow-1">Parking Slot List</h5>
                <div class="flex-shrink-0">
                    <a href="{{ route('parking_slots.create')}}" class="btn btn-success"><i class="ri-add-line align-bottom me-1"></i> Add Parking Slots</a>
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
                                <th class="sort" scope="col">Sr. no</th>
                                <th class="sort" scope="col">Name</th>
                                <th class="sort" scope="col">Zone</th>
                                <th class="sort" scope="col">Slot</th>
                                <th class="sort" scope="col">Action</th>
                                <th class="sort" scope="col">Details</th>
                            </tr>
                        </thead>
                        <!--end thead-->
                        <tbody class="list form-check-all">
                            @foreach ($parkingSlots as $parkingSlot)
                                <tr>
                                    <td scope="col">{{ request('page') !== null ? (request('page') - 1) * 10 + $loop->iteration  :  $loop->iteration}}</td>
                                    <td>{{ $parkingSlot->name }}</td>
                                    <td>{{ $parkingSlot->zone }}</td>
                                    <td>{{ $parkingSlot->parking_slot }}</td>
                                    <td>
                                        <div class="hstack gap-2">
                                            <a class="btn btn-sm btn-soft-danger remove-list" href="{{ route('parking_slots.delete', ['parkingslot' => $parkingSlot->id]) }}"><i class="ri-delete-bin-5-fill align-bottom"></i></a>
                                            <a class="btn btn-sm btn-soft-info edit-list" href="{{ route('parking_slots.update', ['parkingslot' => $parkingSlot->id]) }}"><i class="ri-pencil-fill align-bottom"></i></a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="hstack">
                                            <a class="btn btn-sm btn-soft-info view-details-list" href="{{ route('parking-slot-details.index', ['parkingslot' => $parkingSlot->id]) }}"><i class="ri-eye-fill align-bottom"></i></a>
                                        </div>
                                    </td>
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


                {!! $parkingSlots->withQueryString()->links('admin.paginate') !!}

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
