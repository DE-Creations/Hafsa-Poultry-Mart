<table class="table table-striped align-middle m-0">
    <thead>
        <tr class="text-center">
            <th width="15%">Invoice No.</th>
            <th width="20%">Customer</th>
            <th width="20%">Date</th>
            <th width="15%">Total</th>
            <th width="15%">Paid Amount</th>
            <th width="15%">Due Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($invoices as $invoice)
        <tr class="text-center">
            <td>{{ $invoice->invoice_number }}
            </td>
            <td>{{ $invoice->customer->name }}
            </td>
            <td>{{ $invoice->date }}</td>
            <td>
                {{ $invoice->invoicePayment->first()->to_pay ?? 'N/A' }}
            </td>
            <td>
                {{ $invoice->invoicePayment->first()->paid_amount ?? 'N/A' }}
            </td>
            <td>
                {{ $invoice->invoicePayment->first()->new_balance ?? 'N/A' }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- <div class="m-3 mb-0">
    {{ $invoices->links('pagination::bootstrap-5') }}
</div> --}}
