@extends('Backend.Layouts.master')
@section('body')


@php
Use App\Models\admin_branch_info;

$today_date = date('d/m/Y');
@endphp




<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">নোটিশ</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('ho_collection.index')}}"></a></li>
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
                        <h5>নোটিশ যুক্ত করুন</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('notices.update',$data->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <label>তারিখ</label><span class="text-danger">*</span>
                                    <input type="date" class="form-control form-control-sm" name="published_date" required value="{{$data->published_date}}">
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <label>টাইটেল</label><span class="text-danger">*</span>
                                    <input type="text" class="form-control form-control-sm" name="title" required value="{{$data->title}}">
                                </div>
                            <div class="col-sm-12 mb-3">
                                <label for="validationCustomUsername">বিস্তরিত</label>
                                <div class="input-group">
                                    <textarea class="form-control" name="description" required>{!! $data->description !!}</textarea>
                                </div>
                                @error('main_menu')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-12 mb-3">
                                <label>গুরুত্বপূর্ণ ফাইল/ছবি</label>
                                <input type="file" class="form-control form-control-sm" name="file">
                                @php
                                $path = base_path().'/Backend/Notices/'.$data->file;
                                @endphp
                                @if(file_exists($path))
                                <a target="_blank" href="{{asset('/Backend/Notices')}}/{{$data->file}}" class="btn btn-sm btn-info">View File</a>
                                @endif
                            </div>

                            <div class="col-sm-12 mb-3">
                                <label for="validationCustomUsername">স্ট্যাটাস</label><span class="text-danger">*</span>
                                <div class="input-group">
                                    <select class="form-control-sm form-control @error('status') is-invalid @enderror" name="status" required>

                                        <option @if($data->status  == '1') selected @endif value="1">Active</option>
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
    <script>
        $('.date').datepicker({
        'format': 'dd/mm/yyyy',
        'autoclose': true
    });
    </script>
    @endsection
