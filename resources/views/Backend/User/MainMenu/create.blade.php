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
                            <h5 class="m-b-10">মেইন লিংক</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('main_menu.index')}}">মেইন লিংক</a></li>
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
                        <h5>নতুন মেনু যুক্ত করুন</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('main_menu.store')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label for="validationCustomUsername">সিরিয়াল নং</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control-sm form-control @error('serial_no') is-invalid @enderror" id="validationCustomUsername" placeholder="Seral No" aria-describedby="inputGroupPrepend" name="serial_no" value="{{old('serial_no')}}">
                                    </div>
                                    @error('serial_no')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="validationCustomUsername">মেনু নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control-sm form-control @error('main_menu') is-invalid @enderror" id="validationCustomUsername" placeholder="মেনুর নাম" aria-describedby="inputGroupPrepend" name="main_menu" value="{{old('main_menu')}}">
                                    </div>
                                    @error('main_menu')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="validationCustomUsername">আইকন নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control-sm form-control @error('icon') is-invalid @enderror" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="feather icon-box" name="icon" value="{{old('icon')}}">
                                    </div>
                                    @error('icon')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="validationCustomUsername">স্টেটাস</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="form-control-sm form-control @error('status') is-invalid @enderror" name="status">
                                            <option>নির্বাচন করুন</option>
                                            <option @if(old('status') == '1') selected @endif value="1">Active</option>
                                            <option @if(old('status') == '0') selected @endif value="0">Inactive</option>
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
@endsection
