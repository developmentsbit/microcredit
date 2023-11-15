@extends('Backend.Layouts.master')
@section('body')


@php
Use App\Models\admin_branch_info;
Use App\Models\branch_info;

@endphp





<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
	<div class="pcoded-content">
		<!-- [ breadcrumb ] start -->
		<div class="page-header">
			<div class="page-block">
				<div class="row align-items-center">
					<div class="col-md-12">
						<div class="page-header-title">
							<h5 class="m-b-10">কর্মকর্তা ও কর্মচারী বেতন</h5>
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
						<h5>কর্মকর্তা ও কর্মচারী বেতন</h5>
					</div>
					<div class="card-body">
						<form action="{{ url('insertemployeesalary')}}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="row">
								<div class="col-sm-3 mb-3">
									<label>তারিখ <span class="text-danger">*</span></label>
									<div class="input-group">
										<input type="text" class="date form-control form-control-sm @error('date') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="date" value="{{date('d/m/Y')}}" required="">
									</div>
									@error('date')
									<div class="alert alert-danger">{{ $message }}</div>
									@enderror
								</div>

								<div class="col-sm-4 mb-3">
									<label>ব্রাঞ্চ নাম <span class="text-danger">*</span></label>
									<div class="input-group">
										<select class="js-example-basic-single form-control @error('branch_id') is-invalid @enderror" name="branch_id" required="" id="branch_id" onchange="loadMember()">
											<option value="">নির্বাচন করুন</option>
											@php 
											if(Auth::user()->user_role == 1)
											{
												$admin_branch = branch_info::where('status',1)->get();
											}
											else {

												$admin_branch = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
												->join('branch_infos','branch_infos.id','=','admin_branch_infos.branch_id')
												->select('branch_infos.*')
												->get();
											}

											@endphp

											@if($admin_branch)
											@foreach($admin_branch as $showbranch)

											<option value="{{ $showbranch->id }}">{{ $showbranch->branch_name }}</option>

											@endforeach
											@endif

										</select>
									</div>
									@error('branch_id')
									<div class="alert alert-danger">{{ $message }}</div>
									@enderror
								</div>


								<input type="hidden" name="entry_date" value="{{ date('Y-m-d') }}">


								<div class="col-sm-5 mb-3">
									<label>মেম্বার নাম <span class="text-danger">*</span></label>
									<div class="input-group">

										<select class="js-example-basic-single form-control @error('employee_id') is-invalid @enderror" name="employee_id" id="employee_id" required="">
											<option value="">নির্বাচন করুন</option>

										</select>
									</div>
									@error('employee_id')
									<div class="alert alert-danger">{{ $message }}</div>
									@enderror
								</div>


								<div class="col-sm-2 mb-3">
									<label>বেতন স্কেল <span class="text-danger">*</span></label>
									<div class="input-group">
										<input type="number" name="salary_scale" class="form-control" required="">
									</div>
					
								</div>

								<div class="col-sm-2 mb-3">
									<label>বাড়ী ভাড়া	</label>
									<div class="input-group">
										<input type="number" name="home_rent" class="form-control">
									</div>
					
								</div>

								<div class="col-sm-2 mb-3">
									<label>যাতায়াত ভাতা	</label>
									<div class="input-group">
										<input type="number" name="travel_bill" class="form-control">
									</div>
					
								</div>

								<div class="col-sm-2 mb-3">
									<label>মোবাইল বিল	</label>
									<div class="input-group">
										<input type="number" name="mobile_bill" class="form-control">
									</div>
					
								</div>

								<div class="col-sm-2 mb-3">
									<label>চিকিৎসা ভাতা</label>
									<div class="input-group">
										<input type="number" name="treatment_bill" class="form-control">
									</div>
					
								</div>

								<div class="col-sm-2 mb-3">
									<label>অন্যান্য</label>
									<div class="input-group">
										<input type="number" name="others" class="form-control">
									</div>
					
								</div>


								<div class="col-sm-2 mb-3">
									<label>জি.পি (%)</label>
									<div class="input-group">
										<input type="number" value="10" name="gpper" class="form-control">
									</div>
					
								</div>
								
								
								<div class="col-sm-2 mb-3">
									<label>পূর্বের জি.পি</label>
									<div class="input-group">
										<input type="number" value="0" name="previous_gp" class="form-control">
									</div>
					
								</div>








							</div>
						</div>
						{{-- hidden input --}}
						<input type="hidden" name="admin_id" value="{{Auth::user()->id}}">
						<div class="submit-btn">
							<input type="submit" class="btn btn-success" value="সেভ করুন">
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- Latest Customers end -->
	</div>
	<!-- [ Main Content ] end -->


	

	 <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h5>কর্মকর্তা ও কর্মচারী বেতন</h5>
                            </div>
                        
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>সিরিয়াল নং</th>
                                    <th>তারিখ</th>
                                    <th>ব্রাঞ্চ</th>
                                    <th>নাম</th>
                                    <th>বেতন স্কেল</th>
                                    <th>জি.পি (%)</th>
                                    <th>মোট বেতন	</th>
                                    <th>অ্যাকশান</th>
                                </tr>
                            </thead>
                            <tbody>

                            	

                                @php
                                $i = 1;
                                @endphp

                                @foreach($showdata as $data)
                                
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $data->date }}</td>
                                    <td>{{ $data->branch_name }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->salary_scale }}</td>
                                    <td>{{ $data->gpper }}</td>
                                    <td>{{ ($data->salary_scale+$data->home_rent+$data->travel_bill+$data->mobile_bill+$data->treatment_bill+$data->others) }}</td>

                                    <td>

                                        <form action="{{ url('employeesalarydelete',$data->id) }}" method="post">
                                            @csrf
                                           
                                            <button type="submit" class="btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                                        </form>
                                    </td>
                                    
                                </tr>

                                @endforeach
                                                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>




	<!-- [ Main Content ] end -->
	<script type="text/javascript">
		function loadMember()
		{
			var branch_id = $('#branch_id').val();

			$.ajax({
				headers : {
					'X-CSRF-TOKEN' : '{{ csrf_token() }}'
				},

				url : '{{ url('getloadMember') }}',

				type : 'POST',

				data : {branch_id},

				success : function(data)
				{
					$('#employee_id').html(data);
                            // alert(data);
                        }
                    });

		}
	</script>










	<script>
		$('.date').datepicker({
			'format': 'd/m/yyyy',
			'autoclose': true
		});
	</script>





	@endsection