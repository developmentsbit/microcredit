
<!DOCTYPE html>
<html>
<head>
	<title>Bank Transaction Reports</title>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet">
</head>
<body>


	@php
	$company_info = DB::table("company_informations")->first();

	@endphp


	<div class="invoice border">

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



		<table class="table-bordered w-100">
			<tr>

				<td colspan="9" style="text-align:center;font-size: 16px;text-transform: uppercase;"><b>Bank Transaction Reports</b>
					<br>
					<div style="font-size: 13px;">



					</div>
				</td>
			</tr>
			<tr>

			</tr>



			<!-- <thead> -->
				<tr class="">
					<th>SL</th>
					<th>Date</th>
					<th>Bank Name</th>
					<th>Account Number</th>
					<th>Deposit</th>
					<th>Withdraw</th>
					<th>Cost</th>
					<th>Interest</th>
					<th>Balance</th>

				</tr>
				<!-- </thead> -->



				<tbody>

					@php
					$i=1;
					$totaldeposit = 0;
					$totalwithdraw = 0;
					$totalcost = 0;
					$totalinsterest = 0;
					@endphp
					@if(isset($data))
					@foreach($data as $d)




					<tr>
						<td>&nbsp;{{ $i++ }}</td>
						<td>&nbsp;{{ $d->deposit_withdraw_date }}</td>
						<td>&nbsp;{{ $d->bank_name }}</td>
						<td>&nbsp;{{ $d->account_number }}</td>
						<td class="">&nbsp;
							@if($d->transaction_type == "Deposit")
							@php
							$totaldeposit += $d->deposit_withdraw_amount;
							@endphp
							{{ $d->deposit_withdraw_amount }}/-
							@else
							-
							@endif
						</td>

						<td class="">&nbsp;
							@if($d->transaction_type == "Withdraw")
							@php
							$totalwithdraw += $d->deposit_withdraw_amount;
							@endphp
							{{ $d->deposit_withdraw_amount }}/-
							@else
							-
							@endif
						</td>

						<td class="">&nbsp;
							@if($d->transaction_type == "Bank-Cost")
							@php
							$totalcost += $d->deposit_withdraw_amount;
							@endphp
							{{ $d->deposit_withdraw_amount }}/-
							@else
							-
							@endif
						</td>

						<td class="">&nbsp;
							@if($d->transaction_type == "Bank-Insterest")
							@php
							$totalinsterest += $d->deposit_withdraw_amount;
							@endphp
							{{ $d->deposit_withdraw_amount }}/-
							@else
							-
							@endif
						</td>

						<td class="">&nbsp;
							{{ ($totaldeposit+$totalinsterest)-($totalwithdraw+$totalcost) }}/-
						</td>


					</tr>

					@endforeach
					@endif



				</tbody>

				<tr>
					<th colspan="4" class="text-right">Total</th>
					<th class="">{{ $totaldeposit }}/-</th>
					<th class="">{{ $totalwithdraw }}/-</th>
					<th class="">{{ $totalcost }}/-</th>
					<th class="">{{ $totalinsterest }}/-</th>
					<th class="">{{ ($totaldeposit+$totalinsterest)-($totalwithdraw+$totalcost) }}/-</th>
				</tr>



			</table>




			<br>
			<center><a href="#" class="btn btn-danger btn-sm print w-10" onclick="window.print();">Print</a></center>
			<br>


		</div>






		<style type="text/css">

        table, tr, th, td{
            text-align: left;
            padding-left: 10px;
        }

			body{
				font-family: 'Lato';
			}


			.invoice{
				background: #fff;
				border:none!important;
				padding:30px;

			}

			.invoice span{
				font-size: 15px;
			}

			thead{
				font-size: 15px;
			}

			tbody{
				font-size: 13px;
			}

			.table-bordered td, .table-bordered th{
				border: 1px solid #585858 !important;
				box-shadow: none;
				border-bottom: 1px solid #585858;
			}

			.table-bordered tr{
				border: 1px solid #585858 !important;
			}


			tbody {
				border: none !important;
			}


			@media  print
			{

				.table-bordered tr{
					border: 1px solid #585858 !important;
				}

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
