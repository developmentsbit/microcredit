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
                            <h5 class="m-b-10">কর্মকর্তা ও কর্মচারী তথ্য</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('add_employee.index')}}">কর্মকর্তা ও কর্মচারী তথ্য</a></li>
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
                        <h5>কর্মকর্তা ও কর্মচারী তথ্য</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('add_employee.update',$data->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label>সিরিয়াল নং</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="number" class="form-control form-control-sm @error('sl') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="sl" value="{{$data->sl}}">
                                    </div>
                                    @error('sl')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>ব্রাঞ্চ নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('branch_id') is-invalid @enderror" name="branch_id">
                                            <option value="">নির্বাচন করুন</option>
                                            @if($branch)
                                            @foreach ($branch as $showbranch)
                                            <option @if($showbranch->id == $data->branch_id) selected @endif value="{{$showbranch->id}}">{{$showbranch->branch_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('branch_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>কর্মচারী ধরন</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('type') is-invalid @enderror" name="type">
                                            <option value="">নির্বাচন করুন</option>
                                            <option @if($data->type == 1) selected @endif value="1">কর্মকর্তা</option>
                                            <option @if($data->type == 0) selected @endif value="0">কর্মচারী</option>
                                        </select>
                                    </div>
                                    @error('type')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="name" value="{{$data->name}}">
                                    </div>
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>ফোন</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('phone') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="phone" value="{{$data->phone}}">
                                    </div>
                                    @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>ফোন ২</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control form-control-sm @error('phone_2') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="phone_2" value="{{$data->phone_2}}">
                                    </div>
                                    @error('phone_2')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>ই-মেইল</label>
                                    <div class="input-group">
                                        <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="email" value="{{$data->email}}">
                                    </div>
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>পিতার নাম</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('fathers_name') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="fathers_name" value="{{$data->fathers_name}}">
                                    </div>
                                    @error('fathers_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>মাতার নাম</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('mothers_name') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="mothers_name" value="{{$data->mothers_name}}">
                                    </div>
                                    @error('mothers_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>জন্ম তারিখ</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control form-control-sm @error('date_of_birth') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="date_of_birth" value="{{$data->date_of_birth}}">
                                    </div>
                                    @error('date_of_birth')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>পদবী</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('date_of_birth') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="designation" value="{{$data->designation}}">
                                    </div>
                                    @error('designation')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>লিঙ্গ</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('gender') is-invalid @enderror" name="gender">
                                            <option value="">নির্বাচন করুন</option>
                                           <option @if($data->gender == 'পুরুষ') selected @endif value="পুরুষ">পুরুষ</option>
                                           <option @if($data->gender == 'মহিলা') selected @endif value="মহিলা">মহিলা</option>
                                           <option @if($data->gender == 'অন্যান্য') selected @endif value="অন্যান্য">অন্যান্য</option>
                                        </select>
                                    </div>
                                    @error('gender')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>ধর্ম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('religion') is-invalid @enderror" name="religion">
                                            <option value="">নির্বাচন করুন</option>
                                           <option @if($data->religion == 'ইসলাম') selected @endif value="ইসলাম">ইসলাম</option>
                                           <option @if($data->religion == 'হিন্দু') selected @endif value="হিন্দু">হিন্দু</option>
                                           <option @if($data->religion == 'বৌদ্ধ') selected @endif value="বৌদ্ধ">বৌদ্ধ</option>
                                           <option @if($data->religion == 'খ্রিস্টান') selected @endif value="খ্রিস্টান">খ্রিস্টান</option>
                                           <option @if($data->religion == 'অন্যান্য') selected @endif value="অন্যান্য">অন্যান্য</option>
                                        </select>
                                    </div>
                                    @error('religion')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>বর্তমান ঠিকানা</label>
                                    <div class="input-group">
                                        <textarea class="form-control" name="present_address">{{$data->present_address}}</textarea>
                                    </div>
                                    @error('present_adress')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>স্থায়ী ঠিকানা</label>
                                    <div class="input-group">
                                        <textarea class="form-control" name="permenant_address">{{$data->permenant_address}}</textarea>
                                    </div>
                                    @error('permenant_address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>জাতীয় পরিচয় পত্র নাম্বার</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('nid_no') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="nid_no" value="{{$data->nid_no}}">
                                    </div>
                                    @error('nid_no')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>যোগদানের তারিখ</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control form-control-sm @error('join_date') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="join_date" value="{{$data->join_date}}">
                                    </div>
                                    @error('join_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>স্ট্যাটাস</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('status') is-invalid @enderror" name="status">
                                            <option value="">নির্বাচন করুন</option>
                                           <option @if($data->status == 1) selected @endif value="1">Active</option>
                                           <option @if($data->status == 0) selected @endif  value="0">Inactive</option>
                                        </select>
                                    </div>
                                    @error('status')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>ছবি</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control form-control-sm @error('image') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="image">
                                    </div>
                                    <img src="{{asset('Backend/images/EmployeeImage')}}/{{$data->image}}" class="img-fluid" style="height: 50px;width:50px;border-radius:100%;">
                                    @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>জাতীয় পরিচয় পত্র আপলোড করুন</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control form-control-sm @error('nid_image') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="nid_image">
                                    </div>
                                    <img src="{{asset('Backend/images/EmployeeNid')}}/{{$data->nid_image}}" class="img-fluid" style="height: 50px;width:50px;border-radius:100%;">
                                    @error('nid_image')
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
