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
                                        <input type="text" class="form-control" placeholder="Search" />
                                    </div>
                                </div>
                                <div class="col-2 text-end">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addNewCustomerModal">Add new</button>
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
                                                <th>Email</th>
                                                {{--  <th>Status</th>  --}}
                                                <th>Mobile</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($customers->count() > 0)
                                                @foreach ($customers as $customer)
                                                    <tr>
                                                        <td>{{ $customer->id }}</td>
                                                        {{--  <th>
                                                            <input class="form-check-input" type="checkbox"
                                                                value="option1" />
                                                        </th>  --}}
                                                        <td>
                                                            {{--  <img src="assets/images/user2.png" class="me-2 img-3x rounded-3"
                                                        alt="Bootstrap Gallery" />  --}}
                                                            {{ $customer->name }}
                                                        </td>
                                                        <td>{{ $customer->email }}</td>
                                                        {{--  <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="icon-circle1 me-2 text-success fs-5"></i>
                                                        Online
                                                    </div>
                                                </td>  --}}
                                                        <td>{{ $customer->mobile }}</td>
                                                        <td>
                                                            <button class="btn btn-outline-primary btn-sm"
                                                                onclick="showCustomerEditModal({{ $customer->id }})"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-custom-class="custom-tooltip-primary"
                                                                data-bs-title="Edit">
                                                                <i class="icon-edit"></i>
                                                            </button>
                                                            <button class="btn btn-outline-danger btn-sm"
                                                                onclick="showDeleteCustomerModal({{ $customer->id }})"
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
                <form method="post" action="{{ route('customers.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="m-2">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" class="form-control mt-2" placeholder="Enter Name" name="name" />
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-danger" />
                        </div>

                        <div class="m-2">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control mt-2" placeholder="Enter Email" name="email" />
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-danger" />
                        </div>

                        <div class="m-2">
                            <label class="form-label fw-bold">Mobile</label>
                            <input type="text" class="form-control mt-2" placeholder="Enter Mobile" name="mobile" />
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-danger" />
                        </div>

                        <div class="m-2">
                            <label class="form-label fw-bold">Address</label>
                            <input type="text" class="form-control mt-2" placeholder="Enter Address"
                                name="address" />
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
                        <span class="text-danger" id="name_error"></span>
                    </div>

                    <div class="m-2">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control mt-2" placeholder="Enter Email" name="email"
                            id="edit_email" />
                        <span class="text-danger" id="email_error"></span>
                    </div>

                    <div class="m-2">
                        <label class="form-label fw-bold">Mobile</label>
                        <input type="text" class="form-control mt-2" placeholder="Enter Mobile" id="edit_mobile"
                            name="mobile" />
                        <span class="text-danger" id="mobile_error"></span>
                    </div>

                    <div class="m-2">
                        <label class="form-label fw-bold">Address</label>
                        <input type="text" class="form-control mt-2" placeholder="Enter Address"
                            id="edit_address" name="address" />
                        <span class="text-danger" id="address_error"></span>
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
        var selected_customer_id = 0;
        var modal;

        function openModal(modalName) {
            modal = new bootstrap.Modal(document.getElementById(modalName));
            modal.show();
        }

        function resetFields() {
            document.getElementById("name_error").textContent = "";
            document.getElementById("email_error").textContent = "";
            document.getElementById("mobile_error").textContent = "";
            document.getElementById("address_error").textContent = "";
        }

        function viewErrors(error) {
            document.getElementById("name_error").textContent = error.response.data.errors.name[0];
            document.getElementById("email_error").textContent = error.response.data.errors.email[0];
            document.getElementById("mobile_error").textContent = error.response.data.errors.mobile[0];
            document.getElementById("address_error").textContent = error.response.data.errors.address[0];
        }

        function showAlert(alertType, alertSpan, alertText) {
            document.getElementById(alertSpan).textContent = alertText;
            const alert = document.getElementById(alertType);
            alert.classList.add("show");
            setTimeout(() => {
                alert.classList.remove("show");
            }, 5000);
        }

        async function showCustomerEditModal(id) {
            resetFields();

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
                {{--  modal = new bootstrap.Modal(document.getElementById("editCustomerModal"));
                modal.show();  --}}
            } catch (error) {
                console.error(error);
                alert("Failed to fetch payment data.");
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

                await axios.get("{{ url('/customers/list') }}/");
                modal.hide();
                showAlert("success-modal", "success-text", "Customer updated successfully.");
            } catch (error) {
                viewErrors(error);
            }
        }

        function showDeleteCustomerModal(id) {
            openModal("deleteCustomerModal");
            {{--  modal = new bootstrap.Modal(document.getElementById("deleteCustomerModal"));
            modal.show();  --}}
        }

        function deleteCustomer() {
            alert("delete");
            {{--  try {
                const response = await axios.delete("{{ url('/customers/delete') }}/" + selected_customer_id);
                const customer = response.data;
                console.log(customer);

                await axios.get("{{ url('/customers/list') }}/");
                modal.hide();
                showAlert("success-modal", "success-text", "Customer deleted successfully.");
            } catch (error) {
                showAlert("danger-modal", "danger-text", error);
            }  --}}
        }
    </script>
</x-app-layout>
