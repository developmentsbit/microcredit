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
                            <h5 class="m-b-10">বিনিয়োগ স্কিমা</h5>
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
                        <h5>বিনিয়োগ স্কিমা যুক্ত করুন</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('add_schema.update',$data->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label>বিনিয়োগ নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('investment_name') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="investment_name" value="{{ $data->investment_name }}" required="">
                                    </div>
                                    @error('investment_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>শর্ট নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('short_name') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="short_name" value="{{ $data->short_name }}">
                                    </div>
                                    @error('short_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>মেয়াদকাল</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input id="onlyEng" type="text" class="form-control form-control-sm @error('duration') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="duration" value="{{ $data->duration }}" required="">
                                    </div>
                                    @error('duration')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>শতকরা</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input id="onlyEng" type="text" class="form-control form-control-sm @error('percentage') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="percentage" value="{{ $data->percentage }}">
                                    </div>
                                    @error('percentage')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>কিস্তির পরিমাণ</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input id="onlyEng" type="text" class="form-control form-control-sm @error('installment_no') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="installment_no" value="{{ $data->installment_no }}">
                                    </div>
                                    @error('installment_no')
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
