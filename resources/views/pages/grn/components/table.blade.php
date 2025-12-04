<table class="table table-striped align-middle m-0">
    <thead>
        <tr>
            <th>GRN No.</th>
            <th>Supplier</th>
            <th>Date</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Paid Amount</th>
            <th>Due Amount</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($grns as $grn)
            {{ $grn }}
            <tr>
                <td>{{ $grn->grn_number }}</td>
                <td>{{ $grn->supplier->name }}</td>
                <td>{{ $grn->date }}</td>
                <td>{{ $grn->qty }}</td>
                <td>{{ $grn->total }}</td>
                <td>{{ $grn->paid_amount }}</td>
                <td>{{ $grn->due_amount }}</td>
                <td>
                    <button class="btn btn-outline-primary btn-sm" onclick="goToGrnEdit({{ $grn->id }})"
                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-primary"
                        data-bs-title="Edit">
                        <i class="icon-edit"></i>
                    </button>
                    <button class="btn btn-outline-danger btn-sm" onclick="showDeleteGrnModal({{ $grn->id }})"
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
    {{ $grns->links('pagination::bootstrap-5') }}
</div>
