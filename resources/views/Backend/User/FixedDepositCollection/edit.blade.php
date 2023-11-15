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
                        <h5>ফিক্সড ডিপোজিট আপডেট করুন</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('fixeddeposit_collection.update',$data->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            @php
                            $explode = explode('-',$data->collection_date);

                            $collection_date = $explode[2].'/'.$explode[1].'/'.$explode[0];
                            @endphp
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label>তারিখ</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="date form-control form-control-sm @error('collection_date') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="collection_date" value="{{$collection_date}}">
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
                                                <option @if($data->branch_id == $v->id) selected @endif value="{{$v->id}}">{{$v->branch_name}}</option>
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
                                        <select class="js-example-basic-single form-control @error('area_id') is-invalid @enderror" name="area_id" id="area_id" onchange="loadMember()">
                                            <option value="">নির্বাচন করুন</option>
                                            @if($area)
                                            @foreach ($area as $v)
                                            <option @if($data->area_id == $v->id) selected @endif value="{{$v->id}}">{{$v->area_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('area_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>মেম্বার নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('member_id') is-invalid @enderror" name="member_id" id="member_id">
                                            <option value="">নির্বাচন করুন</option>
                                            @if($member)
                                            @foreach ($member as $v)
                                            <option @if($data->member_id == $v->registration_id) selected @endif value="{{$v->registration_id}}">{{$v->aplicant_name}} - {{$v->registration_id}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('member_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>ডিপোজিট পরিমাণ</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('deposit_ammount') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="deposit_ammount" value="{{$data->deposit_ammount}}">
                                    </div>
                                    @error('deposit_ammount')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>সার্ভিস চার্জ</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('service_charge') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="service_charge" value="{{$data->service_charge}}">
                                    </div>
                                    @error('service_charge')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>মোট</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('total') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="total" value="{{$data->total}}">
                                    </div>
                                    @error('total')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>মন্তব্য</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('comment') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="comment" value="{{$data->comment}}">
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

                        url : '{{ url('loadFixedDepositMember') }}',

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
@endsection
