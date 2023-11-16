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
                        <h5>ডিপোজিট লেনদেন তথ্য</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{url('/depositTransactionReport')}}" method="get">

                            <div class="row">

                                <div class="col-sm-4 mb-3">
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


                                <div class="col-sm-4 mb-3">
                                    <label>কেন্দ্র নাম</label>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('area_id') is-invalid @enderror" name="area_id" id="area_id" required="" onchange="return getFixedDepositMemeber()">
                                            <option value="">নির্বাচন করুন</option>
                                        </select>
                                    </div>
                                    @error('area_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <label>মেম্বার নির্বাচন করুন</label>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('fixed_deposit_id') is-invalid @enderror" name="fixed_deposit_id" id="fixed_deposit_id" required="">
                                            <option value="">নির্বাচন করুন</option>
                                        </select>
                                    </div>
                                    @error('fixed_deposit_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 col-md-6 mb-3">
                                    <label>প্রথম তারিখ</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm date" name="from_date" value="<?php echo date('d-m-Y'); ?>">
                                    </div>
                                    @error('date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 col-md-6 mb-3">
                                    <label>শেষ তারিখ</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm date" name="to_date" value="<?php echo date('d-m-Y'); ?>">
                                    </div>
                                    @error('date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <input type="hidden" name="admin_id" value="{{Auth::user()->id}}">




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

         <script>
            $('.date').datepicker({
            'format': 'd-m-yyyy',
            'autoclose': true
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
            function getFixedDepositMemeber()
            {
                let branch_id = $('#branch_id').val();
                let area_id = $('#area_id').val();
                if(area_id != '')
                {
                    $.ajax({
                        headers : {
                            'X-CSRF-TOKEN' : '{{csrf_token()}}'
                        },

                        url : '{{url('getFixedDepositMemebers')}}',

                        type : 'POST',

                        data : {branch_id,area_id},

                        success : function(data)
                        {
                            $('#fixed_deposit_id').html(data);
                        }
                    });
                }
            }
        </script>






        @endsection
