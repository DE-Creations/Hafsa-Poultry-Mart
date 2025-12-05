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
            <tr class="text-center" style="cursor: pointer;">
                <td onclick="viewGrn('{{ $grn->id }}')">{{ $grn->grn_number }}</td>
                <td onclick="viewGrn('{{ $grn->id }}')" style="text-align: left; padding-left: 4%;">
                    {{ $grn->supplier->name }}</td>
                <td onclick="viewGrn('{{ $grn->id }}')">{{ $grn->date }}</td>
                <td onclick="viewGrn('{{ $grn->id }}')" style="text-align: right; padding-right: 4%;">
                    {{ $grn->sub_total }}</td>
                <td onclick="viewGrn('{{ $grn->id }}')" style="text-align: right; padding-right: 4%;">
                    {{ $grn->grnPay->paid_amount }}</td>
                <td onclick="viewGrn('{{ $grn->id }}')" style="text-align: right; padding-right: 4%;">
                    {{ $grn->grnPay->new_balance }}</td>
                <td>
                    <button class="btn btn-outline-secondary btn-sm" onclick="printGrn('{{ $grn->id }}')"
                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-danger"
                        data-bs-title="Print">
                        <i class="icon-printer"></i>
                    </button>
                    <button class="btn btn-outline-primary btn-sm" onclick="goToGrnEdit('{{ $grn->id }}')"
                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-primary"
                        data-bs-title="Edit">
                        <i class="icon-edit"></i>
                    </button>
                    <button class="btn btn-outline-danger btn-sm" onclick="showDeleteGRNModal('{{ $grn->id }}')"
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
