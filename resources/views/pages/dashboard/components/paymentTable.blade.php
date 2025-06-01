<table class="table truncate align-middle">
    <thead>
        <tr>
            <th>Invoice No.</th>
            <th>Name</th>
            <th>Invoice Date</th>
            {{--  <th>Due Date</th>  --}}
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($payments as $payment)
            <tr>
                <td>{{ $payment->invoice->invoice_number }}</td>
                <td>{{ $payment->customer->name }}</td>
                <td>{{ $payment->invoice_date }}</td>
                {{--  <td>
                    <span class="badge bg-danger">2025/05/10</span>
                </td>  --}}
                <td>{{ $payment->new_balance }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
