<table class="table table-striped align-middle m-0">
    <thead>
        <tr class="text-center">
            <th width="10%">Id</th>
            <th width="15%">Item</th>
            <th width="15%">Date</th>
            <th width="15%">Last updated at</th>
            <th width="15%">Unit Price</th>
            <th width="15%">Balance</th>
            <th width="15%">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($stocks as $stock)
            <tr class="text-center">
                <td>{{ $stock->id }}</td>
                <td>{{ $stock->outputItem->name }}</td>
                <td>{{ $stock->created_at->format('Y-m-d') }}</td>
                <td>{{ $stock->updated_at->format('Y-m-d') }}</td>
                <td style="text-align: right; padding-right: 5%;">{{ $stock->unit_price }}</td>
                <td style="text-align: right; padding-right: 5%;">{{ $stock->balance }}</td>
                <td>
                    {{--  <?php
                    // if the invoice is relevant customer's last invoice, show the edit and delete buttons. otherwise, do not show them
                    $isLastInvoice = $invoice->customer->stocks->last()->id === $invoice->id;
                    ?>
                @if ($isLastInvoice)  --}}
                    <button class="btn btn-outline-primary btn-sm" onclick="showStockEditModal({{ $stock->id }})"
                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-primary"
                        data-bs-title="Edit">
                        <i class="icon-edit"></i>
                    </button>
                    <button class="btn btn-outline-danger btn-sm" onclick="showDeleteStockModal({{ $stock->id }})"
                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-danger"
                        data-bs-title="Delete">
                        <i class="icon-trash"></i>
                    </button>
                    {{--  @endif  --}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="m-3 mb-0">
    {{ $stocks->links('pagination::bootstrap-5') }}
</div>
