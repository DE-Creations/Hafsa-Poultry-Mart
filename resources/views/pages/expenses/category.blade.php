<x-app-layout>

    <div class="app-body">

        <!-- Container starts -->
        <div class="container">

            <!-- Row start -->
            <div class="row gx-3">
                <div class="col-12 col-xl-6">
                    <!-- Breadcrumb start -->
                    <ol class="breadcrumb mb-3">
                        <li class="breadcrumb-item">
                            <i class="icon-house_siding lh-1"></i>
                            <a href="{{ route('dashboard') }}" class="text-decoration-none">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('expenses.index') }}">Expenses</a></li>
                        <li class="breadcrumb-item">Categories</li>
                    </ol>
                    <!-- Breadcrumb end -->
                </div>
            </div>
            <!-- Row end -->

            <!-- Row start -->
            <div class="row gx-3">
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <!-- Search container start -->
                            <div class="row mb-3">
                                <div class="col-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search" id="search"
                                            onkeyup="getExpensesCategories()" />
                                    </div>
                                </div>
                                <div class="col-2 text-end">
                                    <button type="button" class="btn btn-primary" id="TriggerAddnewModel"
                                        onclick="showExpensesCategoriesAddModal()">Add new</button>
                                </div>
                            </div>
                            <!-- Search container end -->

                            <div class="table-outer">
                                <div class="table-responsive" id="all_expense_categories_table">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->

        </div>
        <!-- Container ends -->

    </div>

    <!-- Modals -->

    <!-- Expenses Categories add modal start -->
    <div class="modal fade" id="addExpensesCategoriesModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Add Expenses Categories
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="m-2">
                        <label class="form-label fw-bold">Category Name</label>
                        <input type="text" class="form-control mt-2" placeholder="Enter Name" name="name"
                            id="add_name" />
                        <span class="text-danger" id="name_error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button onclick="addExpensesCategory()" class="btn btn-primary">
                        Save
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Expenses Categories add modal end -->

    <!-- Expenses Categories edit modal start -->
    <div class="modal fade" id="editExpensesCategoriesModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Edit Expenses Categories
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="m-2">

                        <label class="form-label fw-bold">Category Name</label>
                        <input type="text" class="form-control mt-2" placeholder="Enter Name" name="name"
                            id="edit_name" />
                        <span class="text-danger" id="edit_name_error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button onclick="updateCategory()" class="btn btn-primary">
                        Save
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Expenses Categories edit modal end -->

    <!-- Delete modal start -->
    <div class="modal center fade" id="deleteExpenseModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="deleteExpenseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-4 text-center">
                    <h5 class="text-danger">Confirm Delete</h5>
                    <p class="mb-0">
                        Are you sure you want to delete this expense?
                    </p>
                </div>
                <div class="modal-footer flex-nowrap p-0 model-custom">
                    <button type="button" class="btn text-danger fs-6 col-6 m-0 border-end"
                        onclick="deleteExpense()">
                        <strong>Delete</strong>
                    </button>
                    <button type="button" class="btn text-secondary fs-6 col-6 m-0" data-bs-dismiss="modal">
                        <strong>Cancel</strong>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete modal end -->

    <!-- Restore modal start -->
    <div class="modal center fade" id="restoreExpenseModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="restoreExpenseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-4 text-center">
                    <h5 class="text-warning">Confirm Restore</h5>
                    <p class="mb-0">
                        Are you sure you want to restore this expense?
                    </p>
                </div>
                <div class="modal-footer flex-nowrap p-0 model-custom">
                    <button type="button" class="btn text-warning fs-6 col-6 m-0 border-end"
                        onclick="restoreExpense()">
                        <strong>Restore</strong>
                    </button>
                    <button type="button" class="btn text-secondary fs-6 col-6 m-0" data-bs-dismiss="modal">
                        <strong>Cancel</strong>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Restore modal end -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var selected_expense_id = 0;
        var modal;

        function openModal(modalName) {
            modal = new bootstrap.Modal(document.getElementById(modalName));
            modal.show();
        }

        function showAlert(alertType, alertSpan, alertText) {
            document.getElementById(alertSpan).textContent = alertText;
            const alert = document.getElementById(alertType);
            alert.classList.add("show");
            alert.classList.remove("d-none");
            setTimeout(() => {
                alert.classList.remove("show");
                alert.classList.add("d-none");
            }, 1500);
        }

        function showExpensesCategoriesAddModal() {
            openModal("addExpensesCategoriesModal");
            addResetFields();
        }

        function viewAddErrors(error) {
            if (error.response.data.errors.name) {
                document.getElementById("name_error").textContent = error.response.data.errors.name[0];
            } else {
                document.getElementById("name_error").textContent = "";
            }
        }

        function viewEditErrors(error) {
            if (error.response.data.errors.name) {
                document.getElementById("edit_name_error").textContent = error.response.data.errors.name[0];
            } else {
                document.getElementById("edit_name_error").textContent = "";
            }
        }

        function addResetFields() {
            document.getElementById("name_error").textContent = "";
        }

        async function addExpensesCategory() {
            var name = document.getElementById("add_name").value;

            expenses_category_details = {
                name: name,
            }

            try {
                const response = await axios.post("{{ url('/expenses/category/store') }}/",
                    expenses_category_details);
                const expensesCategory = response.data;

                alert("Expense Category added successfully.");
                resetAddInputFields();
                getExpensesCategories();
                modal.hide();
                showAlert("success-modal", "success-text", "Expense Category added successfully.");
            } catch (error) {
                viewAddErrors(error);
            }
        }

        function resetAddInputFields() {
            document.getElementById("add_name").value = "";
        }

        function getExpensesCategories(page = 1) {
            //$('#pre_stop').show();
            var search = $('#search').val();
            var count = 25;

            var data = {
                search: search,
                count: count,
            };

            //$('#pre_stop').show();
            $.ajax({
                url: '/expenses/category/ajax/list?page=' + page,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                dataType: '',
                data: data,
                success: function(response) {
                    $('#all_expense_categories_table').html(response);
                    //$('#pre_stop').hide();
                }
            });
        }

        async function goToExpenseCategoryEdit(id) {

            editResetFields();

            try {
                const response = await axios.get("{{ url('/expenses/category/get') }}/" + id);
                const editCategory = response.data;
                console.log(editCategory);
                var name = document.getElementById("edit_name");
                name.value = editCategory.name;
                selected_expense_id = editCategory.id;

                openModal("editExpensesCategoriesModal");
            } catch (error) {
                console.error(error);
                showAlert("danger-modal", "danger-text", "Failed to fetch customer data.");
            }
        }

        async function updateCategory() {
            var name = document.getElementById("edit_name").value;

            expenses_category_details = {
                name: name,
            };

            try {
                const response = await axios.post("{{ url('expenses/category/edit') }}/" + selected_expense_id,
                    expenses_category_details);
                const expensesCategory = response.data;

                editResetFields();
                getExpensesCategories();
                modal.hide();
                showAlert("success-modal", "success-text", "Expenses Category updated successfully.");
            } catch (error) {
                viewEditErrors(error);
            }
        }

        function editResetFields() {
            document.getElementById("edit_name_error").textContent = "";
        }

        function showDeleteExpenseCategoryModal(id) {
            selected_expense_id = id;
            openModal("deleteExpenseModal");
        }

        async function deleteExpense() {
            try {
                const response = await axios.delete("{{ url('/expenses/category/delete') }}/" + selected_expense_id);

                getExpensesCategories();
                modal.hide();
                showAlert("success-modal", "success-text", "Expense deleted successfully.");
            } catch (error) {
                showAlert("danger-modal", "danger-text", error);
            }
        }

        function showRestoreExpenseCategoryModal(id) {
            selected_expense_id = id;
            openModal("restoreExpenseModal");
        }

        async function restoreExpense() {
            try {
                const response = await axios.post("{{ url('/expenses/category/restore') }}/" + selected_expense_id);

                getExpensesCategories();
                modal.hide();
                showAlert("success-modal", "success-text", "Expense restored successfully.");
            } catch (error) {
                showAlert("danger-modal", "danger-text", error);
            }
        }

        window.addEventListener('load', () => {
            getExpensesCategories();
        });
    </script>
</x-app-layout>
