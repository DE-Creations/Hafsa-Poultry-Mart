<x-app-layout>
    <!-- App body starts -->
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
                        <div class="card-header d-flex justify-content-between">
                            <h3 class="card-title">Customers List</h3>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addNewCustomerModal">Add new</button>
                        </div>
                        <div class="card-body">
                            <!-- Search container start -->
                            <div class="row">
                                <div class="col-sm-4 col-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search" />
                                    </div>
                                </div>
                            </div>
                            <!-- Search container end -->

                            <!-- Contacts Container Start -->
                            <div class="contacts-container mt-3">
                                <div class="contact-list">
                                    <a href="javascript:void(0)" class="px-3 py-2 d-flex align-items-center gap-3">
                                        <img src="assets/images/user.png" alt="Bootstrap Gallery"
                                            class="img-3x rounded-circle" />
                                        <div class="flex-1 flex flex-col">
                                            <h6 class="fw-bold m-0">Angelica Ramos</h6>
                                            <small class="opacity-50">Software Engineer</small>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)" class="px-3 py-2 d-flex align-items-center gap-3">
                                        <img src="assets/images/user2.png" alt="Bootstrap Gallery"
                                            class="img-3x rounded-circle" />
                                        <div class="flex-1 flex flex-col">
                                            <h6 class="fw-bold m-0">Brenden Wagner</h6>
                                            <small class="opacity-50">Chief Operating Officer</small>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)" class="px-3 py-2 d-flex align-items-center gap-3">
                                        <img src="assets/images/user3.png" alt="Bootstrap Themes"
                                            class="img-3x rounded-circle" />
                                        <div class="flex-1 flex flex-col">
                                            <h6 class="fw-bold m-0">Cedric Kelly</h6>
                                            <small class="opacity-50">Senior Javascript Developer</small>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)" class="px-3 py-2 d-flex align-items-center gap-3">
                                        <img src="assets/images/user4.png" alt="Bootstrap Dashboards"
                                            class="img-3x rounded-circle" />
                                        <div class="flex-1 flex flex-col">
                                            <h6 class="fw-bold m-0">Howard Hatfield</h6>
                                            <small class="opacity-50">Senior Marketing Designer</small>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)" class="px-3 py-2 d-flex align-items-center gap-3">
                                        <img src="assets/images/user4.png" alt="Bootstrap Themes"
                                            class="img-3x rounded-circle" />
                                        <div class="flex-1 flex flex-col">
                                            <h6 class="fw-bold m-0">Jenette Caldwell</h6>
                                            <small class="opacity-50">Senior Marketing Designer</small>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)" class="px-3 py-2 d-flex align-items-center gap-3">
                                        <img src="assets/images/user5.png" alt="Bootstrap Dashboards"
                                            class="img-3x rounded-circle" />
                                        <div class="flex-1 flex flex-col">
                                            <h6 class="fw-bold m-0">Olivia Liang</h6>
                                            <small class="opacity-50">Systems Administrator</small>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!-- Contacts Container End -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->

        </div>
        <!-- Container ends -->

    </div>
    <!-- App body ends -->


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
</x-app-layout>
