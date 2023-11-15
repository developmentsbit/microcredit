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
                        <h5>বিনিয়োগ রেজিষ্ট্রেশন রিপোর্ট</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('show_investorregister_report') }}" method="get">
                            @csrf
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
                                        <select class="js-example-basic-single form-control @error('area_id') is-invalid @enderror" name="area_id" id="area_id" required="">
                                            <option value="">নির্বাচন করুন</option>
                                        </select>
                                    </div>
                                    @error('area_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-sm-4 mb-3">
                                    <label>স্কিমা নির্বাচন করুন</label>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('schema_id') is-invalid @enderror" name="schema_id" id="schema_id"  required="">

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






        @endsection
