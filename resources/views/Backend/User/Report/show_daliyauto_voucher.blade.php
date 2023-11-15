

  @php
  $company_info = DB::table("company_informations")->first();
  @endphp


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <title>Daily Auto Voucher</title>
    
</head>
<style>
    body{
        font-family: 'Noto Serif Bengali', serif;
        font-size: 14px;
        padding:20px;
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

    td{border-right: 1px #000 solid;border-bottom: 1px #000 solid; padding:3px; }
    .text-right{
      text-align: right;
    }
</style>
<body >

    <table  cellpadding="0" cellspacing="0" style="border-bottom: 2px #000 dotted; " >
        <tr>    
            <td style="width:10%;border:none;" align="right"></td>
            <td align="center" style="border:none;">
                <label style="widtd:150px;">
          

                    <img src="{{ asset("Backend/images/".$company_info->logo) }}"  style="max-height: 120px;max-widtd: 120px; float: left; clear: right;"></label>
                <label> 
                    <span style="font-size:24px; "> {{ $company_info->company_name }}</span><br>
                    <span style="font-size:16px; ">{{ $company_info->address }}<br>
                       {{ $company_info->email }}, Phone-{{ $company_info->phone }}, {{ $company_info->phone_2 }}</span><br>

                        <b style="font-size:18px; margin-bottom: 5px; ">দৈনিক অটো ভাউচার</b><br>
                </label>

            </td>
            <td style="width:20%;border:none;"> </td>
        </tr>
    </table>

     <table  cellpadding="0" cellspacing="0"  >
            <tr>
                <td  style="text-align: left; background: #f4f4f4; padding: 5px; ">ব্রাঞ্চ নাম: <b>100 হেড অফিস</b></td>    

                <td  style="text-align: left; background: #f4f4f4; padding: 5px; "><b>
                 
                                17-04-2023 থেকে 18-04-2023 পর্যন্ত
                  </b></td>
                

               
                <td  style="text-align: right;background: #f4f4f4;">প্রিন্ট সময় ও তারিখ :<b><?php print date('d-M-Y h:i:sa'); ?>  </b></td>
            </tr>
</table>




            <table  cellpadding="0" cellspacing="0" >

              <thead>
                
                  <tr>
                      <th style="border-left:1px solid #000; "></th>
                      <th style=" text-align: center; " colspan="2">গ্রহণ</th>
                      
                      <th style="border-left:1px solid #000;" width="3%" ></th>
                      <th style="border-left:1px solid #000;"  ></th>
                      <th style=" text-align: center; "></th>
                      <th style="border-right:1px solid #000; text-align: center; " >প্রদান</th>
            
                  </tr>

                  <tr>
                      <th class="text-center" style="border-left:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000; ">ক্রমিক নং</th>

                      <th style="border-left:1px solid #000;border-top:1px solid #000; border-bottom:1px solid #000;">বিবরণ</th>

                      <th style="border-left:1px solid #000;border-top:1px solid #000; border-bottom:1px solid #000;">টাকার পরিমাণ</th>
                       <th style="border-left:1px #000 solid;border-bottom:1px #000 solid;border-top:1px #000 solid;"></th>
                      <th style="border-top:1px solid #000;border-bottom:1px solid #000;border-left:1px solid #000; ">ক্রমিক নং</th>
                      <th style="border-left:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000; ">বিবরণ</th>
                      <th style="border-left:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;border-right:1px solid #000; ">টাকার পরিমাণ</th>
                  </tr>
              </thead>

              <tbody>
                  <tr>
                      <td class="text-center" style="border-left:1px #000 solid; ">০১</td>
                      <td>গত দিনের হাতে নগদ</td>
                      <td class="text-right">{{$cash_in_hand}}</td>
                      <td></td>
                      <td class="text-center">০১</td>
                      <td>বেতন প্রদান</td>
                      <td class="text-right">{{$cash_expenses->salary_expense}}</td>
                  </tr>
                  <tr>
                      <td class="text-center"style="border-left:1px #000 solid; ">০২</td>
                      <td>সার্ভিস চার্জ আদায়</td>
                      <td class="text-right">{{$cash_incomes->collection_service_charge}}</td>
                      <td></td>
                      <td class="text-center">০২</td>
                      <td>অফিস ভাড়া</td>
                      <td class="text-right">{{$cash_expenses->office_rent}}</td>
                  </tr>
                  <tr>
                      <td class="text-center"style="border-left:1px #000 solid; ">০৩</td>
                      <td>এককালিন সার্ভিস চার্জ</td>
                      <td class="text-right">{{$cash_incomes->one_time_service_charge}}</td>
                      <td></td>
                      <td class="text-center">০৩</td>
                      <td>যাতায়াত</td>
                      <td class="text-right">{{$cash_expenses->transport}}</td>
                  </tr>
                  <tr>
                      <td class="text-center"style="border-left:1px #000 solid; ">০৪</td>
                      <td>ভর্তি / ফরম</td>
                      <td class="text-right">{{$cash_incomes->admission_fee}}</td>
                      <td></td>
                      <td class="text-center">০৪</td>
                      <td>সাধারণ খরচ</td>
                      <td class="text-right">{{$cash_expenses->general_expense}}</td>
                  </tr>
                  <tr>
                      <td class="text-center"style="border-left:1px #000 solid; ">০৫</td>
                      <td>-</td>
                      <td class="text-right">-</td>
                      <td></td>
                      <td class="text-center">০৫</td>
                      <td>বিদ্যুৎ বিল</td>
                      <td class="text-right">{{$cash_expenses->electricity_bill}}</td>
                  </tr>
                  <tr>
                      <td class="text-center"style="border-left:1px #000 solid; ">০৬</td>
                      <td>H/O হিসাব</td>
                      <td class="text-right">{{$cash_incomes->ho_income}}</td>
                      <td></td>
                      <td class="text-center">০৬</td>
                      <td>সঞ্চয় সঞ্চিতি ব্যায়</td>
                      <td class="text-right">{{$cash_expenses->saving_accumulation_expense}}</td>
                  </tr>
                  <tr>
                      <td class="text-center"style="border-left:1px #000 solid; " >০৭</td>
                      <td>তৃতীয় পক্ষ গ্রহণ</td>
                      <td class="text-right" >{{$cash_incomes->third_party}}</td>
                      <td></td>
                      <td class="text-center">০৮</td>
                      <td>ঋণ সঞ্চিতি ব্যায়</td>
                      <td class="text-right">{{$cash_expenses->loan_accumulation_expense}}</td>
                  </tr>
                  <tr>
                      <td class="text-center"style="border-left:1px #000 solid; ">০৮</td>
                      <td>সঞ্চয় আদায়</td>
                      <td class="text-right">{{$cash_incomes->savings_collection}}</td>
                      <td></td>
                      <td class="text-center">০৯</td>
                      <td>আপ্যায়ন</td>
                      <td class="text-right">{{$cash_expenses->hospitality}}</td>
                  </tr>
                  <tr>
                      <td class="text-center" style="border-left:1px #000 solid; ">১০</td>
                      <td>মাসিক সঞ্চয় আদায়</td>
                      <td class="text-right">{{$cash_incomes->monthly_saving_collection	}}</td>
                      <td></td>
                      <td class="text-center">১০</td>
                      <td>বোনাস</td>
                      <td class="text-right">{{$cash_expenses->bonus}}</td>
                  </tr>
                  <tr>
                      <td class="text-center"style="border-left:1px #000 solid; ">১১</td>
                      <td>এককালিন সঞ্চয়</td>
                      <td class="text-right">{{$cash_incomes->onetime_saving}}</td>
                      <td></td>
                      <td class="text-center">১১</td>
                      <td>সঞ্চয় ফেরৎ</td>
                      <td class="text-right">{{$cash_expenses->saving_return}}</td>
                  </tr>
                  <tr>
                      <td class="text-center"style="border-left:1px #000 solid; ">১২</td>
                      <td>সঞ্চয় সঞ্চিতি দায়</td>
                      <td class="text-right">{{$cash_incomes->saving_accumulation}}</td>
                      <td></td>
                      <td class="text-center">১২</td>
                      <td>মাসিক সঞ্চয় ফেরৎ</td>
                      <td class="text-right">{{$cash_expenses->monthly_saving_return}}</td>
                  </tr>
                  <tr>
                      <td class="text-center"style="border-left:1px #000 solid; ">১৩</td>
                      <td>ঋণ সঞ্চিতি দায়</td>
                      <td class="text-right">{{$cash_incomes->loan_accumulation}}</td>
                      <td></td>
                      <td class="text-center">১৩</td>
                      <td>এককালিন সঞ্চয় ফেরৎ</td>
                      <td class="text-right">{{$cash_expenses->onetime_saving_return}}</td>
                  </tr>
                  <tr>
                      <td class="text-center"style="border-left:1px #000 solid; ">১৪</td>
                      <td>ঋণ আদায়</td>
                      <td class="text-right">{{$cash_incomes->loan_collection}}</td>
                      <td></td>
                      <td class="text-center">১৪</td>
                      <td>H/O হিসাব</td>
                      <td class="text-right">{{$cash_expenses->ho_expense}}</td>
                  </tr>
                  <tr>
                      <td class="text-center"style="border-left:1px #000 solid; ">১৫</td>
                      <td>সাইঃ/মটর সাইঃ আঃ</td>
                      <td class="text-right">{{$cash_incomes->vehicle_income}}</td>
                      <td></td>
                      <td class="text-center">১৫</td>
                      <td>তৃতীয় পক্ষ</td>
                      <td class="text-right">{{$cash_expenses->third_pary_expense}}</td>
                  </tr>
                  <tr>
                      <td class="text-center"style="border-left:1px #000 solid; ">১৬</td>
                      <td>ষ্টেশনারী বিক্রয়</td>
                      <td class="text-right">{{$cash_incomes->stationary_income}}</td>
                      <td></td>
                      <td class="text-center">১৬</td>
                      <td>সঞ্চয় সঞ্চিতি ফেরৎ</td>
                      <td class="text-right">{{$cash_expenses->saving_accumulation_return}}</td>
                  </tr>
                  <tr>
                      <td class="text-center"style="border-left:1px #000 solid; ">১৭</td>
                      <td>ঝুঁকি হতবিল</td>
                      <td class="text-right">{{$cash_incomes->venture_funds}}</td>
                      <td></td>
                      <td class="text-center">১৭</td>
                      <td>ঋণ সঞ্চিতি ফেরৎ</td>
                      <td class="text-right">{{$cash_expenses->loan_accumulation_return}}</td>
                  </tr>
                  <tr>
                      <td class="text-center"style="border-left:1px #000 solid; ">১৮</td>
                      <td>ভবিষ্যৎ তহবিল</td>
                      <td class="text-right">{{$cash_incomes->future_funds}}</td>
                      <td></td>
                      <td class="text-center">১৮</td>
                      <td>ঋণ বিতরণ</td>
                      <td class="text-right">{{$cash_expenses->loan_distribution}}</td>
                  </tr>
                  <tr>
                      <td class="text-center"style="border-left:1px #000 solid; ">১৯</td>
                      <td>ঘর ভাড়া অগ্রিম</td>
                      <td class="text-right">{{$cash_incomes->house_rent_advance}}</td>
                      <td></td>
                      <td class="text-center">১৯</td>
                      <td>ঋণের সার্ভিস চার্জ</td>
                      <td class="text-right">{{$cash_expenses->loan_service_charge}}</td>
                  </tr>
                  <tr>
                      <td class="text-center"style="border-left:1px #000 solid; ">২০</td>
                      <td>সান্ড্রি হিসাব</td>
                      <td class="text-right">{{$cash_incomes->sundry_income}}</td>
                      <td></td>
                      <td class="text-center">২০</td>
                      <td>সাইঃ/মটর সাইঃ বিঃ</td>
                      <td class="text-right">{{$cash_expenses->vehicle_expense}}</td>
                  </tr>
                  <tr>
                      <td class="text-center"style="border-left:1px #000 solid; ">২১</td>
                      <td>কর্মী কল্যাণ</td>
                      <td class="text-right">{{$cash_incomes->employee_income}}</td>
                      <td></td>
                      <td class="text-center">২১</td>
                      <td>ঘর ভাড়া অগ্রিম</td>
                      <td class="text-right">{{$cash_expenses->advance_house_rent}}</td>
                  </tr>
                  <tr>
                      <td class="text-center"style="border-left:1px #000 solid; ">২২</td>
                      <td>অফিস আদায়</td>
                      <td class="text-right">{{$cash_incomes->office_collection}}</td>
                      <td></td>
                      <td class="text-center">২২</td>
                      <td>ভবিষ্যত তহবিল ফেঃ</td>
                      <td class="text-right">{{$cash_expenses->future_fund_return}}</td>
                  </tr>
                  <tr>
                      <td class="text-center"style="border-left:1px #000 solid; ">২৩</td>
                      <td>বিবিধ</td>
                      <td class="text-right">{{$cash_incomes->others}}</td>
                      <td></td>
                      <td class="text-center">২৩</td>
                      <td>সান্ড্রি হিসাব</td>
                      <td class="text-right">{{$cash_expenses->sundry_expense}}</td>
                  </tr>
                  <tr>
                      <td class="text-center"style="border-left:1px #000 solid; ">২৪</td>
                      <td>-</td>
                      <td class="text-right">-</td>
                      <td></td>
                      <td class="text-center">২৪</td>
                      <td>ঝুঁকি হতবিল উওলন</td>
                      <td class="text-right">{{$cash_expenses->risk_fund_withdraw}}</td>
                  </tr>
                  <tr>
                      <td class="text-center"style="border-left:1px #000 solid; ">২৫</td>
                      <td>-</td>
                      <td class="text-right">-</td>
                      <td></td>
                      <td class="text-center">২৫</td>
                      <td>মামলা খরচ</td>
                      <td class="text-right">{{$cash_expenses->case_expense}}</td>
                  </tr>
                  <tr>
                      <td class="text-center"style="border-left:1px #000 solid; ">২৬</td>
                      <td>-</td>
                      <td class="text-right">-</td>
                      <td></td>
                      <td class="text-center">২৬</td>
                      <td>পাহাড়া</td>
                      <td class="text-right">{{$cash_expenses->case_expense}}</td>
                  </tr>
                  <tr>
                    
                    <th class="text-right" colspan="2" style="border-left:1px #000 solid; border-bottom:1px #000 solid; border-right:1px #000 solid; ">মোট :&nbsp;</th>
                    <th class="text-right"style=" border-bottom:1px #000 solid; border-right:1px #000 solid; ">{{$cash_info->debit}}&nbsp;</th>
                    <th style="border-bottom:1px #000 solid;  "></th>
                
                    <th class="text-right"colspan="2" style="border-left:1px #000 solid; border-bottom:1px #000 solid; border-right:1px #000 solid; ">মোট :&nbsp; </th>
                    <th class="text-right"style=" border-bottom:1px #000 solid; border-right:1px #000 solid; ">{{$cash_info->credit}} &nbsp;</th>
                  </tr>
              </tbody>

          </table>
          <br>
          <br>
          <table  style="width:100%;" style="border: none !important">
            <tr style="border:none">
                <td style="width:30%;text-align: center; border: none">
                  
                </td>
                <td style="width:40%;text-align: center; border: none">

                </td>
                <td style="width:30%; text-align: center; border: none"><br>
                    ---------------------------------- <br>
                    <span>
    শাখা ব্যবস্থাপকের স্বাক্ষর</span>
                </td>
            </tr>
            <tr class="print">
                <td colspan="3"  align="center" style="border: none"><input type="button" value="Print" name="print" onclick="window.print()" style="height:35px; width: 120px; background: #ff0000; color: #fff; border-radius:5px;"></td>
            </tr>
        </table>
  



<style type="text/css">



.text-center{
    text-align:center;
}
table{
width : 100%;
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


</body>
</html>





