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
                            <h5 class="m-b-10"> লোন প্রদান</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('loan_handover.index')}}"> লোন প্রদান</a></li>
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
                        <h5> লোন প্রদান যুক্ত করুন</h5>
                    </div>
                    <div class="card-body">
                        @php 
                        $today_date = date('d/m/Y');
                        @endphp
                        <form action="{{route('loan_handover.store')}}" method="POST">
                            @csrf
                            <div class="row">


                                <div class="col-sm-2 mb-3 d-none">
                                    <label for="validationCustomUsername">সিরিয়াল নং</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control-sm form-control @error('serial_no') is-invalid @enderror" id="validationCustomUsername" placeholder="Seral No" aria-describedby="inputGroupPrepend" name="serial_no" value="{{old('serial_no')}}">
                                    </div>
                                    @error('serial_no')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                 <input type="hidden" class="form-control-sm form-control @error('serial_no') is-invalid @enderror" id="validationCustomUsername" placeholder="Seral No" aria-describedby="inputGroupPrepend" name="serial_no" value="1">




                                <div class="col-sm-5 mb-3">
                                    <label for="validationCustomUsername">তারিখ</label>
                                    <div class="input-group">
                                        <input type="text" class="date form-control-sm form-control @error('date') is-invalid @enderror" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="date" value="{{$today_date}}">
                                    </div>
                                    @error('date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-5 mb-3">
                                    <label>ব্রাঞ্চ নাম</label>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('branch_id') is-invalid @enderror" name="branch_id" id="branch_id" onchange="loadBranchMember()">
                                            <option value="">নির্বাচন করুন</option>
                                            @if($branch)
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
                                    <label>গ্রাহক নাম</label>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('member_id') is-invalid @enderror" name="member_id" id="member_id" onchange="gettotalloan();">
                                            <option value="">নির্বাচন করুন</option>
                                        </select>
                                    </div>
                                    @error('member_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                 <div class="col-sm-6 mb-3">
                                    <label for="validationCustomUsername">বাকী লোন</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control-sm form-control" id="totalloan" aria-describedby="inputGroupPrepend" readonly="">
                                    </div>
                                </div>


                                <div class="col-sm-6 mb-3">
                                    <label for="validationCustomUsername">পরিমাণ</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control-sm form-control @error('ammount') is-invalid @enderror" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="ammount" value="{{old('ammount')}}">
                                    </div>
                                    @error('ammount')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-sm-6 mb-3">
                                    <label for="validationCustomUsername">বিস্তারিত</label>
                                    <div class="input-group">
                                        <textarea class="form-control" name="description"></textarea>
                                    </div>
                                    @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="validationCustomUsername">স্ট্যাটাস</label>
                                    <div class="input-group">
                                        <select class="form-control-sm form-control @error('status') is-invalid @enderror" name="status"> 
                                            <option value="">নির্বাচন করুন</option>
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
                'format': 'd/m/yyyy',
                'autoclose': true
            });
        </script>
        <script>
            function loadBranchMember()
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

                        url : '{{ url('loadBranchMember2') }}',

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


            function gettotalloan(){

                var member_id = $("#member_id").val();

                $.ajax({

                    headers : {
                        'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                    },

                    url : '{{ url('gettotalloan') }}/'+member_id,

                    type : 'GET',

                    success : function(response)
                    {
                        $('#totalloan').val(response);
                        }

                    });

            }
        </script>
        @endsection