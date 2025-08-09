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
                        <li class="breadcrumb-item">Stock</li>
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
                                            onkeyup="getTableDetails()" />
                                    </div>
                                </div>
                                <div class="col-2 text-end">
                                    <button type="button" class="btn btn-primary" onclick="showStockAddModal()">
                                        Add new</button>
                                </div>
                            </div>
                            <!-- Search container end -->

                            <div class="table-outer">
                                <div class="table-responsive" id="all_stocks_table">

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

    <!-- Stock add modal start -->
    <div class="modal fade" id="addNewStockModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Add new Stock
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="m-2">
                        <label class="form-label fw-bold">Item</label>
                        <select name="item" id="add_item" class="form-control mt-2">
                            <option value="0">Select Item</option>
                            @foreach ($output_items as $output_item)
                                <option value="{{ $output_item->id }}">{{ $output_item->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="item_error"></span>
                    </div>

                    <div class="m-2">
                        <label class="form-label fw-bold">Unit Price (Rs)</label>
                        <input type="number" class="form-control mt-2" placeholder="Enter Price" name="price"
                            id="add_price" />
                        <span class="text-danger" id="price_error"></span>
                    </div>

                    <div class="m-2">
                        <label class="form-label fw-bold">Quantity (kg)</label>
                        <input type="number" class="form-control mt-2" placeholder="Enter Quantity (kg)" name="qty"
                            id="add_qty" />
                        <span class="text-danger" id="qty_error"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button onclick="addStock()" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Stock add modal end -->

    <!-- Stock edit modal start -->
    <div class="modal fade" id="editStockModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editStockModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStockModalLabel">
                        Edit customer
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="m-2">
                        <label class="form-label fw-bold">Item</label>
                        <select name="item" id="edit_item" class="form-control mt-2">
                            <option value="0">Select Item</option>
                            @foreach ($output_items as $output_item)
                                <option value="{{ $output_item->id }}">{{ $output_item->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="edit_item_error"></span>
                    </div>

                    <div class="m-2">
                        <label class="form-label fw-bold">Unit Price (Rs)</label>
                        <input type="number" class="form-control mt-2" placeholder="Enter Price" name="price"
                            id="edit_price" />
                        <span class="text-danger" id="edit_price_error"></span>
                    </div>

                    <div class="m-2">
                        <label class="form-label fw-bold">Quantity (kg)</label>
                        <input type="number" class="form-control mt-2" placeholder="Enter Quantity (kg)"
                            name="qty" id="edit_qty" />
                        <span class="text-danger" id="edit_qty_error"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button onclick="updateCustomer()" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Stock edit modal end -->

    <!-- Delete modal start -->
    <div class="modal center fade" id="deleteInvoiceModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="deleteInvoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-4 text-center">
                    <h5 class="text-danger">Confirm Delete</h5>
                    <p class="mb-0">
                        Are you sure you want to delete this Stock?
                    </p>
                </div>
                <div class="modal-footer flex-nowrap p-0 model-custom">
                    <button type="button" class="btn text-danger fs-6 col-6 m-0 border-end"
                        onclick="deleteInvoice()">
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
        var selected_stock_id = 0;
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

        function resetAddInputFields() {
            document.getElementById("add_item").value = "";
            document.getElementById("add_price").value = "";
            document.getElementById("add_qty").value = "";
        }

        function resetEditInputFields() {
            document.getElementById("edit_item").value = "";
            document.getElementById("edit_price").value = "";
            document.getElementById("edit_qty").value = "";
        }

        function viewAddErrors(error) {
            if (error.response.data.errors.output_item_id) {
                document.getElementById("item_error").textContent = error.response.data.errors.output_item_id[0];
            } else {
                document.getElementById("item_error").textContent = "";
            }
            if (error.response.data.errors.unit_price) {
                document.getElementById("price_error").textContent = error.response.data.errors.unit_price[0];
            } else {
                document.getElementById("price_error").textContent = "";
            }
            if (error.response.data.errors.balance) {
                document.getElementById("qty_error").textContent = error.response.data.errors.balance[0];
            } else {
                document.getElementById("qty_error").textContent = "";
            }
        }

        function viewEditErrors(error) {
            if (error.response.data.errors.output_item_id) {
                document.getElementById("edit_item_error").textContent = error.response.data.errors.output_item_id[0];
            } else {
                document.getElementById("edit_item_error").textContent = "";
            }
            if (error.response.data.errors.unit_price) {
                document.getElementById("edit_price_error").textContent = error.response.data.errors.unit_price[0];
            } else {
                document.getElementById("edit_price_error").textContent = "";
            }
            if (error.response.data.errors.balance) {
                document.getElementById("edit_qty_error").textContent = error.response.data.errors.balance[0];
            } else {
                document.getElementById("edit_qty_error").textContent = "";
            }
        }

        function addResetFields() {
            document.getElementById("item_error").textContent = "";
            document.getElementById("price_error").textContent = "";
            document.getElementById("qty_error").textContent = "";
        }

        function editResetFields() {
            document.getElementById("edit_item_error").textContent = "";
            document.getElementById("edit_price_error").textContent = "";
            document.getElementById("edit_qty_error").textContent = "";
        }

        function showStockAddModal() {
            addResetFields();
            openModal("addNewStockModal");
        }

        async function addStock() {
            var item = document.getElementById("add_item").value;
            var price = document.getElementById("add_price").value;
            var qty = document.getElementById("add_qty").value;

            add_stock_details = {
                output_item_id: item,
                unit_price: price,
                balance: qty,
            }

            try {
                const response = await axios.post("{{ url('/stock/store') }}/",
                    add_stock_details);

                resetAddInputFields();
                getTableDetails();
                modal.hide();
                showAlert("success-modal", "success-text", "Stock added successfully.");
            } catch (error) {
                viewAddErrors(error);
            }
        }

        async function showStockEditModal(id) {
            editResetFields();

            try {
                const response = await axios.get("{{ url('/stock/get') }}/" + id);
                const stock = response.data;
                console.log(stock);

                var item = document.getElementById("edit_item");
                var price = document.getElementById("edit_price");
                var qty = document.getElementById("edit_qty");

                item.value = stock.output_item_id;
                price.value = stock.unit_price;
                qty.value = stock.balance;
                selected_stock_id = stock.id;

                openModal("editStockModal");
            } catch (error) {
                console.error(error);
                showAlert("danger-modal", "danger-text", "Failed to fetch stock data.");
            }
        }

        async function updateCustomer() {
            var item = document.getElementById("edit_item").value;
            var price = document.getElementById("edit_price").value;
            var qty = document.getElementById("edit_qty").value;

            edit_stock_details = {
                output_item_id: item,
                unit_price: price,
                balance: qty,
            }

            try {
                const response = await axios.post("{{ url('/stock/update') }}/" + selected_stock_id,
                    edit_stock_details);
                const stock = response.data;

                resetEditInputFields();
                getTableDetails();
                modal.hide();
                showAlert("success-modal", "success-text", "Stock updated successfully.");
            } catch (error) {
                viewEditErrors(error);
            }
        }

        function goToStockEdit(id) {
            window.location.href = '/stock/edit/' + id;
        }

        function showDeleteStockModal(id) {
            selected_stock_id = id;
            openModal("deleteInvoiceModal");
        }

        async function deleteInvoice() {
            try {
                const response = await axios.delete("{{ url('/stock/delete') }}/" + selected_stock_id);
                const invoice = response.data;

                getTableDetails();
                modal.hide();
                showAlert("success-modal", "success-text", "Stock deleted successfully.");
            } catch (error) {
                showAlert("danger-modal", "danger-text", error);
            }
        }

        function showPrintInvoiceModal(invoice_id) {
            selected_stock_id = invoice_id;
            openModal("printInvoiceModal");
        }

        async function printInvoice() {
            modal.hide();
            try {
                const response = await axios.post("{{ url('/invoice/print') }}/" + selected_stock_id, {}, {
                    responseType: 'blob'
                });

                const blob = new Blob([response.data], {
                    type: 'application/pdf'
                });
                const url = window.URL.createObjectURL(blob);
                window.open(url, '_blank');
            } catch (error) {
                console.error(error);
                showAlert("danger-modal", "danger-text", "Something went wrong while generating the invoice.");
            }
        }

        function viewInvoice(id) {
            window.location.href = '/invoice/view/' + id;
        }

        function getTableDetails(page = 1) {
            //$('#pre_stop').show();
            var search = $('#search').val();
            var count = 25;

            var data = {
                search: search,
                count: count,
            };

            //$('#pre_stop').show();
            $.ajax({
                url: '/stock/ajax/list?page=' + page,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                dataType: '',
                data: data,
                success: function(response) {
                    $('#all_stocks_table').html(response);
                    //$('#pre_stop').hide();
                }
            });
        }

        window.addEventListener('load', () => {
            getTableDetails();
        });
    </script>
</x-app-layout>
