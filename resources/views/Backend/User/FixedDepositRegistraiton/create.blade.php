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
                            <h5 class="m-b-10">ফিক্সড ডিপোজিট রেজিষ্ট্রেশন</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('fixeddeposit_registration.index')}}">ফিক্সড ডিপোজিট রেজিষ্ট্রেশন</a></li>
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
                        <h5>ফিক্সড ডিপোজিট রেজিষ্ট্রেশন করুন</h5>
                    </div>
                    <div class="card-body">
                        @php
                        $today_date = date('d/m/Y');
                        @endphp
                        <form action="{{route('fixeddeposit_registration.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label>তারিখ</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="date form-control form-control-sm @error('registration_date') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="registration_date" value="{{old('registration_date')}}">
                                    </div>
                                    @error('registration_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-sm-3 mb-3">
                                    <label>ব্রাঞ্চ নাম</label><span class="text-danger">*</span>
                                        <select class="js-example-basic-single form-control @error('user_role') is-invalid @enderror" name="branch_id" id="branch_id" onchange="loadArea()">
                                            <option value="">নির্বাচন করুন</option>
                                            @if($branch)
                                            @foreach($branch as $v)
                                            <option value="{{$v->id}}">{{$v->branch_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        @error('branch_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>


                                <div class="col-sm-6 mb-3">
                                    <label>কেন্দ্র নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('area_id') is-invalid @enderror" name="area_id" id="area_id" onchange="loadMember()">
                                            <option value="">নির্বাচন করুন</option>
                                        </select>
                                    </div>
                                    @error('area_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>মেম্বার নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('member_id') is-invalid @enderror" name="member_id" id="member_id" onchange="loadMobileNumber()">
                                            <option value="">নির্বাচন করুন</option>
                                        </select>
                                    </div>
                                    @error('member_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>ফোন</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('phone') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="phone" value="{{old('phone')}}" id="phone">
                                    </div>
                                    @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>স্কিমা নির্বাচন করুন</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('schema_id') is-invalid @enderror" name="schema_id">
                                            <option value="">নির্বাচন করুন</option>
                                            @if ($schema)
                                            @foreach ($schema as $v)
                                            <option value="{{$v->id}}">{{$v->fixed_deposit_name}}</option>
                                            @endforeach

                                            @endif
                                        </select>
                                    </div>
                                    @error('schema_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>ডিপোজিট পরিমাণ</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="onlyEng form-control form-control-sm @error('deposit_ammount') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="deposit_ammount" value="{{old('deposit_ammount')}}">
                                    </div>
                                    @error('deposit_ammount')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>সার্ভিস চার্জ</label>
                                    <div class="input-group">
                                        <input type="text" class="onlyEng form-control form-control-sm @error('service_charge') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="service_charge" value="{{old('service_charge')}}">
                                    </div>
                                    @error('service_charge')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>ডিপোজিট খোলার তারিখ</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="date form-control form-control-sm @error('deposit_opening_date') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="deposit_opening_date" value="{{old('deposit_opening_date')}}">
                                    </div>
                                    @error('deposit_opening_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>ডিপোজিট মেয়াদ উত্তীর্ণের তারিখ</label>
                                    <div class="input-group">
                                        <input type="text" class="date form-control form-control-sm @error('deposit_exp_date') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="deposit_exp_date" value="{{old('deposit_exp_date')}}">
                                    </div>
                                    @error('deposit_exp_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>মন্তব্য</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('comment') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="comment" value="{{old('comment')}}">
                                    </div>
                                    @error('comment')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>স্ট্যাটাস</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('status') is-invalid @enderror" name="status">
                                            <option value="">নির্বাচন করুন</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                    @error('status')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="card-header">
                                <h5>নমীনী তথ্য</h5>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label>নমীনী নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('nominee_name') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="nominee_name" value="{{old('nominee_name')}}">
                                    </div>
                                    @error('nominee_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>ইমেইল</label>
                                    <div class="input-group">
                                        <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="email" value="{{old('email')}}">
                                    </div>
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>বর্তমান ঠিকানা</label>
                                    <div class="input-group">
                                        <textarea class="form-control" name="present_address"></textarea>
                                    </div>
                                    @error('present_address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>স্থায়ী ঠিকানা</label>
                                    <div class="input-group">
                                        <textarea class="form-control" name="permanent_address"></textarea>
                                    </div>
                                    @error('permanent_address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>জাতীয় পরিচয় পত্রের নাম্বার</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('nid_no') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="nid_no" value="{{old('nid_no')}}">
                                    </div>
                                    @error('nid_no')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>আবেদনকারীর সাথে সম্পর্ক</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('relation') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="relation" value="{{old('relation')}}">
                                    </div>
                                    @error('relation')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>ছবি</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control form-control-sm @error('nominee_image') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="nominee_image">
                                    </div>
                                    @error('nominee_image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>স্বাক্ষর</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control form-control-sm @error('nominee_signature') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="nominee_signature">
                                    </div>
                                    @error('nominee_signature')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>জাতীয় পরিচয় পত্র</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control form-control-sm @error('nominee_nid') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="nominee_nid">
                                    </div>
                                    @error('nominee_nid')
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

                        url : '{{ url('loadMember3') }}',

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
    function loadMobileNumber()
    {
        var member_id = $('#member_id').val();

            $.ajax({

                headers:{
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },

                url : '{{ url('getmemberphone') }}/'+member_id,

                type : 'GET',

                success : function(data)
                {
                    $('#phone').val(data);
                }

            });

    }
</script>

        @endsection
