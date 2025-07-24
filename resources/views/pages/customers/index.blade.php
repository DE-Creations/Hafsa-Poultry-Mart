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
                        <li class="breadcrumb-item">Customers</li>
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
                                        <input id="search" type="text" class="form-control" placeholder="Search"
                                            onkeyup="getCustomers()" />
                                    </div>
                                </div>
                                <div class="col-2 text-end">
                                    <button type="button" class="btn btn-primary" onclick="showCustomerAddModal()">
                                        Add new</button>
                                </div>
                            </div>
                            <!-- Search container end -->

                            <div class="table-outer">
                                <div class="table-responsive" id="all_customer_table">

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

    <!-- Customer add modal start -->
    <div class="modal fade" id="addNewCustomerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Add new customer
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="m-2">
                        <label class="form-label fw-bold">Name</label>
                        <input type="text" class="form-control mt-2" placeholder="Enter Name" name="name"
                            id="add_name" />
                        <span class="text-danger" id="name_error"></span>
                    </div>

                    <div class="m-2">
                        <label class="form-label fw-bold">Mobile</label>
                        <input type="text" class="form-control mt-2" placeholder="Enter Mobile" name="mobile"
                            id="add_mobile" />
                        <span class="text-danger" id="mobile_error"></span>
                    </div>

                    <div class="m-2">
                        <label class="form-label fw-bold">Email (Optional)</label>
                        <input type="email" class="form-control mt-2" placeholder="Enter Email" name="email"
                            id="add_email" />
                        <span class="text-danger" id="email_error"></span>
                    </div>

                    <div class="m-2">
                        <label class="form-label fw-bold">City (Optional)</label>
                        <input type="text" class="form-control mt-2" placeholder="Enter City" name="city"
                            id="add_address" />
                        <span class="text-danger" id="address_error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button onclick="addCustomer()" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Customer add modal end -->

    <!-- Customer edit modal start -->
    <div class="modal fade" id="editCustomerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editCustomerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCustomerModalLabel">
                        Edit customer
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="m-2">
                        <label class="form-label fw-bold">Name</label>
                        <input type="text" class="form-control mt-2" placeholder="Enter Name" name="name"
                            id="edit_name" />
                        <span class="text-danger" id="edit_name_error"></span>
                    </div>

                    <div class="m-2">
                        <label class="form-label fw-bold">Mobile</label>
                        <input type="text" class="form-control mt-2" placeholder="Enter Mobile" id="edit_mobile"
                            name="mobile" />
                        <span class="text-danger" id="edit_mobile_error"></span>
                    </div>

                    <div class="m-2">
                        <label class="form-label fw-bold">Email (Optional)</label>
                        <input type="email" class="form-control mt-2" placeholder="Enter Email" name="email"
                            id="edit_email" />
                        <span class="text-danger" id="edit_email_error"></span>
                    </div>

                    <div class="m-2">
                        <label class="form-label fw-bold">City (Optional)</label>
                        <input type="text" class="form-control mt-2" placeholder="Enter Address"
                            id="edit_address" name="address" />
                        <span class="text-danger" id="edit_address_error"></span>
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
    <!-- Customer edit modal end -->

    <!-- Delete modal start -->
    <div class="modal center fade" id="deleteCustomerModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="deleteCustomerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-4 text-center">
                    <h5 class="text-danger">Confirm Delete</h5>
                    <p class="mb-0">
                        Are you sure you want to delete this customer?
                    </p>
                </div>
                <div class="modal-footer flex-nowrap p-0">
                    <button type="button" class="btn text-danger fs-6 col-6 m-0 border-end"
                        onclick="deleteCustomer()">
                        <strong>Delete</strong>
                    </button>
                    <button type="button" class="btn text-secondary fs-6 col-6 m-0" data-bs-dismiss="modal">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete modal end -->

    <script>
        var selected_customer_id = 0;
        var modal;

        function openModal(modalName) {
            modal = new bootstrap.Modal(document.getElementById(modalName));
            modal.show();
        }

        function resetAddInputFields() {
            document.getElementById("add_name").value = "";
            document.getElementById("add_email").value = "";
            document.getElementById("add_mobile").value = "";
            document.getElementById("add_address").value = "";
        }

        function resetEditInputFields() {
            document.getElementById("edit_name").value = "";
            document.getElementById("edit_email").value = "";
            document.getElementById("edit_mobile").value = "";
            document.getElementById("edit_address").value = "";
        }

        function addResetFields() {
            document.getElementById("name_error").textContent = "";
            document.getElementById("email_error").textContent = "";
            document.getElementById("mobile_error").textContent = "";
            document.getElementById("address_error").textContent = "";
        }

        function editResetFields() {
            document.getElementById("edit_name_error").textContent = "";
            document.getElementById("edit_email_error").textContent = "";
            document.getElementById("edit_mobile_error").textContent = "";
            document.getElementById("edit_address_error").textContent = "";
        }

        function viewAddErrors(error) {
            document.getElementById("name_error").textContent = error.response.data.errors.name[0];
            document.getElementById("email_error").textContent = error.response.data.errors.email[0];
            document.getElementById("mobile_error").textContent = error.response.data.errors.mobile[0];
            document.getElementById("address_error").textContent = error.response.data.errors.address[0];
        }

        function viewEditErrors(error) {
            document.getElementById("edit_name_error").textContent = error.response.data.errors.name[0];
            document.getElementById("edit_email_error").textContent = error.response.data.errors.email[0];
            document.getElementById("edit_mobile_error").textContent = error.response.data.errors.mobile[0];
            document.getElementById("edit_address_error").textContent = error.response.data.errors.address[0];
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

        function showCustomerAddModal() {
            addResetFields();
            openModal("addNewCustomerModal");
        }

        async function addCustomer() {
            var name = document.getElementById("add_name").value;
            var email = document.getElementById("add_email").value;
            var mobile = document.getElementById("add_mobile").value;
            var address = document.getElementById("add_address").value;

            add_customer_details = {
                name: name,
                email: email,
                mobile: mobile,
                address: address
            }

            try {
                const response = await axios.post("{{ url('/customers/store') }}/",
                    add_customer_details);
                const customer = response.data;

                resetAddInputFields();
                getCustomers();
                modal.hide();
                showAlert("success-modal", "success-text", "Customer added successfully.");
            } catch (error) {
                viewAddErrors(error);
            }
        }

        async function showCustomerEditModal(id) {
            editResetFields();

            try {
                const response = await axios.get("{{ url('/customers/get') }}/" + id);
                const customer = response.data;

                var name = document.getElementById("edit_name");
                var email = document.getElementById("edit_email");
                var mobile = document.getElementById("edit_mobile");
                var address = document.getElementById("edit_address");
                name.value = customer.name;
                email.value = customer.email;
                mobile.value = customer.mobile;
                address.value = customer.address;
                selected_customer_id = customer.id;

                openModal("editCustomerModal");
            } catch (error) {
                console.error(error);
                showAlert("danger-modal", "danger-text", "Failed to fetch customer data.");
            }
        }

        async function updateCustomer() {
            var name = document.getElementById("edit_name").value;
            var email = document.getElementById("edit_email").value;
            var mobile = document.getElementById("edit_mobile").value;
            var address = document.getElementById("edit_address").value;

            edit_customer_details = {
                name: name,
                email: email,
                mobile: mobile,
                address: address
            }

            try {
                const response = await axios.post("{{ url('/customers/update') }}/" + selected_customer_id,
                    edit_customer_details);
                const customer = response.data;

                resetEditInputFields();
                getCustomers();
                modal.hide();
                showAlert("success-modal", "success-text", "Customer updated successfully.");
            } catch (error) {
                viewEditErrors(error);
            }
        }

        function showDeleteCustomerModal(id) {
            selected_customer_id = id;
            openModal("deleteCustomerModal");
        }

        async function deleteCustomer() {
            try {
                const response = await axios.delete("{{ url('/customers/delete') }}/" + selected_customer_id);
                const customer = response.data;

                getCustomers();
                modal.hide();
                showAlert("success-modal", "success-text", "Customer deleted successfully.");
            } catch (error) {
                showAlert("danger-modal", "danger-text", error);
            }
        }

        function getCustomers(page = 1) {
            //$('#pre_stop').show();
            var search = $('#search').val();
            var count = 25;

            var data = {
                search: search,
                count: count,
            };

            //$('#pre_stop').show();
            $.ajax({
                url: '/customers/ajax/list?page=' + page,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                dataType: '',
                data: data,
                success: function(response) {
                    $('#all_customer_table').html(response);
                    //$('#pre_stop').hide();
                }
            });
        }

        window.addEventListener('load', () => {
            getCustomers();
        });
    </script>

</x-app-layout>
