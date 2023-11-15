@extends('Backend.Layouts.master')
@section('body')

@php
Use App\Models\admin_branch_info;
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
                            <h5 class="m-b-10">গ্রাহকের তথ্য</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('add_member.index')}}">গ্রাহক তথ্য</a></li>
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
                        <h5>গ্রাহক তথ্য</h5>
                    </div>
                    @php
                    $today_date = date('d/m/Y');
                    @endphp
                    <div class="card-body">
                        <form action="{{route('add_member.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-4 mb-3">
                                    <label>ব্রাঞ্চ নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('branch_id') is-invalid @enderror" name="branch_id" required="" id="branch_id" onchange="loadArea()">
                                            <option value="">নির্বাচন করুন</option>

                                            @if($admin_branch)
                                            @foreach($admin_branch as $showbranch)

                                            <option value="{{ $showbranch->id }}">{{ $showbranch->branch_name }}</option>

                                            @endforeach
                                            @endif

                                        </select>
                                    </div>
                                    @error('branch_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>কেন্দ্র নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('area_id') is-invalid @enderror" name="area_id" required="" id="area_id">
                                            <option value="">নির্বাচন করুন</option>
                                            {{-- @php
                                              $areas = DB::table("area_infos")->get();
                                            @endphp

                                            @if(isset($areas))
                                            @foreach($areas as $area)
                                            <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                            @endforeach
                                            @endif --}}
                                        </select>
                                    </div>
                                    @error('area_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>আবেদনের তারিখ</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="date form-control form-control-sm @error('apply_date') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="apply_date" value="{{$today_date}}" required="">
                                    </div>
                                    @error('apply_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>আবেদনকারীর নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('aplicant_name') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="aplicant_name" value="{{old('aplicant_name')}}" required="">
                                    </div>
                                    @error('aplicant_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>স্বামী / স্ত্রীর নাম</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('husband_wife') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="husband_wife" value="{{old('husband_wife')}}">
                                    </div>
                                    @error('husband_wife')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>পিতার নাম</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('father_name') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="father_name" value="{{old('father_name')}}">
                                    </div>
                                    @error('father_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>মাতার নাম</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('mother_name') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="mother_name" value="{{old('mother_name')}}">
                                    </div>
                                    @error('mother_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>লিঙ্গ</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('gender') is-invalid @enderror" name="gender" required="">
                                            <option value="">নির্বাচন করুন</option>
                                            <option value="পুরুষ">পুরুষ</option>
                                            <option value="মহিলা">মহিলা</option>
                                            <option value="অন্যান্য">অন্যান্য</option>
                                        </select>
                                    </div>
                                    @error('gender')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>ধর্ম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('religion') is-invalid @enderror" name="religion">
                                            <option value="">নির্বাচন করুন</option>
                                            <option value="ইসলাম">ইসলাম</option>
                                            <option value="হিন্দু">হিন্দু</option>
                                            <option value="বৌদ্ধ">বৌদ্ধ</option>
                                            <option value="খ্রিস্টান">খ্রিস্টান</option>
                                            <option value="অন্যান্য">অন্যান্য</option>
                                        </select>
                                    </div>
                                    @error('religion')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>জন্ম তারিখ</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control form-control-sm @error('date_of_birth') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="date_of_birth" value="{{old('date_of_birth')}}">
                                    </div>
                                    @error('date_of_birth')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>জাতীয় পরিচয় পত্র নাম্বার</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('nid_no') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="nid_no" value="{{old('nid_no')}}">
                                    </div>
                                    @error('nid_no')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>পেশা</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('occupation') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="occupation" value="{{old('occupation')}}">
                                    </div>
                                    @error('occupation')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>ফোন</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('phone') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="phone" value="{{old('phone')}}">
                                    </div>
                                    @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>বিভাগ</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('division') is-invalid @enderror" name="division" required="" id="division" onchange="loadDistrict()">
                                            <option value="">নির্বাচন করুন</option>
                                            @if($division)
                                            @foreach ($division as $v)
                                                <option value="{{$v->id}}">{{$v->division_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('division')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>জেলা</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('district') is-invalid @enderror" name="district" required="" id="district" onchange="loadUpazila()">
                                            <option value="">নির্বাচন করুন</option>
                                        </select>
                                    </div>
                                    @error('district')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>উপজেলা</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('upazila') is-invalid @enderror" name="upazila" required="" id="upazila">
                                            <option value="">নির্বাচন করুন</option>
                                        </select>
                                    </div>
                                    @error('upazila')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>বর্তমান ঠিকানা</label>
                                    <div class="input-group">
                                        <textarea class="form-control" name="present_address"></textarea>
                                    </div>
                                    @error('present_address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>স্থায়ী ঠিকানা</label>
                                    <div class="input-group">
                                        <textarea class="form-control" name="permenant_address"></textarea>
                                    </div>
                                    @error('permenant_address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>স্ট্যাটাস</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('status') is-invalid @enderror" name="status">

                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                    @error('status')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>আবেদনকারীর ছবি</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control form-control-sm @error('image') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="image">
                                    </div>
                                    @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>আবেদনকারীর জাতীয় পরিচয় পত্র</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control form-control-sm @error('applicant_nid') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="applicant_nid">
                                    </div>
                                    @error('applicant_nid')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>আবেদনকারীর স্বাক্ষর</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control form-control-sm @error('signature') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="signature">
                                    </div>
                                    @error('signature')
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
        <script type="text/javascript">
            function loadArea()
            {
                var branch_id = $('#branch_id').val();

                // var default = "<option value=''>নির্বাচন করুন</option>";

                // alert(branch_id);
                if(branch_id == "")
                {
                    $('#area_id').html("");
                }
                else
                {
                    $.ajax({
                        headers : {
                            'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                        },

                        url : '{{ url('loadArea') }}',

                        type : 'POST',

                        data : {branch_id},

                        success : function(data)
                        {
                            $('#area_id').html(data);
                            // alert(data);
                        }
                    });
                }
            }
        </script>


        <script>
            function loadMember()
            {
                var area_id = $('#area_id').val();
                // alert(area_id);
                var branch_id = $('#branch_id').val();
                // alert(branch_id);
                if(area_id == "")
                {

                }
                else
                {
                    $.ajax({

                        headers : {
                            'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                        },

                        url : '{{ url('loadMember') }}',

                        type : 'POST',

                        data : {area_id,branch_id},

                        success : function(data)
                        {
                            $('#member_id').html(data);
                            // alert(data);
                        }

                    });
                }
            }
        </script>
        <script>
            $('.date').datepicker({
            'format': 'd/m/yyyy',
            'autoclose': true
        });
        </script>

        <script>

            function loadDistrict()
            {
                var division_id = $('#division').val();

                // alert(division_id);

                if(division_id == "")
                {
                    alert('Please Select Division');
                }
                else
                {
                    $.ajax({

                        headers : {
                            'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                        },

                        url : '{{ url('loadDistrict') }}',

                        type : 'POST',

                        data : {division_id},

                        success : function(data)
                        {
                            $('#district').html(data);
                        }

                    });
                }

            }

        </script>

        <script>

            function loadUpazila()
            {
                var district_id = $('#district').val();

                if(district_id == "")
                {
                    alert('Please Select District');
                }
                else
                {
                    $.ajax({

                        headers : {
                            'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                        },

                        url : '{{ url('loadUpazila') }}',

                        type : 'POST',

                        data : {district_id},

                        success : function(data)
                        {
                            $('#upazila').html(data);
                        }

                    });
                }

            }

        </script>

        @endsection
