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
                            <h5 class="m-b-10">সাব লিংক</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('sub_menu.index')}}">সাব লিংক</a></li>
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
                        <h5>নতুন সাব লিংক যুক্ত করুন</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('sub_menu.store')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label for="validationCustomUsername">সিরিয়াল নং</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('serial_no') is-invalid @enderror" id="validationCustomUsername" placeholder="Seral No" aria-describedby="inputGroupPrepend" name="serial_no" value="{{old('serial_no')}}">
                                    </div>
                                    @error('serial_no')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="validationCustomUsername">মেইন লিংক নির্বাচন করুন</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control form-control-sm @error('main_menu_id') is-invalid @enderror" name="main_menu_id">
                                            <option>নির্বাচন করুন</option>
                                            @if($main_menu)
                                            @foreach($main_menu as $view)
                                            <option @if(old('main_menu_id') == $view->id) selected @endif value="{{$view->id}}">{{$view->main_menu}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('main_menu_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="validationCustomUsername">সাব লিংক নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('sub_menu') is-invalid @enderror" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="সাব লিংক নাম" name="sub_menu" value="{{old('sub_menu')}}">
                                    </div>
                                    @error('sub_menu')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="validationCustomUsername">রাউট নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('route_name') is-invalid @enderror" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="রাউট নাম" name="route_name" value="{{old('route_name')}}">
                                    </div>
                                    @error('route_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="validationCustomUsername">স্ট্যাটাস</label><span class="text-danger">*</span>
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
