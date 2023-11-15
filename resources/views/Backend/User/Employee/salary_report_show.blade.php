
<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
	<!--<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>-->
	<!--<link href="https://fonts.googleapis.com/css2?family=Tiro+Bangla:ital@0;1&display=swap" rel="stylesheet">-->
	<!--<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet">-->

	
	<style type="text/css">
		input{
			width:60px;
			height:20px;
		}
	</style>
</head>
<body style="font-family: 'Montserrat','Tiro Bangla', serif; font-size: 14px;">

	@php
	$branch_id = $_GET['branch_id'];
	$company_info = DB::table("company_informations")->first();
	$branchName = DB::table('branch_infos')->where('id',$branch_id)->first();
	@endphp


	<div class="container-fluid p-0">

		<form method="post" action="{{ url("depositeemployeesalary") }}">
			@csrf
			<input type="hidden" name="branch_id" id="branch_id" value="{{$branch_id}}">
			<table  cellpadding="0" cellspacing="0" style="border-bottom: 2px #000 dotted; width: 100%;" >
				<tr>    
					<td style="width:10%" align="right"></td>
					<td align="center">
						<label style="widtd:150px;">
							<img src="{{ asset("Backend/images/".$company_info->logo) }}"  style="max-height: 120px;max-widtd: 120px; float: left; clear: right;"></label>
							<label> 
								<span style="font-size:30px; "> শ্যামল ছায়া সমাজকল্যাণ সংস্থা</span><br>
								<span style="font-size:16px; ">আতা, মাদ্রা, নেছারাবাদ, পিরোজপুর ।<br>
								scsks2016@gmail.com, Phone-01721653785, 01880668788</span><br>

								<b style="font-size:18px; margin-bottom: 5px; ">মাসিক কর্মকর্তা ও কর্মচারী বেতন</b><br>
								<b style="font-size:18px; margin-bottom: 5px; ">ব্রাঞ্চ নাম : {{$branchName->branch_name}}</b><br>
							</label>

						</td>
						<td style="width:20%"></td>
					</tr>
				</table>



				<table cellpadding="0" cellspacing="0"  width="100%" style="padding:5px;">
					<tr>
						<td> 
						    Month : 
							@if($month == '01') 
							January 
							@elseif($month == '02') 
							February 
							@elseif($month == '03') 
							March
							@elseif($month == '04')
							April
							@elseif($month == '05')
							May
							@elseif($month == '06')
							June
							@elseif($month == '07')
							July
							@elseif($month == '08')
							August
							@elseif($month == '09')
							September
							@elseif($month == '10')
							October
							@elseif($month == '11')
							November
							@elseif($month == '12')
							December
							@endif
							- {{$year}}
						</td>

					</tr>

				</table>

				<br>

				<table cellpadding="0" cellspacing="0"  width="100%">

					<tr>
						<td rowspan="2" align="center" valign="top" style="border-left: 1px #000 solid;border-top: 1px #000 solid; border-bottom: 1px #000 solid; ">সিরিয়াল</td>
						<td rowspan="2" align="center" valign="top"style="border-left: 1px #000 solid;border-top: 1px #000 solid;  border-bottom: 1px #000 solid; min-width: 150px; ">নাম</td>

						<td rowspan="2" align="center" valign="top" style="border-left: 1px #000 solid;border-top: 1px #000 solid;  border-bottom: 1px #000 solid; ">বেতন স্কেল</td>
						<td rowspan="2" align="center" valign="top" style="border-left: 1px #000 solid;border-top: 1px #000 solid;  border-bottom: 1px #000 solid; ">ইনক্রিমেন্টর<br>
						পরিমাণ</td>
						<td rowspan="2" align="center" valign="top" style="border-left: 1px #000 solid;border-top: 1px #000 solid;  border-bottom: 1px #000 solid; ">মোট  বেতন</td>					
						<td colspan="5" align="center" valign="top" style="border-left: 1px #000 solid;border-top: 1px #000 solid;  ">ভাতাদি</td>		
						<td rowspan="2" align="center" valign="top" style="border-left: 1px #000 solid;border-top: 1px #000 solid;  border-bottom: 1px #000 solid; ">মোট প্রাপ্য বেতন</td>	
						<td colspan="4" align="center" valign="top" style="border-left: 1px #000 solid;border-top: 1px #000 solid;  ">কর্তন সমূহ</td>		
						<td rowspan="2" align="center" border-bottom: 1px #000 solid; valign="top" style="border-left: 1px #000 solid;border-top: 1px #000 solid;  border-bottom: 1px #000 solid; ">মোট কর্তন	</td>		
						<td rowspan="2" align="center" valign="top" style="border-left: 1px #000 solid;border-top: 1px #000 solid;border-right: 1px #000 solid;  border-bottom: 1px #000 solid; ">নীট প্রাপ্তী</td>		
					</tr>

					<tr>
						<td align="center" valign="top" style="border-left: 1px #000 solid; border-top: 1px #000 solid; border-bottom: 1px #000 solid;">বাড়ী ভাড়া</td>
						<td align="center" valign="top" style="border-left: 1px #000 solid; border-top: 1px #000 solid; border-bottom: 1px #000 solid;">যাতায়াত ভাতা</td>
						<td align="center" valign="top" style="border-left: 1px #000 solid; border-top: 1px #000 solid; border-bottom: 1px #000 solid;">মোবাইল বিল</td>
						<td align="center" valign="top" style="border-left: 1px #000 solid; border-top: 1px #000 solid; border-bottom: 1px #000 solid;">চিকিৎসা ভাতা	</td>
						<td align="center" valign="top" style="border-left: 1px #000 solid; border-top: 1px #000 solid; border-bottom: 1px #000 solid;">অন্যান্য</td>	

						<td align="center" valign="top" style="border-left: 1px #000 solid; border-top: 1px #000 solid; border-bottom: 1px #000 solid;">জি.পি	</td>
						<td align="center" valign="top" style="border-left: 1px #000 solid; border-top: 1px #000 solid; border-bottom: 1px #000 solid;">মোট জি.পি</td>
						<td align="center" valign="top" style="border-left: 1px #000 solid; border-top: 1px #000 solid; border-bottom: 1px #000 solid;">ম.স কর্তন</td>
						<td align="center" valign="top" style="border-left: 1px #000 solid; border-top: 1px #000 solid; border-bottom: 1px #000 solid;">রেভিনিউ</td>
					</tr>

					@php
					$i = 1;
				
					@endphp

					@if(isset($data))
					@foreach($data as $d)
                    
					<tr>
						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">{{ $i++ }}</td>
						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="left">&nbsp;{{$d->name}}</td>

						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">&nbsp;{{$d->salary_scale}}</td>
						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">&nbsp;{{$d->increment}}</td>
						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">&nbsp;{{$d->total_salary}}</td>
						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">&nbsp;{{$d->home_rent}}</td>
						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">&nbsp;{{$d->travel_bill}}</td>
						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">&nbsp;{{$d->mobile_bill}}</td>
						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">&nbsp;{{$d->treatment_bill}}</td>
						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">&nbsp;{{$d->others}}</td>

						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">&nbsp;{{$d->totalsalaryforothers}}</td>

						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">&nbsp;{{$d->gp}}</td>

						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">&nbsp;{{$d->totalgp}}</td>

						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">&nbsp;{{$d->monthkorton}}</td>
						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">&nbsp;{{$d->revinew}}</td>
						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">&nbsp;{{$d->totalkorton}}</td>
						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; border-right: 1px #000 solid; " align="center">&nbsp;{{$d->netsalary}}</td>

					</tr>
					
					
					@endforeach
					@endif
					
					<tr>
					    <td colspan="2" style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">
					        মোট
					    </td>
					    <td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">{{$total_salary_scale}}</td>
					    <td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">{{$total_increment}}</td>
					    <td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">{{$grandtotal_salary}}</td>
					    <td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">{{$total_home_rent}}</td>
					    <td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">{{$total_travell_bill}}</td>
					    <td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">{{$total_mobile_bill}}</td>
					    <td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">{{$total_treatment_bill}}</td>
					    <td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">{{$total_others}}</td>
					    <td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">{{$total_totalsalaryforothers}}</td>
					    <td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">{{$total_gp}}</td>
					    <td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">{{$total_totalgp}}</td>
					    <td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">{{$total_monthkorton}}</td>
					    <td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">{{$total_revinew}}</td>
					    <td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">{{$total_totalkorton}}</td>
					    <td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid;border-right:1px #000 solid; " align="center">{{$total_netsalary}}</td>
					</tr>

				</table>
				</br>
				</br>
				</br>
				
				<table style="width:100%;">
                    <tr>
                        <td style="width:30%; text-align: center;">
                            ---------------------------------- <br>
                            <span>
                                শাখা ব্যবস্থাপকের স্বাক্ষর</span>
                        </td>
                        <td style="width:30%;text-align: center;">
                            ---------------------------------- <br>
                            <span>যোনাল ম্যানেজারের স্বাক্ষর</span>
                        </td>
                        <td style="width:30%; text-align: center;">
                            ---------------------------------- <br>
                            <span>
                                পরিচালকের স্বাক্ষর</span>
                        </td>
                    </tr>
                    <tr class="print">
                        <td colspan="3" align="center"><input type="button" value="Print" name="print" onclick="window.print()" style="height:35px; width: 120px; background: #ff0000; color: #fff; border-radius:5px;"></td>
                    </tr>
                </table>


				<br><br>


			</form>


		</div>

		<script type="text/javascript">




       function calculatedata(id){

       	var salary_scale      = parseFloat($("#salary_scale"+id).val());
       	var increment         = parseFloat($("#increment"+id).val());
       	var home_rent         = parseFloat($("#home_rent"+id).val());
       	var travel_bill       = parseFloat($("#travel_bill"+id).val());
       	var mobile_bill       = parseFloat($("#mobile_bill"+id).val());
       	var treatment_bill    = parseFloat($("#treatment_bill"+id).val());
       	var others            = parseFloat($("#others"+id).val());
       	
       	var gpinitial         = parseFloat($("#gpinitial"+id).val());


       	var totalsalary = $("#total_salary"+id).val(salary_scale+increment);

       	$("#totalsalaryforothers"+id).val(salary_scale+increment+home_rent+travel_bill+mobile_bill+treatment_bill+others);

       
       	var totalsalaryincreament = salary_scale+increment;
       	var gpper = (totalsalaryincreament/100)*gpinitial;

       	

		var monthkorton = parseFloat($("#monthkorton"+id).val());
		var revinew = parseFloat($("#revinew"+id).val());

		var totalkorton = gpper+monthkorton+revinew;


        $("#totalkorton"+id).val(totalkorton);
        

        var totalsalaryforothers = parseFloat($("#totalsalaryforothers"+id).val());
        var totalkortons          = parseFloat($("#totalkorton"+id).val());

        $("#netsalary"+id).val(totalsalaryforothers-totalkortons);
        
        $("#gp"+id).val(gpper);


       }






      </script>



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

      	input{
      		border: none;
      		padding: 5px;
      	}

      	input[readonly=""]
      	{
      		background-color:#f1f1f1;
      		color: #000;
      	}

      </style>
      
      
      
      
      


      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

      
      	@if(Session::has('success'))
	<script>
		swal('', '{{ session('success') }}', 'success');
	</script>

	@endif

	@if(Session::has('error'))
	<script>
		swal('', '{{ session('error') }}', 'error');
	</script>

	@endif

	@if(Session::has('info'))
	<script>
		swal('', '{{ session('info') }}', 'info');
	</script>

	@endif
      
      
      
     </body>
     </html>



