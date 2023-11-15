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
                            <h5 class="m-b-10">সঞ্চয় রেজিষ্ট্রেশন</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('saving_registration.index')}}">সঞ্চয় রেজিষ্ট্রেশন</a></li>
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
                        <h5>সঞ্চয় রেজিষ্ট্রেশন আপডেট করুন</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('saving_registration.update',$data->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-4 mb-3">
                                    @php
                                    $explode = explode('-',$data->application_date);

                                    $date = $explode[2].'/'.$explode[1].'/'.$explode[0];
                                    @endphp
                                    <label>তারিখ</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="date form-control form-control-sm @error('registration_date') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="registration_date" value="{{$date}}">
                                    </div>
                                    @error('registration_date')
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
                                            @foreach ($area  as $v)
                                            <option @if($v->id == $data->area_id) selected @endif value="{{$v->id}}">{{$v->area_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('area_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>সদস্যের নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('member_id') is-invalid @enderror" name="member_id" id="member_id">
                                            <option value="">নির্বাচন করুন</option>
                                            @if($member)
                                            @foreach ($member as $v)
                                            <option @if($v->member_id == $data->member_id) selected @endif value="{{$v->member_id}}">{{$v->aplicant_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('member_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>ফোন</label>
                                    <div class="input-group">
                                        <input type="text" class=" form-control form-control-sm @error('phone') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="phone" value="{{$data->phone}}">
                                    </div>
                                    @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>স্কিমা নির্বাচন করুন</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('schema_id') is-invalid @enderror" name="schema_id" onchange="getSchemaPer();;getSavingSchemaInstallment()" id="schema_id">
                                            <option value="">নির্বাচন করুন</option>
                                            @if ($schema)
                                            @foreach ($schema as $view)
                                                <option @if($view->id == $data->schema_id) selected @endif value="{{$view->id}}">{{$view->deposit_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('schema_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>লভ্যাংশের শতকরা পরিমাণ (%)</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input id="schema_per" type="text" class=" form-control form-control-sm @error('profit_percantage') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="profit_percantage" value="{{$data->profit_percantage}}" onkeyup="calCulateData()">
                                    </div>
                                    @error('profit_percantage')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <input type="hidden" id="schema_per" value="{{$schema_per->percantage}}">
                                <div class="col-sm-4 mb-3">
                                    <label>সঞ্চয় পরিমাণ</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class=" form-control form-control-sm @error('installment_ammount') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="installment_ammount" value="{{$data->installment_ammount}}" onkeyup="calCulateData()" id="installment_ammount">
                                    </div>
                                    @error('installment_ammount')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>কিস্তির নং</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class=" form-control form-control-sm @error('installment_no') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="installment_no" value="{{$data->installment_no}}" onkeyup="calCulateData()" id="installment_no">
                                    </div>
                                    @error('installment_no')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>মোট সঞ্চয়</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class=" form-control form-control-sm @error('savings_ammount') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="savings_ammount" value="{{$data->savings_ammount}}" onkeyup="calCulateData()" id="savings_ammount">
                                    </div>
                                    @error('savings_ammount')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>লভ্যাংশের পরিমাণ</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class=" form-control form-control-sm @error('profit_ammount') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="profit_ammount" value="{{$data->profit_ammount}}" onkeyup="calCulateData()" id="profit_ammount">
                                    </div>
                                    @error('profit_ammount')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>নীট পরিমাণ</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class=" form-control form-control-sm @error('total') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="total" value="{{$data->total}}" onkeyup="calCulateData()" id="total">
                                    </div>
                                    @error('total')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>সার্ভিস চার্জ</label>
                                    <div class="input-group">
                                        <input type="text" class=" form-control form-control-sm @error('service_charge') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="service_charge" value="{{$data->service_charge}}">
                                    </div>
                                    @error('service_charge')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- @php
                                $explode = explode('-',$data->savings_handover_date);

                                $savings_handover_date = $explode[2].'/'.$explode[1].'/'.$explode[0];
                                @endphp --}}
                                {{-- <div class="col-sm-4 mb-3">
                                    <label>সঞ্চয় প্রদানের তারিখ</label>
                                    <div class="input-group">
                                        <input type="text" class="date form-control form-control-sm @error('savings_handover_date') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="savings_handover_date" value="{{$savings_handover_date}}">
                                    </div>
                                    @error('savings_handover_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div> --}}
                                @php
                                $explode = explode('-',$data->savings_exp_date);

                                $savings_exp_date = $explode[2].'/'.$explode[1].'/'.$explode[0];
                                @endphp
                                <div class="col-sm-4 mb-3">
                                    <label>সঞ্চয় মেয়াদ উত্তীর্ণের তারিখ</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="date form-control form-control-sm @error('savings_exp_date') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="savings_exp_date" value="{{$savings_exp_date}}">
                                    </div>
                                    @error('savings_exp_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>মন্তব্য</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('comment') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="comment" value="{{$data->comment}}">
                                    </div>
                                    @error('comment')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-header">
                                <h5>নমীনী তথ্য</h5>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 mb-3">
                                    <label>নমীনী নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('nominee_name') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="nominee_name" value="{{$nominee->nominee_name}}">
                                    </div>
                                    @error('nominee_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>ইমেইল</label>
                                    <div class="input-group">
                                        <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="email" value="{{$nominee->email}}">
                                    </div>
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>বর্তমান ঠিকানা</label>
                                    <div class="input-group">
                                        <textarea class="form-control" name="present_address">{!! $nominee->present_address !!}</textarea>
                                    </div>
                                    @error('present_address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>স্থায়ী ঠিকানা</label>
                                    <div class="input-group">
                                        <textarea class="form-control" name="permenant_address">{!! $nominee->permenant_address !!}</textarea>
                                    </div>
                                    @error('permenant_address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>জাতীয় পরিচয় পত্রের নাম্বার</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('nid_no') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="nid_no" value="{{$nominee->nid_no}}">
                                    </div>
                                    @error('nid_no')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>আবেদনকারীর সাথে সম্পর্ক</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('relation') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="relation" value="{{$nominee->relation}}">
                                    </div>
                                    @error('relation')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>ছবি</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control form-control-sm @error('nominee_image') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="nominee_image">
                                    </div>
                                    <img src="{{asset('Backend/images/NomineeImage')}}/{{$nominee->nominee_image}}" alt="" height="80px" width="80px">
                                    @error('nominee_image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>স্বাক্ষর</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control form-control-sm @error('nominee_singature') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="nominee_singature">
                                    </div>
                                    <img src="{{asset('Backend/images/NomineeSignature')}}/{{$nominee->nominee_signature}}" alt="" height="80px" width="80px">
                                    @error('nominee_singature')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>জাতীয় পরিচয় পত্র</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control form-control-sm @error('nominee_nid') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="nominee_nid">
                                    </div>
                                    <img src="{{asset('Backend/images/NomineeNid')}}/{{$nominee->nid}}" alt="" height="80px" width="80px">
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

    function getSavingSchemaInstallment()
    {
        var schema_id = $('#schema_id').val();

        if(schema_id == "")
        {
            alert('স্কিমা নির্বাচন করুন');
        }
        else
        {
            $.ajax({

                headers:
                {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },

                url : '{{url('getSavingSchemaInstallment')}}',

                type : 'POST',

                data : {schema_id},

                success : function(data)
                {
                    // alert(data);
                    $('#installment_no').val(data);
                }

                });
                // alert(instalment_ammount);
        }

    }

</script>

<script>

    function getSchemaPer()
    {
        var schema_id = $('#schema_id').val();

        if(schema_id == "")
        {
            alert('স্কিমা নির্বাচন করুন');
        }
        else
        {
            $.ajax({

                headers:
                {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },

                url : '{{url('getSchemaPer')}}',

                type : 'POST',

                data : {schema_id},

                success : function(data)
                {
                    // alert(data);
                    $('#schema_per').val(data);
                }

                });
                // alert(instalment_ammount);
        }

    }

</script>


<script>
    function calCulateData()
    {
        var instalment_ammount = $('#installment_ammount').val();

                var instalment_no = $('#installment_no').val();

                // alert(instalment_no);

                var saving_ammount = instalment_ammount * instalment_no;

                // alert(saving_ammount);


                $('#savings_ammount').val(saving_ammount);

                var schema_per = $('#schema_per').val();

                // alert(schema_per);

                var profit_ammount = saving_ammount * schema_per / 100 ;

                // alert(profit_ammount);

                $('#profit_ammount').val(profit_ammount);

                var net_total = saving_ammount + profit_ammount;

                $('#total').val(net_total);
    }
</script>


<script>
    function loadMobileNumber()
    {
        var member_id = $('#member_id').val();

        if(member_id == "")
        {
            alert('মেম্বার নির্বাচন করুন');
        }
        else
        {
            $.ajax({

                headers:{
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },

                url : '{{ url('loadMobileNumber') }}',

                type : 'POST',

                data : {member_id},

                success : function(data)
                {
                    $('#phone').val(data);
                }

            });
        }
    }
</script>



@endsection
