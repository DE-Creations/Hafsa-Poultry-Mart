@extends('print.layouts.template')
@section('content')
    <div style="padding:20px">
        <h3 style="text-align:center">Profit &amp; Loss Report</h3>
        @if($start_date && $end_date)
            <p style="text-align:center;font-size:12px">
                {{ \Carbon\Carbon::parse($start_date)->format('d M Y') }} -
                {{ \Carbon\Carbon::parse($end_date)->format('d M Y') }}
            </p>
        @endif
        <table width="100%" style="border-collapse: collapse;margin-top:20px">
            <thead>
                <tr>
                    <th style="border:1px solid #000;padding:8px;text-align:left">Description</th>
                    <th style="border:1px solid #000;padding:8px;text-align:right">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border:1px solid #000;padding:8px">Total Revenue</td>
                    <td style="border:1px solid #000;padding:8px;text-align:right">{{ number_format($totalSales,2) }}</td>
                </tr>
                <tr>
                    <td style="border:1px solid #000;padding:8px">Total Expenses</td>
                    <td style="border:1px solid #000;padding:8px;text-align:right">{{ number_format($totalExpenses,2) }}</td>
                </tr>
                <tr>
                    <td style="border:1px solid #000;padding:8px"><strong>Net {{ $net >= 0 ? 'Profit' : 'Loss' }}</strong></td>
                    <td style="border:1px solid #000;padding:8px;text-align:right"><strong>{{ number_format($net,2) }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
