<table class="table table-striped align-middle m-0">
    <thead>
        <tr>
            <th>Id</th>
            <th>Item</th>
            <th>Date</th>
            <th>Last updated at</th>
            <th>Unit Price</th>
            <th>Balance</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($stocks as $stock)
            <tr>
                <td style="cursor: pointer" onclick="viewInvoice({{ $stock->id }})">{{ $stock->id }}</td>
                <td style="cursor: pointer" onclick="viewInvoice({{ $stock->id }})">{{ $stock->outputItem->name }}</td>
                <td style="cursor: pointer" onclick="viewInvoice({{ $stock->id }})">
                    {{ $stock->created_at->format('Y-m-d') }}</td>
                <td style="cursor: pointer" onclick="viewInvoice({{ $stock->id }})">
                    {{ $stock->updated_at->format('Y-m-d') }}</td>
                <td style="cursor: pointer" onclick="viewInvoice({{ $stock->id }})">{{ $stock->unit_price }}</td>
                <td style="cursor: pointer" onclick="viewInvoice({{ $stock->id }})">{{ $stock->balance }}</td>
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
