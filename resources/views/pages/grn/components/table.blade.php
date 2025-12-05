<table class="table table-striped align-middle m-0 text-center">
    <thead>
        <tr>
            <th>GRN No.</th>
            <th>Supplier</th>
            <th>Date</th>
            <th>Total</th>
            <th>Paid Amount</th>
            <th>Due Amount</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($grns as $grn)
            <tr>
                <td>{{ $grn->grn_number }}</td>
                <td>{{ $grn->supplier->name }}</td>
                <td>{{ $grn->date }}</td>
                <td>{{ number_format((float) (optional($grn->grn_pay)->sub_total ?? $grn->sub_total), 2) }}</td>
                <td>{{ $grn->total }}</td>
                @php
                    $paid = (float) ($grn->total ?? 0);
                    $subTotal = (float) (optional($grn->grn_pay)->sub_total ?? ($grn->sub_total ?? 0));
                    $newBalance = optional($grn->grn_pay)->new_balance;
                    if ($newBalance === null) {
                        $newBalance = $paid - $subTotal;
                    } else {
                        $newBalance = (float) $newBalance;
                    }
                @endphp
                <td>{{ number_format($newBalance, 2) }}</td>
                <td>{{ $grn->due_amount }}</td>
                <td>
                    <button class="btn btn-outline-secondary btn-sm" onclick="printGrn('{{ $grn->id }}')"
                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-danger"
                        data-bs-title="Print">
                        <i class="icon-printer"></i>
                    </button>
                    <button class="btn btn-outline-primary btn-sm" onclick="goToGrnEdit({{ $grn->id }})"
                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-primary"
                        data-bs-title="Edit">
                        <i class="icon-edit"></i>
                    </button>
                    <button class="btn btn-outline-danger btn-sm" onclick="showDeleteGRNModal({{ $grn->id }})"
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
