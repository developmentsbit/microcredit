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
                        <h5>সঞ্চয় আদায় করুন</h5>
                    </div>
                    <div class="card-body">
                        @php
                        $today_date = date('d/m/Y');
                        @endphp
                        <form enctype="multipart/form-data" id="form-data">
                            {{-- @csrf --}}
                            <div class="row">
                                <div class="col-sm-3 col-lg-3 mb-3">
                                    <label>তারিখ</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="date form-control form-control-sm @error('collection_date') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="collection_date" value="{{$today_date}}">
                                    </div>
                                    @error('collection_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-3 col-lg-3 mb-3">
                                    <label>ব্রাঞ্চ নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('branch_id') is-invalid @enderror" name="branch_id" id="branch_id" onchange="loadArea()" required>
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
                                <div class="col-sm-3 col-lg-3 mb-3">
                                    <label>কেন্দ্র নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('area_id') is-invalid @enderror" name="area_id" id="area_id" onchange="loadSavingMember()" required>
                                            <option>নির্বাচন করুন</option>
                                        </select>
                                    </div>
                                    @error('area_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                @php
                                $scheamas = DB::table('saving_schemas')->get();
                                @endphp

                                    <div class="col-sm-3 mb-3">
                                    <label>স্কিমা নির্বাচন করুন <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('schema_id') is-invalid @enderror" name="schema_id" id="schema_id" required="" onchange="loadSavingMember();">
                                        <option value="">নির্বাচন করুন</option>
                                            @if($scheamas)
                                            @foreach ($scheamas as $v)
                                            <option value="{{$v->id}}">{{$v->deposit_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('schema_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                <div class="col-sm-6 mb-3">
                                    <label>সদস্যের নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('member_id') is-invalid @enderror" name="member_id" id="member_id" onchange="loadTotalSavings();totalSavings();loadInstalmentAmmount()" required>
                                            <option value="">নির্বাচন করুন</option>
                                            {{-- @if($member)
                                            @foreach ($member as $v)
                                            <option value="{{$v->registration_id}}">{{$v->aplicant_name}} - {{$v->registration_id}}</option>
                                            @endforeach
                                            @endif --}}
                                        </select>
                                    </div>
                                    @error('member_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>মোট জমা</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('savings_ammount') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="savings_ammount" value="{{old('savings_ammount')}}" id="total_savings" readonly>
                                    </div>
                                    @error('savings_ammount')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- <div class="col-sm-6 mb-3">
                                    <label>সার্ভিস চার্জ</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('service_charge') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="service_charge" value="{{old('service_charge')}}">
                                    </div>
                                    @error('service_charge')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div> --}}
                                <div class="col-sm-6 mb-3">
                                    <label>সঞ্চয়ের পরিমাণ</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="onlyEng form-control form-control-sm @error('deposit_ammount') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="deposit_ammount" value="{{old('deposit_ammount')}}" id="deposit_ammount" onkeyup="totalSavings()">
                                    </div>
                                    @error('deposit_ammount')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label>মোট</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('total') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="total" value="{{old('total')}}" id="total" readonly>
                                    </div>
                                    @error('total')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <label>মন্তব্য</label>
                                    <div class="input-group">
                                        {{-- <input type="text" class="form-control form-control-sm @error('comment') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="comment" value="{{old('comment')}}"> --}}
                                        <textarea class="form-control" name="comment" cols="30" rows="2"></textarea>
                                    </div>
                                    @error('comment')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- hidden input --}}
                            <input type="hidden" name="admin_id" value="{{Auth::user()->id}}">
                            <div class="submit-btn">
                                <input type="submit" id="submit" class="btn btn-success" value="সেভ করুন">
                                <input type="button" id="loading" class="btn btn-success" value="Loading....">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Latest Customers end -->
        </div>
        <!-- [ Main Content ] end -->
        <script>

            // alert();

            $('#loading').hide();

$('#form-data').submit(function(e){

    e.preventDefault();

    var data = $(this).serialize();

    $.ajax({

        headers:{
            'X-CSRF-TOKEN' : '{{csrf_token()}}'
        },

        url : '{{ route('saving_collection.store') }}',

        type : 'POST',

        data : data ,

        beforeSend : function(response)
        {
            $('#loading').show();
            $('#submit').hide();
        },

        success : function(data)
        {
            $('#loading').hide();
            $('#submit').show();
            if(data == 1)
            {

                loadTotalSavings();
                totalSavings();
                swal("Good job!", "Data Inserted Successfull!", "success");
            }
            else
            {
                swal("Good job!", "Data Inserted Successfull!", "success");

            }
        }

    });

});
        </script>

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
            function loadTotalSavings()
            {
                var registration_id = $('#member_id').val();
                if(registration_id == "")
                {
                    alert('Select Member');
                }
                else
                {
                    $.ajax({
                        headers:{
                            'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                        },

                        url : '{{ url('loadTotalSaving') }}',

                        type : 'POST',

                        data : {registration_id},

                        success : function(data)
                        {
                            $('#total_savings').val(data);
                        }
                    })
                }
            }
        </script>

        <script>

            function totalSavings()
            {
                var previous_savings = $('#total_savings').val();

                var today_savings = $('#deposit_ammount').val();

                var result = parseInt(previous_savings) + parseInt(today_savings);

                $('#total').val(result);
            }
        </script>

        <script>
            function loadInstalmentAmmount()
            {
                var registration_id = $('#member_id').val();

                $.ajax({
                    headers : {
                        'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                    },

                    url : '{{ url('loadInstalmentAmount') }}',

                    type : 'POST',

                    data : {registration_id},

                    success : function(data)
                    {
                        $('#deposit_ammount').attr('placeholder',data);
                    }
                });
            }
        </script>


        <script>
            function loadSavingMember()
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

                        url : '{{ url('loadSavingMember') }}',

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

@endsection
