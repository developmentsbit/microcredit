@extends('Backend.Layouts.master')
@section('body')


@php
Use App\Models\admin_branch_info;
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
                            <h5 class="m-b-10">H/O প্রদান</h5>
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
                        <h5>H/O প্রদান যুক্ত করুন</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('ho_handover.update',$data->id)}}" method="POST">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-sm-6 mb-3 d-none">
                                    <label for="validationCustomUsername">সিরিয়াল নং</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control-sm form-control @error('sl') is-invalid @enderror" id="validationCustomUsername" placeholder="Seral No" aria-describedby="inputGroupPrepend" name="sl" value="{{ $data->sl }}">
                                    </div>

                                     <input type="hidden" class="form-control-sm form-control @error('sl') is-invalid @enderror" id="validationCustomUsername" placeholder="Seral No" aria-describedby="inputGroupPrepend" name="sl" value="1">
                                    @error('sl')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label for="validationCustomUsername">তারিখ</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="date form-control-sm form-control @error('date') is-invalid @enderror" id="validationCustomUsername" placeholder="Seral No" aria-describedby="inputGroupPrepend" name="date" value="{{ $data->date }}" required="">
                                    </div>
                                    @error('date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>প্রদানকৃত  ব্রাঞ্চ নাম</label><span class="text-danger">*</span>
                                   <div class="input-group">
                                    <select class="js-example-basic-single form-control @error('handover_branch_id') is-invalid @enderror" name="handover_branch_id" required="">

                                        @php
                                        if(Auth::user()->user_role == 1)
                                        {
                                            $admin_branch = DB::table('branch_infos')->where('status',1)->get();
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

                                        <option value="{{ $showbranch->id }}"<?php if ($data->handover_branch_id == $showbranch->id) {
                                            echo "selected";
                                        } ?>>{{ $showbranch->branch_name }}</option>

                                        @endforeach
                                        @endif

                                    </select>
                                </div>
                                @error('handover_branch_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-4 mb-3">
                                <label>গ্রহীত ব্রাঞ্চ নাম</label><span class="text-danger">*</span>
                                <div class="input-group">
                                    <select class="js-example-basic-single form-control @error('collection_branch_id') is-invalid @enderror" name="collection_branch_id" required="">

                                        @php
                                        if(Auth::user()->user_role == 1)
                                        {
                                            $admin_branch = DB::table('branch_infos')->where('status',1)->get();
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

                                        <option value="{{ $showbranch->id }}" <?php if ($data->collection_branch_id == $data->id) {
                                            echo "selected";
                                        } ?>>{{ $showbranch->branch_name }}</option>

                                        @endforeach
                                        @endif

                                    </select>
                                </div>
                                @error('collection_branch_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label for="validationCustomUsername">বিস্তরিত</label>
                                <div class="input-group">
                                    <textarea class="form-control" name="details">{{ $data->details }}</textarea>
                                </div>
                                @error('main_menu')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label for="validationCustomUsername">টাকার পরিমাণ</label><span class="text-danger">*</span>
                                <div class="input-group">
                                    <input type="text" class="onlyEng form-control-sm form-control @error('amount') is-invalid @enderror" id="validationCustomUsername" placeholder="Amount" aria-describedby="inputGroupPrepend" name="amount" value="{{ $data->amount }}" required="">
                                </div>
                                @error('amount')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label for="validationCustomUsername">স্ট্যাটাস</label><span class="text-danger">*</span>
                                <div class="input-group">
                                    <select class="form-control-sm form-control @error('status') is-invalid @enderror" name="status">
                                        @if($data->status == 1)
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                        @else
                                        <option value="0">Inactive</option>
                                        <option value="1">Active</option>

                                        @endif
                                    </select>
                                </div>
                                @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- hidden input --}}
                        <input type="text" hidden name="admin_id" value="{{Auth::user()->id}}">
                        {{-- hidden input --}}
                        <div class="submit-btn">
                            <input type="submit" class="btn btn-sm btn-success" value="সেভ করুন">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Latest Customers end -->
    </div>
    <!-- [ Main Content ] end -->
    <script>
        $('.date').datepicker({
        'format': 'd/m/yyyy',
        'autoclose': true
    });
    </script>
    @endsection
