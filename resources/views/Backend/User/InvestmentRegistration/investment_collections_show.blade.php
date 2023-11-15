@extends('Backend.Layouts.master')
@section('body')
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
	<div class="pcoded-content">
		<!-- [ breadcrumb ] start -->
		<div class="page-header">
			<div class="page-block">
				<div class="row align-items-center">
					<div class="col-md-12">
						<div class="page-header-title">
							<h5 class="m-b-10">বিনিয়োগ আদায়</h5>
						</div>

					</div>
				</div>
			</div>
		</div>
		<!-- [ breadcrumb ] end -->
		<!-- [ Main Content ] start -->
		<div class="row">
			<!-- table card-1 start -->
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-6">
								<h5>বিনিয়োগ আদায় তথ্য</h5>
							</div>

						</div>
					</div>
					<div class="card-body table-responsive">
                        <form form-target="_blank" action="{{url('/showInvestmentCollReport')}}" method="post">
                            @csrf
                            <div class="row mb-4">
                                <div class="input-single-box col-4">
                                    <label for="">ব্রাঞ্চ নির্বাচন করুন</label>
                                    <select name="branch_id" id="branch_id" class="form-control js-example-basic-single" onchange="loadArea();loadSavingCollBranch()" required>
                                        <option value="">নির্বাচন করুন</option>
                                        @if($branch)
                                        @foreach ($branch as $v)
                                            <option value="{{$v->id}}">{{$v->branch_name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="input-single-box col-4">
                                    <label for="">কোন্দ্র নির্বাচন করুন</label>
                                    <select name="area_id" id="area_id" class="form-control js-example-basic-single" onchange="loadAreaSavingColl()" required>
                                        <option value="">নির্বাচন করুন</option>
                                    </select>
                                </div>
                                <div class="input-single-box col-4 mt-5">
                                    <input formtarget="_blannk" type="submit" class="btn btn-dark btn-sm" value="রিপোর্ট দেখুন">
                                </div>
                            </div>
                        </form>
						<table class="table" id="myTable">
							<thead>
								<tr>
									<th>
										<input type="checkbox" id="chkAll" onclick="chkAll()">
									</th>
									<th>সিরিয়াল নং</th>
									<th>তারিখ</th>
									<th>ব্রাঞ্চ</th>
									<th>কেন্দ্র নাম</th>
									<th>মেম্বার আইডি</th>
									<th>বিনিয়োগ আদায় পরিমাণ</th>

									<th>মন্তব্য</th>
									<th>অ্যাকশান</th>
								</tr>
							</thead>
							<tbody id="table_data">


								@php
								$i = 1;
								@endphp

								@if(isset($data))
								@foreach($data as $d)

								<tr>
									<td><input onclick="chkAll()" id="chkSavingReg" type="checkbox" name="investor_reg[]" value="{{$d->id}}"></td>
									<td>{{ $i++ }}</td>
									<td>{{ $d->date }}</td>
									<td>{{ $d->branch_name }}</td>
									<td>{{ $d->area_name }}</td>
									<td>{{ $d->member_id }}</td>
									<td>{{ $d->investment_collection }}</td>
									<td>{{ $d->comment }}</td>

									<td>

										<a style="float: left;margin-right:10px;" href="{{route('investment_collection.edit',$d->id)}}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>
										<form action="{{ route('investment_collection.destroy',$d->id) }}" method="post">
											@csrf
											@method('DELETE')
											<button type="submit" class="btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
										</form>

										 <a href="{{url('investment_collections_show_approve')}}/{{$d->id}}" class="btn btn-dark btn-sm">Approve</a>

									</td>
								</tr>

								@endforeach
								@endif
							</tbody>
						</table>
						<input type="button" class="btn btn-success btn-sm" value="Approve All" disabled id="approveAll" onclick="approveAllData()">
					</div>
				</div>
			</div>
			<!-- Latest Customers end -->
		</div>
		<!-- [ Main Content ] end -->





		<script>
			function chkAll()
			{
				if($('#chkAll').is(':checked'))
				{
					$('input#chkSavingReg').prop('checked',true);
				}
				else
				{
                    // $('input#chkSavingReg').prop('checked',false);
                }


                if($('input#chkSavingReg').is(':checked'))
                {
                	$('#approveAll').prop('disabled',false);
                }
                else
                {
                	$('#approveAll').prop('disabled',true);

                }
            }
        </script>


        <script>
        	function approveAllData()
        	{

        		var id = [];

        		$('#chkSavingReg:checked').each(function(key){

        			id[key] = $(this).val();

                    // alert(id);

                    $.ajax({

                    	headers:{
                    		'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                    	},

                    	url : '{{ url('approve_all_investor_collection') }}',

                    	type : 'POST',

                    	data : {saving_id : id},

                    	success : function(data)
                    	{
                            // console.log(data);
                            if(data == 1)
                            {
                            	location.reload(true)
                            }
                        }

                    });

                });

        	}
        </script>


<script>
    function loadSavingCollBranch()
    {
        var branch_id = $('#branch_id').val();

        if(branch_id == "")
        {
            location.reload(true)
        }
        else
        {
            $.ajax({

                headers:{
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },

                url : '{{ url('loadInvestmentCollBranch') }}',

                type : 'POST',

                data : {branch_id},

                success : function(data)
                {
                    // alert(data);
                    $('#table_data').html(data);
                }

            });
        }
    }
</script>

<script>

    function loadAreaSavingColl()
    {
        var area_id = $('#area_id').val();

        if(area_id == "")
        {
            location.reload(true)
        }
        else
        {
            $.ajax({

                headers : {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },

                url : '{{ url('loadInvestmentCollArea') }}',

                type : 'POST',

                data : {area_id},

                success : function(data)
                {
                    $('#table_data').html(data);
                }

            });
        }

    }

</script>


<script type="text/javascript">
    function loadArea()
    {
        var branch_id = $('#branch_id').val();

        // var default = "<option value=''>নির্বাচন করুন</option>";

        // alert(branch_id);
        if(branch_id == "")
        {
            $('#area_id').html("");
        }
        else
        {
            $.ajax({
                headers : {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },

                url : '{{ url('loadArea') }}',

                type : 'POST',

                data : {branch_id},

                success : function(data)
                {
                    $('#area_id').html(data);
                    // alert(data);
                }
            });
        }
    }
</script>


        @endsection
