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
                            <h5 class="m-b-10">আয় খাত</h5>
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
                        <h5>আয় খাত যুক্ত করুন</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('add_income_title.update',$data->id)}}" method="POST">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-sm-6 mb-3 d-none">
                                    <label for="validationCustomUsername">সিরিয়াল নং</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control-sm form-control @error('sl') is-invalid @enderror" id="validationCustomUsername" placeholder="Seral No" aria-describedby="inputGroupPrepend" name="sl" value="{{ $data->sl }}">
                                    </div>
                                     <input type="hidden" class="form-control-sm form-control @error('sl') is-invalid @enderror" id="validationCustomUsername" placeholder="Seral No" aria-describedby="inputGroupPrepend" name="sl" value="1">
                                    @error('sl')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <label for="validationCustomUsername">আয় খাতের নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control-sm form-control @error('title') is-invalid @enderror" id="validationCustomUsername" placeholder="" aria-describedby="inputGroupPrepend" name="title" value="{{ $data->title }}">
                                    </div>
                                    @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="validationCustomUsername">বিস্তারিত</label>
                                    <div class="input-group">
                                        <textarea class="form-control" name="details">{{ $data->details }}</textarea>
                                    </div>
                                    @error('details')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="validationCustomUsername">স্ট্যাটাস</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="form-control-sm form-control @error('status') is-invalid @enderror" name="status" required="">
                                            @if($data->status == 1)
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                            @else
                                            <option value="0">Inactive</option>
                                            <option value="1">Active</option>
                                            @endif


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
