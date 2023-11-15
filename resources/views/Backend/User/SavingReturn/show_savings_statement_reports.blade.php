
@if(isset($saving))


<!doctype html>
<html lang="en">
<head>
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
            <td colspan="8"><h5 class="p-1">সঞ্চয়  স্টেটমেন্ট রিপোর্ট</h5></td>
          </tr>
          <tr>
            <th>তারিখ:</th>
            <td>{{ date('d M Y') }}</td>


            <th>ব্রাঞ্চ নাম:</th>
            <td>{{ $branch->branch_name }}</td>

            <th>কেন্দ্র নাম:</th>
            <td>{{ $area->area_name }}</td>

            <th>মেম্বার নাম:</th>
            <td>{{ $saving->aplicant_name }} - {{ $saving->registration_id }}</td>

          </tr>
        </table>




        <div class="row">



          <div class="col-md-12">

            <table class="table-bordered w-100 text-center mt-3">

              <thead>
                <tr>
                  <td>সিরিয়াল</td>
                  <td>তারিখ</td>
                  <td>আদায়</td>
                  <td>প্রদান</td>
                  <td>বর্তমান ব্যালেন্স</td>
                </tr>
              </thead>

              <tbody>

                @php $i = 1; @endphp
                @if(isset($savings_collections))
                @foreach($savings_collections as $d)

                @php
                  $deposit_ammount = DB::table("saving_transactions")->where("date",$d->date)->where('member_id',$member_id)->sum("deposit_ammount");
                  $return_ammount = DB::table("saving_transactions")->where("date",$d->date)->where('member_id',$member_id)->sum("return_ammount");
                @endphp

                <tr>
                  <td>{{ $i++ }}</td>
                  <td>{{ $d->date }}</td>
                  <td>
                    @if($deposit_ammount > 0)
                    {{ $deposit_ammount }}/-
                    @else
                    0/-
                    @endif
                  </td>
                  <td>
                    @if($return_ammount > 0)
                    {{ $return_ammount }}/-
                    @else
                    0/-
                    @endif
                  </td>
                  <td>{{ $deposit_ammount - $return_ammount }}/-</td>
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

</body>
</html>



@else


<center>
   No Statement...
</center>

@endif
