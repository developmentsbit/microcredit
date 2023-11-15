
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
    <title>Profile For Investor</title>
</head>
<body style="font-family: 'Montserrat','Tiro Bangla', serif; font-size: 14px;">

    @php
    $company_info = DB::table("company_informations")->first();
    @endphp


    <div class="container mt-4">


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
                        <th>তারিখ:</th>
                        <td>{{ $data->date }}</td>

                        <th>রেজিষ্ট্রেশন আইডি:</th>
                        <td>{{ $data->registration_id }}</td>

                        <th>ব্রাঞ্চ নাম:</th>
                        <td>{{ $branch->branch_name }}</td>

                        <th>কেন্দ্র নাম:</th>
                        <td>{{ $area->area_name }}</td>

                    </tr>
                </table>
                @php
                     $member = DB::table('members')->where('member_id',$data->member_id)->first();
                     @endphp
                <div class="row mt-3">
                    <div class="col-md-6">
                        <table class="table-bordered w-100 text-center">
                         <tr class="bg-light">
                            <th colspan="2">সদস্য তথ্য</th>
                        </tr>

                        <tr>
                         <td class="w-50">নাম:</td>
                         <td class="w-50">{{ $member->aplicant_name }}</td>
                     </tr>
                     <tr>
                         <td class="w-50">ফোন:</td>
                         <td class="w-50">{{ $data->phone }}</td>
                     </tr>
                     
                     <tr>
                         <td class="w-50">স্বাক্ষর:</td>
                         <td class="w-50"><img src="{{asset('Backend/images/MemberImage')}}/{{$member->signature}}" class="img-fluid" style="max-height: 50px;"></td>
                     </tr>
                     <tr>
                         <td class="w-50">জাতীয় পরিচয় পত্র:</td>
                         <td class="w-50"><img src="{{asset('Backend/images/MemberNid')}}/{{$member->applicant_nid}}" class="img-fluid" style="max-height: 65px;"></td>
                     </tr>


                 </table>
             </div>



             <div class="col-md-6">
                <table class="table-bordered w-100 text-center">
                 <tr class="bg-light">
                    <th colspan="2">বিনিয়োগের তথ্য</th>
                </tr>

                <tr>
                 <td class="w-50">বিনিয়োগ স্কিমা :</td>
                 <td class="w-50">{{ $schema->investment_name }}</td>
             </tr>
             <tr>
                 <td class="w-50">বিনিয়োগ পরিমাণ:</td>
                 <td class="w-50">{{ $data->amount }}/-</td>
             </tr>

             <tr>
                 <td class="w-50">মোট:</td>
                 <td class="w-50">{{ $data->totalamount }}/-</td>
             </tr>

             <tr>
                 <td class="w-50">কিস্তির নং:</td>
                 <td class="w-50">{{ $data->installment }}/-</td>
             </tr>

             <tr>
                 <td class="w-50">কিস্তির পরিমাণ:</td>
                 <td class="w-50">{{ $data->installment_amount }}/-</td>
             </tr>

             <tr>
                 <td class="w-50">বিনিয়োগ প্রদানের তারিখ:</td>
                 <td class="w-50">{{ $data->investment_start_date }}</td>
             </tr>

             <tr>
                 <td class="w-50">বিনিয়োগ মেয়াদ উত্তীর্ণের তারিখ:</td>
                 <td class="w-50">{{ $data->investment_end_date }}</td>
             </tr>




         </table>
     </div>

 </div>




 <div class="row mt-3">


    <div class="col-md-6">
     <table class="table-bordered w-100 text-center">
         <tr class="bg-light">
            <th colspan="2">গ্রেন্টার ১</th>
        </tr>

        <tr>
         <td class="w-50">নাম:</td>
         <td class="w-50">{{ $data->go_name }}</td>
     </tr>
     <tr>
         <td class="w-50">ফোন:</td>
         <td class="w-50">{{ $data->go_phone }}</td>
     </tr>

     <tr>
         <td class="w-50">বর্তমান ঠিকানা:</td>
         <td class="w-50">{{ $data->go_address }}</td>
     </tr>


     <tr>
         <td class="w-50">স্বাক্ষর:</td>
         <td class="w-50"><img src="{{asset('Backend/images/InvestorImage')}}/{{$data->go_signature}}" class="img-fluid" style="max-height: 50px;"></td>
     </tr>
     <tr>
         <td class="w-50">জাতীয় পরিচয় পত্র:</td>
         <td class="w-50"><img src="{{asset('Backend/images/goNid')}}/{{$data->go_nid}}" class="img-fluid" style="max-height: 65px;"></td>
     </tr>


 </table>
</div>



<div class="col-md-6">
 <table class="table-bordered w-100 text-center">
     <tr class="bg-light">
        <th colspan="2">গ্রেন্টার ২</th>
    </tr>

    <tr>
     <td class="w-50">নাম:</td>
     <td class="w-50">{{ $data->gt_name }}</td>
 </tr>
 <tr>
     <td class="w-50">ফোন:</td>
     <td class="w-50">{{ $data->gt_phone }}</td>
 </tr>

 <tr>
     <td class="w-50">বর্তমান ঠিকানা:</td>
     <td class="w-50">{{ $data->gt_address }}</td>
 </tr>


 <tr>
     <td class="w-50">স্বাক্ষর:</td>
     <td class="w-50"><img src="{{asset('Backend/images/InvestorImage')}}/{{$data->gt_signature}}" class="img-fluid" style="max-height: 50px;"></td>
 </tr>
 <tr>
     <td class="w-50">জাতীয় পরিচয় পত্র:</td>
     <td class="w-50"><img src="{{asset('Backend/images/gtNid')}}/{{$data->gt_nid}}" class="img-fluid" style="max-height: 65px;"></td>
 </tr>


</table>
</div>




</div>



<div class="row mt-3">


    <div class="col-md-12">
     <table class="table-bordered w-100 text-center">
         <tr class="bg-light">
            <th colspan="2">নমীনীর তথ্য</th>
        </tr>

        <tr>
         <td class="w-50">নাম:</td>
         <td class="w-50">{{ $data->nominee_name }}</td>
     </tr>
     <tr>
         <td class="w-50">ইমেইল:</td>
         <td class="w-50">{{ $data->nominee_email }}</td>
     </tr>

     <tr>
         <td class="w-50">বর্তমান ঠিকানা:</td>
         <td class="w-50">{{ $data->nominee_present_address }}</td>
     </tr>

     <tr>
         <td class="w-50">আবেদনকারীর সাথে সম্পর্ক:</td>
         <td class="w-50">{{ $data->relation_for_applicant }}</td>
     </tr>

     <tr>
         <td class="w-50">ছবি:</td>
         <td class="w-50"><img src="{{asset('Backend/images/InvestorImage')}}/{{$data->nominee_image}}" class="img-fluid" style="max-height: 50px;"></td>
     </tr>

     <tr>
         <td class="w-50">স্বাক্ষর:</td>
         <td class="w-50"><img src="{{asset('Backend/images/InvestorImage')}}/{{$data->nominee_signature}}" class="img-fluid" style="max-height: 50px;"></td>
     </tr>
     <tr>
         <td class="w-50">জাতীয় পরিচয় পত্র:</td>
         <td class="w-50"><img src="{{asset('Backend/images/InvestorNomNid')}}/{{$data->nominee_nid}}" class="img-fluid" style="max-height: 65px;"></td>
     </tr>




 </table>
</div>


</div>











</div>
<center><a href="#" class="btn btn-danger btn-sm print w-40" onclick="window.print();">Print Now</a></center><br>
</div>


</div>



<style type="text/css">

    table, tr, th, td{
        text-align: left;
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



