@extends('Backend.Layouts.master')
@section('body')

<div class="pcoded-main-container bg-white">
    <div class="pcoded-content">
	<div class="page-heading">
		<h3 class="page-title">ব্যাংক লেনদেন সমূহ</h3>
	</div>



	<div class="page-content fade-in">
		<div class="ibox">
			<div class="ibox-head mb-3 myhead">

				<div><a href="{{ url("managebanktransaction") }}" class="btn btn-dark rounded addbutton"><i class="fa fa-eye"></i>&nbsp;সকল লেনদেন সমূহ</a></div>

			</div>
			<div class="ibox-body">
				<form method="post" action="{{ url("banktransactioninsert") }}">
					@csrf

					<div class="row myinput">
						@php
						$bank = DB::table('bank_information')->get();
						@endphp

						<div class="form-group col-md-8">
							<label>ব্যাংক একাউন্ট:<span class="text-danger" style="font-size: 15px;">*</span></label>
							<div class="input-group">

								<select class="form-control" name="account_id" id="account_id" required="" onchange="gettotalamount();">
									<option value="">ব্যাংক একাউন্ট নির্বাচন করুন</option>
									@if(isset($bank))
									@foreach($bank as $c)
									<option value="{{ $c->id }}">{{ $c->bank_name }} -> {{ $c->account_type }} -> {{ $c->account_number }}</option>
									@endforeach
									@endif

								</select>
							</div>
						</div>



						<div class="form-group col-md-4">
							<label>মোট ব্যালেন্স:</label>
							<div class="input-group">

								<input class="form-control" type="text" name="totalbalance" id="totalbalance"  readonly="">
							</div>
						</div>


						<div class="form-group col-md-4">
							<label>তারিখ: <span class="text-danger" style="font-size: 15px;">*</span></label>
							<div class="input-group">

								<input class="form-control" type="date" name="deposit_withdraw_date" id="deposit_withdraw_date" required="">
							</div>
						</div>



						<div class="form-group col-md-4">
							<label>লেনদেন ধরণ:</label>
							<div class="input-group">

								<select class="form-control" name="transaction_type" id="transaction_type">
									<option value="Deposit">Deposit</option>
									<option value="Withdraw">Withdraw</option>
									<option value="Bank-Cost">Bank Account Cost</option>
									<option value="Bank-Insterest">Bank Account Interest</option>
								</select>
							</div>
						</div>


						<div class="form-group col-md-4">
							<label>পরিমাণ: <span class="text-danger" style="font-size: 15px;">*</span></label>
							<div class="input-group">

								<input class="form-control" type="text" name="deposit_withdraw_amount" id="deposit_withdraw_amount" required="">
							</div>
						</div>




						<div class="form-group col-md-8">
							<label>ভাউচার/চেক/ট্রানজেকশন আইডি:</label>
							<div class="input-group">

								<textarea rows="3" class="form-control" name="vouchar_cheque_no" id="vouchar_cheque_no"></textarea>
							</div>
						</div>





						<div class="modal-footer col-12 border-0">
							<button type="button" class="btn btn-secondary border-0" onClick="window.location.reload();">x</button>
							<button type="submit" class="btn btn-success button border-0">সেভ</button>
							<button type="button" class="btn btn-success loading border-0">Loading...</button>
						</div>





					</div>
				</form>

			</div>
		</div>

	</div>
</div>

<!-------End Table--------->




<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});



	$('.loading').hide();
	$(".btn-submit").submit(function(e){
		e.preventDefault();
		var data = $(this).serialize();

		$.ajax({
			url:'{{ url('banktransactioninsert') }}',
			method:'POST',
			data:data,
			beforeSend:function(response) {
				$('.loading').show();
				$('.button').hide();

			},
			success:function(response){

				Command:toastr["success"]("Data Save Successfully Done")
				toastr.options = {
					"closeButton": true,
					"debug": false,
					"newestOnTop": false,
					"progressBar": true,
					"positionClass": "toast-top-right",
					"preventDuplicates": false,
					"onclick": null,
					"showDuration": "300",
					"hideDuration": "1000",
					"timeOut": "3000",
					"extendedTimeOut": "1000",
					"showEasing": "swing",
					"hideEasing": "linear",
					"showMethod": "fadeIn",
					"hideMethod": "fadeOut"
				}

				$('#account_id').val('');
				$('#totalbalance').val('');
				$('#deposit_withdraw_date').val('');
				$('#deposit_withdraw_amount').val('');
				$('#transaction_type').val('');
				$('#vouchar_cheque_no').val('');
				$('.loading').hide();
				$('.button').show();


			},

			error:function(error){
				console.log(error)
			}
		});
	});

	// End Add Data



	function gettotalamount(){
		let account_id = $("#account_id").val();
		$.ajax({
			url: "{{ url('gettotalamount') }}/"+account_id,
			type: 'get',
			success: function (response)
			{
				$("#totalbalance").val(response);
			},
			error:function(errors){
				alert("Select Customer")
			}
		});

	}


</script>





@endsection
