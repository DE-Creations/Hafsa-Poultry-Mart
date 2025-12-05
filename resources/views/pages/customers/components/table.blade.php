<table class="table table-striped align-middle m-0">
    <thead>
        <tr class="text-center">
            <th width="10%">No.</th>
            <th width="20%">Name</th>
            <th width="20%">Mobile</th>
            <th width="20%">Email</th>
            <th width="20%">City</th>
            <th width="10%">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $customer)
            <tr class="text-center">
                <td >{{ $loop->iteration }}</td>
                <td style="text-align: left; padding-left: 8%;">{{ $customer->name }}</td>
                <td style="text-align: left; padding-left: 8%;">{{ $customer->mobile }}</td>
                <td style="text-align: left; padding-left: 8%;">{{ $customer->email }}</td>
                <td style="text-align: left; padding-left: 8%;">{{ $customer->city }}</td>
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
