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
                            <h5 class="m-b-10">অ্যাসেট ডিপ্রেসিয়েশন ব্যায়</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('add_asset_depreciation.index')}}">অ্যাসেট ডিপ্রেসিয়েশন ব্যায়</a></li>
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
                        <h5>অ্যাসেট ডিপ্রেসিয়েশন ব্যায় আপডেট করুন</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('add_asset_depreciation.update',$data->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-6 mb-3 d-none">
                                    <label for="validationCustomUsername">সিরিয়াল নং</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control-sm form-control @error('sl') is-invalid @enderror" id="validationCustomUsername" placeholder="" aria-describedby="inputGroupPrepend" name="sl" value="{{$data->sl}}">
                                    </div>
                                     <input type="hidden" class="form-control-sm form-control @error('sl') is-invalid @enderror" id="validationCustomUsername" placeholder="" aria-describedby="inputGroupPrepend" name="sl" value="1">
                                    @error('sl')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>অ্যাসেট টাইটেল</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('asset_title_id') is-invalid @enderror" name="asset_title_id">
                                            <option value="">নির্বাচন করুন</option>
                                            @if ($asset_title)

                                            @foreach ($asset_title as $v)
                                            <option @if($v->id == $data->asset_title_id) selected @endif value="{{$v->id}}">{{$v->asset_title}}</option>
                                            @endforeach

                                            @endif
                                        </select>
                                    </div>
                                    @error('asset_title_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="validationCustomUsername">ডিপ্রেসিয়েশন ভ্যালু পার্সেন্টেজ</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="onlyEng form-control-sm form-control @error('depreciation_value_per') is-invalid @enderror" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="depreciation_value_per" value="{{$data->depreciation_value_per}}">
                                    </div>
                                    @error('depreciation_value_per')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="validationCustomUsername">বিস্তরিত</label>
                                    <div class="input-group">
                                        <textarea class="form-control" name="description">{!! $data->description !!}</textarea>
                                    </div>
                                    @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="validationCustomUsername">স্ট্যাটাস</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="form-control-sm form-control @error('status') is-invalid @enderror" name="status">
                                            <option value="">নির্বাচন করুন</option>
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
