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
                            <h5 class="m-b-10">কেন্দ্র তথ্য</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('area_info.index')}}">কেন্দ্র</a></li>
                        </ul>
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
                        <h5>কেন্দ্র আপডেট করুন</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('area_info.update',$data->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label>সিরিয়াল নং</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('sl') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="sl" value="{{$data->sl}}">
                                    </div>
                                    @error('sl')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>ব্রাঞ্চ নির্বাচন করুন</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control form-control-sm @error('branch_id') is-invalid @enderror" name="branch_id">
                                            <option value="">নির্বাচন করুন</option>
                                            @if($branch)
                                            @foreach($branch as $showbranch)
                                            <option @if($data->branch_id == $showbranch->id) selected @endif value="{{$showbranch->id}}">{{$showbranch->branch_name}}</option>
                                            @endforeach
                                            @endif

                                        </select>
                                    </div>
                                    @error('branch_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>কেন্দ্র নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('area_name') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="area_name" value="{{$data->area_name}}">
                                    </div>
                                    @error('area_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>স্ট্যাটাস</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="form-control form-control-sm @error('status') is-invalid @enderror" name="status">
                                            <option @if($data->status == '1') selected @endif value="1">Active</option>
                                            <option @if($data->status == '0') selected @endif value="0">Inactive</option>
                                        </select>
                                    </div>
                                    @error('status')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            {{-- hidden input --}}
                            <input type="hidden" name="admin_id" value="{{Auth::user()->id}}">
                            <div class="submit-btn">
                                <input type="submit" class="btn btn-success" value="আপডেট করুন">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Latest Customers end -->
        </div>
        <!-- [ Main Content ] end -->
@endsection