@extends('Backend.Layouts.master')
@section('body')
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">

        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- table card-1 start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>মুনাফা তৈরি করুন</h5>
                    </div>
                    <div class="card-body">
                        <form action="report/profit_generate.php" method="get">

                            <div class="row">

                                <div class="col-sm-2 mb-3">
                                    <label>ব্রাঞ্চ নাম</label>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('branch_id') is-invalid @enderror" name="branch_id" required="" id="branch_id" onchange="loadArea()">
                                            <option value="">নির্বাচন করুন</option>

                                            @if($branch)
                                            @foreach($branch as $showbranch)

                                            <option value="{{ $showbranch->id }}">{{ $showbranch->branch_name }}</option>

                                            @endforeach
                                            @endif

                                        </select>
                                    </div>
                                    @error('branch_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-sm-2 mb-3">
                                    <label>স্কিমা নাম</label>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('schema_id') is-invalid @enderror" name="schema_id" id="schema_id" required="">
                                            <option value="">নির্বাচন করুন</option>
                                            @if ($investmentschema)

                                            @foreach ($investmentschema as $v)
                                            <option value="{{$v->id}}">{{$v->fixed_deposit_name}}</option>
                                            @endforeach

                                            @endif
                                        </select>
                                    </div>
                                    @error('schema_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-2 mb-3">
                                    <label>মাসের নাম</label>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('month1') is-invalid @enderror" name="month1" id="month1" required="">
                                            <option value="">নির্বাচন করুন</option>
                                            <option value="01">জানুয়ারী</option>
                                            <option value="02">ফেব্রুয়ারী</option>
                                            <option value="03">মার্চ</option>
                                            <option value="04">এপ্রিল</option>
                                            <option value="05">মে</option>
                                            <option value="06">জুন</option>
                                            <option value="07">জুলাই</option>
                                            <option value="08">আগষ্ট</option>
                                            <option value="09">সেপ্টেম্বর</option>
                                            <option value="10">অক্টোবর</option>
                                            <option value="11">নভেম্বর</option>
                                            <option value="12">ডিসেম্বর</option>
                                        </select>
                                    </div>
                                    @error('month1')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>



                                <div class="col-sm-2 mb-3">
                                    <label>বছর</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm" name="year" value="@php echo date('Y'); @endphp">
                                    </div>
                                    @error('month2')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-sm-2 mb-3">
                                    <label>তারিখ</label>
                                    <div class="input-group">
                                        <input type="text" class="date form-control form-control-sm" name="date" value="@php echo date('Y-m-d'); @endphp">
                                    </div>
                                    @error('month2')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <input type="hidden" name="admin_id" id="admin_id" value="{{Auth::user()->id}}">




                                <div class="submit-btn text-center col-12">
                                    <center><input formtarget="blank" type="submit" class="btn btn-sm btn-success pr-5 pl-5" value="সার্চ করুন"></center>
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
            $('.date').datepicker({
            'format': 'yyyy-mm-dd',
            'autoclose': true
        });
        </script>






        @endsection