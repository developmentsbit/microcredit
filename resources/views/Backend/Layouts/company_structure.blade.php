@extends('Backend.Layouts.master')
@section('body')
<style>
    a.box-link {
    background: white;
    padding: 11px 12px;
    border-radius: 8px;
    box-shadow: 0px 3px 2px 1px;
    transition: .3s;
    margin-right: 15px;
    margin-top: 15px;
}

a.box-link:hover {
    background: #e3e0e0;
}
</style>

@php
Use App\Models\admin_branch_info;
Use App\Models\branch_info;

@endphp

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Header ] start -->
        <div class="row">
            <a class="box-link col-lg-12 col-md-12 col-12" href="#" style="padding: 17px 20px;">
                <div class="row">
                    <div class="col-sm-3 col-lg-3 mb-3 link-box">
                        <p><b>Welcome back, SUPER ADMIN !</b></p>
                        <span class="fs-semibold text-muted">Track your somity activity, leads and deals here.</span>
                    </div>
                    <div class="col-sm-3 col-lg-3 mb-3 link-box">
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
                    
                    <div class="col-sm-3 col-lg-3 mb-3 link-box">
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
                    <div class="col-sm-3 col-lg-3 link-box" style="padding: 31px 75px;">
                        <button type="button" class="btn btn-secondary" onClick="window.location.reload();">Reload Dashboard</button>
                    </div>
                </div>
            </a>
        </div>
        <!-- [ Main Header ] end -->

        <!-- [ Main Content ] start -->


        <div class="row mt-4">
            <!-- table card-1 start -->
            <div class="col-md-12 col-xl-4">
                <!-- widget primary card start -->
                <div class="card flat-card widget-primary-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="feather icon-user"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>{{$total_user}}</h4>
                            <h6>অ্যাডমিন</h6>
                        </div>
                    </div>
                </div>
                <!-- widget primary card end -->
            </div>
            <div class="col-md-12 col-xl-4">
                <!-- widget primary card start -->
                <div class="card flat-card widget-purple-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="feather icon-box"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>{{$investment_schema}}</h4>
                            <h6>বিনিয়োগ স্কিমা</h6>
                        </div>
                    </div>
                </div>
                <!-- widget primary card end -->
            </div>
            <div class="col-md-12 col-xl-4">
                <!-- widget primary card start -->
                <div class="card flat-card widget-primary-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="feather icon-box"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>{{$saving_schema}}</h4>
                            <h6>সঞ্চয় স্কিমা</h6>
                        </div>
                    </div>
                </div>
                <!-- widget primary card end -->
            </div>
            <div class="col-md-12 col-xl-4">
                <!-- widget primary card start -->
                <div class="card flat-card widget-purple-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="feather icon-box"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>{{$fixed_deposit_schema}}</h4>
                            <h6>ফিক্সড ডিপোজিট স্কিমা</h6>
                        </div>
                    </div>
                </div>
                <!-- widget primary card end -->
            </div>
            @php
            $total_member = DB::table('members')->where('status',1)->count();
            @endphp
            <div class="col-md-12 col-xl-4">
                <!-- widget primary card start -->
                <div class="card flat-card widget-primary-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="feather icon-user"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>{{$total_member}}</h4>
                            <h6>জন মোট সদস্য</h6>
                        </div>
                    </div>
                </div>
                <!-- widget primary card end -->
            </div>
            @php
            $total_saving_registration = DB::table('saving_registrations')->where('status',1)->where('approval',1)->count();
            @endphp
            <div class="col-md-12 col-xl-4">
                <!-- widget primary card start -->
                <div class="card flat-card widget-primary-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="feather icon-user"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>{{$total_saving_registration}}</h4>
                            <h6>জন মোট সঞ্চয় রেজিষ্ট্রেশন</h6>
                        </div>
                    </div>
                </div>
                <!-- widget primary card end -->
            </div>
            @php
            $total_fixedeposit_registration = DB::table('fixed_deposit_registrations')->where('status',1)->where('approval',0)->count();
            @endphp
            <div class="col-md-12 col-xl-4">
                <!-- widget primary card start -->
                <div class="card flat-card widget-primary-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="feather icon-user"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>{{$total_fixedeposit_registration}}</h4>
                            <h6>জন মোট ফিক্সড ডিপোজিট রেজিষ্ট্রেশন</h6>
                        </div>
                    </div>
                </div>
                <!-- widget primary card end -->
            </div>
            @php
            $total_investor_registration = DB::table('investor_registrations')->where('status',1)->where('approval',1)->count();
            @endphp
            <div class="col-md-12 col-xl-4">
                <!-- widget primary card start -->
                <div class="card flat-card widget-primary-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="feather icon-user"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>{{$total_investor_registration}}</h4>
                            <h6>জন মোট বিনিয়োগ রেজিষ্ট্রেশন</h6>
                        </div>
                    </div>
                </div>
                <!-- widget primary card end -->
            </div>
        </div>
            <!-- Widget primary-success card start -->
            <!-- Widget primary-success card end -->

        {{-- yearly --}}
        <div class="row mt-4">
            <div class="col-md-12 col-xl-4">
                <div class="card flat-card">
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <b>মোট ঋণ আদায়</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-md-center pt-2">
                                    <h5>{{$grandtotals['loan_recived']}} /-</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <b>মোট ঋণ প্রদান</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-md-center pt-2">
                                    <h5>{{$grandtotals['loan_provide']}} /-</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-4">
                <div class="card flat-card">
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <b>মোট সঞ্চয় আদায়</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-md-center pt-2">
                                    <h5>{{$grandtotals['saving_collection']}} /-</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <b>মোট সঞ্চয় ফেরত</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-md-center pt-2">
                                    <h5>{{$grandtotals['saving_provide']}} /-</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-4">
                <div class="card flat-card">
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <b>মোট ডিপোজিট আদায়</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-md-center pt-2">
                                    <h5>{{$grandtotals['deposit_collection']}} /-</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <b>মোট ডিপোজিট ফেরত</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-md-center pt-2">
                                    <h5>{{$grandtotals['deposit_provide']}} /-</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- daily --}}
        <div class="row mt-4">
            <div class="col-md-12 col-xl-4">
                <div class="card flat-card">
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <b>আজকের ঋণ আদায়</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-md-center pt-2">
                                    <h5>{{$totals['total_loan_recived']}} /-</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <b>আজকের ঋণ প্রদান</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-md-center pt-2">
                                    <h5>{{$totals['total_loan_provide']}} /-</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-4">
                <div class="card flat-card">
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <b>আজকের সঞ্চয় আদায়</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-md-center pt-2">
                                    <h5>{{$totals['total_saving_collection']}} /-</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <b>আজকের সঞ্চয় ফেরত</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-md-center pt-2">
                                    <h5>{{$totals['total_saving_provide']}} /-</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-4">
                <div class="card flat-card">
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <b>আজকের ডিপোজিট ফেরত</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-md-center pt-2">
                                    <h5>{{$totals['total_deposit_collection']}} /-</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <b>আজকের ডিপোজিট প্রদান</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-md-center pt-2">
                                    <h5>{{$totals['total_deposit_provide']}} /-</h5>
                                </div>
                            </div>
                        </div>
                    </div>
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

@endsection
