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
                            <h5 class="m-b-10">কর্মকর্তা ও কর্মচারী বেতন </h5>
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
                        <h5>কর্মকর্তা ও কর্মচারী বেতন </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('draftemployeesalarycheck')}}" method="GET" enctype="multipart/form-data" target="blank">
                        
                            <div class="row">
                          
                                <div class="col-sm-4 mb-3">
                                    <label>ব্রাঞ্চ নাম</label><span class="text-danger">*</span>
                                    
                                        <select class="js-example-basic-single form-control @error('branch_id') is-invalid @enderror" name="branch_id" required="">
                                            <option value="">নির্বাচন করুন</option>
                                            @if($branch)
                                            @foreach ($branch as $showbranch)
                                            @php 
                                               $check = DB::table('draftemployeesalarysetups')->where('draftemployeesalarysetups.branch_id',$showbranch->id)->count();
                                            @endphp
                                            @if($check > 0)
                                            <option value="{{$showbranch->id}}">{{$showbranch->branch_name}}</option>
                                            @endif
                                            @endforeach
                                            @endif
                                        </select>
                                  
                                    @error('branch_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                              
                            {{-- hidden input --}}
                            <input type="hidden" name="admin_id" value="{{Auth::user()->id}}">
                            <br>
                            <div class="submit-btn col-12">
                               <center> <input type="submit" class="btn btn-success" value="সার্চ করুন"></center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Latest Customers end -->
        </div>
        <!-- [ Main Content ] end -->
@endsection
