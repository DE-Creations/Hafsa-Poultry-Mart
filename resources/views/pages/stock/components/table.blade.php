<table class="table table-striped align-middle m-0">
    <thead>
        <tr>
            <th>Item</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        {{ $stocks }}
        @foreach ($stocks as $stock)
            <tr>
                <td style="cursor: pointer" onclick="viewInvoice({{ $stock->id }})">{{ $stock->id }}</td>
                <td style="cursor: pointer" onclick="viewInvoice({{ $stock->id }})">{{ $stock->id }}</td>
                <td style="cursor: pointer" onclick="viewInvoice({{ $stock->id }})">{{ $stock->id }}</td>
                {{--  <td style="cursor: pointer" onclick="viewInvoice({{ $invoice->id }})">
                    {{ $invoice->invoicePayment->first()->new_balance ?? 'N/A' }}</td>
                <td>  --}}
                {{--  <?php
                // if the invoice is relevant customer's last invoice, show the edit and delete buttons. otherwise, do not show them
                $isLastInvoice = $invoice->customer->stocks->last()->id === $invoice->id;
                ?>
                @if ($isLastInvoice)
                    <button class="btn btn-outline-primary btn-sm" onclick="goToInvoiceEdit({{ $invoice->id }})"
                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-primary"
                        data-bs-title="Edit">
                        <i class="icon-edit"></i>
                    </button>
                    <button class="btn btn-outline-danger btn-sm" onclick="showDeleteInvoiceModal({{ $invoice->id }})"
                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-danger"
                        data-bs-title="Delete">
                        <i class="icon-trash"></i>
                    </button>
                @endif
                </td>  --}}
            </tr>
        @endforeach
    </tbody>
</table>

<div class="m-3 mb-0">
    {{ $stocks->links('pagination::bootstrap-5') }}
</div>
