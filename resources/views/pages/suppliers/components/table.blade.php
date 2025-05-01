<table class="table table-striped align-middle m-0">
    <thead>
        <tr>
            <th></th>
            {{--  <th></th>  --}}
            <th>Name</th>
            <th>NIC</th>
            {{--  <th>Status</th>  --}}
            {{-- <th>Mobile</th> --}}
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
            @foreach ($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->id }}</td>
                    {{--  <th>
                        <input class="form-check-input" type="checkbox"
                            value="option1" />
                    </th>  --}}
                    <td>
                        {{--  <img src="assets/images/user2.png" class="me-2 img-3x rounded-3"
                    alt="Bootstrap Gallery" />  --}}
                        {{ $supplier->name }}
                    </td>
                    <td>{{ $supplier->nic }}</td>
                    {{--  <td>
                <div class="d-flex align-items-center">
                    <i class="icon-circle1 me-2 text-success fs-5"></i>
                    Online
                </div>
            </td>  --}}
                    <td>
                        <button
                            class="btn btn-outline-primary btn-sm edit-customer-btn"
                            onclick="showSupplierEditModal({{ $supplier->id }})"
                            data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-custom-class="custom-tooltip-primary"
                            data-bs-title="Edit">
                            <i class="icon-edit"></i>
                        </button>
                        <button class="btn btn-outline-danger btn-sm"
                            onclick="showDeleteSupplierModal({{ $supplier->id }})"
                            data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-custom-class="custom-tooltip-danger"
                            data-bs-title="Delete">
                            <i class="icon-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach

    </tbody>
</table>
<div class="m-3 mb-0">
    {{ $suppliers->links('pagination::bootstrap-5') }}
</div>
