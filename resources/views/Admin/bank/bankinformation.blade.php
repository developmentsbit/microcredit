@extends('Backend.Layouts.master')
@section('body')

<div class="pcoded-main-container bg-white">
    <div class="pcoded-content">

	<div class="page-heading">
		<h3 class="page-title">ব্যাংক তথ্য সমূহ</h3>
	</div>



	<div class="page-content fade-in">
		<div class="ibox">
			<div class="ibox-head mb-3 myhead">
				<div><a data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-dark rounded addbutton text-light"><i class="fa fa-plus"></i>&nbsp;নতুন যুক্ত করুন</a></div>
			</div>
			<div class="ibox-body table-responsive overflow">
				<table class="table" id="myTable">
					<thead class="mythead">
						<tr>
							<th>সিরিয়াল নং</th>
							<th>ব্যাংক নাম</th>
							<th>একাউন্ট</th>
							<th>বিস্তারিত</th>
							<th>যোগাযোগ</th>
							<th>একাউন্ট ধরণ</th>
							<th>অ্যাকশান</th>
						</tr>
					</thead>

					<tbody class="tbody" id="showtdata">



					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>
</div>

<!-------End Table--------->





<!-- Add Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<form method="post" action="{{ url('bankinformationinsert') }}">
			@csrf
			<div class="modal-content rounded">
				<div class="modal-header bg-dark text-light">
					<h5 class="modal-title text-light" id="exampleModalCenterTitle"><i class="fa fa-plus"></i>&nbsp;&nbsp;নতুন ব্যাংক যুক্ত করুন</h5>
					<button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body myinput">

					<div class="row">
						<div class="form-group col-md-12">
							<label>ব্যাংক নাম:<span class="text-danger" style="font-size: 15px;">*</span></label>
							<div class="input-group">

								<input class="form-control" type="text" name="bank_name" id="bank_name" required="">
							</div>
						</div>



						<div class="form-group col-md-12">
							<label>একাউন্ট নং:<span class="text-danger" style="font-size: 15px;">*</span></label>
							<div class="input-group">

								<input class="form-control" type="number" name="account_number" id="account_number" required="">
							</div>
						</div>

						<div class="form-group col-md-6">
							<label>একাউন্ট ধরণ:<span class="text-danger" style="font-size: 15px;">*</span></label>
							<div class="input-group">

								<input class="form-control" type="text" name="account_type" id="account_type">
							</div>
						</div>


						<div class="form-group col-md-6">
							<label>ফোন নাম্বার:</label>
							<div class="input-group">

								<input class="form-control" type="text" name="contact" id="contact" >
							</div>
						</div>




						<div class="form-group col-md-6">
							<label>ব্যাংক টাইপ:</label>
							<div class="input-group">

								<input class="form-control" type="text" name="bankingType" id="bankingType">
							</div>
						</div>


						<div class="form-group col-md-12">
							<label>বিস্তারিত:</label>
							<div class="input-group">

								<textarea rows="3" name="details" id="details" class="form-control"></textarea>
							</div>
						</div>





					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary border-0" data-dismiss="modal">X</button>
					<button type="submit" class="btn btn-success button border-0">সেভ করুন</button>

				</div>
			</form>
		</div>
	</div>
</div>

<!-- End Add Modal -->





<!-- Edit Modal -->
<div class="modal fade" id="exampleModalCenters" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitles" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">

		<div class="modal-content rounded">
			<div class="modal-header bg-dark text-light">
				<h5 class="modal-title text-light" id="exampleModalCenterTitles"><i class="fa fa-plus"></i>&nbsp;&nbsp;ব্যাংক তথ্য আপডেট করুন</h5>
				<button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body editdata myinput">


			</div>


		</div>
	</div>
</div>
<!--End Edit Modal -->



<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});


	showdata();

	function showdata(){
		$.ajax(
		{
			url: "{{ url('getbankinformation') }}",
			type: 'get',
			data:{},
			success: function(data)
			{
				$("#showtdata").html(data);
			}
		});

	}

	// End Get Data


	$('.loading').hide();
	$(".btn-submit").submit(function(e){
		e.preventDefault();
		var data = $(this).serialize();

		$.ajax({
			url:'{{ url('bankinformationinsert') }}',
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

				$('#bank_name').val('');
				$('#account_number').val('');
				$('#account_type').val('');
				$('#bankingType').val('');
				$('#details').val('');
				$('.loading').hide();
				$('.button').show();
				$('#exampleModalCenter').modal('hide');

				showdata();

			},

			error:function(error){
				console.log(error)
			}
		});
	});

	// End Add Data


</script>





@endsection
