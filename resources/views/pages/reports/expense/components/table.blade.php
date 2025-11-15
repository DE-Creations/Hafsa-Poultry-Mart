<table class="table table-striped align-middle m-0">
    <thead>
        <tr>
            <th>Code</th>
            <th>Date</th>
            <th>Category</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($expenses as $expense)
            <tr>
                <td style="cursor: pointer">{{ $expense->code }}
                </td>
                <td style="cursor: pointer">{{ $expense->date }}</td>
                <td style="cursor: pointer">{{ $expense->expenseCategory->name }}</td>
                <td style="cursor: pointer">{{ $expense->amount }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{--  <div class="m-3 mb-0">
    {{ $invoices->links('pagination::bootstrap-5') }}
</div>  --}}
