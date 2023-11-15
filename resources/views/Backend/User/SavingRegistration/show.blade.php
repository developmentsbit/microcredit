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
                        <h5>সঞ্চয় রেজিষ্ট্রেশন তথ্য</h5>
                    </div>
                    <div class="card-body">
                        <h4 class="uk-modal-title">বিস্তারিত তথ্য</h4>
                        <div class="information-box">
                            {{-- <div class="profile-image">
                                <img src="{{asset('Backend/images/EmployeeImage')}}/{{$data->image}}" class="img-fluid" style="height: 100px;width:100px;border-radius:100%;">
                            </div> --}}
                            <div class="informaiton-body">
                                <div class="row">
                                    <div class="col-lg-4 col-12">
                                        <div class="input-single-box">
                                            <label>তারিখ</label>
                                            <input type="text" readonly value="{{$data->application_date}}" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="input-single-box">
                                            <label>রেজিষ্ট্রেশন আইডি</label>
                                            <input type="text" readonly value="{{$data->registration_id}}" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="input-single-box">
                                            <label>ব্রাঞ্চ</label>
                                            <input type="text" readonly value="{{$data->branch_name}}" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="input-single-box">
                                            <label>কেন্দ্র</label>
                                            <input type="text" readonly value="{{$data->area_name}}" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="input-single-box">
                                            <label>মেম্বার নাম</label>
                                            <input type="text" readonly value="{{$data->aplicant_name}}" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="input-single-box">
                                            <label>ফোন</label>
                                            <input type="text" readonly value="{{$data->phone}}" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="input-single-box">
                                            <label>ডিপোজিট নাম</label>
                                            <input type="text" readonly value="{{$data->deposit_name}}" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="input-single-box">
                                            <label>কিস্তির পরিমাণ</label>
                                            <input type="text" readonly value="{{$data->installment_ammount}}" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="input-single-box">
                                            <label>কিস্তির নং</label>
                                            <input type="text" readonly value="{{$data->installment_no}}" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="input-single-box">
                                            <label>সঞ্চয় পরিমাণ</label>
                                            <input type="text" readonly value="{{$data->savings_ammount}}" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="input-single-box">
                                            <label>লাভের পরিমাণ</label>
                                            <input type="text" readonly value="{{$data->savings_ammount}}" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="input-single-box">
                                            <label>নীট পরিমাণ</label>
                                            <input type="text" readonly value="{{$data->total}}" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="input-single-box">
                                            <label>সার্ভিস চার্জ</label>
                                            <input type="text" readonly value="{{$data->service_charge}}" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="input-single-box">
                                            <label>সঞ্চয় প্রদানের তারিখ</label>
                                            <input type="text" readonly value="{{$data->savings_handover_date}}" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="input-single-box">
                                            <label>সঞ্চয় উত্তীর্নের তারিখ</label>
                                            <input type="text" readonly value="{{$data->savings_exp_date}}" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="input-single-box">
                                            <label>মন্তব্য</label>
                                            <input type="text" readonly value="{!! $data->comment !!}" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="input-single-box">
                                            <label>আবেদনকারীর স্বাক্ষর</label>
                                            <img src="{{asset('Backend/images/MemberImage')}}/{{$member->signature}}" alt="" class="img-fluid" style="height: 80px;width:120px;">
                                            <a href="{{asset('Backend/images/MemberImage')}}/{{$member->signature}}" class="btn btn-sm btn-warning" download="">Download</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="input-single-box">
                                            <label>আবেদনকারীর জাতীয় পরিচয় পত্র</label>
                                            <img src="{{asset('Backend/images/MemberNid')}}/{{$member->applicant_nid}}" alt="" class="img-fluid" style="height: 80px;width:120px;">
                                            <a href="{{asset('Backend/images/MemberNid')}}/{{$member->applicant_nid}}" class="btn btn-sm btn-warning" download="">Download</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @php
                            $nominee = DB::table('savings_registration_nominees')->where('savings_reg_id',$data->id)->first();
                            @endphp
                            <h5 class="mt-5 uk-modal-title">নমীনি তথ্য</h5>
                            <div class="informaiton-body">
                                <div class="row">

                                    <div class="col-lg-4 col-12">
                                        <div class="input-single-box">
                                            <label>নমীনি নাম</label>
                                            <input type="text" readonly value="{{$nominee->nominee_name}}" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="input-single-box">
                                            <label>ই-মেইল</label>
                                            <input type="text" readonly value="{{$nominee->email}}" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="input-single-box">
                                            <label>বর্তমান ঠিকানা</label>
                                            <input type="text" readonly value="{{$nominee->present_address}}" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="input-single-box">
                                            <label>বর্তমান ঠিকানা</label>
                                            <input type="text" readonly value="{{$nominee->permenant_address}}" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="input-single-box">
                                            <label>জাতীয় পরিচয় পত্র </label>
                                            <input type="text" readonly value="{{$nominee->nid_no}}" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="input-single-box">
                                            <label>সম্পর্ক</label>
                                            <input type="text" readonly value="{{$nominee->relation}}" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="input-single-box">
                                            <label>নমীনি স্বাক্ষর</label>
                                            <img src="{{asset('Backend/images/NomineeSignature')}}/{{$nominee->nominee_signature}}" alt="" class="img-fluid" style="height: 80px;width:120px;">
                                            <a href="{{asset('Backend/images/NomineeSignature')}}/{{$nominee->nominee_signature}}" class="btn btn-sm btn-warning" download="">Download</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="input-single-box">
                                            <label>জাতীয় পরিচয় পত্র</label>
                                            <img src="{{asset('Backend/images/NomineeNid')}}/{{$nominee->nid}}" alt="" class="img-fluid" style="height: 80px;width:120px;">
                                            <a href="{{asset('Backend/images/NomineeNid')}}/{{$nominee->nid}}" class="btn btn-sm btn-warning" download="">Download</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="input-single-box">
                                            <label>নমীনি ছবি</label>
                                            <img src="{{asset('Backend/images/NomineeImage')}}/{{$nominee->nominee_image}}" alt="" class="img-fluid" style="height: 120px;width:120px;">
                                            <a href="{{asset('Backend/images/NomineeImage')}}/{{$nominee->nominee_image}}" class="btn btn-sm btn-warning" download="">Download</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
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
