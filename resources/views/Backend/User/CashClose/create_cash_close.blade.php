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
                        <h5>ক্যাশ ক্লোজ তৈরি করুন</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{url('show_dailyauto_voucher')}}" method="get">
                           @csrf
                            <div class="row">

                                <div class="col-sm-4 mb-3">
                                    <label>ব্রাঞ্চ নাম</label>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('branch_id') is-invalid @enderror" name="branch_id" required="" id="branch_id" onchange="getLastCashClose()">
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
                                    <label>সর্বশেষ ক্যাশ ক্লোজ তারিখ</label>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('last_cashclose_date') is-invalid @enderror" name="last_cashclose_date" required="" id="last_cashclose_date">
                                            <option value="">নির্বাচন করুন</option>

                                            

                                        </select>
                                    </div>
                                    @error('last_cashclose_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                
                               
                            
                                
                                <div class="col-sm-4 mb-3">
                                    <label>শেষ তারিখ</label>
                                    <div class="input-group">
                                        <input type="text" class="date form-control form-control-sm" name="to_date" required autocomplete="off" value="<?php echo date('d-m-Y'); ?>">
                                    </div>
                                    @error('month2')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>




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
                function getLastCashClose()
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

                        url : '{{ url('getLastCashClose') }}',

                        type : 'POST',

                        data : {branch_id},

                        success : function(data)
                        {
                            $('#last_cashclose_date').html(data);
                            // alert(data);
                        }
                    });
                }
            }
        </script>






        @endsection
