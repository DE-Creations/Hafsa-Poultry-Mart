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
                        <li class="breadcrumb-item">Suppliers</li>
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
                                        <input type="text" class="form-control" placeholder="Search"
                                            onkeyup="getSupplier()" id="search" />
                                    </div>
                                </div>
                                <div class="col-2 text-end">
                                    <button type="button" class="btn btn-primary" onclick="showSupplierAddModal()">Add
                                        new</button>
                                </div>
                            </div>
                            <!-- Search container end -->

                            <div class="table-outer">
                                <div class="table-responsive" id="all_supplier_table">

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
    <div class="modal fade" id="addNewSupplierModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Add new supplier
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @csrf
                <div class="modal-body">
                    <div class="m-2">
                        <label class="form-label fw-bold">Name</label>
                        <input type="text" class="form-control mt-2" placeholder="Enter Name" name="name"
                            id="add_name" />
                        <span class="text-danger" id="name_error"></span>
                    </div>

                    <div class="m-2">
                        <label class="form-label fw-bold">NIC</label>
                        <input type="text" class="form-control mt-2" placeholder="Enter NIC" name="nic"
                            id="add_nic" />
                        <span class="text-danger" id="nic_error"></span>
                    </div>

                    <div class="m-2">
                        <label class="form-label fw-bold">Mobile</label>
                        <input type="text" class="form-control mt-2" placeholder="Enter Mobile" name="mobile"
                            id="add_mobile" />
                        <span class="text-danger" id="mobile_error"></span>
                    </div>

                    <div class="m-2">
                        <label class="form-label fw-bold">City</label>
                        <input type="text" class="form-control mt-2" placeholder="Enter City" name="city"
                            id="add_city" />
                        <span class="text-danger" id="city_error"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button class="btn btn-primary" onclick="addSupplier()">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Customer add modal end -->

    <!-- Customer edit modal start -->
    <div class="modal fade" id="editSupplierModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editSupplierModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSupplierModalLabel">
                        Edit Supplier
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
                        <label class="form-label fw-bold">NIC</label>
                        <input type="text" class="form-control mt-2" placeholder="Enter NIC" id="edit_nic"
                            name="nic" />
                        <span class="text-danger" id="edit_nic_error"></span>
                    </div>

                    <div class="m-2">
                        <label class="form-label fw-bold">Mobile</label>
                        <input type="text" class="form-control mt-2" placeholder="Enter Mobile" name="mobile"
                            id="edit_mobile" />
                        <span class="text-danger" id="edit_mobile_error"></span>
                    </div>

                    <div class="m-2">
                        <label class="form-label fw-bold">City</label>
                        <input type="text" class="form-control mt-2" placeholder="Enter City" name="city"
                            id="edit_city" />
                        <span class="text-danger" id="edit_city_error"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button onclick="updateSupplier()" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Customer edit modal end -->

    <!-- Delete modal start -->
    <div class="modal center fade" id="deleteSupplierModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="deleteSupplierModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-4 text-center">
                    <h5 class="text-danger">Confirm Delete</h5>
                    <p class="mb-0">
                        Are you sure you want to delete this supplier?
                    </p>
                </div>
                <div class="modal-footer flex-nowrap p-0 model-custom">
                    <button type="button" class="btn text-danger fs-6 col-6 m-0 border-end"
                        onclick="deleteSupplier()">
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
        var selected_supplier_id = 0;
        var modal;

        function openModal(modalName) {
            modal = new bootstrap.Modal(document.getElementById(modalName));
            modal.show();
        }

        function resetAddInputFields() {
            document.getElementById("add_name").value = "";
            document.getElementById("add_nic").value = "";
            document.getElementById("add_mobile").value = "";
            document.getElementById("add_city").value = "";
        }

        function resetEditInputFields() {
            document.getElementById("edit_name").value = "";
            document.getElementById("edit_nic").value = "";
            document.getElementById("edit_mobile").value = "";
            document.getElementById("edit_city").value = "";
        }

        function addResetFields() {
            document.getElementById("name_error").textContent = "";
            document.getElementById("nic_error").textContent = "";
            document.getElementById("mobile_error").textContent = "";
            document.getElementById("city_error").textContent = "";
        }

        function editResetFields() {
            document.getElementById("edit_name_error").textContent = "";
            document.getElementById("edit_nic_error").textContent = "";
            document.getElementById("edit_mobile_error").textContent = "";
            document.getElementById("edit_city_error").textContent = "";
        }

        function viewAddErrors(error) {
            if (error.response.data.errors.name) {
                document.getElementById("name_error").textContent = error.response.data.errors.name[0];
            } else {
                document.getElementById("name_error").textContent = "";
            }
            if (error.response.data.errors.nic) {
                document.getElementById("nic_error").textContent = error.response.data.errors.nic[0];
            } else {
                document.getElementById("nic_error").textContent = "";
            }
            if (error.response.data.errors.mobile) {
                document.getElementById("mobile_error").textContent = error.response.data.errors.mobile[0];
            } else {
                document.getElementById("mobile_error").textContent = "";
            }
            if (error.response.data.errors.city) {
                document.getElementById("city_error").textContent = error.response.data.errors.city[0];
            } else {
                document.getElementById("city_error").textContent = "";
            }
        }

        function viewEditErrors(error) {
            if (error.response.data.errors.name) {
                document.getElementById("edit_name_error").textContent = error.response.data.errors.name[0];
            } else {
                document.getElementById("edit_name_error").textContent = "";
            }
            if (error.response.data.errors.nic) {
                document.getElementById("edit_nic_error").textContent = error.response.data.errors.nic[0];
            } else {
                document.getElementById("edit_nic_error").textContent = "";
            }
            if (error.response.data.errors.mobile) {
                document.getElementById("edit_mobile_error").textContent = error.response.data.errors.mobile[0];
            } else {
                document.getElementById("edit_mobile_error").textContent = "";
            }
            if (error.response.data.errors.city) {
                document.getElementById("edit_city_error").textContent = error.response.data.errors.city[0];
            } else {
                document.getElementById("edit_city_error").textContent = "";
            }
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

        function showSupplierAddModal() {
            addResetFields();
            openModal("addNewSupplierModal");
        }

        async function addSupplier() {
            var name = document.getElementById("add_name").value;
            var nic = document.getElementById("add_nic").value;
            var mobile = document.getElementById("add_mobile").value;
            var city = document.getElementById("add_city").value;

            add_supplier_details = {
                name: name,
                nic: nic,
                mobile: mobile,
                city: city
            }

            try {
                const response = await axios.post("{{ url('/suppliers/store') }}/",
                    add_supplier_details);

                resetAddInputFields();
                getSupplier();
                modal.hide();
                showAlert("success-modal", "success-text", "Supplier added successfully.");
            } catch (error) {
                viewAddErrors(error);
            }
        }

        async function showSupplierEditModal(id) {
            editResetFields();

            try {
                const response = await axios.get("{{ url('/suppliers/get') }}/" + id);
                const supplier = response.data;

                var name = document.getElementById("edit_name");
                var nic = document.getElementById("edit_nic");
                var mobile = document.getElementById("edit_mobile");
                var city = document.getElementById("edit_city");

                name.value = supplier.name;
                nic.value = supplier.nic;
                mobile.value = supplier.mobile;
                city.value = supplier.city;
                selected_supplier_id = supplier.id;

                openModal("editSupplierModal");

            } catch (error) {
                console.error(error);
                showAlert("danger-modal", "danger-text", "Failed to fetch supplier data.");
            }
        }

        async function updateSupplier() {
            var name = document.getElementById("edit_name").value;
            var nic = document.getElementById("edit_nic").value;
            var mobile = document.getElementById("edit_mobile").value;
            var city = document.getElementById("edit_city").value;

            edit_supplier_details = {
                name: name,
                nic: nic,
                mobile: mobile,
                city: city
            }

            try {
                const response = await axios.post("{{ url('/suppliers/update') }}/" + selected_supplier_id,
                    edit_supplier_details);
                const supplier = response.data;

                resetEditInputFields();
                getSupplier();
                modal.hide();
                showAlert("success-modal", "success-text", "Supplier updated successfully.");
            } catch (error) {
                viewEditErrors(error);
            }
        }

        function showDeleteSupplierModal(id) {
            selected_customer_id = id;
            openModal("deleteSupplierModal");
        }

        async function deleteSupplier() {
            try {
                const response = await axios.delete("{{ url('/suppliers/delete') }}/" + selected_customer_id);
                const customer = response.data;

                getSupplier();
                modal.hide();
                showAlert("success-modal", "success-text", "Supplier deleted successfully.");
            } catch (error) {
                showAlert("danger-modal", "danger-text", error);
            }
        }

        function getSupplier(page = 1) {
            //$('#pre_stop').show();
            var search = $('#search').val();
            var count = 25;

            var data = {
                search: search,
                count: count,
            };

            //$('#pre_stop').show();
            $.ajax({
                url: '/suppliers/ajax/list?page=' + page,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                dataType: '',
                data: data,
                success: function(response) {
                    $('#all_supplier_table').html(response);
                    //$('#pre_stop').hide();
                }
            });
        }

        window.addEventListener('load', () => {
            getSupplier();
        });
    </script>
</x-app-layout>
