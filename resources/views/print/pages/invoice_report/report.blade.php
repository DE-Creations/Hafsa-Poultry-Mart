@extends('print.layouts.template')
@section('content')
    <div style="text-align: center; margin-top: 20px;">
        <h2>Invoice Report</h2>
        {{--  <p>{{ date('F d, Y') }}</p>  --}}
    </div>
    <table width="100%" style="margin-top: 20px; border-collapse: collapse;">
        <tr>
            {{--  <td style="padding: 8px;">Total Revenue</td>
            <td style="padding: 8px; text-align: right;">{{ $data->customer }}</td>  --}}
        </tr>
        <tr>
            <td style="padding: 8px;">Total Expenses</td>
            <td style="padding: 8px; text-align: right;">{{ $from }}</td>
        </tr>
        <tr>
            {{--  <td style="padding: 8px;"><strong>Net {{ $net >= 0 ? 'Profit' : 'Loss' }}</strong></td>
            <td style="padding: 8px; text-align: right;"><strong>{{ number_format($net, 2) }}</strong></td>  --}}
        </tr>
    </table>
@endsection

