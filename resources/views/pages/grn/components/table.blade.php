<table class="table table-striped align-middle m-0 text-center">
    <thead>
        <tr class="text-center">
            <th width="10%">GRN No.</th>
            <th width="15%">Supplier</th>
            <th width="15%">Date</th>
            <th width="15%">Total</th>
            <th width="15%">Paid Amount</th>
            <th width="15%">Due Amount</th>
            <th width="15%">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($grns as $grn)
            {{ $grn }}
            <tr class="text-center" onclick="viewGrn('{{ $grn->id }}')">
                <td>{{ $grn->grn_number }}</td>
                <td style="text-align: left; padding-left: 4%;">{{ $grn->supplier->name }}</td>
                <td>{{ $grn->date }}</td>
                <td style="text-align: right; padding-right: 4%;">
                    {{ number_format((float) (optional($grn->grn_pay)->sub_total ?? $grn->sub_total), 2) }}</td>
                <td style="text-align: right; padding-right: 4%;">{{ }}</td>
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
                <td style="text-align: right; padding-right: 4%;">{{ number_format($newBalance, 2) }}</td>
                <td style="text-align: right; padding-right: 4%;">{{ $grn->due_amount }}</td>
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
