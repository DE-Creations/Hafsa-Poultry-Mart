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

            <!-- Summary start -->
            <div class="row gx-3">
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0 fw-semibold">Summary</h5>
                                <a href="{{ route('reports.profit_loss.print') }}" target="_blank" class="btn btn-primary btn-sm">Print Report</a>
                            </div>
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
</x-app-layout>
