@if(count($data) > 0)


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
	
		<style type="text/css">
		input{
			width:60px;
			height:20px;
		}
	</style>
</head>
<body style="font-family: 'Montserrat','Tiro Bangla', serif; font-size: 14px;">

	@php
	$company_info = DB::table("company_informations")->first();
	@endphp


	<div class="container-fluid p-0">


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
						<td colspan="8"><h5>কর্মকর্তা / কর্মচারী বেতন</h5></td>
					</tr>

					<form method="post" action="{{ url("employee_salray_confirm_update") }}">
						@csrf
						<div class="row align-items-center">


							<div class="col-md-2">
								<select class="form-control" name="month" required="">
									@if($data[0]->month == "01")
									<option value="01">January</option>
									@elseif($data[0]->month == "02")
									<option value="02">February</option>
									@elseif($data[0]->month == "03")
									<option value="03">March</option>
									@elseif($data[0]->month == "04")
									<option value="04">April</option>
									@elseif($data[0]->month == "05")
									<option value="05">May</option>
									@elseif($data[0]->month == "06")
									<option value="06">June</option>
									@elseif($data[0]->month == "07")
									<option value="07">July</option>
									@elseif($data[0]->month == "08")
									<option value="08">August </option>
									@elseif($data[0]->month == "09")
									<option value="09">September </option>
									@elseif($data[0]->month == "10")
									<option value="10">October </option>
									@elseif($data[0]->month == "11")
									<option value="11">November </option>
									@elseif($data[0]->month == "12")
									<option value="12">December </option>
									@endif
								</select>
							</div>
							<div class="col-md-2">
								<select class="form-control" name="year" required="">
									<option value="{{ $data[0]->year }}">{{ $data[0]->year }}</option>
								</select>
							</div>


							<div class="col-md-2">
								
								<button type="submit" class="btn btn-success">Update Now</button>
							</div>

						</div>
						<br>

					</table>
					
					
				<table cellpadding="0" cellspacing="0"  width="100%" style="background:#f4f4f4;">

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
                    
                    
                    @php
                        $totalmygp = DB::table('acceptemployeesalarysetups')->where('employee_id',$d->id)->sum('gp');
                    @endphp


					<input type="hidden" name="gpper[]" id="gpinitial{{ $d->id }}" value="{{ $d->gpper }}">
					<tr>
						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center">{{ $i++ }}
						<input type="hidden" value="{{$d->id}}" name="id[]">
						</td>
						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="left">&nbsp;{{ $d->name }} <input type="hidden" name="employee[]" value="{{ $d->emp_id }}"></td>

						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center"><input type="text" name="salary_scale[]" readonly="" id="salary_scale{{ $d->id }}" value="{{ $d->salary_scale }}"></td>
						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center"><input type="text" name="increment[]" id="increment{{ $d->id }}" onkeyup="calculatedata('{{ $d->id }}');" required="" value="{{ $d->increment }}"></td>
						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center"><input type="text" name="total_salary[]" id="total_salary{{ $d->id }}" readonly="" value="{{ $d->salary_scale+$d->increment }}" ></td>
						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center"><input type="text" name="home_rent[]" id="home_rent{{ $d->id }}" onkeyup="calculatedata('{{ $d->id }}');" value="@if(isset($d->home_rent)){{ $d->home_rent }}@else 0 @endif" ></td>
						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center"><input type="text" name="travel_bill[]" id="travel_bill{{ $d->id }}" onkeyup="calculatedata('{{ $d->id }}');" value="@if(isset($d->travel_bill)){{ $d->travel_bill }}@else 0 @endif" ></td>
						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center"><input type="text" name="mobile_bill[]" id="mobile_bill{{ $d->id }}" onkeyup="calculatedata('{{ $d->id }}');" value="@if(isset($d->mobile_bill)){{ $d->mobile_bill }}@else 0 @endif" ></td>
						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center"><input type="text" name="treatment_bill[]" id="treatment_bill{{ $d->id }}" onkeyup="calculatedata('{{ $d->id }}');" value="@if(isset($d->treatment_bill)){{ $d->treatment_bill }}@else 0 @endif" ></td>
						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center"><input type="text" name="others[]" id="others{{ $d->id }}" onkeyup="calculatedata('{{ $d->id }}');" value="@if(isset($d->others)){{ $d->others }}@else 0 @endif" ></td>

						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center"><input type="text" name="totalsalaryforothers[]" id="totalsalaryforothers{{ $d->id }}" readonly="" value="{{ $d->salary_scale+$d->increment+$d->home_rent+$d->travel_bill+$d->mobile_bill+$d->treatment_bill+$d->others }}"></td>


						@php
						$gpper = ($d->salary_scale+$d->increment)/100*$d->gpper;
					 
						@endphp

						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center"><input type="text" name="gp[]" id="gp{{ $d->id }}" onkeyup="calculatedata('{{ $d->id }}')" value="{{ $gpper }}" readonly=></td>

						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center"><input type="text" name="totalgp[]" id="totalgp{{ $d->id }}" readonly="" value="{{ $totalmygp }}"></td>

						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center"><input type="text" name="monthkorton[]" id="monthkorton{{ $d->id }}" value="{{ $d->monthkorton }}" onkeyup="calculatedata('{{ $d->id }}')"></td>
						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center"><input type="text" name="revinew[]" id="revinew{{ $d->id }}" value="{{ $d->revinew }}" onkeyup="calculatedata('{{ $d->revinew }}')"></td>
						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; " align="center"><input type="text" name="totalkorton[]" id="totalkorton{{ $d->id }}" value="{{ $gpper+$d->monthkorton+$d->revinew }}" readonly=""></td>
						<td style="border-left: 1px #000 solid; border-bottom: 1px #000 solid; border-right: 1px #000 solid; " align="center"><input type="text" name="netsalary[]" id="netsalary{{ $d->id }}" value="{{ ($d->salary_scale+$d->increment+$d->home_rent+$d->travel_bill+$d->mobile_bill+$d->treatment_bill+$d->others)- ($gpper+$d->monthkorton+$d->revinew)}}" readonly=""></td>

					</tr>
					@endforeach
					@endif

				</table>




			</div>

		</div>



	</div>

</div>


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

</style>



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
      		padding: 5px!important;
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



@else
 Not Found
@endif