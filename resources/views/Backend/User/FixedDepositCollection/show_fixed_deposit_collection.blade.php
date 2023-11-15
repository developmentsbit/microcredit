
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tiro+Bangla:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet">
    <title>Fixed Deposite Reports</title>
</head>
<body style="font-family: 'Montserrat','Tiro Bangla', serif; font-size: 14px;">

    @php
    $company_info = DB::table("company_informations")->first();
    @endphp


    <div class="container-fluid mt-4">


        <div class="card">
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

            <div class="card-body">


                <table class="table-bordered w-100 text-center">

                    <tr>
                        <td colspan="8">ফিক্সড ডিপোজিট আদায় রিপোর্ট</td>
                    </tr>




                    <tr>
                        <th>তারিখ:</th>
                        <td>{{ date('d M Y') }}</td>


                        <th>ব্রাঞ্চ নাম:</th>
                        <td>{{ $branch->branch_name }}</td>

                        <th>কেন্দ্র নাম:</th>
                        <td>{{ $area->area_name }}</td>

                    </tr>
                </table>


                <table class="table-bordered w-100 text-center mt-3">

                    <thead>
                        <tr>
                            <th>সিরিয়াল নং</th>
                            <th>তারিখ</th>
                            <th>ব্রাঞ্চ</th>
                            <th>কেন্দ্র নাম</th>
                            <th>মেম্বার নাম</th>
                            <th>ডিপোজিট পরিমাণ</th>
                            <th>সর্ভিস চার্জ</th>
                            <th>ফেরত পরিমাণ</th>
                            <th>লাভের পরিমাণ</th>
                            <th>মোট</th>
                            <th>মন্তব্য</th>

                        </tr>
                    </thead>

                    <tbody>
                        @if($data)
                        @foreach ($data as $v)
                        <tr>
                            <td>{{$sl++}}</td>
                            <td>{{$v->collection_date}}</td>
                            <td>{{$v->branch_name}}</td>
                            <td>{{$v->area_name}}</td>
                            <td>{{$v->aplicant_name}} - {{$v->registration_id}}</td>
                            <td>{{$v->deposit_ammount}}</td>
                            <td>{{$v->service_charge}}</td>
                            <td>{{$v->return_deposit}}</td>
                            <td>{{$v->return_profit}}</td>
                            <td>{{$v->total}}</td>
                            <td>{{$v->comment}}</td>
                        </tr>
                        @endforeach
                        @endif


                        <tr>
                            <td colspan="5">মোট</td>
                            <td colspan="">{{$total}}</td>
                        </tr>

                  </tbody>

              </table>

          </div>

      </div>



  </div>
  <br>
  <center><a href="#" class="btn btn-danger btn-sm print w-40" onclick="window.print();">Print Now</a></center><br>
</div>


</div>



<style type="text/css">
  @media  print
  {


    @page  {
        /*size: 7in 15.00in;*/
        margin: 1mm 1mm 1mm 1mm;
        padding: 10px;
    }

    .print{
        display: none;
    }

    .invoice span{
        font-size: 22px;
    }
    /*@page  { size: 10cm 20cm landscape; }*/

}

</style>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>



