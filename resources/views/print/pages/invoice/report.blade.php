@extends('print.layouts.template')
@section('content')
    <div>invoice</div>
    <div class="table-responsive">
        <table cellspacing="0" cellpadding="0" border="0" width="100%">
            <tbody>
                <tr>
                    <td style="width: 50%; padding-left: 0;">
                        <div class="text-head" style="color: black">
                            <b>RECEIPT - INV00001</b>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" class="td-customer-style " style="vertical-align:text-top;padding-left: 0;">
                        <div style="opacity: 0.5;padding-left: 0;">PAYED BY</div>
                        <div style="margin-bottom: 4px;margin-top: 4px;">Customer</div>
                    </td>
                </tr>
            </tbody>
        </table>


        {{--  <table cellspacing="0" cellpadding="0" border="0" width="40%" style="margin-top: -10px;">
            <tbody>
                @if (isset($member))
                    <tr class="td-customer-style" style="vertical-align:text-top;padding-top: 0;margin-top: 0px">
                        <div align="left" class="date-row"><span class="customer-section-name">MEMBER : </span><span
                                style="vertical-align: text-top;">{{ $member }}</span>
                        </div>
                    </tr>
                @endif
                <tr class="td-customer-style" style="vertical-align:text-top;padding-top: 0;margin-top: 0px">
                    <div align="left" class="date-row">
                        @if (isset($search_details_from_date))
                            <span class="customer-section-name">FROM: </span><span
                                style="vertical-align: text-top;">{{ \Carbon\Carbon::parse($search_details_from_date)->setTimezone('Asia/Colombo')->format('d M, Y') }}</span>
                        @endif
                        @if (isset($search_details_to_date))
                            <span class="customer-section-name" style="margin-left: 5px">TO: </span><span
                                style="vertical-align: text-top;">{{ \Carbon\Carbon::parse($search_details_to_date)->setTimezone('Asia/Colombo')->format('d M, Y') }}</span>
                        @endif
                    </div>
                </tr>
                <tr></tr>
            </tbody>
        </table>  --}}
    </div>

    {{--  <table cellspacing="0" cellpadding="0" border="0" width="100%" class="invoice_table">
        <thead class="invoice_table_head" style="">
            <tr class="row-bg-head"
                style="line-height:1; white-space:nowrap; color: {{ $business_details->color_code ?? '#000000' }}; background-color: {{ $business_details->color_code ?? '#000000' }}20;">
                <th width="40%" align="left" class="table_head_data" style="font-size: 11px;">
                    DATE
                </th>
                <th width="30%" align="left" class="table_head_data" style="font-size: 11px;">
                    PAYMENT TYPE
                </th>
                <th width="30%" align="right" class="table_head_data " style="font-size: 11px;">
                    PAYMENT
                </th>
            </tr>
        </thead>
        <tbody>

            <tr class="row-bg">
                <td align="left" class="td-style">
                    {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M, Y') }}
                </td>
                <td align="left" class="td-style">
                    @if ($payment->payment_type == 0)
                        OTHER
                    @endif
                    @if ($payment->payment_type == 1)
                        REGISTRATION FEE
                    @endif
                    @if ($payment->payment_type == 2)
                        MEMBERSHIP FEE
                    @endif
                </td>
                <td align="right" class="td-style">
                    @isset($business_details->currency)
                        {{ $business_details->currency->code }}
                    @endisset
                    {{ number_format($payment->price, 2) }}
                </td>
            </tr>
            <tr class="row-bg " style="border-top: 2px dotted #eee;">
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>  --}}

    {{--  <table cellspacing="0" cellpadding="0" border="0" width="100%">
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
    </table>  --}}


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
            background-color: #f5f5f5;
        }

        .row-bg {
            background-color: transparent;
        }

        .invoice_table th,
        td {
            padding: 10px;
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
            padding: 5px;
        }

        .invoice_table {
            margin-top: 2rem;
            border-collapse: collapse;
        }

        .row-bg-subtotal {
            background-color: #e8e8e8c4;
        }

        .row-white {
            background-color: #ffffff;
        }

        .td-style {
            font-size: 11px;
            line-height: 1;
            margin: 10px;
            padding: 10px;
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
    </style>
@endsection
