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
                            <h5 class="m-b-10">বিনিয়োগ প্রদান</h5>
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
                        <h5>বিনিয়োগ প্রদান করুন</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('investment_handover.update',$data->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label>তারিখ</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control form-control-sm @error('date') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="date"  value="{{ $data->date }}" required="">
                                    </div>
                                    @error('date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label>ব্রাঞ্চ নাম</label>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('branch_id') is-invalid @enderror" name="branch_id" required="">
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

                                            <option value="{{ $showbranch->id }}" <?php if ($showbranch->id == $data->branch_id) {
                                            	echo "selected";
                                            } ?>>{{ $showbranch->branch_name }}</option>

                                            @endforeach
                                            @endif

                                        </select>
                                    </div>
                                    @error('branch_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-sm-6 mb-3">
                                    <label>কেন্দ্র নাম</label>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('area_id') is-invalid @enderror" name="area_id" required="">
                                            <option value="">নির্বাচন করুন</option>
                                            @php
                                            $areas = DB::table("area_infos")->get();
                                            @endphp

                                            @if(isset($areas))
                                            @foreach($areas as $area)
                                            <option value="{{ $area->id }}" <?php if ($area->id == $data->area_id) {
                                            	echo "selected";
                                            } ?>>{{ $area->area_name }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('area_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-sm-6 mb-3">
                                    <label>মেম্বার নাম</label>
                                    <div class="input-group">

                                        @php
                                        $member = DB::table("members")->get();
                                        @endphp


                                        <select class="js-example-basic-single form-control @error('member_id') is-invalid @enderror" name="member_id" required="">
                                            <option value="">নির্বাচন করুন</option>

                                            @if(isset($member))
                                            @foreach($member as $m)
                                            <option value="{{ $m->id }}" <?php if ($m->id == $data->member_id) {
                                            	echo "selected";
                                            } ?>>{{ $m->aplicant_name }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('member_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>



                                <div class="col-sm-6 mb-3">
                                    <label>বিনিয়োগ পরিমাণ</label>
                                    <div class="input-group">
                                        <input type="text" class="onlyEng form-control form-control-sm @error('investment_amount') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="investment_amount" value="{{ $data->investment_amount }}" required="">
                                    </div>
                                    @error('investment_amount')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>ঝুকি পরিমাণ</label>
                                    <div class="input-group">
                                        <input type="text" class="onlyEng form-control form-control-sm @error('risk_amount') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="risk_amount" value="{{ $data->risk_amount }}">
                                    </div>
                                    @error('risk_amount')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>সার্ভিস চার্জ</label>
                                    <div class="input-group">
                                        <input type="text" class="onlyEng form-control form-control-sm @error('service_charge') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="service_charge" value="{{ $data->service_charge }}">
                                    </div>
                                    @error('service_charge')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>মোট</label>
                                    <div class="input-group">
                                        <input type="text" class="onlyEng form-control form-control-sm @error('total') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="total" value="{{ $data->total }}" required="">
                                    </div>
                                    @error('total')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>মন্তব্য</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('comment') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="comment" value="{{ $data->comment }}">
                                    </div>
                                    @error('comment')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
        @endsection
