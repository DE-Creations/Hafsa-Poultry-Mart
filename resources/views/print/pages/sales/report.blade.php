@extends('print.layouts.template')
@section('content')
    <div style="text-align: center; margin-top: 20px; color: rgba(0,0,0,0.75);">
        <div class="text-center" style="margin-top: 20px"><b>HAFSA POULTRY MART</b></div>
        <div class="text-center" style="font-size: 10px">Wholesale & Retails Dealers in Chicken.</div>
        <div class="text-center" style="font-size: 11px">TEL:- 0777 188 008, 0777 252 155</div>
        {{--  <p>{{ date('F d, Y') }}</p>  --}}
    </div>

    <div style="text-align: center; margin-top: 5px;">
        <h2>Sales Report</h2>
    </div>

    <div width="90%" style="margin-left: 5%; margin-top: 25px; border-collapse: collapse;">
        <div>
            <span style="padding: 8px; width: 50px">From Date :</span>
            <span style="padding: 8px;">{{ $from }}</span>
        </div>
        <div>
            <span style="padding: 8px; width: 50px">To Date :</span>
            <span style="padding: 8px;">{{ $to }}</span>
        </div>
        <br />
        <div>
            <span style="padding: 8px; width: 50px">Printed At :</span>
            <span style="padding: 8px;">{{ date('F d, Y h:i A') }}</span>
        </div>
    </div>

    <table cellspacing="0" cellpadding="0" border="0" width="90%" class="invoice_table"
        style="margin-left: 5%; margin-top: 25px;">
        <thead>
            <tr class="row-bg-head"
                style="line-height:1; white-space:nowrap; color: #000000; background-color: #000000,20;">
                <th width="20%" align="left" style="font-size: 15px;">
                    Invoice No.
                </th>
                <th width="20%" align="center" style="font-size: 15px;">
                    Customer
                </th>
                <th width="20%" align="center" style="font-size: 15px;">
                    Date
                </th>
                <th width="20%" align="right" style="font-size: 15px;">
                    Total
                </th>
                <th width="20%" align="right" style="font-size: 15px;">
                    Paid Amount
                </th>
                <th width="20%" align="right" style="font-size: 15px;">
                    Due Amount
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
                <tr class="row-bg" style="line-height:1; white-space:nowrap; color: #000000;">
                    <td align="left" class="td-style" style="font-size: 14px; margin-top: 2px">
                        {{ $invoice->invoice_number }}
                    </td>
                    <td align="center" class="td-style" style="font-size: 14px">
                        {{ $invoice->customer->name }}
                    </td>
                    <td align="center" class="td-style" style="font-size: 14px">
                        {{ $invoice->date }}
                    </td>
                    <td align="right" class="td-style" style="font-size: 14px">
                        {{ $invoice->invoicePayment->first()->to_pay ?? 'N/A' }}
                    </td>
                    <td align="right" class="td-style" style="font-size: 14px">
                        {{ $invoice->invoicePayment->first()->paid_amount ?? 'N/A' }}
                    </td>
                    <td align="right" class="td-style" style="font-size: 14px">
                        {{ $invoice->invoicePayment->first()->new_balance ?? 'N/A' }}
                    </td>
                </tr>
            @endforeach
        </tbody>

        {{--  @php
            $totalTotal = $invoices->sum(function ($inv) {
                return (float) ($inv->invoicePayment->first()->to_pay ?? 0);
            });
            $totalPaid = $invoices->sum(function ($inv) {
                return (float) ($inv->invoicePayment->first()->paid_amount ?? 0);
            });
            $totalDue = $invoices->sum(function ($inv) {
                return (float) ($inv->invoicePayment->first()->new_balance ?? 0);
            });
        @endphp

        <tfoot class="row-bg-footer"
            style="line-height:1; white-space:nowrap; color: #000000; background-color: #000000,20;">
            <tr class="row-bg">
                <td colspan="3" align="right" class="td-style" style="font-size: 12px; padding-right: 10px">
                    <b>GRAND TOTAL</b>
                </td>
                <td align="right" class="td-style" style="font-size: 12px">
                    {{ number_format($totalTotal, 2) }}
                </td>
                <td align="right" class="td-style" style="font-size: 12px">
                    {{ number_format($totalPaid, 2) }}
                </td>
                <td align="right" class="td-style row-bg-balance" style="font-size: 12px">
                    {{ number_format($totalDue, 2) }}
                </td>
            </tr>
        </tfoot>  --}}
    </table>
@endsection
