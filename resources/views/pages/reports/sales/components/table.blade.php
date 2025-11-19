<table class="table table-striped align-middle m-0">
    <thead>
        <tr>
            <th>Invoice No.</th>
            <th>Customer</th>
            <th>Date</th>
            <th>Total</th>
            <th>Paid Amount</th>
            <th>Due Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($invoices as $invoice)
            <tr>
                <td style="cursor: pointer" onclick="viewInvoice('{{ $invoice->id }}')">{{ $invoice->invoice_number }}
                </td>
                <td style="cursor: pointer" onclick="viewInvoice('{{ $invoice->id }}')">{{ $invoice->customer->name }}
                </td>
                <td style="cursor: pointer" onclick="viewInvoice('{{ $invoice->id }}')">{{ $invoice->date }}</td>
                <td style="cursor: pointer" onclick="viewInvoice('{{ $invoice->id }}')">
                    {{ $invoice->invoicePayment->first()->to_pay ?? 'N/A' }}</td>
                <td style="cursor: pointer" onclick="viewInvoice('{{ $invoice->id }}')">
                    {{ $invoice->invoicePayment->first()->paid_amount ?? 'N/A' }}</td>
                <td style="cursor: pointer" onclick="viewInvoice('{{ $invoice->id }}')">
                    {{ $invoice->invoicePayment->first()->new_balance ?? 'N/A' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{--  <div class="m-3 mb-0">
    {{ $invoices->links('pagination::bootstrap-5') }}
</div>  --}}
