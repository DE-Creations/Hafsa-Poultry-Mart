<table class="table table-striped align-middle m-0">
    <thead>
        <tr class="text-center">
            <th width="15%">Code</th>
            <th width="30%">Date</th>
            <th width="30%">Category</th>
            <th width="25%">Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($expenses as $expense)
            <tr class="text-center">
                <td>{{ $expense->code }}
                </td>
                <td>{{ $expense->date }}</td>
                <td style="text-align: left; padding-left: 12%;">{{ $expense->expenseCategory->name }}</td>
                <td style="text-align: right; padding-right: 10%;">{{ $expense->amount }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{--  <div class="m-3 mb-0">
    {{ $invoices->links('pagination::bootstrap-5') }}
</div>  --}}
