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
                    <th class="sort" data-sort="time" scope="col">Role Name</th>
                    <th class="sort" data-sort="currency_name" scope="col">Created At</th>
                    <th class="sort" data-sort="currency_name" scope="col">Action</th>

                </tr>
            </thead>
            <!--end thead-->
            <tbody class="list form-check-all">
                @foreach ($items as $key => $value)
                {{-- {{ dd($value) }} --}}
                    <tr>
                        <td scope="col" >
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="cardtableCheck">
                                <label class="form-check-label" for="cardtableCheck"></label>
                            </div>
                        </td>
                        <td>{{ $value->name }}</td>
                        <td class="status"><span class="badge badge-soft-success text-uppercase">Successful</span></td>
                        <td></td>
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


    {!! $items->withQueryString()->links('admin.paginate') !!}

</div>
