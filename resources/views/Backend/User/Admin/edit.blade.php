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
                            <h5 class="m-b-10">অ্যাডমিন তথ্যাবলি</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('create_admin.index')}}">অ্যাডমিন</a></li>
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
                        <h5>অ্যাডমিন তথ্য আপডেট করুন</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('create_admin.update',$data->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label for="validationCustomUsername">ইউজার রোল</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('user_role') is-invalid @enderror" name="user_role">
                                            <option value="">নির্বাচন করুন</option>
                                            @if(Auth::user()->user_role == 1)
                                            <option @if($data->user_role == 1) selected @endif value="1">Super Admin</option>
                                            <option @if($data->user_role == 2) selected @endif value="2">Main Admin</option>
                                            <option value="3">Sub Admin</option>
                                            @elseif (Auth::user()->user_role ==2)
                                            <option @if($data->user_role == 2) selected @endif value="2">Main Admin</option>
                                            <option @if($data->user_role == 3) selected @endif value="3">Sub Admin</option>
                                            @else
                                            <option @if($data->user_role == 3) selected @endif value="3">Sub Admin</option>
                                            @endif
                                        </select>
                                    </div>
                                    @error('user_role')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row" id="emp_data">
                                <div class="col-sm-6 mb-3">
                                    <label>প্রথম নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('first_name') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="first_name" value="{{$data->name}}">
                                    </div>
                                    @error('first_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>শেষ নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('last_name') is-invalid @enderror" aria-describedby="inputGroupPrepend" placeholder="" name="last_name" value="{{$data->last_name}}">
                                    </div>
                                    @error('last_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>ফোন</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="number" class="form-control form-control-sm @error('phone') is-invalid @enderror" aria-describedby="inputGroupPrepend" placeholder="Phone" name="phone" value="{{$data->phone}}">
                                    </div>
                                    @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>ই-মেইল</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" aria-describedby="inputGroupPrepend" placeholder="Email" name="email" value="{{$data->email}}">
                                    </div>
                                    @error('email')
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
                                <div class="col-sm-6">
                                    <img src="{{asset('Backend/images/EmployeeImage')}}/{{$data->image}}" class="img-fluid" style="height: 100px;width:100px;border-radius:100%;">
                                    <input type="hidden" name="image" value="{{$data->image}}">
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
