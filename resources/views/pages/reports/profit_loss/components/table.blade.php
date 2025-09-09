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
            <p class="mb-0 fs-5 {{ $net >= 0 ? 'text-success' : 'text-danger' }}">
                {{ number_format($net, 2) }}</p>
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
