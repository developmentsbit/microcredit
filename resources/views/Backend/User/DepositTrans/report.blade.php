<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <title>ডিপোজিট আদায় ও ফেরত রিপোর্ট</title>

</head>
<style>
    .body {
    width: 1000px;
    margin: auto;
}
    h3{
        margin : 0px !important;
    }
    table{
        width : 100%;
        font-size: 14px;
    }
    table,tr,th,td{
        border : 1px solid black;
        border-collapse: collapse;
    }
    body{
        font-family: 'Noto Serif Bengali', serif;
        font-size: 12px;
        padding:20px;
    }
    .debit {
        width: 50%;
        float: left;
        clear: right;
    }

    .crdit {
        width: 50%;
        float: left;
    }
    @media print{
        .print{
            display:none;
        }
        @page{
         margin-top: 0px;
         margin-bottom: 0px;
         margin-left: 0;
         margin-right: 0;
    }
    }
</style>
<body>
<div class="body">
@php
use App\Traits\Date;
@endphp
<table>
    <thead>
    <tr>
        <td colspan="3" style="text-align: center">
            <h3>{{$data['members']->aplicant_name}}</h3>
            এর<br>
            ডিপোজিট লেনদেন তথ্য<br>
            {{ $data['from_date'] }} থেকে {{$data['to_date']}} পর্যন্ত
        </td>
    </tr>
    <tr>
        <th>তারিখ</th>
        <th style="width : 10%;">টাকা</th>
        <th style="width : 10%;">টাকা</th>
    </tr>
    @if($data['total_collection'])
    @foreach ($data['total_collection'] as $v)
    <tr style="border: 0px;">
        <td style="border: 0px;border-right:1px solid black;">

            @if($v->return_deposit != 0 || $v->return_profit != 0 || $v->deposit_ammount > 0)
           {{Date::DbToOriginal('-',$v->collection_date)}}
           @if($v->return_profit > 0)
           (লভ্যাংশ প্রদান)
           @endif

           @endif
        </td>
        <td style="border: 0px;border-right:1px solid black;padding:3px;text-align:center">
            @if($v->deposit_ammount > 0){{$v->deposit_ammount}} @endif
        </td>
        <!-- returns -->
        <td style="border: 0px;border-right:1px solid black;padding:3px;text-align:center">
            @if($v->deposit_ammount == 0)
            @if($v->return_deposit != 0 || $v->return_profit != 0)
            {{$v->return_deposit ?: $v->return_profit}}
            @endif
            @endif
        </td>
    </tr>
    @endforeach
    @endif
    <tr>
        <td style="text-align: right;">মোট</td>
        <td style="text-align: center;">
            <b><u>{{$data['total_deposit']}}</u></b>
        </td>
        <td style="text-align: center;">
            <b><u>{{$data['total_return_profit']}}</u></b>
        </td>
    </tr>
</table>

<br>
    <table style="width:100%;border:none;">
        <tr style="border: 0px;">
            <td style="width:30%;text-align: center;border:none;">
                ---------------------------------- <br>
                <span>যোনাল ম্যানেজারের স্বাক্ষর</span>
            </td>
            <td style="width:40%;text-align: center;border:none;">

            </td>
            <td style="width:30%; text-align: center;border:none;">
                ---------------------------------- <br>
                <span>
শাখা ব্যবস্থাপকের স্বাক্ষর</span>
            </td>
        </tr>
        <tr class="print" style="border: none;">
            <td style="border: none;" colspan="3" align="center"><input type="button" value="Print" name="print" onclick="window.print()" style="height:35px; width: 120px; background: #ff0000; color: #fff; border-radius:5px;"></td>
        </tr>
    </table>
</div>

</body>
</html>
