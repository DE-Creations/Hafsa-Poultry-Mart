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
                        <li class="breadcrumb-item">GRN</li>
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
                                    <a type="button" class="btn btn-primary" href="{{ route('grn.create') }}">Add
                                        new</a>
                                </div>
                            </div>
                            <!-- Search container end -->

                            <div class="table-outer">
                                <div class="table-responsive" id="all_grns_table">

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
    <!-- Customer add modal end -->

    <!-- Delete modal start -->
    <div class="modal center fade" id="deleteGRNModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteGRNModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-4 text-center">
                    <h5 class="text-danger">Confirm Delete</h5>
                    <p class="mb-0">
                        Are you sure you want to delete this GRN?
                    </p>
                </div>
                <div class="modal-footer flex-nowrap p-0 model-custom">
                    <button type="button" class="btn text-danger fs-6 col-6 m-0 border-end" onclick="deleteGRN()">
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
        var selected_grn_id = 0;
        var modal;

        function openModal(modalName) {
            modal = new bootstrap.Modal(document.getElementById(modalName));
            modal.show();
        }

        function goToInvoiceEdit(id) {
            window.location.href = '/invoice/edit/' + id;
        }

        function showDeleteGRNModal(id) {
            selected_grn_id = id;
            openModal("deleteGRNModal");
        }

        async function deleteGRN() {
            try {
                // Always restock when deleting an GRN
                const response = await axios.delete("{{ url(path: '/grn/delete') }}/" + selected_grn_id, {
                    data: {
                        restock: true
                    }
                });
                const grn = response.data;

                getTableDetails();
                modal.hide();
                showAlert("success-modal", "success-text", "GRN deleted successfully.");
            } catch (error) {
                showAlert("danger-modal", "danger-text", error);
            }
        }

        async function printGRN(grn_id) {
            try {
                selected_grn_id = grn_id;
                const response = await axios.post("{{ url(path: '/grn/print') }}/" + selected_grn_id, {}, {
                    responseType: 'blob'
                });

                const blob = new Blob([response.data], {
                    type: 'application/pdf'
                });
                const url = window.URL.createObjectURL(blob);
                window.open(url, '_blank');
            } catch (error) {
                console.error(error);
                showAlert("danger-modal", "danger-text", "Something went wrong while generating the grn.");
            }
        }

        function viewGrn(id) {
            window.location.href = '/grn/view/' + id;
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
                url: '/grn/ajax/list?page=' + page,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                dataType: '',
                data: data,
                success: function(response) {
                    $('#all_grns_table').html(response);
                    //$('#pre_stop').hide();
                }
            });
        }

        window.addEventListener('load', () => {
            getTableDetails();
        });
    </script>
</x-app-layout>
