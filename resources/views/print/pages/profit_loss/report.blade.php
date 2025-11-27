@extends('print.layouts.template')
@section('content')
    <div style="text-align: center; margin-top: 20px; color: rgba(0,0,0,0.75);">
        <div class="text-center" style="margin-top: 20px"><b>HAFSA POULTRY MART</b></div>
        <div class="text-center" style="font-size: 10px">Wholesale & Retails Dealers in Chicken.</div>
        <div class="text-center" style="font-size: 11px">TEL:- 0777 188 008, 0777 252 155</div>
    </div>

    <div style="text-align: center; margin-top: 5px;">
        <h2>Profit &amp; Loss Report</h2>
    </div>

    <div width="90%" style="margin-left: 5%; margin-top: 25px; border-collapse: collapse;">
        <div>
            <span style="padding: 8px; width: 50px">From Date :</span>
            <span style="padding: 8px;">{{ \Carbon\Carbon::parse($from)->format('d M, Y') }}</span>
        </div>
        <div>
            <span style="padding: 8px; width: 50px">To Date :</span>
            <span style="padding: 8px;">{{ \Carbon\Carbon::parse($to)->format('d M, Y') }}</span>
        </div>
        <br />
        <div>
            <span style="padding: 8px; width: 50px">Printed At :</span>
            <span style="padding: 8px;">{{ date('F d, Y h:i A') }}</span>
        </div>
    </div>

    <table cellspacing="0" cellpadding="0" border="1" width="90%" class="invoice_table"
        style="margin-left: 5%; margin-top: 25px;">
        <tbody style="border: 1px solid #000000;">
            <tr>
                <td style="padding: 8px;" border="1">Total Revenue</td>
                <td style="padding: 8px; text-align: right;" border="1">{{ number_format($totalSales, 2) }}</td>
            </tr>
            <tr>
                <td style="padding: 8px;" border="1">Total Expenses</td>
                <td style="padding: 8px; text-align: right;" border="1">{{ number_format($totalExpenses, 2) }}</td>
            </tr>
            <tr>
                @if ($net >= 0)
                    <td style="padding: 8px; color: green;" border="1"><strong>Net Profit</strong></td>
                    <td style="padding: 8px; text-align: right; color: green;" border="1">
                        <strong>{{ number_format($net, 2) }}</strong>
                    @else
                    <td style="padding: 8px; color: red;" border="1"><strong>Net Loss</strong></td>
                    <td style="padding: 8px; text-align: right; color: red;" border="1">
                        <strong>{{ number_format($net, 2) }}</strong>
                @endif
                </td>
            </tr>
        </tbody>
    </table>
@endsection
