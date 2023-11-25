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
                            <h5 class="m-b-10">কেন্দ্র তথ্য</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('area_info.index')}}">কেন্দ্র</a></li>
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
                        <h5>কেন্দ্র আপডেট করুন</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('area_info.update',$data->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label>সিরিয়াল নং</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('sl') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="sl" value="{{$data->sl}}">
                                    </div>
                                    @error('sl')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>ব্রাঞ্চ নির্বাচন করুন</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control form-control-sm @error('branch_id') is-invalid @enderror" name="branch_id">
                                            <option value="">নির্বাচন করুন</option>
                                            @if($branch)
                                            @foreach($branch as $showbranch)
                                            <option @if($data->branch_id == $showbranch->id) selected @endif value="{{$showbranch->id}}">{{$showbranch->branch_name}}</option>
                                            @endforeach
                                            @endif

                                        </select>
                                    </div>
                                    @error('branch_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>কেন্দ্র নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('area_name') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="area_name" value="{{$data->area_name}}">
                                    </div>
                                    @error('area_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>টাইপ</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="form-control form-control-sm @error('type') is-invalid @enderror" name="type">
                                            <option value="">-- নির্বাচন করুন --</option>
                                            <option @if($data->type == 'daily') selected @endif value="daily">দৈনিক</option>
                                            <option @if($data->type == 'weekly') selected @endif value="weekly">সাপ্তাহিক</option>
                                            <option @if($data->type == 'monthly') selected @endif value="monthly">মাসিক</option>
                                            <option @if($data->type == 'yearly') selected @endif value="yearly">বার্ষিক</option>
                                        </select>
                                    </div>
                                    @error('type')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3 @if($data->type != 'weekly') d-none @endif" id="day">
                                    <label>দিন</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="form-control form-control-sm @error('day') is-invalid @enderror" name="day" onchange="showDay()" id="day" required>
                                            <option value="NULL">-- নির্বাচন করুন --</option>
                                            <option @if($data->day == 'saturday') selected @endif value="saturday">শনিবার</option>
                                            <option @if($data->day == 'sunday') selected @endif value="sunday">রবিবার</option>
                                            <option @if($data->day == 'monday') selected @endif value="monday">সোমবার</option>
                                            <option @if($data->day == 'tuesday') selected @endif value="tuesday">মঙ্গলবার</option>
                                            <option @if($data->day == 'wednesday') selected @endif value="wednesday">বুধবার</option>
                                            <option @if($data->day == 'thursday') selected @endif value="thursday">বৃহস্পতিবার</option>
                                            <option @if($data->day == 'friday') selected @endif value="friday">শুক্রবার</option>
                                        </select>
                                    </div>
                                    @error('day')
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

                            </div>
                            {{-- hidden input --}}
                            <input type="hidden" name="admin_id" value="{{Auth::user()->id}}">
                            <div class="submit-btn">
                                <input type="submit" class="btn btn-success" value="আপডেট করুন">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Latest Customers end -->
        </div>
        <!-- [ Main Content ] end -->
        <script>
            function showDay()
            {
                let type = $('#type').val();
                // alert(type);
                if(type == 'weekly')
                {
                    $('#day').removeClass('d-none');
                }
                else
                {
                    $('#day').addClass('d-none');
                }
            }
        </script>
@endsection
