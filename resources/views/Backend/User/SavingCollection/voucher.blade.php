<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>জমা ভাউচার</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Bengali:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<style>
    body{

        font-family: 'Noto Serif Bengali', serif;
    }
    .voucher-title {
    text-align: center;
    /* background: #292942; */
}

.voucher-title span {
    background: #3f3459;
    color: white;
    padding: 2px 16px;
    border-radius: 7px;
    -webkit-print-color-adjust: exact;
}
.sign-box{
    margin-top: 20px;
}
.voucher-wrapper{
    margin-top: 20px;
    border : 1px solid lightgray;
    padding: 10px;
}
@media print{
    .print-none{
        display: none;
    }
}

</style>

<body>

    @php
    $company_info = DB::table('company_informations')->where('id',1)->first();
    @endphp

    <div class="voucher-wrapper container">
        <div class="card-header">
            <center>
              <img src="{{ asset("Backend/images/".$company_info->logo) }}" class="img-fluid" style="height: 40px;">

              <div class="mt-2">
                <h5><strong>{{ $company_info->company_name }}</strong></h5>
                <span>
                  {{ $company_info->address }}<br>
                  {{ $company_info->email }}<br>
                  Phone-{{ $company_info->phone }}, {{ $company_info->phone_2 }}<br>

                </span>
              </div>
            </center>
          </div>
        <div class="row">
            <div class="col-5">
                <div class="content">
                    <label>Print Date : </label> <span>@php echo date('Y-m-d'); @endphp</span><br>
                    <label>সংগঠনের নাম : </label> <span>{{ $company_info->company_name }}</span>
                </div>
            </div>
            <div class="col-2">
                <div class="voucher-title">
                    <br>
                    <span>জমা ভাউচার</span>
                </div>
            </div>
            <div class="col-5">
                <div class="content">
                    {{--<label>ভাউচার নং : </label> <span>9995556644</span>--}}<br>
                    <label>তারিখ : </label> <span>{{$data->transaction_date}}</span><br>
                </div>
            </div>
        </div>
        <div class="table-content">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ক্রমিক নং</th>
                        <th>ব্রাঞ্চ নাম</th>
                        <th>কেন্দ্র নাম</th>
                        <th>সদস্যের নাম</th>
                        <th>সঞ্চয়ের পরিমাণ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>{{$data->branch_name}}</td>
                        <td>{{$data->area_name}}</td>
                        <td>{{$data->aplicant_name}} - {{$data->aplicant_id}}</td>
                        <td>{{$data->deposit_ammount}}/-</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">কথায় : {{$totalDepositWord}} টাকা মাত্র।</td>
                        <td style="text-align: right;">মোট</td>
                        <td>{{$data->deposit_ammount}}/-</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="row text-center mt-4">
            <div class="col-4">
                <div class="sign-box">
                    <span>---------------------</span><br>
                    <label>হিসাব রক্ষক</label>
                </div>
            </div>
            <div class="col-4">
                <div class="sign-box">
                    <span>---------------------</span><br>
                    <label>ম্যনেজার</label>
                </div>
            </div>
            <div class="col-4">
                <div class="sign-box">
                    <span>---------------------</span><br>
                    <label>অনুমোদনকারী</label>
                </div>
            </div>
        </div>

        <center>
            <button class="btn btn-sm btn-danger print-none" onclick="window.print();">Print</button>
        </center>

    </div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

</body>
</html>
