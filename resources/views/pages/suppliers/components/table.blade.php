<table class="table table-striped align-middle m-0">
    <thead>
        <tr class="text-center">
            <th width="10%">ID</th>
            <th width="25%">Name</th>
            <th width="25%">Mobile</th>
            <th width="25%">City</th>
            <th width="15%">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($suppliers as $supplier)
            <tr class="text-center">
                <td>{{ $supplier->id }}</td>
                <td style="text-align: left; padding-left: 10%;">{{ $supplier->name }}</td>
                <td>{{ $supplier->mobile }}</td>
                <td style="text-align: left; padding-left: 10%;">{{ $supplier->city }}</td>
                <td>
                    <button class="btn btn-outline-primary btn-sm edit-customer-btn"
                        onclick="showSupplierEditModal({{ $supplier->id }})" data-bs-toggle="tooltip"
                        data-bs-placement="top" data-bs-custom-class="custom-tooltip-primary" data-bs-title="Edit">
                        <i class="icon-edit"></i>
                    </button>
                    <button class="btn btn-outline-danger btn-sm" onclick="showDeleteSupplierModal({{ $supplier->id }})"
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
    {{ $suppliers->links('pagination::bootstrap-5') }}
</div>
