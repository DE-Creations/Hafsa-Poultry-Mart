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
                        <li class="breadcrumb-item">Expenses</li>
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
                                <div class="col">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search" id="search"
                                            onkeyup="getExpenses()" />
                                    </div>
                                </div>
                                <div class="col text-end">
                                    <button class="btn btn-warning" onclick="openExpensesCategoriesModal()">Expenses
                                        Categories</button>
                                    <a type="button" class="btn btn-primary" href="{{ route('expenses.create') }}">Add
                                        new</a>
                                </div>
                            </div>
                            <!-- Search container end -->

                            <div class="table-outer">
                                <div class="table-responsive" id="all_expense_table">

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

    <!-- Expenses Categories modal start -->
    <div class="modal fade" id="expensesCategoriesModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Expenses Categories
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="m-2">
                        <label class="form-label fw-bold">Add new Expense Category</label>
                        <div class="d-flex mt-2">
                            <input type="text" class="form-control" placeholder="Enter Name" name="name"
                                id="add_name" />
                            <span class="text-danger" id="name_error"></span>
                            <button onclick="addExpensesCategory()" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </div>

                    <div class="table-outer">
                        <div class="table-responsive" id="all_expense_category_table">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>

                </div>
            </div>
        </div>
    </div>
    <!-- Expenses Categories modal end -->

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
                    <button type="button" class="btn text-danger fs-6 col-6 m-0 border-end" onclick="deleteExpense()">
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
            }, 5000);
        }

        function goToExpenseEdit(id) {
            window.location.href = '/expenses/edit/' + id;
        }

        function showDeleteExpenseModal(id) {
            selected_expense_id = id;
            openModal("deleteExpenseModal");
        }

        async function deleteExpense() {
            try {
                const response = await axios.delete("{{ url('/expenses/delete') }}/" + selected_expense_id);
                const customer = response.data;

                getExpenses();
                modal.hide();
                showAlert("success-modal", "success-text", "Expense deleted successfully.");
            } catch (error) {
                showAlert("danger-modal", "danger-text", error);
            }
        }

        function getExpenses(page = 1) {
            //$('#pre_stop').show();
            var search = $('#search').val();
            var count = 25;

            var data = {
                search: search,
                count: count,
            };

            //$('#pre_stop').show();
            $.ajax({
                url: '/expenses/ajax/list?page=' + page,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                dataType: '',
                data: data,
                success: function(response) {
                    $('#all_expense_table').html(response);
                    //$('#pre_stop').hide();
                }
            });
        }

        function openExpensesCategoriesModal() {
            openModal("expensesCategoriesModal");
        }

        {{--  function getExpensesCategories() {
            try {
                $.ajax({
                    url: '/expenses/category/list',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'GET',
                    dataType: '',
                    success: function(response) {
                        console.log(response);
                        $('#all_expense_category_table').html(response);
                        //$('#pre_stop').hide();
                    }
                });
            } catch (error) {
                console.error("Error fetching expenses categories:", error);
            }
        }  --}}

        function resetAddInputFields() {
            document.getElementById("add_name").value = "";
        }

        {{--  function addExpensesCategory() {
            var name = document.getElementById("add_name").value;

            expenses_category_details = {
                name: name,
            }

            try {
                const response = await axios.post("{{ url('/expenses/category/store') }}/",
                    expenses_category_details);
                const expensesCategory = response.data;

                resetAddInputFields();
                getExpensesCategories();
                {{--  modal.hide();  --}}
        showAlert("success-modal", "success-text", "Expense Category added successfully.");
        }
        catch (error) {
            viewAddErrors(error);
        }
        }--
        }
        }

        window.addEventListener('load', () => {
            getExpenses();
        });
    </script>
</x-app-layout>
