

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
  <title>Member Statement Reports</title>
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
            <td colspan="8"><h5 class="p-1">গ্রাহকের  স্টেটমেন্ট রিপোর্ট</h5></td>
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



        <div class="row">



          <div class="col-md-12">

            <table class="table-bordered w-100 mt-3">

              <thead>
                <tr>
                  <th>সিরিয়াল</th>
                  <th>তারিখ</th>
                  <th>সদস্য আইডি</th>
                  <th>আবেদনকারীর নাম</th>
                  <th>পিতার নাম</th>
                  <th>ফোন</th>
                  <th>ঠিকানা</th>id
                  <th>সঞ্চয় আইডি</th>
                  <th>ফিক্সড ডিপোজিট আইডি</th>
                  <th>বিনিয়োগ  আইডি</th>
                </tr>
              </thead>

              <tbody>

                @php $i = 1; @endphp
                @if(isset($member))
                @foreach($member as $d)

                @php
                $deposite = DB::table("fixed_deposit_registrations")
                ->where("member_id",$d->member_id)
                ->get();

                $savings = DB::table("saving_registrations")
                ->where("member_id",$d->member_id)
                ->get();

                $investor = DB::table("investor_registrations")
                ->where("member_id",$d->member_id)
                ->get();
                @endphp

                <tr>
                  <td>{{ $i++ }}</td>
                  <td>{{ $d->apply_date }}</td>
                  <td>{{ $d->member_id }}</td>
                  <td>{{ $d->aplicant_name }}</td>
                  <td>{{ $d->father_name }}</td>
                  <td>{{ $d->phone }}</td>
                  <td>{{ $d->present_address }}</td>
                   <td>
                    @if(isset($savings))
                    @foreach($savings as $savingss)
                    {{ $savingss->registration_id }}<br>
                    @endforeach
                    @endif
                  </td>
                  <td>
                    @if(isset($deposite))
                    @foreach($deposite as $deposites)
                    {{ $deposites->registration_id }}<br>
                    @endforeach
                    @endif
                  </td>
                 
                  <td>
                    @if(isset($investor))
                    @foreach($investor as $investors)
                    {{ $investors->registration_id }}<br>
                    @endforeach
                    @endif
                  </td>
                </tr>

                @endforeach
                @endif

              </tbody>

            </table>
          </div>



        </div>



      </div>

    </div>



  </div>
  <br>
  <center><a href="#" class="btn btn-danger btn-sm print w-40" onclick="window.print();">Print Now</a></center><br>
</div>


</div>



<style type="text/css">
table{
    text-align: left !important;
}
table, tr, td{
    padding-left: 10px;
}
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



