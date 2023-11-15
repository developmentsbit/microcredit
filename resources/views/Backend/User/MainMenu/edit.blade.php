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
                        <h5>লিংক তথ্য আপডেট করুন</h5>
                    </div>
                    <div class="card-body">

                        @if($data)
                        <form action="{{route('main_menu.update',$data->id)}}" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label for="">সিরিয়াল নং</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control @error('serial_no') is-invalid @enderror" id="" placeholder="Seral No" aria-describedby="inputGroupPrepend" name="serial_no" value="{{$data->serial_no}}">
                                    </div>
                                    @error('serial_no')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="">মেনু নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control @error('main_menu') is-invalid @enderror" id="" aria-describedby="inputGroupPrepend" name="main_menu" value="{{$data->main_menu}}">
                                    </div>
                                    @error('main_menu')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="">আইকন নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control @error('icon') is-invalid @enderror" id="" aria-describedby="inputGroupPrepend" value="feather icon-box" name="icon" value="{{$data->icon}}">
                                    </div>
                                    @error('icon')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="">স্টেটাস</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="form-control @error('status') is-invalid @enderror" name="status">
                                            <option>নির্বাচন করুন</option>
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
                            <input type="text" hidden name="admin_id" value="{{Auth::user()->id}}">
                            {{-- hidden input --}}
                            <div class="submit-btn">
                                <input type="submit" class="btn btn-sm btn-success" value="আপডেট করুন">
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Latest Customers end -->
        </div>
        <!-- [ Main Content ] end -->
@endsection
