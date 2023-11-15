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
                        <form action="{{ url('searchemployee_salary')}}" method="GET" enctype="multipart/form-data" target="blank">
                        
                            <div class="row">
                          
                                <div class="col-sm-4 mb-3">
                                    <label>ব্রাঞ্চ নাম</label><span class="text-danger">*</span>
                                    
                                        <select class="js-example-basic-single form-control @error('branch_id') is-invalid @enderror" name="branch_id" required="">
                                            <option value="">নির্বাচন করুন</option>
                                            @if($branch)
                                            @foreach ($branch as $showbranch)
                                            <option value="{{$showbranch->id}}">{{$showbranch->branch_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                  
                                    @error('branch_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-sm-4 mb-3">
                                    <label>মাস</label><span class="text-danger">*</span>
                                    <select class="js-example-basic-single form-control form-control-sm" name="month" required="">
        								<option value="">মাস নির্বাচন করুন</option>
        								<option value="01">January</option>
        								<option value="02">February</option>
        								<option value="03">March</option>
        								<option value="04">April</option>
        								<option value="05">May</option>
        								<option value="06">June</option>
        								<option value="07">July</option>
        								<option value="08">August </option>
        								<option value="09">September </option>
        								<option value="10">October </option>
        								<option value="11">November </option>
        								<option value="12">December </option>
        							</select>
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>বছর</label><span class="text-danger">*</span>
                                    <select class="js-example-basic-single form-control form-control-sm" name="year" required="">
        								<option value="">বছর নির্বাচন করুন</option>
        								<option value="<?php echo date('Y'); ?>"><?php echo date("Y"); ?></option>
        								<option value="<?php echo date("Y")-1; ?>"><?php echo date("Y")-1; ?></option>
        							</select>
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
