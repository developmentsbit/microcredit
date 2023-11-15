@extends('Backend.Layouts.master')
@section('body')


@php
Use App\Models\admin_branch_info;
Use App\Models\branch_info;
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
                            <h5 class="m-b-10">বিনিয়োগ আদায়</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('investment_collection.index')}}">বিনিয়োগ আদায়</a></li>
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
                        <h5>বিনিয়োগ আদায় করুন</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('investment_collection.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                               <div class="col-sm-3 mb-3">
                                <label>তারিখ <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="date form-control form-control-sm @error('date') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="date" value="{{date('d/m/Y')}}" required="">
                                </div>
                                @error('date')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <input type="hidden" value="{{ date('Y-m-d') }}" name="entry_date">


                            <div class="col-sm-3 mb-3">
                                <label>ব্রাঞ্চ নাম</label>
                                <div class="input-group">
                                    <select class="js-example-basic-single form-control @error('branch_id') is-invalid @enderror" name="branch_id" required="" id="branch_id" onchange="loadArea()">
                                        <option value="">নির্বাচন করুন</option>
                                        @php
                                        if(Auth::user()->user_role == 1)
                                        {
                                            $admin_branch = branch_info::where('status',1)->get();
                                        }
                                        else {

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


                            <div class="col-sm-3 mb-3">
                                <label>কেন্দ্র নাম</label>
                                <div class="input-group">
                                    <select class="js-example-basic-single form-control @error('area_id') is-invalid @enderror" name="area_id" required="" id="area_id" onchange="loadMember()">
                                        <option value="">নির্বাচন করুন</option>

                                    </select>
                                </div>
                                @error('area_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            @php
                                $scheamas = DB::table('investmentschemas')->get();
                            @endphp

                            <div class="col-sm-3 mb-3">
                                <label>স্কিমা নির্বাচন করুন <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <select class="js-example-basic-single form-control @error('schema_id') is-invalid @enderror" name="schema_id" id="schema_id" required="" onchange="loadMember();">
                                    <option value="">নির্বাচন করুন</option>
                                        @if($scheamas)
                                        @foreach ($scheamas as $v)
                                        <option value="{{$v->id}}">{{$v->investment_name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                @error('schema_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="col-sm-6 mb-3">
                                <label>মেম্বার নাম</label>
                                <div class="input-group">



                                    <select class="js-example-basic-single form-control @error('member_id') is-invalid @enderror" name="member_id" id="member_id" required="" onchange="getinvestSchemaPer()">
                                        <option value="">নির্বাচন করুন</option>

                                    </select>
                                </div>
                                @error('member_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>





                            <div class="col-sm-2 mb-3">
                                <label>বিনিয়োগ আাদায় পরিমাণ</label>
                                <div class="input-group">
                                    <input type="text" class="onlyEng form-control form-control-sm @error('investment_collection') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="investment_collection" value="{{old('investment_collection')}}" id="investment_collection" onkeyup="calculateAmmount()">
                                </div>
                                @error('investment_collection')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="col-sm-2 mb-3">
                                <label>আসল টাকার পরিমাণ</label>
                                <div class="input-group">
                                    <input type="text" class="onlyEng form-control form-control-sm @error('main_balance') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="main_balance" value="{{old('main_balance')}}" id="main_balance">
                                </div>
                                @error('main_balance')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="col-sm-2 mb-3">
                                <label>লাভের পরিমাণ</label>
                                <div class="input-group">
                                    <input type="text" class="onlyEng form-control form-control-sm @error('profit_ammount') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="profit_ammount" value="{{old('profit_ammount')}}" id="profit_ammount">
                                </div>
                                @error('profit_ammount')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-2 mb-3">
                                <label>সঞ্চয়ের পরিমাণ</label>
                                <div class="input-group">
                                    <input type="text" class="onlyEng form-control form-control-sm @error('deposit_ammount') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="deposit_ammount" value="{{old('deposit_ammount')}}" id="deposit_ammount">
                                </div>
                                @error('deposit_ammount')
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
                        </div>
                        {{-- hidden input --}}
                        <input type="hidden" name="admin_id" value="{{Auth::user()->id}}">
                        <input type="hidden" name="schema_per" id="schema_per" value="">
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

                var schema_id = $('#schema_id').val();
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

                        url : '{{ url('loadInvestorMembers') }}',

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
            $('.date').datepicker({
                'format': 'd/m/yyyy',
                'autoclose': true
            });
        </script>


        <script>
            function getinvestSchemaPer()
            {
                var member_id = $('#member_id').val();

                // alert(member_id);
                $('#main_balance').val(0);
                $('#profit_ammount').val(0);
                $('#investment_collection').val(0);

                $.ajax({

                    headers : {
                        'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                    },

                    url : '{{ url('getinvestmentSchemaPer') }}',

                    type : 'POST',

                    data  : {member_id},

                    success : function(data)
                    {
                        $('#schema_per').val(data);

                        // alert(data);
                    }



                });
            }
        </script>


        <script>
            function calculateAmmount()
            {

                var investment_coll = $('#investment_collection').val();

                
                var schema_per = $('#schema_per').val();
                
                var result = parseFloat(investment_coll) * parseFloat(schema_per) / 100;
                
                $('#profit_ammount').val(result);

                var main_balance = investment_coll - result;
                
                $('#main_balance').val(main_balance);

            }
        </script>


        <script>

            var main_balance = $('#main_balance').val();
            var profit_ammount = $('#profit_ammount').val();

            // if(main_balance == "" && profit_ammount == "")
            // {
            //     $('#investment_collection').val(0);
            //     $('#investment_collection').prop('readonly',false);
            // }

            $('#main_balance').on('keyup',function(){
                $('#investment_collection').val(0);
                $('#investment_collection').prop('readonly',true);

                
            });


            $('#profit_ammount').on('keyup',function(){
                $('#investment_collection').val(0);
                $('#investment_collection').prop('readonly',true);

            });


            

        </script>




        @endsection
