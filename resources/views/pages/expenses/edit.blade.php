<x-app-layout>
    <!-- App body starts -->
    <div class="app-body">

        <!-- Container starts -->
        <div class="container">

            <!-- Row start -->
            <div class="row gx-3">
                <div class="col-12">
                    <!-- Breadcrumb start -->
                    <ol class="breadcrumb mb-3">
                        <li class="breadcrumb-item">
                            <i class="icon-house_siding lh-1"></i>
                            <a href="index.html" class="text-decoration-none">Home</a>
                        </li>
                        <li class="breadcrumb-item">Expenses</li>
                        <li class="breadcrumb-item">Update Expense - {{ $expense->code }}</li>
                    </ol>
                    <!-- Breadcrumb end -->
                </div>
            </div>
            <!-- Row end -->

            <!-- Row start -->
            <div class="row gx-3">
                <div class="col-xxl-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title">Update Expense - {{ $expense->code }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label">Category</label>
                                            <select class="form-select" id="expense_category">
                                                <option selected>Select category</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                            <span class="text-danger" id="expense_category_error"></span>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Date</label>
                                            <input type="date" class="form-control" id="expense_date"
                                                value="{{ $expense->date }}" />
                                            <span class="text-danger" id="expense_date_error"></span>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Description</label>
                                            <input type="text" class="form-control" id="expense_description"
                                                placeholder="Enter expense description"
                                                value="{{ $expense->description }}" />
                                            <span class="text-danger" id="expense_description_error"></span>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Amount</label>
                                            <input type="text" class="form-control" id="expense_amount"
                                                placeholder="Amount" value="{{ $expense->amount }}" />
                                            <span class="text-danger" id="expense_amount_error"></span>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Note</label>
                                            <textarea class="form-control" placeholder="Expense note" rows="3" id="expense_note" value="{{ $expense->note }}"></textarea>
                                            <span class="text-danger" id="expense_note_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row g-3">
                                        <div class="col-12 py-0">

                                            <div class="card shadow h-100">
                                                <div class="text-sm card-body p-4 p-md-7 py-0 py-md-3">

                                                    {{--  <form @submit.prevent="saveExpense" enctype="multipart/form-data">  --}}
                                                    <div class="row mt-2">
                                                        <div class="col-md-12">
                                                            <div class="form-label text-gray-600">Receipt Image
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 pt-2 d-flex justify-content-center">

                                                            <!-- Desktop View -->
                                                            <div
                                                                class="image-input image-chooser-border p-2 d-none d-md-flex">
                                                                <div class="image-input-wrapper w-400px h-400px">
                                                                    <div id="filePreviewArea">
                                                                        <img id="imagePreview" onclick="openImageFile()"
                                                                            src="{{ asset('assets/images/receipt/expense-receipt-placeholder.png') }}"
                                                                            class="img-fluid mb-2 image-pdf-fix-resolution"
                                                                            style="display: block;">
                                                                        <iframe id="pdfPreview" width="100%"
                                                                            height="500px"
                                                                            style="display: none;"></iframe>
                                                                    </div>
                                                                    {{--  <img src="{{ asset('assets/images/receipt/expense-receipt-placeholder.png') }}"
                                                                            onclick="openImageFile()"
                                                                            class="img-fluid mb-2 image-pdf-fix-resolution" />  --}}
                                                                </div>

                                                                <label onclick="openImageFile()"
                                                                    class="btn btn-icon btn-circle btn-active-color-primary w-40px h-40px bg-body shadow d-none"
                                                                    data-kt-image-input-action="remove"
                                                                    data-bs-toggle="tooltip" aria-label="Change avatar"
                                                                    data-bs-original-title="Change avatar"
                                                                    data-kt-initialized="1">
                                                                    <i class="bi bi-pencil-fill fs-3 edit-btn"></i>

                                                                </label>
                                                                <input type="file" hidden ref="fileInput"
                                                                    accept="image/jpg, image/png, application/pdf"
                                                                    id="expense_image" name="avatar"
                                                                    onchange="onFileChange()">
                                                                <input type="hidden" name="avatar_remove">
                                                                {{--  <span v-if="expense.image_url"
                                                                        @click.prevent="selectImageRemove"
                                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow d-none"
                                                                        data-kt-image-input-action="change"
                                                                        data-bs-toggle="tooltip"
                                                                        aria-label="Change avatar"
                                                                        data-bs-original-title="Change avatar"
                                                                        data-kt-initialized="1">
                                                                        <i class="bi bi-x-lg delete-btn"></i> </span>  --}}
                                                            </div>

                                                            <!-- Mobile view -->
                                                            {{--  <div class="image-input image-chooser-border-mobile p-2 d-block d-md-none"
                                                                    :class="{ 'drag-over': isDragOver }"
                                                                    @dragover.prevent="handleDragOver"
                                                                    @drop.prevent="handleFileDrop"
                                                                    @dragleave.prevent="handleDragLeave">
                                                                    <div class="image-input-wrapper-mobile">
                                                                        <template v-if="expense.isPdf == 1">
                                                                            <iframe :src="expense.image_url"
                                                                                width="100%"
                                                                                height="500px"></iframe>
                                                                        </template>
                                                                        <template v-else>
                                                                            <img v-if="expense.image_url && edit_expense.isPdf == 0"
                                                                                :src="expense.image_url"
                                                                                class="img-fluid mb-2 image-pdf-fix-resolution-mobile" />
                                                                            <img v-else
                                                                                src="@/../src/assets/media/receipt/expense-receipt-placeholder.png"
                                                                                @click="openImageFile"
                                                                                class="img-fluid mb-2" />
                                                                        </template>
                                                                    </div>

                                                                    <label @click="openImageFile"
                                                                        class="btn btn-icon btn-circle btn-active-color-primary w-40px h-40px bg-body shadow d-none"
                                                                        data-kt-image-input-action="remove"
                                                                        data-bs-toggle="tooltip"
                                                                        aria-label="Change avatar"
                                                                        data-bs-original-title="Change avatar"
                                                                        data-kt-initialized="1">
                                                                        <i class="bi bi-pencil-fill fs-3 edit-btn"></i>

                                                                    </label>
                                                                    <input type="file" hidden ref="fileInput"
                                                                        accept="image/jpg, image/png, application/pdf"
                                                                        id="expense_image" name="avatar"
                                                                        @change="onFileChange">
                                                                    <input type="hidden" name="avatar_remove">
                                                                    <span v-if="expense.image_url"
                                                                        @click.prevent="selectImageRemove"
                                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow d-none"
                                                                        data-kt-image-input-action="change"
                                                                        data-bs-toggle="tooltip"
                                                                        aria-label="Change avatar"
                                                                        data-bs-original-title="Change avatar"
                                                                        data-kt-initialized="1">
                                                                        <i class="bi bi-x-lg delete-btn"></i> </span>
                                                                </div>  --}}
                                                        </div>
                                                        <div class="col-12 text-center pt-4 text-gray-400">
                                                            File should be less than 5MB
                                                        </div>
                                                    </div>

                                                    <div class="row mt-10">
                                                        <div class="col mt-4 text-end">
                                                        </div>
                                                    </div>
                                                    {{--  </form>  --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary" onclick="addExpense()">
                                        Create Expense
                                    </button>
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
    <!-- App body ends -->

    <script>
        var selected_customer_id = 0;
        var modal;

        function openModal(modalName) {
            modal = new bootstrap.Modal(document.getElementById(modalName));
            modal.show();
        }

        {{--  function resetAddInputFields() {
            document.getElementById("add_name").value = "";
            document.getElementById("add_email").value = "";
            document.getElementById("add_mobile").value = "";
            document.getElementById("add_address").value = "";
        }  --}}

        {{--  function resetEditInputFields() {
            document.getElementById("edit_name").value = "";
            document.getElementById("edit_email").value = "";
            document.getElementById("edit_mobile").value = "";
            document.getElementById("edit_address").value = "";
        }  --}}

        function addResetFields() {
            document.getElementById("expense_category_error").textContent = "";
            document.getElementById("expense_date_error").textContent = "";
            document.getElementById("expense_description_error").textContent = "";
            document.getElementById("expense_amount_error").textContent = "";
            document.getElementById("expense_note_error").textContent = "";
        }

        {{--  function editResetFields() {
            document.getElementById("edit_name_error").textContent = "";
            document.getElementById("edit_email_error").textContent = "";
            document.getElementById("edit_mobile_error").textContent = "";
            document.getElementById("edit_address_error").textContent = "";
        }  --}}

        function viewAddErrors(error) {
            if (error.response.data.errors.expense_category_id) {
                document.getElementById("expense_category_error").textContent = error.response.data.errors
                    .expense_category_id[0];
            }
            if (error.response.data.errors.date) {
                document.getElementById("expense_date_error").textContent = error.response.data.errors.date[0];
            }
            if (error.response.data.errors.description) {
                document.getElementById("expense_description_error").textContent = error.response.data.errors.
                description[0];
            }
            if (error.response.data.errors.amount) {
                document.getElementById("expense_amount_error").textContent = error.response.data.errors.amount[0];
            }
            if (error.response.data.errors.note) {
                document.getElementById("expense_note_error").textContent = error.response.data.errors.note[0];
            }
        }

        {{--  function viewEditErrors(error) {
            document.getElementById("edit_name_error").textContent = error.response.data.errors.name[0];
            document.getElementById("edit_email_error").textContent = error.response.data.errors.email[0];
            document.getElementById("edit_mobile_error").textContent = error.response.data.errors.mobile[0];
            document.getElementById("edit_address_error").textContent = error.response.data.errors.address[0];
        }  --}}

        function showAlert(alertType, alertSpan, alertText) {
            document.getElementById(alertSpan).textContent = alertText;
            const alert = document.getElementById(alertType);
            alert.classList.add("show");
            setTimeout(() => {
                alert.classList.remove("show");
            }, 5000);
        }

        {{--  function showCustomerAddModal() {
            addResetFields();
            openModal("addNewCustomerModal");
        }  --}}

        {{--  async function showCustomerEditModal(id) {
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
        }  --}}

        {{--  async function updateCustomer() {
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
        }  --}}

        {{--  function showDeleteCustomerModal(id) {
            selected_customer_id = id;
            openModal("deleteCustomerModal");
        }  --}}

        {{--  async function deleteCustomer() {
            try {
                const response = await axios.delete("{{ url('/customers/delete') }}/" + selected_customer_id);
                const customer = response.data;

                getCustomers();
                modal.hide();
                showAlert("success-modal", "success-text", "Customer deleted successfully.");
            } catch (error) {
                showAlert("danger-modal", "danger-text", error);
            }
        }  --}}




















        function openImageFile() {
            var expense_category = document.getElementById('expense_category').value;
            var expense_amount = document.getElementById('expense_amount').value;

            {{--  if (expense_category == "Select category") {
                showAlert("danger-modal", "danger-text", "Please select an expense category");
            } else if (expense_amount == "") {
                showAlert("danger-modal", "danger-text", "Please enter expense amount");
            } else {  --}}
            const fileInput = document.getElementById('expense_image');
            fileInput.click();
            {{--  }  --}}
        }

        const placeholderImage =
            '{{ asset('assets/images/receipt/expense-receipt-placeholder.png') }}'; // Change to your real placeholder path

        function onFileChange(event) {
            const fileInput = document.getElementById('expense_image');
            const file = fileInput.files[0];

            if (!file) {
                console.error('No file selected.');
                return;
            }

            if (file.size > 5 * 1024 * 1024) { // 5MB limit
                console.error('File is too large.');
                return;
            }

            const fileType = file.type;
            const reader = new FileReader();

            reader.onload = function(e) {
                const fileURL = e.target.result;
                const imagePreview = document.getElementById('imagePreview');
                const pdfPreview = document.getElementById('pdfPreview');

                if (fileType === 'application/pdf') {
                    // Show PDF
                    pdfPreview.src = fileURL;
                    console.log(pdfPreview.src);
                    pdfPreview.style.display = 'block';
                    imagePreview.style.display = 'none';
                } else if (fileType.startsWith('image/')) {
                    // Show Image
                    imagePreview.src = fileURL;
                    console.log(imagePreview.src);
                    imagePreview.style.display = 'block';
                    pdfPreview.style.display = 'none';
                } else {
                    // Unsupported type: fallback to placeholder
                    imagePreview.src = placeholderImage;
                    imagePreview.style.display = 'block';
                    pdfPreview.style.display = 'none';
                }
            };

            reader.readAsDataURL(file);
        }

        async function addExpense() {
            addResetFields();

            var expense_category = document.getElementById("expense_category").value;
            var expense_date = document.getElementById("expense_date").value;
            var expense_description = document.getElementById("expense_description").value;
            var expense_amount = document.getElementById("expense_amount").value;
            var expense_note = document.getElementById("expense_note").value;

            const imagePreview = document.getElementById('imagePreview');
            const pdfPreview = document.getElementById('pdfPreview');

            var imageUrl = "";

            if (imagePreview.src === placeholderImage) {
                console.log("image added");
                imageUrl = imagePreview.files[0];
            } else if (pdfPreview.src === placeholderImage) {
                console.log("pdf added");
                imageUrl = pdfPreview.files[0];
            } else {
                console.log("no image or pdf added");
            }

            add_expense_details = {
                expense_category_id: expense_category,
                date: expense_date,
                description: expense_description,
                amount: expense_amount,
                note: expense_note,
                image: imageUrl,
            }

            try {
                const response = await axios.post("{{ url('/expenses/store') }}",
                    add_expense_details, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    });
                {{--  window.location.href = "/expenses";  --}}
            } catch (error) {
                viewAddErrors(error);
            }
        }
    </script>
</x-app-layout>
