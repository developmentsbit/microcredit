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
                            <h5 class="m-b-10">বিনিয়োগ রেজিষ্ট্রেশন</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('investment_registration.index')}}">বিনিয়োগ রেজিষ্ট্রেশন</a></li>
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
                        <h5>বিনিয়োগ রেজিষ্ট্রেশন করুন</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('investment_registration.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="approval" value="0">


                            <div class="row">
                                <div class="col-sm-4 mb-3">
                                    <label>তারিখ</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="date form-control form-control-sm @error('date') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="date" value="{{date('d/m/Y')}}" required="" autocomplete="off">
                                    </div>
                                    @error('date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-4 mb-3">
                                    <label>ব্রাঞ্চ নাম <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('branch_id') is-invalid @enderror" name="branch_id" required="" id="branch_id" onchange="loadArea()">
                                            <option value="">নির্বাচন করুন</option>
                                            @php

                                            if(Auth::user()->user_role == 1) {
                                                $admin_branch = DB::table("branch_infos")->get();
                                            }
                                            else{

                                                $admin_branch = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
                                                ->join('branch_infos','branch_infos.id','=','admin_branch_infos.branch_id')
                                                ->select('branch_infos.*')
                                                ->get();

                                            }

                                            @endphp

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
                                    <label>কেন্দ্র নাম <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('area_id') is-invalid @enderror" name="area_id" id="area_id" onchange="loadMember()">
                                            <option value="">নির্বাচন করুন</option>
                                        </select>
                                    </div>
                                    @error('area_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-sm-3 mb-3">
                                    <label>মেম্বার নাম <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('member_id') is-invalid @enderror" name="member_id" id="member_id" onchange="getdepositenumber();">
                                            <option value="">নির্বাচন করুন</option>

                                        </select>
                                    </div>
                                    @error('member_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-sm-6 mb-3">
                                    <label>ডিপোজিট অ্যাকাউন্ট নাম্বার <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select class="form-control js-example-basic-single" name="deposite" required="" id="deposite">
                                            <option value="">Select Deposite Account</option>
                                        </select>
                                    </div>
                                    @error('deposite')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-sm-3 mb-3">
                                    <label>ফোন</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('phone') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="phone" id="phone" value="{{old('phone')}}">
                                    </div>
                                    @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>






                                <div class="col-sm-6 mb-3">
                                    <label>স্কিমা নির্বাচন করুন <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('schema_id') is-invalid @enderror" name="schema_id" id="schema_id" required="" onchange="calCulateData();getInvestmentSchemaInstallment()">

                                            @php
                                            $schema = DB::table("investmentschemas")->get();
                                            @endphp
                                            <option value="">নির্বাচন করুন</option>
                                            @if(isset($schema))
                                            @foreach($schema as $s)
                                            <option value="{{ $s->id }}">{{ $s->investment_name }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('schema_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="col-sm-3 mb-3">
                                    <label>লাভের পরিমাণ (%)</label>
                                    <div class="input-group">
                                        <input type="text" class=" form-control form-control-sm @error('schema_per') is-invalid @enderror" aria-describedby="inputGroupPrepend" required="" name="schema_per"  id="schema_per" onkeyup="calCulateData2()">
                                    </div>
                                    @error('schema_per')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>



                                <div class="col-sm-3 mb-3">
                                    <label>বিনিয়োগ পরিমাণ <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class=" form-control form-control-sm @error('amount') is-invalid @enderror" aria-describedby="inputGroupPrepend" required="" name="amount"  id="investment_amount" onkeyup="calCulateData2()">
                                    </div>
                                    @error('amount')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>








                                <div class="col-sm-3 mb-3">
                                    <label>মোট</label>
                                    <div class="input-group">
                                        <input type="text" class=" form-control form-control-sm @error('totalamount') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="totalamount"  id="totalamount" readonly="">
                                    </div>
                                    @error('totalamount')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>




                                <div class="col-sm-2 mb-3">
                                    <label>কিস্তির নং <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class=" form-control form-control-sm @error('installment') is-invalid @enderror" aria-describedby="inputGroupPrepend" required="" name="installment" value="{{old('installment')}}" id="installment_no" onkeyup="calCulateData2()" readonly>
                                    </div>
                                    @error('installment')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>




                                <div class="col-sm-3 mb-3">
                                    <label>কিস্তির পরিমাণ</label>
                                    <div class="input-group">
                                        <input type="text" class=" form-control form-control-sm @error('installment_amount') is-invalid @enderror" aria-describedby="inputGroupPrepend" required="" name="installment_amount" id="installment_amount" readonly="">
                                    </div>
                                    @error('installment_amount')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                   <div class="col-sm-2 mb-3">
                                    <label>আসল টাকা</label>
                                    <div class="input-group">
                                        <input type="text" class=" form-control form-control-sm" aria-describedby="inputGroupPrepend" id="asol" readonly="">
                                    </div>

                                </div>

                                   <div class="col-sm-2 mb-3">
                                    <label>লাভের পরিমাণ</label>
                                    <div class="input-group">
                                        <input type="text" class=" form-control form-control-sm" aria-describedby="inputGroupPrepend" id="laberporiman" readonly="">
                                    </div>

                                </div>


                                <div class="col-sm-4 mb-3">
                                    <label>ঝুকির পরিমাণ</label>
                                    <div class="input-group">
                                        <input type="text" class=" form-control form-control-sm @error('risk_amount') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="risk_amount" value="{{old('risk_amount')}}">
                                    </div>
                                    @error('risk_amount')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>





                                {{-- <div class="col-sm-6 mb-3">
                                    <label>সার্ভিস চার্জ</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('service_charge') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="service_charge" value="{{old('service_charge')}}" onkeyup="calCulateData()">
                                    </div>
                                    @error('service_charge')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                --}}
                                <div class="col-sm-4 mb-3">
                                    <label>বিনিয়োগ প্রদানের তারিখ <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="date form-control form-control-sm @error('investment_start_date') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="investment_start_date" value="{{old('investment_start_date')}}" required="">
                                    </div>
                                    @error('investment_start_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <input type="text" name="duration" id="duraiton">
                                




                                <div class="col-sm-4 mb-3">
                                    <label>মন্তব্য</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('comment') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="comment" value="{{old('comment')}}">
                                    </div>
                                    @error('comment')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <input type="hidden" value="0" name="status">
                            </div>
                            <div class="bg-dark rounded p-2 mt-3">
                                <h5 class="text-light text-center"><b>নমীনী তথ্য</b></h5>
                            </div><hr>
                            <div class="row">
                                <div class="col-sm-3 mb-3">
                                    <label>নমীনী নাম</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('nominee_name') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="nominee_name" value="{{old('nominee_name')}}">
                                    </div>
                                    @error('nominee_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-3 mb-3">
                                    <label>ইমেইল</label>
                                    <div class="input-group">
                                        <input type="email" class="form-control form-control-sm @error('nominee_email') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="nominee_email" value="{{old('nominee_email')}}">
                                    </div>
                                    @error('nominee_email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-sm-3 mb-3">
                                    <label>জাতীয় পরিচয় পত্রের নাম্বার</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('nominee_nid_no') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="nominee_nid_no" value="{{old('nominee_nid_no')}}">
                                    </div>
                                    @error('nominee_nid_no')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-3 mb-3">
                                    <label>আবেদনকারীর সাথে সম্পর্ক</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('relation_for_applicant') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="relation_for_applicant" value="{{old('relation_for_applicant')}}">
                                    </div>
                                    @error('relation_for_applicant')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>



                                <div class="col-sm-6 mb-3">
                                    <label>বর্তমান ঠিকানা</label>
                                    <div class="input-group">
                                        <textarea class="form-control" name="nominee_present_address"></textarea>
                                    </div>
                                    @error('present_address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>স্থায়ী ঠিকানা</label>
                                    <div class="input-group">
                                        <textarea class="form-control" name="nominee_permanent_address"></textarea>
                                    </div>
                                    @error('permanent_address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-4 mb-3">
                                    <label>ছবি</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control form-control-sm @error('nominee_image') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="nominee_image">
                                    </div>
                                    @error('nominee_image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>স্বাক্ষর</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control form-control-sm @error('nominee_signature') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="nominee_signature">
                                    </div>
                                    @error('nominee_signature')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>জাতীয় পরিচয় পত্র</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control form-control-sm @error('nominee_nid') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="nominee_nid">
                                    </div>
                                    @error('nominee_nid')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="bg-dark rounded p-2 mt-3">
                                <h5 class="text-light text-center"><b>গ্রেন্টার ১</b></h5>
                            </div><hr>


                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label>নাম</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('go_name') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="go_name" value="{{old('go_name')}}">
                                    </div>
                                    @error('go_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label>ফোন</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('go_phone') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="go_phone" value="{{old('go_phone')}}">
                                    </div>
                                    @error('go_phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>বর্তমান ঠিকানা</label>
                                    <div class="input-group">
                                        <textarea class="form-control" name="go_address"></textarea>
                                    </div>
                                    @error('go_address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>স্বাক্ষর</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control form-control-sm @error('go_signature') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="go_signature">
                                    </div>
                                    @error('go_signature')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>জাতীয় পরিচয় পত্র</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control form-control-sm @error('go_nid') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="go_nid">
                                    </div>
                                    @error('go_nid')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                              <div class="bg-dark rounded p-2 mt-3">
                                <h5 class="text-light text-center"><b>গ্রেন্টার ২</b></h5>
                            </div><hr>




                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label>নাম</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('gt_name') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="gt_name" value="{{old('gt_name')}}">
                                    </div>
                                    @error('gt_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label>ফোন</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('gt_phone') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="gt_phone" value="{{old('gt_phone')}}">
                                    </div>
                                    @error('gt_phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>বর্তমান ঠিকানা</label>
                                    <div class="input-group">
                                        <textarea class="form-control" name="gt_address"></textarea>
                                    </div>
                                    @error('gt_address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>স্বাক্ষর</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control form-control-sm @error('gt_signature') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="gt_signature">
                                    </div>
                                    @error('gt_signature')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>জাতীয় পরিচয় পত্র</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control form-control-sm @error('gt_nid') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="gt_nid">
                                    </div>
                                    @error('gt_nid')
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


            function getdepositenumber()
            {
                var member_id = $('#member_id').val();

                // alert(member_id);

                if(member_id == "")
                {

                }else{

                   $.ajax({

                    headers : {
                        'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                    },

                    url : '{{ url('loaddeposite') }}',

                    type : 'POST',

                    data : {member_id},

                    success : function(data)
                    {
                        $('#deposite').html(data);
                            // alert(data);

                        // $("#registration_id").val(member_id);
                        }

                    });

                //    getmemberphone();

               }



           }

           function getmemberphone(){

              var member_id = $('#member_id').val();
              $.ajax({

                headers : {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },

                url : '{{ url('getmemberphone') }}/'+member_id,

                type : 'GET',

                success : function(response)
                {
                    $('#phone').val(response);

                }

            });

          }





      </script>


      <script>
        $('.date').datepicker({
            'format': 'd/m/yyyy',
            'autoclose': true
        });
    </script>



    <script>

        function calCulateData()
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

                    url : '{{url('getinvestSchemaPer')}}',

                    type : 'POST',

                    data : {schema_id},

                    success : function(data)
                    {
                    // alert(data);
                    $('#schema_per').val(data);


                }

            });

            }



        }

        function calCulateData2(){

            var investment_amount = parseInt($('#investment_amount').val());
            var schema_per = parseInt($('#schema_per').val());
            var installment_no = parseInt($("#installment_no").val());

            var schema_id = $('#schema_id').val();
            
            // alert(schema_id);
            
            if(schema_id == 2)
            {
                var totalamount = investment_amount * schema_per / 100;
                $('#totalamount').val(investment_amount);
            }
            else
            {
                var totalamount = investment_amount * schema_per / 100;
                $('#totalamount').val(totalamount+investment_amount);
            }


            var installment_amount = (investment_amount+totalamount);
            $("#installment_amount").val(installment_amount/installment_no);

            $("#asol").val(investment_amount);
            $("#laberporiman").val(totalamount);

        }




    </script>

    <script>
        $('.date').datepicker({
            'format': 'd/m/yyyy',
            'autoclose': true
        });
    </script>


<script>

    function getInvestmentSchemaInstallment()
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

                url : '{{url('getInvestmentSchemaInstallment')}}',

                type : 'POST',

                data : {schema_id},

                success : function(data)
                {
                    var explode = data.split("and");
                    $('#installment_no').val(explode[0]);
                    $('#duraiton').val(explode[1]);
                }

                });
                // alert(instalment_ammount);
        }

    }

</script>

    @endsection
