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
                            <h5 class="m-b-10">সঞ্চয় আদায়</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('saving_collection.index')}}">সঞ্চয় আদায়</a></li>
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
                        <h5>সঞ্চয় আদায় আপডেট করুন</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('saving_collection.update',$data->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-4 mb-3">
                                    <label>তারিখ</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="date" class="form-control form-control-sm @error('collection_date') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="collection_date" value="{{$data->collection_date}}">
                                    </div>
                                    @error('collection_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>ব্রাঞ্চ নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('branch_id') is-invalid @enderror" name="branch_id" id="branch_id" onchange="loadArea()">
                                            <option value="">নির্বাচন করুন</option>
                                            @if ($branch)
                                            @foreach ($branch as $v)
                                            <option @if($v->id == $data->branch_id) selected @endif value="{{$v->id}}">{{$v->branch_name}}</option>
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
                                        <select class="js-example-basic-single form-control @error('area_id') is-invalid @enderror" name="area_id" id="area_id" onchange="loadMember()">
                                            <option value="">নির্বাচন করুন</option>
                                            @if($area)
                                            @foreach ($area as $v)
                                            <option @if ($data->area_id == $v->id) selected @endif value="{{$v->id}}">{{$v->area_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('area_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>সদস্যের নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('member_id') is-invalid @enderror" name="member_id" id="member_id">
                                            <option value="">নির্বাচন করুন</option>
                                            @if($member)
                                            @foreach ($member as $v)
                                            <option @if($v->registration_id == $data->member_id) selected @endif value="{{$v->registration_id}}">{{$v->aplicant_name}} - {{$v->registration_id}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('member_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                @php
                                // $savings_ammount = DB::table('savings_collections')->where('savings_collections.memeber_id',$data->member_id)->sum('savings_collections.savings_ammount');
                                @endphp
                                <div class="col-sm-6 mb-3">
                                    <label>মোট জমা</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('savings_ammount') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="savings_ammount" value="{{$savings_ammount}}" readonly>
                                    </div>
                                    @error('savings_ammount')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>ডিপোজিট পরিমাণ</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('deposit_ammount') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="deposit_ammount" value="{{$data->deposit_ammount}}">
                                    </div>
                                    @error('deposit_ammount')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>মোট</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('total') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="total" value="{{$data->total}}" readonly>
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
@endsection
