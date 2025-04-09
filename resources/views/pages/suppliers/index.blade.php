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
                                        <input type="text" class="form-control" placeholder="Search" />
                                    </div>
                                </div>
                                <div class="col-2 text-end">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addNewSupplierModal">Add new</button>
                                </div>
                            </div>
                            <!-- Search container end -->

                            <div class="table-outer">
                                <div class="table-responsive">
                                    <table class="table table-striped align-middle m-0">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                {{--  <th></th>  --}}
                                                <th>Name</th>
                                                <th>NIC</th>
                                                {{--  <th>Status</th>  --}}
                                                {{-- <th>Mobile</th> --}}
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($suppliers->count() > 0)
                                                @foreach ($suppliers as $supplier)
                                                    <tr>
                                                        <td>{{ $supplier->id }}</td>
                                                        {{--  <th>
                                                            <input class="form-check-input" type="checkbox"
                                                                value="option1" />
                                                        </th>  --}}
                                                        <td>
                                                            {{--  <img src="assets/images/user2.png" class="me-2 img-3x rounded-3"
                                                        alt="Bootstrap Gallery" />  --}}
                                                            {{ $supplier->name }}
                                                        </td>
                                                        <td>{{ $supplier->nic }}</td>
                                                        {{--  <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="icon-circle1 me-2 text-success fs-5"></i>
                                                        Online
                                                    </div>
                                                </td>  --}}
                                                        <td>
                                                            <button
                                                                class="btn btn-outline-primary btn-sm edit-customer-btn"
                                                                onclick="showSupplierEditModal({{ $supplier->id }})"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-custom-class="custom-tooltip-primary"
                                                                data-bs-title="Edit">
                                                                <i class="icon-edit"></i>
                                                            </button>
                                                            <button class="btn btn-outline-danger btn-sm"
                                                                onclick="showDeleteSupplierModal({{ $supplier->id }})"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-custom-class="custom-tooltip-danger"
                                                                data-bs-title="Delete">
                                                                <i class="icon-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                            {{--  <tr>
                                                <td>3</td>
                                                <th>
                                                    <input class="form-check-input" type="checkbox" value="option3" />
                                                </th>
                                                <td>
                                                    <img src="assets/images/user.png" class="me-2 img-3x rounded-3"
                                                        alt="Bootstrap Gallery" />
                                                    Gino Watson
                                                </td>
                                                <td>info@example.com</td>
                                                <td>200</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="icon-circle1 me-2 text-dark fs-5"></i>
                                                        Offline
                                                    </div>
                                                </td>
                                                <td>Turkey</td>
                                                <td>76</td>
                                                <td>44</td>
                                                <td>
                                                    <div class="starReadOnly1 rating-stars"></div>
                                                </td>
                                                <td>
                                                    <button class="btn btn-outline-primary btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-custom-class="custom-tooltip-primary"
                                                        data-bs-title="Edit">
                                                        <i class="icon-edit"></i>
                                                    </button>
                                                    <button class="btn btn-outline-danger btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-custom-class="custom-tooltip-danger"
                                                        data-bs-title="Delete">
                                                        <i class="icon-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>  --}}

                                        </tbody>
                                    </table>
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
                <form method="post" action="{{ route('suppliers.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="m-2">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" class="form-control mt-2" placeholder="Enter Name" name="name" />
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-danger" />
                        </div>

                        <div class="m-2">
                            <label class="form-label fw-bold">NIC</label>
                            <input type="text" class="form-control mt-2" placeholder="Enter NIC" name="nic" />
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-danger" />
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </form>
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
                        <span class="text-danger" id="name_error"></span>
                    </div>

                    <div class="m-2">
                        <label class="form-label fw-bold">NIC</label>
                        <input type="text" class="form-control mt-2" placeholder="Enter NIC" id="edit_nic"
                            name="nic" />
                        <span class="text-danger" id="nic_error"></span>
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

    <!--Alerts start-->
    <div class="alert alert-danger alert-dismissible fade w-50 m-3 fixed-bottom" role="alert" id="danger-modal"
        style="z-index: 10000;">
        <span id="danger-text" class="fs-6"></span>
    </div>

    <div class="alert alert-success alert-dismissible fade w-full m-3 fixed-bottom" role="alert" id="success-modal"
        style="z-index: 10000;">
        <span id="success-text" class="fs-6"></span>
    </div>
    <!--Alerts end-->

    <script>
        var edit_supplier_id = 0;
        var modal;

        async function showSupplierEditModal(id) {
            resetFilds();
            try {

                const response = await axios.get("{{ url('/suppliers/get') }}/" + id);
                const supplier = response.data;

                var name = document.getElementById("edit_name");
                var nic = document.getElementById("edit_nic");

                name.value = supplier.name;
                nic.value = supplier.nic;
                edit_supplier_id = supplier.id;

                openModal("editSupplierModal");

            } catch (error) {
                console.error(error);
                alert("Failed to fetch payment data.");
            }
        }

        async function updateSupplier() {
            var name = document.getElementById("edit_name").value;
            var nic = document.getElementById("edit_nic").value;

            edit_supplier_details = {
                name: name,
                nic: nic,
            }

            try {
                const response = await axios.post("{{ url('/suppliers/update') }}/" + edit_supplier_id,
                    edit_supplier_details);
                const supplier = response.data;

                await axios.get("{{ url('/suppliers/list') }}/");
                modal.hide();
                showAlert("success-modal", "success-text", "Supplier updated successfully.");
            } catch (error) {
                viewErrors(error);
            }
        }

        function openModal(modalName) {
            modal = new bootstrap.Modal(document.getElementById(modalName));
            modal.show();
        }

        function resetFields() {
            document.getElementById("name_error").textContent = "";
            document.getElementById("nic_error").textContent = "";
        }

        function viewErrors(error) {
            document.getElementById("name_error").textContent = error.response.data.errors.name[0];
            document.getElementById("nic_error").textContent = error.response.data.errors.nic[0];
        }

        function showAlert(alertType, alertSpan, alertText) {
            document.getElementById(alertSpan).textContent = alertText;
            const alert = document.getElementById(alertType);
            alert.classList.add("show");
            setTimeout(() => {
                alert.classList.remove("show");
            }, 5000);
        }

        function showDeleteSupplierModal(id) {
            selected_customer_id = id;
            openModal("deleteSupplierModal");
        }

        async function deleteCustomer() {
            try {
                const response = await axios.delete("{{ url('/suppliers/delete') }}/" + selected_customer_id);
                const customer = response.data;
                console.log(customer);

                await axios.get("{{ url('/suppliers/list') }}/");
                modal.hide();
                showAlert("success-modal", "success-text", "Supplier deleted successfully.");
            } catch (error) {
                showAlert("danger-modal", "danger-text", error);
            } 
        }

    </script>
</x-app-layout>
