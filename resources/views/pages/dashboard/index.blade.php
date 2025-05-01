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
                        <li class="breadcrumb-item">Dashboard</li>
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
                            <!-- Row start -->
                            <div class="row">
                                <div class="col-12">
                                    <h3 class="mb-3">Sales in May</h3>
                                    {{--  <p class="w-50">
                                        You have resolved
                                        <span class="text-success fw-bold">85%</span> more
                                        tickets than last year.
                                    </p>  --}}
                                    <div id="sales_in_month"></div>
                                </div>
                            </div>
                            <!-- Row end -->
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 col-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total sales</h5>
                            <div id="total_sales"></div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex flex-row">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-4 icons-box md">
                                        <img src="{{ asset('assets/images/custom/hen.png') }}" alt="">
                                    </div>
                                    <div class="ms-2">
                                        <h3 class="m-0">3000kg</h3>
                                        <p class="m-0 text-primary">Total weight</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-sm-6 col-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Monthly sales</h5>
                            <div id="monthly_sales" class="auto-align-graph"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->

            <!-- Row start -->
            <div class="row gx-3">
                <div class="col-lg-12 col-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title">Payments to collect</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-outer">
                                <div class="table-responsive">
                                    <table class="table truncate align-middle">
                                        <thead>
                                            <tr>
                                                <th>Invoice No.</th>
                                                <th>Name</th>
                                                <th>Invoice Date</th>
                                                <th>Due Date</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>00001</td>
                                                <td>Name</td>
                                                <td>2025/05/01</td>
                                                <td>
                                                    <span class="badge bg-danger">2025/05/10</span>
                                                </td>
                                                <td>2500.00</td>
                                            </tr>
                                            <tr>
                                                <td>00002</td>
                                                <td>Name</td>
                                                <td>2025/05/01</td>
                                                <td>
                                                    <span class="badge bg-danger">2025/05/10</span>
                                                </td>
                                                <td>2500.00</td>
                                            </tr>
                                            <tr>
                                                <td>00003</td>
                                                <td>Name</td>
                                                <td>2025/05/01</td>
                                                <td>
                                                    <span class="badge bg-danger">2025/05/10</span>
                                                </td>
                                                <td>2500.00</td>
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var options = {
                chart: {
                    type: 'line',
                    height: 250,
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: '2024',
                    data: [120, 150, 180, 160, 200, 230, 250, 300, 350, 400, 5000],
                    color: '#3B82F6' // blue
                }],
                xaxis: {
                    categories: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14',
                        '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28',
                        '29', '30', '31'
                    ],
                    labels: {
                        style: {
                            fontSize: '14px'
                        }
                    }
                },
                stroke: {
                    curve: 'smooth',
                    width: 4
                },
                legend: {
                    show: false
                },
                grid: {
                    strokeDashArray: 4
                }
            };

            var chart = new ApexCharts(document.querySelector("#sales_in_month"), options);
            chart.render();
        });

        document.addEventListener("DOMContentLoaded", function() {
            var options = {
                chart: {
                    type: 'donut',
                    height: 250
                },
                series: [2500, 500], // e.g., 70% blue, 30% light blue
                labels: ['Sold', 'Wastage'],
                colors: ['#019202', '#ce0303'], // blue, light blue
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%'
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#total_sales"), options);
            chart.render();
        });

        document.addEventListener("DOMContentLoaded", function() {
            var options = {
                chart: {
                    type: 'bar',
                    height: 310
                },
                series: [{
                    name: 'Sales',
                    data: [10, 30, 50, 70, 20, 30, 45, 85, 55, 52,
                        25, 25
                    ]
                }],
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                        'Dec'
                    ],
                    labels: {
                        style: {
                            fontSize: '14px'
                        }
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 8,
                        columnWidth: '30%'
                    }
                },
                colors: ['#EF4444'], // Red
                dataLabels: {
                    enabled: false
                },
                grid: {
                    strokeDashArray: 4
                },
                tooltip: {
                    enabled: true
                }
            };

            var chart = new ApexCharts(document.querySelector("#monthly_sales"), options);
            chart.render();
        });
    </script>

</x-app-layout>
