<table class="table table-striped align-middle m-0">
    <thead>
        <tr>
            <th></th>
            {{--  <th></th>  --}}
            <th>Name</th>
            <th>Email</th>
            {{--  <th>Status</th>  --}}
            <th>Mobile</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $customer)
            <tr>
                <td>{{ $customer->id }}</td>
                {{--  <th>
                        <input class="form-check-input" type="checkbox"
                            value="option1" />
                    </th>  --}}
                <td>
                    {{--  <img src="assets/images/user2.png" class="me-2 img-3x rounded-3"
                    alt="Bootstrap Gallery" />  --}}
                    {{ $customer->name }}
                </td>
                <td>{{ $customer->email }}</td>
                {{--  <td>
                <div class="d-flex align-items-center">
                    <i class="icon-circle1 me-2 text-success fs-5"></i>
                    Online
                </div>
            </td>  --}}
                <td>{{ $customer->mobile }}</td>
                <td>
                    <button class="btn btn-outline-primary btn-sm" onclick="showCustomerEditModal({{ $customer->id }})"
                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-primary"
                        data-bs-title="Edit">
                        <i class="icon-edit"></i>
                    </button>
                    <button class="btn btn-outline-danger btn-sm" onclick="showDeleteCustomerModal({{ $customer->id }})"
                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-danger"
                        data-bs-title="Delete">
                        <i class="icon-trash"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="m-3 mb-0">
    {{ $customers->links('pagination::bootstrap-5') }}
</div>
