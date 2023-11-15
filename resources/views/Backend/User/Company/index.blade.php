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
                            <h5 class="m-b-10">কোম্পানি ইনফরমেশন</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('company_information.index')}}">কোম্পানি ইনফরমেশন</a></li>
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
                        <h5>কোম্পানি ইনফরমেশন</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('company_information.update',1)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label>কোম্পনি নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('company_name') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="company_name" value="{{$data->company_name}}">
                                    </div>
                                    @error('first_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>টাইটেল</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('title') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="title" value="{{$data->title}}">
                                    </div>
                                    @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>ফোন</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="number" class="form-control form-control-sm @error('phone') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="phone" value="{{$data->phone}}">
                                    </div>
                                    @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>ফোন নাম্বার ২</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control form-control-sm @error('phone_2') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="phone_2" value="{{$data->phone_2}}">
                                    </div>
                                    @error('phone_2')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>ই-মেইল</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="email" value="{{$data->email}}">
                                    </div>
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>ঠিকানা</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('address') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="address" value="{{$data->address}}">
                                    </div>
                                    @error('address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>লগো</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="file" class="form-control form-control-sm @error('logo') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="logo" value="{{old('logo')}}">
                                    </div>
                                    <img src="{{asset('Backend/images/')}}/{{$data->logo}}" alt="" height="100px" width="100px">
                                    @error('logo')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>শর্টকাট লগো</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="file" class="form-control form-control-sm @error('short_logo') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="short_logo" value="{{old('short_logo')}}">
                                    </div>
                                    <img src="{{asset('Backend/images/')}}/{{$data->short_logo}}" alt="" height="100px" width="100px">
                                    @error('short_logo')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>ওয়েব অ্যড্রেস</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('web_address') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="web_address" value="{{$data->web_address}}">
                                    </div>
                                    @error('web_address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- hidden input --}}
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
