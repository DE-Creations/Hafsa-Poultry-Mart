<table class="table table-striped align-middle m-0">
    <thead>
        <tr class="text-center">
            <th width="10%">Invoice No.</th>
            <th width="18%">Customer</th>
            <th width="18%">Date</th>
            <th width="18%">Total</th>
            <th width="18%">Paid Amount</th>
            <th width="18%">Due Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($invoices as $invoice)
            <tr class="text-center">
                <td>{{ $invoice->invoice_number }}
                </td>
                <td style="text-align: left; padding-left: 6%;">{{ $invoice->customer->name }}
                </td>
                <td>{{ $invoice->date }}</td>
                <td style="text-align: right; padding-right: 6%;">
                    {{ $invoice->invoicePayment->first()->to_pay ?? 'N/A' }}</td>
                <td style="text-align: right; padding-right: 6%;">
                    {{ $invoice->invoicePayment->first()->paid_amount ?? 'N/A' }}</td>
                <td style="text-align: right; padding-right: 6%;">
                    {{ $invoice->invoicePayment->first()->new_balance ?? 'N/A' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{--  <div class="m-3 mb-0">
    {{ $invoices->links('pagination::bootstrap-5') }}
</div>  --}}
