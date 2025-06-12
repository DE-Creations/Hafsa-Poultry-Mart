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
                        <li class="breadcrumb-item">Invoice</li>
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
                                            onkeyup="getInvoices()" />
                                    </div>
                                </div>
                                <div class="col-2 text-end">
                                    <a type="button" class="btn btn-primary" href="{{ route('invoice.create') }}">Add
                                        new</a>
                                </div>
                            </div>
                            <!-- Search container end -->

                            <div class="table-outer">
                                <div class="table-responsive" id="all_invoices_table">

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

    <!-- Invoice add modal start -->
    <div class="modal fade" id="addNewCustomerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Add new invoice
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">...</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Invoice add modal end -->

    <script>
        var selected_invoice_id = 0;
        var modal;

        function openModal(modalName) {
            modal = new bootstrap.Modal(document.getElementById(modalName));
            modal.show();
        }

        function showAlert(alertType, alertSpan, alertText) {
            document.getElementById(alertSpan).textContent = alertText;
            const alert = document.getElementById(alertType);
            alert.classList.add("show");
            setTimeout(() => {
                alert.classList.remove("show");
            }, 5000);
        }

        function goToExpenseEdit(id) {
            window.location.href = '/expenses/edit/' + id;
        }

        function showDeleteInvoiceModal(id) {
            selected_invoice_id = id;
            openModal("deleteExpenseModal");
        }

        async function deleteExpense() {
            try {
                const response = await axios.delete("{{ url('/expenses/delete') }}/" + selected_invoice_id);
                const customer = response.data;

                getExpenses();
                modal.hide();
                showAlert("success-modal", "success-text", "Expense deleted successfully.");
            } catch (error) {
                showAlert("danger-modal", "danger-text", error);
            }
        }

        function getInvoices(page = 1) {
            //$('#pre_stop').show();
            var search = $('#search').val();
            var count = 25;

            var data = {
                search: search,
                count: count,
            };

            //$('#pre_stop').show();
            $.ajax({
                url: '/invoice/ajax/list?page=' + page,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                dataType: '',
                data: data,
                success: function(response) {
                    $('#all_invoices_table').html(response);
                    //$('#pre_stop').hide();
                }
            });
        }

        window.addEventListener('load', () => {
            getInvoices();
        });
    </script>
</x-app-layout>
