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
                        <li class="breadcrumb-item">Profit &amp; Loss</li>
                    </ol>
                    <!-- Breadcrumb end -->
                </div>
            </div>
            <!-- Row end -->

            <!-- Filter start -->
            <div class="row gx-3 mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="GET" class="row align-items-end g-2">
                                <div class="col-md-3">
                                    <label for="date-range" class="form-label">Range</label>
                                    <select id="date-range" class="form-select">
                                        <option value="today">Today</option>
                                        <option value="last_week">Last Week</option>
                                        <option value="last_month">Last Month</option>
                                        <option value="last_3_months">Last 3 Months</option>
                                        <option value="custom">Custom</option>
                                    </select>
                                </div>
                                <div id="custom-dates" class="col-md-6 d-none">
                                    <div class="row g-2">
                                        <div class="col">
                                            <label for="start-date" class="form-label">From</label>
                                            <input type="date" id="start-date" name="start_date" class="form-control">
                                        </div>
                                        <div class="col">
                                            <label for="end-date" class="form-label">To</label>
                                            <input type="date" id="end-date" name="end_date" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                                    <button type="button" class="btn btn-outline-secondary" onclick="printReport()">Print</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Filter end -->

            <!-- Summary start -->
            <div class="row gx-3">
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="mb-3 fw-semibold">Summary</h5>
                            <div class="row text-center">
                                <div class="col-md-4 mb-3">
                                    <div class="p-3 border rounded">
                                        <h6 class="mb-1">Total Revenue</h6>
                                        <p class="mb-0 fs-5">{{ number_format($totalSales, 2) }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="p-3 border rounded">
                                        <h6 class="mb-1">Total Expenses</h6>
                                        <p class="mb-0 fs-5">{{ number_format($totalExpenses, 2) }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="p-3 border rounded">
                                        <h6 class="mb-1">Net {{ $net >= 0 ? 'Profit' : 'Loss' }}</h6>
                                        <p class="mb-0 fs-5 {{ $net >= 0 ? 'text-success' : 'text-danger' }}">{{ number_format($net, 2) }}</p>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-bordered mt-4">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th class="text-end">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Total Revenue</td>
                                        <td class="text-end">{{ number_format($totalSales, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total Expenses</td>
                                        <td class="text-end">{{ number_format($totalExpenses, 2) }}</td>
                                    </tr>
                                    <tr class="{{ $net >= 0 ? 'table-success' : 'table-danger' }}">
                                        <td><strong>Net {{ $net >= 0 ? 'Profit' : 'Loss' }}</strong></td>
                                        <td class="text-end"><strong>{{ number_format($net, 2) }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Summary end -->
        </div>
        <!-- Container ends -->
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const rangeSelect = document.getElementById('date-range');
            const customDates = document.getElementById('custom-dates');
            const startInput = document.getElementById('start-date');
            const endInput = document.getElementById('end-date');

        function setRange(start, end) {
            startInput.value = start.toISOString().slice(0, 10);
            endInput.value = end.toISOString().slice(0, 10);
            customDates.classList.add('d-none');
        }

        rangeSelect.addEventListener('change', function () {
            const now = new Date();
            switch (this.value) {
                case 'today':
                    setRange(now, now);
                    break;
                case 'last_week':
                    const weekAgo = new Date();
                    weekAgo.setDate(now.getDate() - 7);
                    setRange(weekAgo, now);
                    break;
                case 'last_month':
                    const monthAgo = new Date();
                    monthAgo.setMonth(now.getMonth() - 1);
                    setRange(monthAgo, now);
                    break;
                case 'last_3_months':
                    const threeAgo = new Date();
                    threeAgo.setMonth(now.getMonth() - 3);
                    setRange(threeAgo, now);
                    break;
                case 'custom':
                    customDates.classList.remove('d-none');
                    startInput.value = '';
                    endInput.value = '';
                    break;
            }
        });

        @if(isset($startDate) && isset($endDate))
            startInput.value = '{{ $startDate }}';
            endInput.value = '{{ $endDate }}';
            rangeSelect.value = 'custom';
            customDates.classList.remove('d-none');
        @else
            rangeSelect.value = 'today';
            rangeSelect.dispatchEvent(new Event('change'));
        @endif
    });

    async function printReport() {
        const start = document.getElementById('start-date').value;
        const end = document.getElementById('end-date').value;
        const url = `{{ route('reports.profit_loss.print') }}?start_date=${start}&end_date=${end}`;
        window.open(url, '_blank');
    }
    </script>
</x-app-layout>
