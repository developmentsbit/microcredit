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
					<div><a href="{{ url('banktransaction') }}" class="btn btn-dark rounded addbutton"><i class="fa fa-plus"></i>&nbsp;নতুন লেনদেন সমূহ</a></div>
				</div>
				<div class="ibox-body table-responsive overflow">
					<table class="table" id="myTable">
						<thead class="mythead">
							<tr>
								<th>সিরিয়াল</th>
								<th>তারিখ</th>
								<th>ব্যাংক তথ্য</th>
								<th>ভাউচার/চেক/ট্রানজেকশন আইডি</th>
								<th>ধরণ</th>
								<th>পরিমাণ</th>
								<th>অ্যাকশান</th>
							</tr>
						</thead>

						<tbody class="tbody">

							@php $i=1;  @endphp
							@if(isset($data))
							@foreach($data as $d)
							<tr id="tr{{ $d->id }}">
								<td>{{ $i++ }}</td>
								<td>{{ $d->deposit_withdraw_date }}</td>
								<td>{{ $d->bank_name }}, {{ $d->account_number }}</td>
								<td>{{ $d->vouchar_cheque_no }}</td>
								<td>{!! $d->transaction_type !!}</td>
								<td>{!! $d->deposit_withdraw_amount !!}</td>
								<td>
									<a  class="btn btn-info border-0 edit text-light" data-toggle="modal" data-target="#exampleModalCenters" data-id="{{ $d->id }}"><i class="fa fa-pencil-square-o"></i></a>
									<a class="delete btn btn-danger  border-0 text-light" data-id="{{ $d->id }}"><i class="fa fa-trash-o"></i></a>

								</td>

							</tr>
							@endforeach
							@endif



						</tbody>
					</table>
				</div>
			</div>

		</div>
	</div>

	<!-------End Table--------->






	<!-- Edit Modal -->
	<div class="modal fade" id="exampleModalCenters" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitles" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">

			<div class="modal-content rounded">
				<div class="modal-header bg-dark text-light">
					<h5 class="modal-title text-light" id="exampleModalCenterTitles"><i class="fa fa-plus"></i>&nbsp;&nbsp;ব্যাংক লেনদেন আপডেট করুন</h5>
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

		$(".delete").click(function(){
			let id = $(this).data('id');



			swal({
				title: "Are you sure?",
				icon: "info",
				buttons: true,
				dangerMode: true,

			})
			.then((willDelete) => {
				if (willDelete) {

					$.ajax(
					{
						url: "{{ url('deletebanktransaction') }}/"+id,
						type: 'get',
						success: function()
						{
							$('#tr'+id).hide();

							Command:toastr["warning"]("Data Delete Successfully Done")
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


						},
						errors:function(){
							Command:toastr["danger"]("Data Delete Unsuccessfully")


						}
					});

				}

			});
		});

	// End Delete Data


	$(".edit").click(function(){
		var id = $(this).data("id");
		$.ajax(
		{
			url: "{{ url('editbanktransaction') }}/"+id,
			type: 'get',
			data:{},
			success: function (data)
			{
				$(".editdata").html(data);
			}
		});


	});

  // End Edit Data

</script>


@endsection
