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
                            <h5 class="m-b-10">ফিক্সড ডিপোজিট আদায়</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('fixeddeposit_collection.index')}}">ফিক্সড ডিপোজিট আদায়</a></li>
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
                        <h5>ফিক্সড ডিপোজিট আদায় করুন</h5>
                    </div>
                    <div class="card-body">
                        @php
                        $today_date = date('d/m/Y');
                        @endphp
                        <form action="{{route('fixeddeposit_collection.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label>তারিখ</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="date form-control form-control-sm @error('collection_date') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="collection_date" value="{{$today_date}}">
                                    </div>
                                    @error('collection_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>ব্রাঞ্চ নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('branch_id') is-invalid @enderror" name="branch_id" id="branch_id" onchange="loadArea()">
                                            <option value="">নির্বাচন করুন</option>
                                            @if ($branch)
                                            @foreach ($branch as $v)
                                                <option value="{{$v->id}}">{{$v->branch_name}}</option>
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
                                        <select class="js-example-basic-single form-control @error('area_id') is-invalid @enderror" name="area_id" id="area_id" onchange="loadMember4()">
                                            <option value="">নির্বাচন করুন</option>
                                        </select>
                                    </div>
                                    @error('area_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                @php
                                    $scheamas = DB::table('fixed_deposit_schemas')->get();
                                @endphp

                                <div class="col-sm-6 mb-3">
                                    <label>স্কিমা নির্বাচন করুন <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('schema_id') is-invalid @enderror" name="schema_id" id="schema_id" required="" onchange="loadMember4();">
                                        <option value="">নির্বাচন করুন</option>
                                            @if($scheamas)
                                            @foreach ($scheamas as $v)
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
                                    <label>মেম্বার নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('member_id') is-invalid @enderror" name="member_id" id="member_id" onchange="loadTotalFixedDeposit()">
                                            <option value="">নির্বাচন করুন</option>
                                            @if($member)
                                            @foreach ($member as $v)
                                            <option value="{{$v->registration_id}}">{{$v->aplicant_name}} - {{$v->registration_id}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('member_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>ডিপোজিট পরিমাণ</label>
                                    <div class="input-group">
                                        <input type="text" class="onlyEng form-control form-control-sm @error('deposit_ammount') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="deposit_ammount" value="{{old('deposit_ammount')}}" id="deposit_ammount" onkeyup="caluclateTotalDeposit()">
                                    </div>
                                    @error('deposit_ammount')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <input type="hidden" id="totalDeposit">
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
                                    <label>মোট</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('total') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="total" value="{{old('total')}}" readonly id="total">
                                    </div>
                                    @error('total')
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
            function loadMember4()
            {
                var area_id = $('#area_id').val();
                // alert(area_id);
                var branch_id = $('#branch_id').val();

                var schema_id = $("#schema_id").val();
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

                        url : '{{ url('loadFixedDepositMember') }}',

                        type : 'POST',

                        data : {area_id,branch_id,schema_id},

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
            function loadTotalFixedDeposit()
            {
                var member_id = $('#member_id').val();

                if(member_id == "")
                {
                    alert('মেম্বার নির্বাচন করুন');
                }
                else
                {
                    $.ajax({

                        headers :
                        {
                            'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                        },

                        url : '{{ url('loadTotalFixedDeposit') }}',

                        type : 'POST',

                        data : {member_id},

                        success : function(data)
                        {
                            $('#total').val(data);
                            $('#totalDeposit').val(data);
                        }

                    });
                }
            }
        </script>

        <script>
            function caluclateTotalDeposit()
            {
                var deposit_ammount = $('#deposit_ammount').val();
                var totalDeposit = $('#totalDeposit').val();

                var result = parseInt(deposit_ammount) + parseInt(totalDeposit);

                $('#total').val(result);
            }
        </script>

        <script>
            $('.date').datepicker({
            'format': 'd/m/yyyy',
            'autoclose': true
        });
        </script>
@endsection
