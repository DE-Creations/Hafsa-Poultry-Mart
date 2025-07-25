<table class="table table-striped align-middle m-0">
    <thead>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>City</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $customer)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->mobile }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->city }}</td>
                <td>
                    <button class="btn btn-outline-primary btn-sm" onclick="showCustomerEditModal('{{ $customer->id }}')"
                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-primary"
                        data-bs-title="Edit">
                        <i class="icon-edit"></i>
                    </button>
                    <button class="btn btn-outline-danger btn-sm" onclick="showDeleteCustomerModal('{{ $customer->id }}')"
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
