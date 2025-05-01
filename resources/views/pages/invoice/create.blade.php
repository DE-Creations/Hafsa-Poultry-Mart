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
                        <li class="breadcrumb-item">Invoice</li>
                        <li class="breadcrumb-item">Create New Invoice</li>
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
                            <h5 class="card-title">Invoice</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <!-- Row start -->
                                <div class="row gx-3">
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" placeholder="Enter fullname" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control"
                                                placeholder="Enter email address" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Phone</label>
                                            <input type="number" class="form-control"
                                                placeholder="Enter phone number" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Company</label>
                                            <input type="text" class="form-control"
                                                placeholder="Enter company name" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Business Address</label>
                                            <input type="text" class="form-control"
                                                placeholder="Enter business address" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Province/Territory</label>
                                            <input type="text" class="form-control"
                                                placeholder="Enter province/territory" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Industry Type</label>
                                            <select class="form-select">
                                                <option value="0">Select</option>
                                                <option value="1">One</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Postal Code</label>
                                            <input type="number" class="form-control"
                                                placeholder="Enter postal code" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Message</label>
                                            <textarea class="form-control" placeholder="Enter message" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex gap-2 justify-content-end">
                                            <button type="button" class="btn btn-success col-3">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Row end -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->

        </div>
        <!-- Container ends -->

    </div>
    <!-- App body ends -->
</x-app-layout>
