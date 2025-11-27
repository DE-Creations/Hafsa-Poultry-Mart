@extends('print.layouts.template')
@section('content')
<div style="padding: 20px; padding-left: 0px; padding-right: 0px">
    <div class="text-center" style="margin-top: 20px"><b>HAFSA POULTRY MART</b></div>
    <div class="text-center" style="font-size: 10px">Wholesale & Retails Dealers in Chicken.</div>
    <div class="text-center" style="font-size: 11px">TEL:- 0777 188 008, 0777 252 155</div>
    <div class="text-center" style="font-size: 10px">Report created at - {{ date('F d, Y h:i A') }}</div>
    <div class="text-center" style="margin-top: 40px"><b>EXPENSES SUMMARY</b></div>

    {{-- Date Range Section --}}
    <div style="margin-top: 20px; border-bottom: 1px solid #000000; padding-bottom: 5px;">
        <div style="font-size: 12px" class="text-left">
            <span><b>From Date:</b> {{ \Carbon\Carbon::parse($from)->format('d M, Y') }}</span>
        </div>
        {{-- Using negative margin to align the 'To Date' to the right --}}
        <div style="font-size: 12px; margin-top: -20px;" class="text-right">
            <span><b>To Date:</b> {{ \Carbon\Carbon::parse($to)->format('d M, Y') }}</span>
        </div>
    </div>
    {{-- End Date Range Section --}}
</div>

{{-- Expense Table --}}
<table cellspacing="0" cellpadding="0" border="0" width="100%" class="invoice_table">
    <thead>
        <tr class="row-bg-head"
            style="line-height:1; white-space:nowrap; color: #000000; background-color: #000000,20;">
            <th width="50%" align="left" style="font-size: 10px; padding-left: 10px;">
                NAME
            </th>
            <th width="30%" align="center" style="font-size: 10px;">
                DATE
            </th>
            <th width="20%" align="right" style="font-size: 10px; padding-right: 10px;">
                AMOUNT
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($expenses as $expense)
        <tr class="row-bg">
            <td align="left" class="td-style" style="padding-top: 10px; padding-left: 10px;">
                {{ $expense->expenseCategory->name }}
            </td>
            <td align="center" class="td-style" style="padding-top: 10px;">
                {{ \Carbon\Carbon::parse($expense['date'])->format('d M, Y') }}
            </td>
            <td align="right" class="td-style" style="padding-top: 10px; padding-right: 10px;">
                {{ number_format($expense['amount'], 2) }}
            </td>
        </tr>
        @endforeach

        @for ($i = count($expenses); $i < 15; $i++)
            <tr class="row-bg">
            <td class="td-style" style="height: 20px;"></td>
            <td class="td-style"></td>
            <td class="td-style"></td>
            </tr>
            @endfor

    </tbody>
</table>

{{-- Total Row - Aligned with the bottom of the table data, matching the sketch --}}
<table cellspacing="0" cellpadding="0" border="0" width="100%" class="invoice_table" style="margin-top: 0px;">
    <tfoot class="row-bg-footer" style="border-top: 1px solid #000000;">
        <tr class="row-bg">
            <td align="left" class="td-style" colspan="2" style="font-size: 12px; padding-left: 10px; font-weight: bold; padding-top: 10px; padding-bottom: 10px;">
                TOTAL
            </td>
            <td align="right" class="td-style" style="font-size: 12px; padding-right: 10px; padding-top: 10px; padding-bottom: 10px; font-weight: bold; border-top: 2px solid #000000; border-bottom: 2px double #000000;">
                {{ number_format($total_expense ?? 0.00, 2) }} {{-- Replace $total_expense with your actual total variable --}}
            </td>
        </tr>
    </tfoot>
</table>
{{-- End Expense Table and Total --}}

<div class="text-center" style="margin-top: 30px; font-size: 8px">DE CREATIONS&reg; | 070 300 4483</div>

{{-- Insert your existing style block here --}}
<style>
    /* ... Your existing style block ... */
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

    .invoice_table td {
        padding: 0px;
    }

    .invoice_table {
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
