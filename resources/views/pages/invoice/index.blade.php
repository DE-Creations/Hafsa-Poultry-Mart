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
                        <li class="breadcrumb-item">Invoice</li>
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
                                                <th></th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Tickets</th>
                                                <th>Status</th>
                                                <th>Country</th>
                                                <th>Email Sent</th>
                                                <th>Calls</th>
                                                <th>Reviews</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <th>
                                                    <input class="form-check-input" type="checkbox" value="option1" />
                                                </th>
                                                <td>
                                                    <img src="assets/images/user2.png" class="me-2 img-3x rounded-3"
                                                        alt="Bootstrap Gallery" />
                                                    Araceli Zhang
                                                </td>
                                                <td>info@example.com</td>
                                                <td>248</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="icon-circle1 me-2 text-success fs-5"></i>
                                                        Online
                                                    </div>
                                                </td>
                                                <td>United States</td>
                                                <td>98</td>
                                                <td>86</td>
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
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <th>
                                                    <input class="form-check-input" type="checkbox" value="option2" />
                                                </th>
                                                <td>
                                                    <img src="assets/images/user1.png" class="me-2 img-3x rounded-3"
                                                        alt="Bootstrap Gallery" />
                                                    Carmen Mccall
                                                </td>
                                                <td>info@example.com</td>
                                                <td>230</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="icon-circle1 me-2 text-success fs-5"></i>
                                                        Online
                                                    </div>
                                                </td>
                                                <td>India</td>
                                                <td>65</td>
                                                <td>39</td>
                                                <td>
                                                    <div class="starReadOnly2 rating-stars"></div>
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
                                            </tr>
                                            <tr>
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
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <th>
                                                    <input class="form-check-input" type="checkbox" value="option4" />
                                                </th>
                                                <td>
                                                    <img src="assets/images/user3.png" class="me-2 img-3x rounded-3"
                                                        alt="Bootstrap Gallery" />
                                                    Edwardo Manning
                                                </td>
                                                <td>info@example.com</td>
                                                <td>198</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="icon-circle1 me-2 text-success fs-5"></i>
                                                        Online
                                                    </div>
                                                </td>
                                                <td>Indonesia</td>
                                                <td>72</td>
                                                <td>39</td>
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
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <th>
                                                    <input class="form-check-input" type="checkbox"
                                                        value="option5" />
                                                </th>
                                                <td>
                                                    <img src="assets/images/user4.png" class="me-2 img-3x rounded-3"
                                                        alt="Bootstrap Gallery" />
                                                    Rolf Weeks
                                                </td>
                                                <td>info@example.com</td>
                                                <td>187</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="icon-circle1 me-2 text-success fs-5"></i>
                                                        Online
                                                    </div>
                                                </td>
                                                <td>Brazil</td>
                                                <td>44</td>
                                                <td>12</td>
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
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <th>
                                                    <input class="form-check-input" type="checkbox"
                                                        value="option6" />
                                                </th>
                                                <td>
                                                    <img src="assets/images/user5.png" class="me-2 img-3x rounded-3"
                                                        alt="Bootstrap Gallery" />
                                                    Maria Oliver
                                                </td>
                                                <td>info@example.com</td>
                                                <td>181</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="icon-circle1 me-2 text-success fs-5"></i>
                                                        Online
                                                    </div>
                                                </td>
                                                <td>Saudi Arabia</td>
                                                <td>73</td>
                                                <td>33</td>
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
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <th>
                                                    <input class="form-check-input" type="checkbox"
                                                        value="option2" />
                                                </th>
                                                <td>
                                                    <img src="assets/images/user2.png" class="me-2 img-3x rounded-3"
                                                        alt="Bootstrap Gallery" />
                                                    Mitzi Stark
                                                </td>
                                                <td>info@example.com</td>
                                                <td>176</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="icon-circle1 me-2 text-success fs-5"></i>
                                                        Online
                                                    </div>
                                                </td>
                                                <td>France</td>
                                                <td>65</td>
                                                <td>39</td>
                                                <td>
                                                    <div class="starReadOnly2 rating-stars"></div>
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
                                            </tr>
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
    <div class="modal fade" id="addNewCustomerModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
