@extends('Backend.Layouts.master')
@section('body')
<style>
    .uk-modal-dialog {
    width: 892px;
}
.uk-modal-dialog {left: 115px;}
</style>
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">সঞ্চয় ফেরত</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('saving_return.index')}}">সঞ্চয় ফেরত</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        @php
        $today_date = date('d/m/Y');
        @endphp
        <div class="row">
            <!-- table card-1 start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>সঞ্চয় ফেরত করুন</h5>
                    </div>
                    <div class="card-body">
                        <form action="" enctype="multipart/form-data" id="form-data">
                            {{-- @csrf --}}
                            <div class="row">
                                <div class="col-sm-3 col-lg-3 mb-3">
                                    <label>তারিখ</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="date form-control form-control-sm @error('return_date') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="return_date" value="{{$today_date}}">
                                    </div>
                                    @error('return_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-3 col-lg-3 mb-3">
                                    <label>ব্রাঞ্চ নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('branch_id') is-invalid @enderror" name="branch_id" id="branch_id" onchange="loadArea()" required>
                                            <option value="">নির্বাচন করুন</option>
                                            @if($branch)
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
                                            <option value="">নির্বাচন করুন</option>
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
                                    <label>মেম্বার নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('member_id') is-invalid @enderror" name="member_id" id="member_id" onchange="loadTotalSavings();loadSavingSchemaPercant();stateMentBtnshow()" required>
                                            <option value="">নির্বাচন করুন</option>
                                            @if($member)
                                            @foreach ($member as $v)
                                            <option value="{{$v->registration_id}}">{{$v->aplicant_name}} - {{$v->registration_id}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('member_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-3 mb-3">
                                    <label>মোট জমা</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('total_savings') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="total_savings" value="{{old('total_savings')}}" id="total_savings" readonly>
                                    </div>
                                    @error('total_savings')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-3 mb-3">
                                    <label>লাভের শতকরা পরিমাণ (%)</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('profit_per') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="profit_per" value="{{old('profit_per')}}" id="profit_per" readonly>
                                    </div>
                                    @error('profit_per')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 col-lg-4 mb-3">
                                    <label>সঞ্চয় ফেরত পরিমাণ</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="onlyEng form-control form-control-sm @error('return_ammount') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="return_ammount" value="{{old('return_ammount')}}" id="return_ammount" onkeyup="checkAmmount()">
                                    </div>
                                    @error('return_ammount')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 col-lg-4 mb-3">
                                    <label>লভ্যাংশ প্রদান</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('profit_ammount') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="profit_ammount" value="{{old('profit_ammount')}}" id="profit_ammount" onkeyup="calculateTotal()">
                                    </div>
                                    @error('profit_ammount')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 col-lg-4 mb-3">
                                    <label>মোট</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('total') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="total" value="{{old('total')}}" id="total">
                                    </div>
                                    @error('total')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <label>মন্তব্য</label>
                                    <div class="input-group">
                                        {{-- <input type="text" class="form-control form-control-sm @error('comment') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="comment" value="{{old('comment')}}"> --}}
                                        <textarea class="form-control" name="comment" rows="2"></textarea>
                                    </div>
                                    @error('comment')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- hidden input --}}
                            <input type="hidden" name="admin_id" value="{{Auth::user()->id}}">
                            <div class="submit-btn">
                                <input type="submit" class="btn btn-success" value="সেভ করুন" id="submit">
                                <input type="button" class="btn btn-success" value="Loading...." id="loading">
                                {{-- <input type="button" class="btn btn-info" value="স্টেটমেন্ট দেখুন" id="statement" onclick="savingsMemberStatementShow()"> --}}
                                <a class="btn btn-info" href="#modal-sections" uk-toggle id="statement" onclick="savingsMemberStatementShow()">স্টেটমেন্ট দেখুন</a>

                                <div id="modal-sections" uk-modal>
                                    <div class="uk-modal-dialog">
                                        <button class="uk-modal-close-default" type="button" uk-close></button>
                                        <div class="uk-modal-body" id="modal-data">

                                        </div>
                                    </div>
                                </div>
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

        url : '{{ route('saving_return.store') }}',

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
            function loadSavingSchemaPercant()
            {
                var member_id = $('#member_id').val();

                // alert(member_id);

                $.ajax({

                    headers:{
                        'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                    },

                    url : '{{ url('loadSavingSchemaPercant') }}',

                    type : 'POST',

                    data : {member_id},

                    success : function(data)
                    {
                        $('#profit_per').val(data);
                    }

                });
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
    function checkAmmount()
    {
        var return_ammount = $('#return_ammount').val();

        var total_savings = $('#total_savings').val();

        var retAmmount = parseInt(return_ammount);

        var totalSavings = parseInt(total_savings);

        if(retAmmount > totalSavings)
        {
            $('#return_ammount').val('');
        }

    }
</script>


<script>
    $('#statement').hide();
    function stateMentBtnshow()
    {

        var member_id = $('#member_id').val();

        if(member_id != "")
        {
             $('#statement').show();
        }

    }
</script>


<script>
    function savingsMemberStatementShow()
    {

        var branch_id = $('#branch_id').val();
        var area_id = $('#area_id').val();
        var member_id = $('#member_id').val();

        $.ajax({

            headers:{
                'X-CSRF-TOKEN' : '{{ csrf_token() }}'
            },

            url : '{{ url('savingsMemberStatementShow') }}',

            type : 'POST',

            data : {branch_id,area_id,member_id},

            success : function(data)
            {
                $('#modal-data').html(data);
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

                url : '{{ url('loadSavingReturnMember') }}',

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

    function calculateProfitAmmount()
    {

        var member_id = $('#member_id').val();

        var return_ammount = $('#return_ammount').val();

        if(member_id == "")
        {
            alert('স্কিমা নির্বাচন করুন');
            $('#return_ammount').val('0');
        }
        else
        {
            $.ajax({

                headers:{
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },

                url : '{{ url('calCulateProfit') }}',

                type : 'POST',

                data : {member_id,return_ammount},

                success : function(data)
                {
                    // alert(data);

                    var profit_ammount = return_ammount * data / 100 ;

                    $('#profit_ammount').val(profit_ammount);

                    var total = parseInt(return_ammount) + parseInt(profit_ammount);

                    $('#total').val(total);
                }

            });
        }

    }


</script>

<script>
    function calculateTotal()
    {
        var return_ammount = $('#return_ammount').val();

        var profit_ammount = $('#profit_ammount').val();

        // alert(profit_ammount);

        console.log(profit_ammount);

        var total = parseInt(return_ammount) + parseInt(profit_ammount);

        $('#total').val(total);
    }
</script>

<script>
    $('.date').datepicker({
    'format': 'd/m/yyyy',
    'autoclose': true
});
</script>

@endsection
