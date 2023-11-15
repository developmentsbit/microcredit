



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
  <title>Daily Auto Voucher</title>
</head>
<body style="font-family: 'Montserrat','Tiro Bangla', serif; font-size: 14px;">

  @php
  $company_info = DB::table("company_informations")->first();
  @endphp


  <div class="">


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

      <div class="card-body p-3">






        <table class="">
          <tr>
            <td colspan="8" class="text-center"><h5 class="p-1">দৈনিক অটো ভাউচার</h5></td>
          </tr>
          
        </table>


        <div class="row">



          <div class="col-md-12">
            <form method="POST" action="{{url('submitCashCloseReport')}}">
            @csrf
            <input type="hidden" name="branch_id" value="{{$branch_id}}">
            <input type="hidden" name="cash_close_date" value="{{$cash_date}}">
            <table class="">

              <thead>
                  <tr>
                      <td colspan="8" class="text-right">০১/০১/২০২৩ থেকে ০১/০২/২০২৩ পর্যন্ত</td>
                  </tr>
                  <tr>
                      <th></th>
                      <th style="text-align:center;">গ্রহণ</th>
                      <th></th>
                      <th style="width:3%"></th>
                      <th ></th>
                      <th style="text-align:center;">প্রদান</th>
                      <th></th>
                  </tr>
                  <tr>
                      <th class="text-center" style="width : 5%">ক্রমিক নং</th>
                      <th style="text-align:center;">বিবরণ</th>
                      <th class="text-center" style="width : 15%">টাকার পরিমাণ</th>
                      <th></th>
                      <th class="text-center" style="width : 5%">ক্রমিক নং</th>
                      <th style="text-align:center;">বিবরণ</th>
                      <th class="text-center" style="width : 15%">টাকার পরিমাণ</th>
                  </tr>
              </thead>

              <tbody>
                  <tr>
                      <td class="text-center">০১</td>
                      <td>গত দিনের হাতে নগদ</td>
                      <td class="text-right">{{$cash_in_hand}}</td>
                      <td></td>
                      <td class="text-center">০১</td>
                      <td>বেতন প্রদান</td>
                      <td class="text-right"><input type="text" name="salary_expense" value="20000"></td>
                  </tr>
                  <tr>
                      <td class="text-center">০২</td>
                      <td>সার্ভিস চার্জ আদায়</td>
                      <td class="text-right"><input type="text" name="collection_service_charge" value="{{$total_service_charge}}"></td>
                      <td></td>
                      <td class="text-center">০২</td>
                      <td>অফিস ভাড়া</td>
                      <td class="text-right"><input type="text" name="office_rent" value="10000"></td>
                  </tr>
                  <tr>
                      <td class="text-center">০৩</td>
                      <td>এককালিন সার্ভিস চার্জ</td>
                      <td class="text-right"><input type="text" name="one_time_service_charge" value="50000"></td>
                      <td></td>
                      <td class="text-center">০৩</td>
                      <td>যাতায়াত</td>
                      <td class="text-right"><input type="text" name="transport" value="5000"></td>
                  </tr>
                  <tr>
                      <td class="text-center">০৪</td>
                      <td>ভর্তি / ফরম</td>
                      <td class="text-right"><input type="text" name="admission_fee" value="{{$admission_fee}}"></td>
                      <td></td>
                      <td class="text-center">০৪</td>
                      <td>সাধারণ খরচ</td>
                      <td class="text-right"><input type="text" name="general_expense" value="4500"></td>
                  </tr>
                  <tr>
                      <td class="text-center">০৫</td>
                      <td>-</td>
                      <td class="text-right">-</td>
                      <td></td>
                      <td class="text-center">০৫</td>
                      <td>বিদ্যুৎ বিল</td>
                      <td class="text-right"><input type="text" name="electricity_bill" value="8500"></td>
                  </tr>
                  <tr>
                      <td class="text-center">০৬</td>
                      <td>H/O হিসাব</td>
                      <td class="text-right"><input type="text" name="ho_income" value="{{$ho_income}}"></td>
                      <td></td>
                      <td class="text-center">০৬</td>
                      <td>সঞ্চয় সঞ্চিতি ব্যায়</td>
                      <td class="text-right"><input type="text" name="saving_accumulation_expense" value="56000"></td>
                  </tr>
                  <tr>
                      <td class="text-center">০৭</td>
                      <td>তৃতীয় পক্ষ গ্রহণ</td>
                      <td class="text-right"><input type="text" name="third_party" value="50000"></td>
                      <td></td>
                      <td class="text-center">০৮</td>
                      <td>ঋণ সঞ্চিতি ব্যায়</td>
                      <td class="text-right"><input type="text" name="loan_accumulation_expense" value="45000"></td>
                  </tr>
                  <tr>
                      <td class="text-center">০৮</td>
                      <td>সঞ্চয় আদায়</td>
                      <td class="text-right"><input type="text" name="savings_collection" value="{{$savings_collection}}"></td>
                      <td></td>
                      <td class="text-center">০৯</td>
                      <td>আপ্যায়ন</td>
                      <td class="text-right"><input type="text" name="hospitality" value="500"></td>
                  </tr>
                  <tr>
                      <td class="text-center">১০</td>
                      <td>মাসিক সঞ্চয় আদায়</td>
                      <td class="text-right"><input type="text" name="monthly_saving_collection" value="{{$monthly_saving_collection}}"></td>
                      <td></td>
                      <td class="text-center">১০</td>
                      <td>বোনাস</td>
                      <td class="text-right"><input type="text" name="bonus" value="10000"></td>
                  </tr>
                  <tr>
                      <td class="text-center">১১</td>
                      <td>এককালিন সঞ্চয়</td>
                      <td class="text-right"><input type="text" name="onetime_saving" value="45000"></td>
                      <td></td>
                      <td class="text-center">১১</td>
                      <td>সঞ্চয় ফেরৎ</td>
                      <td class="text-right"><input type="text" name="saving_return" value="78000"></td>
                  </tr>
                  <tr>
                      <td class="text-center">১২</td>
                      <td>সঞ্চয় সঞ্চিতি দায়</td>
                      <td class="text-right"><input type="text" name="saving_accumulation" value="85000"></td>
                      <td></td>
                      <td class="text-center">১২</td>
                      <td>মাসিক সঞ্চয় ফেরৎ</td>
                      <td class="text-right"><input type="text" name="monthly_saving_return" value="8000"></td>
                  </tr>
                  <tr>
                      <td class="text-center">১৩</td>
                      <td>ঋণ সঞ্চিতি দায়</td>
                      <td class="text-right"><input type="text" name="loan_accumulation" value="12000"></td>
                      <td></td>
                      <td class="text-center">১৩</td>
                      <td>এককালিন সঞ্চয় ফেরৎ</td>
                      <td class="text-right"><input type="text" name="onetime_saving_return" value="20000"></td>
                  </tr>
                  <tr>
                      <td class="text-center">১৪</td>
                      <td>ঋণ আদায়</td>
                      <td class="text-right"><input type="text" name="loan_collection" value="30000"></td>
                      <td></td>
                      <td class="text-center">১৪</td>
                      <td>H/O হিসাব</td>
                      <td class="text-right"><input type="text" name="ho_expense" value="45000"></td>
                  </tr>
                  <tr>
                      <td class="text-center">১৫</td>
                      <td>সাইঃ/মটর সাইঃ আঃ</td>
                      <td class="text-right"><input type="text" name="vehicle_income" value="10000"></td>
                      <td></td>
                      <td class="text-center">১৫</td>
                      <td>তৃতীয় পক্ষ</td>
                      <td class="text-right"><input type="text" name="third_pary_expense" value="25000"></td>
                  </tr>
                  <tr>
                      <td class="text-center">১৬</td>
                      <td>ষ্টেশনারী বিক্রয়</td>
                      <td class="text-right"><input type="text" name="stationary_income" value="38000"></td>
                      <td></td>
                      <td class="text-center">১৬</td>
                      <td>সঞ্চয় সঞ্চিতি ফেরৎ</td>
                      <td class="text-right"><input type="text" name="saving_accumulation_return" value="75000"></td>
                  </tr>
                  <tr>
                      <td class="text-center">১৭</td>
                      <td>ঝুঁকি হতবিল</td>
                      <td class="text-right"><input type="text" name="venture_funds" value="46000"></td>
                      <td></td>
                      <td class="text-center">১৭</td>
                      <td>ঋণ সঞ্চিতি ফেরৎ</td>
                      <td class="text-right"><input type="text" name="loan_accumulation_return" value="52000"></td>
                  </tr>
                  <tr>
                      <td class="text-center">১৮</td>
                      <td>ভবিষ্যৎ তহবিল</td>
                      <td class="text-right"><input type="text" name="future_funds" value="78000"></td>
                      <td></td>
                      <td class="text-center">১৮</td>
                      <td>ঋণ বিতরণ</td>
                      <td class="text-right"><input type="text" name="loan_distribution" value="222000"></td>
                  </tr>
                  <tr>
                      <td class="text-center">১৯</td>
                      <td>ঘর ভাড়া অগ্রিম</td>
                      <td class="text-right"><input type="text" name="house_rent_advance" value="15000"></td>
                      <td></td>
                      <td class="text-center">১৯</td>
                      <td>ঋণের সার্ভিস চার্জ</td>
                      <td class="text-right"><input type="text" name="loan_service_charge" value="35000"></td>
                  </tr>
                  <tr>
                      <td class="text-center">২০</td>
                      <td>সান্ড্রি হিসাব</td>
                      <td class="text-right"><input type="text" name="sundry_income" value="48000"></td>
                      <td></td>
                      <td class="text-center">২০</td>
                      <td>সাইঃ/মটর সাইঃ বিঃ</td>
                      <td class="text-right"><input type="text" name="vehicle_expense" value="75000"></td>
                  </tr>
                  <tr>
                      <td class="text-center">২১</td>
                      <td>কর্মী কল্যাণ</td>
                      <td class="text-right"><input type="text" name="employee_income" value="86000"></td>
                      <td></td>
                      <td class="text-center">২১</td>
                      <td>ঘর ভাড়া অগ্রিম</td>
                      <td class="text-right"><input type="text" name="advance_house_rent" value="89000"></td>
                  </tr>
                  <tr>
                      <td class="text-center">২২</td>
                      <td>অফিস আদায়</td>
                      <td class="text-right"><input type="text" name="office_collection" value="86000"></td>
                      <td></td>
                      <td class="text-center">২২</td>
                      <td>ভবিষ্যত তহবিল ফেঃ</td>
                      <td class="text-right"><input type="text" name="future_fund_return" value="90000"></td>
                  </tr>
                  <tr>
                      <td class="text-center">২৩</td>
                      <td>বিবিধ</td>
                      <td class="text-right"><input type="text" name="others" value="101000"></td>
                      <td></td>
                      <td class="text-center">২৩</td>
                      <td>সান্ড্রি হিসাব</td>
                      <td class="text-right"><input type="text" name="sundry_expense" value="56000"></td>
                  </tr>
                  <tr>
                      <td class="text-center">২৪</td>
                      <td>-</td>
                      <td class="text-right">-</td>
                      <td></td>
                      <td class="text-center">২৪</td>
                      <td>ঝুঁকি হতবিল উওলন</td>
                      <td class="text-right"><input type="text" name="risk_fund_withdraw" value="45000"></td>
                  </tr>
                  <tr>
                      <td class="text-center">২৫</td>
                      <td>-</td>
                      <td class="text-right">-</td>
                      <td></td>
                      <td class="text-center">২৫</td>
                      <td>মামলা খরচ</td>
                      <td class="text-right"><input type="text" name="case_expense" value="45600"></td>
                  </tr>
                  <tr>
                      <td class="text-center">২৬</td>
                      <td>-</td>
                      <td class="text-right">-</td>
                      <td></td>
                      <td class="text-center">২৬</td>
                      <td>পাহাড়া</td>
                      <td class="text-right"><input type="text" name="security_expense" value="83000"></td>
                  </tr>
              </tbody>

          </table>
          <br>
          <center><input href="#" type="submit" class="btn btn-danger btn-sm print w-40" value="Submit"></center><br>
          </form>
        </div>



      </div>



    </div>

  </div>



</div>
<br>

</div>


</div>



<style type="text/css">
.text-center{
    text-align:center;
}
table{
width : 100%;
}
table, th, td{
    border : 1px solid black;
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





