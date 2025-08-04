<table class="table table-striped align-middle m-0">
    <thead>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($expensesCategories as $expensesCategory)
            <tr>
                <td>{{ $expensesCategory->id }}</td>
                <td>{{ $expensesCategory->name }}</td>
                <td>
                    <button class="btn btn-outline-primary btn-sm"
                        onclick="goToExpenseCategoryEdit({{ $expensesCategory->id }})" data-bs-toggle="tooltip"
                        data-bs-placement="top" data-bs-custom-class="custom-tooltip-primary" data-bs-title="Edit">
                        <i class="icon-edit"></i>
                    </button>
                    <button class="btn btn-outline-danger btn-sm"
                        onclick="showDeleteExpenseCategoryModal({{ $expensesCategory->id }})" data-bs-toggle="tooltip"
                        data-bs-placement="top" data-bs-custom-class="custom-tooltip-danger" data-bs-title="Delete">
                        <i class="icon-trash"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
