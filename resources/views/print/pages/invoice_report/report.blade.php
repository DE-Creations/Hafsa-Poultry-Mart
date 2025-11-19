@extends('print.layouts.template')
@section('content')
    @foreach ($data->invoices as $item)
        <div style="padding: 20px; padding-left: 80px; padding-right: 80px">
            <div class="text-center" style="margin-top: 20px">INVOICE</div>
            <div class="text-center" style="margin-top: 20px"><b>HAFSA POULTRY MART</b></div>
            <div class="text-center" style="font-size: 10px">Wholesale & Retails Dealers in Chicken.</div>
            <div class="text-center" style="font-size: 11px">TEL:- 0777 188 008, 0777 252 155</div>
            <div class="text-center" style="font-size: 10px">Printed at - {{ date('F d, Y h:i A') }}</div>

            {{-- 1  --}}
            {{-- <div style="font-size: 14px; margin-top: 20px;" class="text-right"><b>DATE:</b> 7-Jul-24</div>
        <div>
            <div class="text-left" style="margin-top: 5px;"><span><u>SML</u></span></div>
            <div style="margin-top: -100px" class="text-right"><span><b>Inv. No:</b> 10</span></div>
        </div>  --}}
            {{-- 1  --}}

            {{-- 2  --}}
            <div style="margin-top: 20px;">
                <div style="font-size: 12px" class="text-left"><span><b>INV. No:</b>
                        {{ data_get($item, 'invoice_number') }}</span>
                </div>
                <div style="font-size: 12px; margin-top: -20px;" class="text-right"><b>DATE:</b>
                    {{ \Carbon\Carbon::parse(data_get($item, 'invoice_date'))->setTimezone('Asia/Colombo')->format('d M, Y') }}
                </div>
            </div>
            @if (data_get($item, 'customer_name') != 'Walking Customer')
                <div class="text-left" style="margin-top: 5px; font-size: 12px"><b>CUSTOMER:</b>
                    {{ data_get($item, 'customer_name') }}
                </div>
            @endif
            {{-- 2  --}}
        </div>

        <table cellspacing="0" cellpadding="0" border="0" width="100%" class="invoice_table">
            <thead>
                <tr class="row-bg-head"
                    style="line-height:1; white-space:nowrap; color: #000000; background-color: #000000,20;">
                    <th width="20%" align="left" style="font-size: 10px;">
                        NO
                    </th>
                    <th width="20%" align="left" style="font-size: 10px;">
                        ITEM
                    </th>
                    <th width="20%" align="center" style="font-size: 10px;">
                        QTY
                    </th>
                    <th width="20%" align="center" style="font-size: 10px;">
                        PRICE
                    </th>
                    <th width="20%" align="right" style="font-size: 10px;">
                        AMOUNT
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach (data_get($item, 'invoiceItems') as $invoiceItem)
                    <tr class="row-bg">
                        <td align="left" class="td-style">
                            {{ $loop->iteration }}
                        </td>
                        <td align="left" class="td-style">
                            {{ data_get($invoiceItem, 'output_item_name') }}
                        </td>
                        <td align="right" class="td-style">
                            {{ number_format(data_get($invoiceItem, 'weight', 0), 3) }}
                        </td>
                        <td align="right" class="td-style">
                            {{ number_format(data_get($invoiceItem, 'unit_price', 0), 2) }}
                        </td>
                        <td align="right" class="td-style">
                            {{ number_format(data_get($invoiceItem, 'amount', 0), 2) }}
                        </td>
                    </tr>
                @endforeach

                {{-- <tr class="row-bg " style="border-top: 2px dotted #eee;">
                <td></td>
                <td></td>
                <td></td>
            </tr>  --}}
            </tbody>

            <tfoot class="row-bg-footer"
                style="line-height:1; white-space:nowrap; color: #000000; background-color: #000000,20;">
                @foreach (data_get($item, 'invoicePayment', []) as $payment)
                    <tr class="row-bg">
                        <td align="right" class="td-style" colspan="4" style="font-size: 10px; padding-right: 10px">
                            <b>TOTAL</b>
                        </td>
                        <td align="right" class="td-style">
                            {{ number_format(data_get($payment, 'sub_total', 0), 2) }}
                        </td>
                    </tr>
                    <tr class="row-bg">
                        <td align="right" class="td-style" colspan="4" style="font-size: 10px; padding-right: 10px">
                            <b>DISCOUNT</b>
                        </td>
                        <td align="right" class="td-style">
                            {{ number_format(data_get($payment, 'discount_amount', 0), 2) }}
                        </td>
                    </tr>
                    <tr class="row-bg">
                        <td align="right" class="td-style" colspan="4" style="font-size: 10px; padding-right: 10px">
                            <b>BALANCE FORWARD</b>
                        </td>
                        <td align="right" class="td-style">
                            {{ number_format(data_get($payment, 'previous_balance_forward', 0), 2) }}
                        </td>
                    </tr>
                    <tr class="row-bg">
                        <td align="right" class="td-style" colspan="4" style="font-size: 10px; padding-right: 10px">
                            <b>CASH RECEIVED</b>
                        </td>
                        <td align="right" class="td-style">
                            {{ number_format(data_get($payment, 'paid_amount', 0), 2) }}
                        </td>
                    </tr>
                    <tr class="row-bg">
                        <td align="right" class="td-style" colspan="4" style="font-size: 10px; padding-right: 10px">
                            <b>BALANCE</b>
                        </td>
                        <td align="right" class="td-style row-bg-balance">
                            {{ number_format(data_get($payment, 'new_balance', 0), 2) }}
                        </td>
                    </tr>
                @endforeach
            </tfoot>
        </table>

        {{-- <table cellspacing="0" cellpadding="0" border="0" width="100%">
        <tbody>

            @if ($payment->note != null)
                <tr class="row-bg">
                    <div style="opacity: 0.5;padding-left: 0; font-size: 12px; padding-top: 40px;">NOTE</div>
                    <div class="remark-content" style="font-size: 14px;">
                        {{ $payment->note }}
</div>
</tr>
@endif
<tr class="row-bg">
    <div class="remark-content" style="font-size: 14px; padding-top: 50px; text-align: center;">
        Thank you for your payment!
    </div>
</tr>
</tbody>
</table> --}}

        <div style="padding: 80px; padding-top: 50px; padding-bottom: 20px">
            <div style="margin-top: 20px; width: 40%" class="text-center">
                <hr style="background-color: black">
                <span style="font-size: 11px">ISSUED BY</span>
            </div>
            <div style="margin-top: -37.5px;width: 40%; margin-left: 60%" class="text-center">
                <hr style="background-color: black">
                <span style="font-size: 11px">RECEIVED BY</span>
            </div>
        </div>

        <div class="text-center" style="margin-top: 16px; font-size: 12px">Thank you! Come again!</div>
        <div class="text-center" style="margin-top: 15px; font-size: 8px">DE CREATIONS&reg; | 070 300 4483</div>
        @if (!$loop->last)
            <div class="page_break"></div>
        @endif
    @endforeach

    <style>
        .page_break {
            page-break-before: always;
        }

        .ql-cursor {
            display: none;
        }

        .right-text {
            text-align: right;
            padding-right: 5px;
        }

        .row-style {
            padding-left: 0px;
            padding-right: 0px;
            padding-top: 0px;
            padding-bottom: 0px;
        }

        .row-bg-head {
            border: 1px solid #000000;
            border-left: none;
            border-right: none;
        }

        .row-bg-footer {
            border: 1px solid #000000;
            border-bottom: none;
            border-left: none;
            border-right: none;
        }

        .row-bg-balance {
            border-top: 1px solid #000000;
            border-bottom: 3px double #000000;
            border-left: none;
            border-right: none;
        }

        .row-bg {
            background-color: transparent;
        }

        .invoice_table th,
        td {
            padding: 0px;
        }

        .parameter-table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
        }

        .parameter-td-style-head {
            font-size: 11px;
            opacity: 0.5;
            width: 25%;
            /* height: 20px; */
            padding: 0.4%;
        }

        .parameter-td-customer-style {
            font-size: 11px;
            word-wrap: break-word;
            width: 80%;
            margin-left: 10%;
            margin-top: -35px;
            /* height: 20px; */
            padding: 0.4%;
        }

        ..invoice_table td {
            padding: 0px;
        }

        .invoice_table {
            padding-left: 80px;
            padding-right: 80px;
            margin-top: 0px;
            border-collapse: collapse;
        }

        .row-bg-subtotal {
            background-color: #e8e8e8c4;
        }

        .row-white {
            background-color: #ffffff;
        }

        .td-style {
            font-size: 10px;
            line-height: 1;
            white-space: nowrap;
            vertical-align: top;
        }

        .td-style-total {
            font-size: 11px;
            line-height: 1;
            margin: 10px;
            padding: 10px;
            white-space: nowrap;
            vertical-align: top;
            font-weight: bold;
            color: #252323;
        }

        .td-style-head {
            font-size: 11px;
            opacity: 0.5;
        }

        .td-customer-style {
            font-size: 11px;
            line-height: 1;
        }

        .company_data {
            font-size: 0.8rem;
            font-weight: 400;
        }

        .td-style-gt {
            font-family: arial;
            font-size: 14px;
            font-weight: 400;
            line-height: 17px;
            padding-left: 10px;
            padding-bottom: 6px;
            padding-top: 6px;
        }

        .signature {
            text-align: center;
            line-height: 10px;
        }

        .signature-section {
            margin-top: 50px;
        }

        .material-img {
            height: 120px;
            position: fixed;
            right: 150px;
            top: 160px;
            z-index: 999999;
            padding: 5px 0px 5px 0px;
        }

        .border-mb {
            border-bottom: #000000 solid 1px;
        }

        .border-mt {
            border-top: #000000 solid 1px;
        }

        .border-b {
            border-bottom: #000000 solid 2px;
        }

        .border-t {
            border-top: #000000 solid 2px;
        }

        .border-l {
            border-left: #000000 solid 2px;
        }

        .border-r {
            border-right: #000000 solid 2px;
        }

        .brand-logo {
            width: 150px;
            padding-bottom: 20px;
            padding-top: 2px;
        }

        .heading-bg {
            background-color: #e8e8e8c4;
        }

        .heading-bg-po {
            background-color: #ffffff7d;
            color: #2b2b2b;
        }

        .total-bg {
            background-color: #e8e8e8c4;
            padding-right: 10px;
            font-family: arial;
            font-size: 10px;
            font-weight: 400;
            line-height: 20px;
            padding-left: 10px;
            padding-bottom: 5px;
        }

        .total-txt {
            text-align: left;
            padding-left: 10px;
            font-family: arial;
            font-size: 10px;
            font-weight: 400;
            line-height: 20px;
            font-weight: bold;
        }

        .total-value {
            text-align: right;
            font-family: arial;
            font-size: 10px;
            font-weight: 400;
            line-height: 20px;
            font-weight: bold;
        }

        .table-heading {
            padding-left: 15px;
            font-size: 12px;
        }

        .remark-content {
            text-align: left;
            font-size: 11px;
            text-align: justify;

            p {
                line-height: 1px;
                margin-bottom: 0px;
            }

        }

        .remark-content p {
            line-height: 1;
            margin-bottom: 0px;
            margin-top: 0px
        }

        .remark-note {
            /* text-align: center; */
            text-align: center
        }

        .section-table {
            margin-bottom: 20px;
        }

        .section-footer {
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .section-table {
            margin-bottom: 20px;
        }

        .note-area {
            border-bottom: #c8c8c8ab solid 1px;
            border-top: #c8c8c8ab solid 1px;
            border-left: #c8c8c8ab solid 1px;
            border-right: #c8c8c8ab solid 1px;
            border-radius: 5px;
            margin-top: 50px;
        }

        .text {
            text-align: left;
            margin-top: 20px;
            padding-bottom: 20px;
            margin-left: 20px;
        }

        .text-head {
            font-size: 17px;
        }

        .text-body {
            font-family: Cambria;
            font-size: 15px;
        }

        .text-tc {
            font-size: 12px;
            line-height: 20px;
        }

        .vendor-info {
            font-size: 0.8rem;
            line-height: 5px;
        }

        .signature-row {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 3rem;
            padding: 10px 0;
            text-align: center;
        }

        .signature-label {
            margin-left: 10px;
            font-size: 11px;
        }

        .signature-dots {
            font-size: 14px;
            margin: 0 10px;
            flex-grow: 1;
        }

        .customer-section-name {
            vertical-align: text-top;
        }

        .customer-section-description {
            padding-right: 10;
            vertical-align: text-top;
        }

        .date-row {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            padding-top: 5px;
        }

        .note {
            margin-top: -50px !important;
        }

        .row-bg {
            background-color: #ffffff;
        }

        .invoice_table th,
        td {
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .row-bg-subtotal {
            background-color: #e8e8e8c4;
        }

        .company_data {
            font-size: 0.8rem;
            font-weight: 400;
        }


        .signature {
            text-align: center;
            line-height: 10px;
        }

        .signature-section {
            margin-top: 50px;
        }


        .brand-logo {
            width: 150px;
            padding-bottom: 20px;
            padding-top: 2px;
        }

        .text {
            text-align: left;
            margin-top: 20px;
            padding-bottom: 20px;
            margin-left: 20px;
        }

        .text-head {
            font-size: 17px;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .d-flex {
            display: flex;
        }
    </style>
@endsection

{{--  @extends('print.layouts.template')
@section('content')
    <div style="text-align: center; margin-top: 20px; color: rgba(0,0,0,0.75);">
        <div class="text-center" style="margin-top: 20px"><b>HAFSA POULTRY MART</b></div>
        <div class="text-center" style="font-size: 10px">Wholesale & Retails Dealers in Chicken.</div>
        <div class="text-center" style="font-size: 11px">TEL:- 0777 188 008, 0777 252 155</div>
    </div>

    <div style="text-align: center; margin-top: 5px;">
        <h2>Invoice Report</h2>
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
        @if ($customer != 'select')
            <div>
                <span style="padding: 8px; width: 50px">Customer :</span>
                <span style="padding: 8px;">{{ $customer }}</span>
            </div>
        @endif
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
    </table>
@endsection  --}}
