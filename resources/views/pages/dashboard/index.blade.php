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
                                    <h3 class="mb-3">Sales in {{ \Carbon\Carbon::now()->format('F') }}</h3>
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
                                        <h3 class="m-0" id="total-weight">0kg</h3>
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
                                <div class="table-responsive" id="payments_to_collect_table">

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
        function renderSalesInMonth(sales_in_month, month_dates, year) {
            var options = {
                chart: {
                    type: 'line',
                    height: 250,
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: year,
                    data: sales_in_month,
                    color: '#3B82F6' // blue
                }],
                xaxis: {
                    categories: month_dates,
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
        };

        async function getTotalSales() {
            try {
                const response = await axios.get("{{ url('/totalSales') }}");
                const revenue = parseFloat(response.data.revenue) || 0;
                const expenses = parseFloat(response.data.expenses) || 0;

                var options = {
                    chart: {
                        type: 'donut',
                        height: 250
                    },
                    series: [revenue, expenses],
                    labels: ['Revenue', 'Expenses'],
                    colors: ['#019202', '#ce0303'],
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

                const container = document.querySelector("#total_sales");
                if (container) {
                    container.innerHTML = ''; // clear previous chart if any
                    var chart = new ApexCharts(container, options);
                    chart.render();
                }
            } catch (error) {
                console.error("Error fetching total sales:", error);
            }
        }

        function renderMonthlySalesChart(monthly_sales) {
            var options = {
                chart: {
                    type: 'bar',
                    height: 310
                },
                series: [{
                    name: 'Sales',
                    data: monthly_sales
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
        };

        function setTotalWeight(value) {
            totalWeight = Number(value) || 0;
            const roundedWeight = Math.round(totalWeight);
            document.getElementById("total-weight").textContent = roundedWeight.toLocaleString('en-US') + 'kg';
        }

        async function getDashboardDetails() {
            try {
                const response = await axios.get("{{ url('/dashboardDetails') }}");
                renderSalesInMonth(response.data.sales_in_month, response.data.month_dates, response.data.year);
                renderMonthlySalesChart(response.data.monthly_sales);
                setTotalWeight(response.data.grnTotal);
            } catch (error) {
                console.error("Error fetching dashboard details :", error);
            }
        }

        function getPaymentsToCollect(page = 1) {
            try {
                {{--  const response = await axios.get("{{ url('/paymentsToCollect') }}");
                $('#payments_to_collect_table').html(response);  --}}


                $.ajax({
                    url: '/paymentsToCollect',
                    success: function(response) {
                        $('#payments_to_collect_table').html(response);
                        //$('#pre_stop').hide();
                    }
                });
            } catch (error) {
                console.error("Error fetching payments to collect :", error);
            }






            {{--  //$('#pre_stop').show();
            $.ajax({
                url: '/customers/ajax/list?page=',
                success: function(response) {
                    $('#payments_to_collect_table').html(response);
                    //$('#pre_stop').hide();
                }
            });  --}}
        }

        window.addEventListener("load", function() {
            getDashboardDetails();
            getPaymentsToCollect();
            getTotalSales();
        });
    </script>
</x-app-layout>
