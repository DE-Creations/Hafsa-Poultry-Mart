<table class="table table-striped align-middle m-0">
    <thead>
        <tr>
            <th>Invoice No.</th>
            <th>Customer</th>
            <th>Date</th>
            <th>Total</th>
            <th>Paid Amount</th>
            <th>Due Amount</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        {{ $invoices }}
        @foreach ($invoices as $invoice)
            <tr>
                <td style="cursor: pointer" onclick="viewInvoice('{{ $invoice->id }}')">{{ $invoice->invoice_number }}</td>
                <td style="cursor: pointer" onclick="viewInvoice('{{ $invoice->id }}')">{{ $invoice->customer->name }}</td>
                <td style="cursor: pointer" onclick="viewInvoice('{{ $invoice->id }}')">{{ $invoice->date }}</td>
                <td style="cursor: pointer" onclick="viewInvoice('{{ $invoice->id }}')">
                    {{ $invoice->invoicePayment->first()->to_pay ?? 'N/A' }}</td>
                <td style="cursor: pointer" onclick="viewInvoice('{{ $invoice->id }}')">
                    {{ $invoice->invoicePayment->first()->paid_amount ?? 'N/A' }}</td>
                <td style="cursor: pointer" onclick="viewInvoice('{{ $invoice->id }}')">
                    {{ $invoice->invoicePayment->first()->new_balance ?? 'N/A' }}</td>
                <td>
                    <button class="btn btn-outline-secondary btn-sm"
                        onclick="printInvoice('{{ $invoice->id }}')" data-bs-toggle="tooltip"
                        data-bs-placement="top" data-bs-custom-class="custom-tooltip-danger" data-bs-title="Print">
                        <i class="icon-printer"></i>
                    </button>
                    <?php
                    // if the invoice is relevant customer's last invoice, show the edit and delete buttons. otherwise, do not show them
                    $isLastInvoice = $invoice->customer->invoices->last()->id === $invoice->id;
                    ?>
                    @if ($isLastInvoice)
                        <button class="btn btn-outline-primary btn-sm" onclick="goToInvoiceEdit('{{ $invoice->id }}')"
                            data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-custom-class="custom-tooltip-primary" data-bs-title="Edit">
                            <i class="icon-edit"></i>
                        </button>
                        <button class="btn btn-outline-danger btn-sm"
                            onclick="showDeleteInvoiceModal('{{ $invoice->id }}')" data-bs-toggle="tooltip"
                            data-bs-placement="top" data-bs-custom-class="custom-tooltip-danger" data-bs-title="Delete">
                            <i class="icon-trash"></i>
                        </button>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="m-3 mb-0">
    {{ $invoices->links('pagination::bootstrap-5') }}
</div>
