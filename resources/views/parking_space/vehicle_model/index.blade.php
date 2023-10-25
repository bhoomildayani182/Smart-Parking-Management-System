@extends('layouts.master')
@section('title') @lang('translation.starter')  @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Master @endslot
@slot('title') Vehicle Models  @endslot
@endcomponent

<div class="row" id="contactList">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center border-0">
                <h5 class="card-title mb-0 flex-grow-1">Vehicle Model List</h5>
                <div class="flex-shrink-0">
                    <a href="{{ route('vehicle-models.create')}}" class="btn btn-success"><i class="ri-add-line align-bottom me-1"></i> Add Vehicle Model</a>

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
                                <th class="sort" scope="col">Maker Name</th>
                                <th class="sort" scope="col">Model Number</th>
                                <th class="sort" scope="col">Company Name</th>

                                <th class="sort" scope="col">Type</th>
                                <th class="sort" scope="col">Year</th>
                                <th class="sort" scope="col">description</th>
                                <th class="sort" scope="col">Status</th>
                                <th class="sort" scope="col">Action</th>
                            </tr>
                        </thead>
                        <!--end thead-->
                        <tbody class="list form-check-all">
                            @foreach ($vehicleModel as $key => $value)
                                <tr>
                                    <td scope="col">{{$loop->iteration}}</td>

                                    <td scope="col">{{  $value->maker_name }}</td>
                                    <td scope="col">{{  $value->model_number }}</td>
                                    <td scope="col">{{  $value->company_name }}</td>
                                    <td scope="col">{{  $value->type }}</td>
                                    <td scope="col">{{  $value->year }}</td>
                                    <td scope="col">{{  $value->description }}</td>

                                    <td class="status"><span class='badge text-uppercase {{ ($value->status == '1') ? 'badge-soft-success' : 'badge-soft-danger' }}'>{{ $value->status ? "Active" : "In Active" }}</span></td>
                                    <td>
                                        <div class="hstack gap-2">
                                            {{ Form::open(array('url' => 'vehicle-models/'. $value->id)) }}
                                                {{ Form::hidden('_method', 'DELETE') }}
                                                {!! Form::button('<i class="ri-delete-bin-5-fill align-bottom"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-soft-danger remove-list']); !!}
                                            {{ Form::close() }}
                                            <a class="btn btn-sm btn-soft-info edit-list" href="{{ route('vehicle-models.edit', ['vehicle_model' => $value->id]) }}"><i class="ri-pencil-fill align-bottom"></i></a>
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


                {!! $vehicleModel->withQueryString()->links('admin.paginate') !!}

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
