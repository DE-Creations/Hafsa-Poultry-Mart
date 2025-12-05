<table class="table table-striped align-middle m-0">
    <thead>
        <tr class="text-center">
            <th width="10%">Code</th>
            <th width="20%">Date</th>
            <th width="20%">Category</th>
            <th width="20%">Description</th>
            <th width="20%">Amount</th>
            <th width="10%">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($expenses as $expense)
            <tr class="text-center">
                <td>{{ $expense->code }}</td>
                <td>
                    {{ $expense->date }}
                </td>
                <td style="text-align: left; padding-left: 8%;">{{ $expense->expenseCategory->name }}</td>
                <td style="text-align: left; padding-left: 8%;">{{ $expense->description }}</td>
                <td style="text-align: right; padding-right: 8%;">{{ $expense->amount }}</td>
                <td>
                    <button class="btn btn-outline-primary btn-sm" onclick="goToExpenseEdit({{ $expense->id }})"
                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-primary"
                        data-bs-title="Edit">
                        <i class="icon-edit"></i>
                    </button>
                    <button class="btn btn-outline-danger btn-sm" onclick="showDeleteExpenseModal({{ $expense->id }})"
                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-danger"
                        data-bs-title="Delete">
                        <i class="icon-trash"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="m-3 mb-0">
    {{ $expenses->links('pagination::bootstrap-5') }}
</div>
