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
                        <li class="breadcrumb-item">Reports</li>
                        <li class="breadcrumb-item">Expenses</li>
                    </ol>
                    <!-- Breadcrumb end -->
                </div>
            </div>
            <!-- Row end -->

            <!-- Summary start -->
            <div class="row gx-3">
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="row g-2 align-items-end">
                                    <div class="col-md-4">
                                        <label for="from_date" class="form-label">From Date</label>
                                        <input id="from_date" name="from_date" type="date" class="form-control"
                                            onchange="getTableDetails()"
                                            value="{{ \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d') }}" />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="to_date" class="form-label">To Date</label>
                                        <input id="to_date" name="to_date" type="date" class="form-control"
                                            onchange="getTableDetails()"
                                            value="{{ \Carbon\Carbon::now()->endOfMonth()->format('Y-m-d') }}" />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="customer_id" class="form-label">Customer</label>
                                        <select id="customer_id" class="form-control select2"
                                            onchange="getTableDetails();">
                                            <option value="select">Select Customer</option>
                                            @foreach ($customers as $customer)
                                                @if ($customer->id == '1')
                                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                @endif
                                                @if ($customer->id != '1')
                                                    <option value="{{ $customer->id }}">{{ $customer->name }} -
                                                        {{ $customer->mobile }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0 fw-semibold">Summary</h5>
                                <a href="{{ route('reports.profit_loss.print') }}" target="_blank"
                                    class="btn btn-primary btn-sm">Print Report</a>
                            </div>

                            <div id="report_table">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Summary end -->
        </div>
        <!-- Container ends -->
    </div>

    <script>
        function loadDates() {
            const now = new Date();
            const firstDay = new Date(now.getFullYear(), now.getMonth(), 1);
            const lastDay = new Date(now.getFullYear(), now.getMonth() + 1, 0);

            function formatDate(date) {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0'); // +1 because months are 0-indexed
                const day = String(date.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            }

            document.getElementById('from_date').value = formatDate(firstDay);
            document.getElementById('to_date').value = formatDate(lastDay);
        };

        function getTableDetails(page = 1) {
            //$('#pre_stop').show();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();

            var data = {
                from_date: from_date,
                to_date: to_date,
            };

            //$('#pre_stop').show();
            $.ajax({
                url: '/reports/profit_loss/loadReport',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                dataType: '',
                data: data,
                success: function(response) {
                    $('#report_table').html(response);
                    //$('#pre_stop').hide();
                }
            });
        }

        window.addEventListener('load', () => {
            setTimeout(() => {
                loadDates();
            }, 1000);
            getTableDetails();
        });
    </script>
</x-app-layout>
