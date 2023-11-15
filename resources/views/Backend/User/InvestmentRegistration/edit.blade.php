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
                        <h5>বিনিয়োগ রেজিষ্ট্রেশন</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('investment_registration.update',$data->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="approval" value="{{ $data->approval }}">

                            @php
                            $explode = explode('-',$data->date);

                            $date = $explode[2].'/'.$explode[1].'/'.$explode[0];
                            @endphp

                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label>তারিখ</label>
                                    <div class="input-group">
                                        <input type="text" class="date form-control form-control-sm @error('date') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="date" value="{{ $date }}" required="" >
                                    </div>
                                    @error('date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label>ব্রাঞ্চ নাম</label>
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

                                            <option value="{{ $showbranch->id }}" <?php if ($showbranch->id == $data->branch_id) {
                                               echo "selected";
                                           } ?>>{{ $showbranch->branch_name }}</option>

                                           @endforeach
                                           @endif

                                       </select>
                                   </div>
                                   @error('branch_id')
                                   <div class="alert alert-danger">{{ $message }}</div>
                                   @enderror
                               </div>


                               <div class="col-sm-6 mb-3">
                                <label>কেন্দ্র নাম</label>
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
                            <div class="col-sm-6 mb-3">
                                <label>মেম্বার নাম</label>
                                <div class="input-group">
                                    <select class="js-example-basic-single form-control @error('member_id') is-invalid @enderror" name="member_id" id="member_id">
                                        <option value="">নির্বাচন করুন</option>
                                        @if($member)
                                        @foreach ($member as $v)
                                        <option @if($v->id == $data->member_id) selected @endif value="{{$v->id}}">{{$v->aplicant_name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                @error('member_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6 mb-3">
                                <label>ফোন</label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm @error('phone') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="phone" value="{{ $data->phone }}">
                                </div>
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label>স্কিমা নির্বাচন করুন</label>
                                <div class="input-group">
                                    <select class="js-example-basic-single form-control @error('schema_id') is-invalid @enderror" name="schema_id" required="" onchange="getInvestmentSchemaInstallment()">

                                        @php
                                        $schema = DB::table("investmentschemas")->get();
                                        @endphp
                                        @if(isset($schema))
                                        @foreach($schema as $s)
                                        <option value="{{ $s->id }}" <?php if ($s->id == $data->schema_id) {
                                            echo "selected";
                                        } ?>>{{ $s->investment_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                @error('schema_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label>বিনিয়োগ পরিমাণ</label>
                                <div class="input-group">
                                    <input type="text" class="onlyEng form-control form-control-sm @error('amount') is-invalid @enderror" aria-describedby="inputGroupPrepend" required="" name="amount" value="{{ $data->amount }}">
                                </div>
                                @error('amount')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label>মোট</label>
                                <div class="input-group">
                                    <input type="text" class="onlyEng form-control form-control-sm @error('totalamount') is-invalid @enderror" aria-describedby="inputGroupPrepend" required="" name="totalamount" value="{{$data->totalamount}}">
                                </div>
                                @error('totalamount')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label>সার্ভিস চার্জ</label>
                                <div class="input-group">
                                    <input type="text" class="onlyEng form-control form-control-sm @error('service_charge') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="service_charge" value="{{$data->service_charge}}">
                                </div>
                                @error('service_charge')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label>কিস্তির নং</label>
                                <div class="input-group">
                                    <input type="text" class="onlyEng form-control form-control-sm @error('installment') is-invalid @enderror" aria-describedby="inputGroupPrepend" required="" name="installment" value="{{$data->installment}}">
                                </div>
                                @error('installment')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label>কিস্তির পরিমাণ</label>
                                <div class="input-group">
                                    <input type="text" class="onlyEng form-control form-control-sm @error('installment_amount') is-invalid @enderror" aria-describedby="inputGroupPrepend" required="" name="installment_amount" value="{{$data->installment_amount}}">
                                </div>
                                @error('installment_amount')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            @php
                            $explode1 = explode('-',$data->investment_start_date);

                            $investment_start_date = $explode1[2].'/'.$explode1[1].'/'.$explode1[0];

                            $explode2 = explode('-',$data->investment_end_date);

                            $investment_end_date = $explode2[2].'/'.$explode2[1].'/'.$explode2[0];
                            @endphp

                            <div class="col-sm-6 mb-3">
                                <label>বিনিয়োগ প্রদানের তারিখ</label>
                                <div class="input-group">
                                    <input type="text" class="date form-control form-control-sm @error('investment_start_date') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="investment_start_date" value="{{$investment_start_date}}" required="">
                                </div>
                                @error('investment_start_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label>বিনিয়োগ মেয়াদ উত্তীর্ণের তারিখ</label>
                                <div class="input-group">
                                    <input type="text" class="date form-control form-control-sm @error('investment_end_date') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="investment_end_date" value="{{$investment_end_date}}" required="">
                                </div>
                                @error('investment_end_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label>ডিপোজিট পরিমাণ</label>
                                <div class="input-group">
                                    <input type="text" class="onlyEng form-control form-control-sm @error('deposite') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="deposite" value="{{$data->deposite}}">
                                </div>
                                @error('deposite')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label>ঝুকির পরিমাণ</label>
                                <div class="input-group">
                                    <input type="text" class="onlyEng form-control form-control-sm @error('risk_amount') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="risk_amount" value="{{ $data->risk_amount }}">
                                </div>
                                @error('risk_amount')
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
                                <label>স্ট্যাটাস</label>
                                <div class="input-group">
                                    <select class="js-example-basic-single form-control @error('status') is-invalid @enderror" name="status">
                                     @if($data->status == 1)
                                     <option value="1">Active</option>
                                     <option value="0">Inactive</option>
                                     @else
                                     <option value="0">Inactive</option>
                                     <option value="1">Active</option>
                                     @endif
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
                            <label>নমীনী নাম</label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm @error('nominee_name') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="nominee_name" value="{{ $data->nominee_name }}">
                            </div>
                            @error('nominee_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label>ইমেইল</label>
                            <div class="input-group">
                                <input type="email" class="form-control form-control-sm @error('nominee_email') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="nominee_email" value="{{ $data->nominee_email }}">
                            </div>
                            @error('nominee_email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label>বর্তমান ঠিকানা</label>
                            <div class="input-group">
                                <textarea class="form-control" name="nominee_present_address">{{ $data->nominee_present_address }}</textarea>
                            </div>
                            @error('present_address')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label>স্থায়ী ঠিকানা</label>
                            <div class="input-group">
                                <textarea class="form-control" name="nominee_permanent_address">{{ $data->nominee_permanent_address }}</textarea>
                            </div>
                            @error('permanent_address')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label>জাতীয় পরিচয় পত্রের নাম্বার</label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm @error('nominee_nid_no') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="nominee_nid_no" value="{{$data->nominee_nid_no}}">
                            </div>
                            @error('nominee_nid_no')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label>আবেদনকারীর সাথে সম্পর্ক</label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm @error('relation_for_applicant') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="relation_for_applicant" value="{{ $data->relation_for_applicant }}">
                            </div>
                            @error('relation_for_applicant')
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
                            <img src="{{asset('Backend/images/InvestorImage')}}/{{$data->nominee_image}}" class="img-fluid" style="max-height: 50px;">
                            <input type="hidden" name="oldimage2" value="{{asset('Backend/images/InvestorImage')}}/{{$data->nominee_image}}">
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label>স্বাক্ষর</label>
                            <div class="input-group">
                                <input type="file" class="form-control form-control-sm @error('nominee_signature') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="nominee_signature">
                            </div>
                            @error('nominee_signature')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                             <img src="{{asset('Backend/images/InvestorImage')}}/{{$data->nominee_signature}}" class="img-fluid" style="max-height: 50px;">
                            <input type="hidden" name="oldimage3" value="{{asset('Backend/images/InvestorImage')}}/{{$data->nominee_signature}}">
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label>জাতীয় পরিচয় পত্র</label>
                            <div class="input-group">
                                <input type="file" class="form-control form-control-sm @error('nominee_nid') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="nominee_nid">
                            </div>
                            @error('nominee_nid')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                             <img src="{{asset('Backend/images/InvestorNomNid')}}/{{$data->nominee_nid}}" class="img-fluid" style="max-height: 50px;">
                        </div>
                    </div>
                    <div class="card-header">
                        <h5>গ্রেন্টার ১</h5>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label>নাম</label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm @error('go_name') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="go_name" value="{{$data->go_name}}">
                            </div>
                            @error('go_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-sm-6 mb-3">
                            <label>ফোন</label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm @error('go_phone') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="go_phone" value="{{$data->go_phone}}">
                            </div>
                            @error('go_phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label>বর্তমান ঠিকানা</label>
                            <div class="input-group">
                                <textarea class="form-control" name="go_address">{{ $data->go_address }}</textarea>
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

                             <img src="{{asset('Backend/images/InvestorImage')}}/{{$data->go_signature}}" class="img-fluid" style="max-height: 50px;">
                            <input type="hidden" name="oldimage4" value="{{asset('Backend/images/InvestorImage')}}/{{$data->go_signature}}">
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label>জাতীয় পরিচয় পত্র</label>
                            <div class="input-group">
                                <input type="file" class="form-control form-control-sm @error('go_nid') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="go_nid">
                            </div>
                            @error('go_nid')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                             <img src="{{asset('Backend/images/goNid')}}/{{$data->go_nid}}" class="img-fluid" style="max-height: 50px;">
                        </div>
                    </div>
                    <div class="card-header">
                        <h5>গ্রেন্টার ২</h5>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label>নাম</label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm @error('gt_name') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="gt_name" value="{{$data->gt_name}}">
                            </div>
                            @error('gt_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-sm-6 mb-3">
                            <label>ফোন</label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm @error('gt_phone') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="gt_phone" value="{{$data->gt_phone}}">
                            </div>
                            @error('gt_phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label>বর্তমান ঠিকানা</label>
                            <div class="input-group">
                                <textarea class="form-control" name="gt_address">{{ $data->gt_address }}</textarea>
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
                             <img src="{{asset('Backend/images/InvestorImage')}}/{{$data->gt_signature}}" class="img-fluid" style="max-height: 50px;">
                            <input type="hidden" name="oldimage5" value="{{asset('Backend/images/InvestorImage')}}/{{$data->gt_signature}}">
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label>জাতীয় পরিচয় পত্র</label>
                            <div class="input-group">
                                <input type="file" class="form-control form-control-sm @error('gt_nid') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="gt_nid">
                            </div>
                            @error('gt_nid')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                             <img src="{{asset('Backend/images/gtNid')}}/{{$data->gt_nid}}" class="img-fluid" style="max-height: 50px;">
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
                    // alert(data);
                    $('#installment_no').val(data);
                }

                });
                // alert(instalment_ammount);
        }

    }

</script>
        @endsection
