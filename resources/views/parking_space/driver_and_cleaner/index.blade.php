@extends('layouts.master')
@section('title') @lang('translation.starter')  @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Master @endslot
@slot('title') Driver And Cleaner  @endslot
@endcomponent

<div class="row" id="contactList">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center border-0">
                <h5 class="card-title mb-0 flex-grow-1">All Driver and Cleaner</h5>
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
                                <th class="sort" scope="col">Mobile</th>
                                <th class="sort" scope="col">Designation</th>
                                <th class="sort" scope="col">Action</th>
                            </tr>
                        </thead>
                        <!--end thead-->
                        <tbody class="list form-check-all">
                            @foreach ($driver_and_cleaner as $item)
                                <tr>
                                    <td scope="col">{{ request('page') !== null ? (request('page') - 1) * 10 + $loop->iteration  :  $loop->iteration}}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->mobile }}</td>
                                    <td>{{ $item->designation }}</td>
                                    <td>
                                        <div class="hstack">
                                            <button type="button" class="btn btn-sm btn-soft-info view-details-list modal-view" data-id="{{ $item->id }}"><i class="ri-eye-fill align-bottom"></i></button>
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

                {!! $driver_and_cleaner->withQueryString()->links('admin.paginate') !!}

            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
</div>
<div class="modal fade" id="showModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" id="model-content">
        </div>
    </div>
</div>  
<!--end row-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var driverDetailsContainer = $('#model-content');
        $('.modal-view').on('click', async function() {
            const id = $(this).data('id');
            try {
                const response = await $.ajax({
                    url: `/driver-and-cleaner/${id}`,
                    method: 'GET',
                    dataType: 'json',
                });

                if (response) {
                    // Populate the user details into the modal
                    driverDetailsContainer.html(`
                        <div class="modal-header bg-light p-3">
                            <h5 class="modal-title me-3" id="exampleModalLabel">${response.designation}</h5>
                            <span class="badge bg-soft-${response.is_active == 1 ? "success" : "danger"} text-${response.is_active == 1 ? "success" : "danger"} float-end">${response.is_active == 1 ? "Active" : "In Active"}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                        </div>
                        <div class="modal-body row">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" value=${response.name} readonly />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mobile</label>
                                <input type="text" class="form-control" value=${response.mobile} readonly />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Country</label>
                                <input type="text" class="form-control" value=${response.country} readonly />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">State</label>
                                <input type="text" class="form-control" value=${response.state} readonly />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">City</label>
                                <input type="text" class="form-control" value=${response.city} readonly />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Document Type</label>
                                <input type="text" class="form-control" value=${response.document_type} readonly />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Document Number</label>
                                <input type="text" class="form-control" value=${response.document_number} readonly />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Document</label>
                                <div class="flex-shrink-0">
                                    <a type="button" class="btn btn-soft-primary" href="http://localhost:8000/storage/${response.document_file_id}" target="_blank"><i class="ri-file-list-3-line align-middle"></i> View Document</a> 
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    `);

                    // Show the modal
                    $('#showModal').modal('show');
                }
            } catch (error) {
                console.error('Error fetching user details:', error);
            }
        });
    });
</script>

@endsection
@section('script')
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
