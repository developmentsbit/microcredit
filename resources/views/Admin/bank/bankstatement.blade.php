@extends('Backend.Layouts.master')
@section('body')

<div class="pcoded-main-container bg-white">
	<div class="pcoded-content">
	<div class="page-heading">
		<h3 class="page-title">ব্যাংক স্টেটমেন্ট রিপোর্ট</h3>
	</div>



	<div class="page-content fade-in">
		<div class="ibox">
			<div class="ibox-head mb-3 myhead">

			</div>
			<div class="ibox-body">
				<form method="get" action="{{ url("bankstatementreports") }}" class="reloadform myinput" target="_blank">
					@csrf

					<div class="col-md-12 p-0 row">

						<div class="form-group col-md-4">
							<label>ব্যাংক নাম:</label>
							<div class="input-group">

								<select class="form-control" name="bank_id" id="bank_id" required="">
									<option value="">ব্যাংক নির্বাচন করুন</option>
									@if(isset($bank))
									@foreach($bank as $c)
									<option value="{{ $c->id }}">{{ $c->bank_name }}</option>
									@endforeach
									@endif

								</select>
							</div>
						</div>



						<div class="form-group col-md-3">
							<label>রিপোর্ট ধরণ</label>
							<select  name ="Type"  id="Type" class="form-control textfill select2_demo_1" onchange="showReport()" required="">
								<option value="">-- রিপোর্ট ধরণ নির্বাচন করুন --</option>
								<option value="1">দৈনিক</option>
								<option value="2">তারিখ থেকে তারিখ</option>
								<option value="3">মাসিক</option>
								<option value="4">বাৎসারিক</option>

							</select>

						</div>



						<div class="form-group col-md-2" id="firstdate" style="display:none">
							<label class="control-label">প্রথম তারিখ</label> <input type="date" class="form-control" placeholder="Start Date"  name="start_date" id="start_date" value="{{  date('d-m-Y') }}">
						</div>


						<div class="form-group col-md-2"  id="seconddate" style="display:none">
							<label class="control-label">শেষ তারিখ</label> <div class="controls"> <input type="date" class="form-control" placeholder="End Date"  name="end_date" id="end_date" value="{{  date('d-m-Y') }}"></div>
						</div>


						<div class="form-group col-md-2" id="first">

						</div>


						<div class="form-group col-md-2"  id="second">

						</div>



					</div>


				</div>


				<div class="col-12 border p-4 mt-4">
					<center><input type="submit" name="" value="Search Reports" class="btn btn-success" style="width: 200px; font-weight: bold; border-radius: 30px;"></center>
				</div>


			</form>

		</div>
	</div>

</div>
</div>


<script type="text/javascript">
	function showReport(){

		$('#second').html('');
		$('#first').html('');
		var type = $('#Type').val();
		if(type==''){
			$('#second').html('');
			$('#first').html('');
		}
		else{


			if(type==='1'){

				$('#second').html('');
				$('#first').html('');
				$('#firstdate').css('display','block');
				$('#seconddate').css('display','none');

			}
			else if(type==='3'){
				$('#firstdate').css('display','none');
				$('#seconddate').css('display','none');
				$('#second').html('');
				$('#first').html('');

				$('#first').append('<label class="control-label ">Select Month</label> <div class="controls"> <select  name="month"  id="month" class="form-control select2_demo_1"><option value="01">January</option><option value="02">February</option><option value="03">March</option> <option value="04">April</option> <option value="05">May</option> <option value="06">June</option> <option value="07">July</option><option value="08">August </option> <option value="09">September </option> <option value="10">October </option> <option value="11">November </option>  <option value="12">December </option></select></div>');

				$('#second').append('<label class="control-label">Year</label><div class="controls"><input type="text" name="year" id="year"   class=" form-control" value="{{date('Y')}}"> </div>');
			}else if(type==='4')
			{
				$('#firstdate').css('display','none');
				$('#seconddate').css('display','none');

				$('#second').html('');
				$('#first').html('');
				$('#first').append('<label class="control-label">Year</label><div class="controls"><input type="text" name="year"  id="year"  placeholder="2021" class=" form-control" value="{{date('Y')}}"> </div>');

			}else if(type==='2')
			{
				$('#first').html('');
				$('#second').html('');

				$('#firstdate').css('display','block');
				$('#seconddate').css('display','block');

			}



			else{

				$('#second').html('');
				$('#first').html('');
			}



		}



	}




	function resetledger()
	{
		location.reload();

	}

</script>


@endsection
