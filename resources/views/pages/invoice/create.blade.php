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
                                            <label class="form-label">Invoice No:</label>
                                            <input type="text" class="form-control" disabled />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" placeholder="Enter name" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Date</label>
                                            <input type="date" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Weight</label>
                                            <input type="number" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Price per 1kg</label>
                                            <input type="text" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Total</label>
                                            <input type="text" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Payment Method</label>
                                            <select class="form-select">
                                                <option value="0">Cash</option>
                                                <option value="1">Card</option>
                                                <option value="2">Bank Transfer</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Message</label>
                                            <textarea class="form-control" placeholder="Enter Note" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
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
