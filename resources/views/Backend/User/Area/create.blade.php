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
                        <h5>নতুন কেন্দ্র যুক্ত করুন</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('area_info.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label>সিরিয়াল নং</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('sl') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="sl" value="{{old('sl')}}">
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
                                            <option value="{{$showbranch->id}}">{{$showbranch->branch_name}}</option>
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
                                        <input type="text" class="form-control form-control-sm @error('area_name') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="area_name" value="{{old('area_name')}}">
                                    </div>
                                    @error('area_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>টাইপ</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="form-control form-control-sm @error('type') is-invalid @enderror" name="type" onchange="showDay()" id="type">
                                            <option value="">-- নির্বাচন করুন --</option>
                                            <option @if(old('type') == 'daily') selected @endif value="daily">দৈনিক</option>
                                            <option @if(old('type') == 'weekly') selected @endif value="weekly">সাপ্তাহিক</option>
                                            <option @if(old('type') == 'monthly') selected @endif value="monthly">মাসিক</option>
                                            <option @if(old('type') == 'yearly') selected @endif value="yearly">বার্ষিক</option>
                                        </select>
                                    </div>
                                    @error('type')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6 mb-3 d-none" id="day">
                                    <label>দিন</label><span class="text-danger">*</span>
                                    <select class="form-control form-control-sm @error('day') is-invalid @enderror" name="day" onchange="showDay()" id="day" required>
                                        <option value="NULL">-- নির্বাচন করুন --</option>
                                        <option value="saturday">শনিবার</option>
                                        <option value="sunday">রবিবার</option>
                                        <option value="monday">সোমবার</option>
                                        <option value="tuesday">মঙ্গলবার</option>
                                        <option value="wednesday">বুধবার</option>
                                        <option value="thursday">বৃহস্পতিবার</option>
                                        <option value="friday">শুক্রবার</option>
                                    </select>
                                    @error('day')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label>স্ট্যাটাস</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="form-control form-control-sm @error('status') is-invalid @enderror" name="status">
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
                            <input type="hidden" name="admin_id" value="{{Auth::user()->id}}">
                            <div class="submit-btn">
                                <input type="submit" class="btn btn-success" value="যুক্ত করুন">
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
