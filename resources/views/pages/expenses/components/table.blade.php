<table class="table table-striped align-middle m-0">
    <thead>
        <tr>
            <th>Code</th>
            {{--  <th></th>  --}}
            <th>Date</th>
            <th>Category</th>
            {{--  <th>Status</th>  --}}
            <th>Description</th>
            <th>Amount</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($expenses as $expense)
            <tr>
                <td>{{ $expense->code }}</td>
                {{--  <th>
                        <input class="form-check-input" type="checkbox"
                            value="option1" />
                    </th>  --}}
                <td>
                    {{--  <img src="assets/images/user2.png" class="me-2 img-3x rounded-3"
                    alt="Bootstrap Gallery" />  --}}
                    {{ $expense->date }}
                </td>
                <td>{{ $expense->category_name }}</td>
                {{--  <td>
                <div class="d-flex align-items-center">
                    <i class="icon-circle1 me-2 text-success fs-5"></i>
                    Online
                </div>
            </td>  --}}
                <td>{{ $expense->description }}</td>
                <td>{{ $expense->amount }}</td>
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
