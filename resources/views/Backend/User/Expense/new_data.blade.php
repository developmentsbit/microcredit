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
                            <h5 class="m-b-10">ব্যায় সমূহ</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            {{-- <li class="breadcrumb-item"><a href="{{route('add_expense.index')}}">ব্যায় সমূহ</a></li> --}}
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
                        <div class="row">
                            <div class="col-6">
                                <h5>ব্যায় সমূহ</h5>
                            </div>
                            <div class="col-6" style="text-align: right">
                                {{-- <a href="{{route('add_expense.create')}}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> নতুন ব্যায় খাত ফেরত করুন</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <form form-target="_blank" action="{{url('/showNewExpenseReport')}}" method="post">
                            @csrf
                        <div class="row mb-4">
                            <div class="input-single-box col-4">
                                <label for="">ব্রাঞ্চ নির্বাচন করুন</label>
                                <select name="branch_id" id="branch_id" class="form-control js-example-basic-single" onchange="loadArea();loadBranchExpense()" required>
                                    <option value="">নির্বাচন করুন</option>
                                    @if($branch)
                                    @foreach ($branch as $v)
                                        <option value="{{$v->id}}">{{$v->branch_name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="input-single-box col-4 mt-5">
                                <input formtarget="blank" type="submit" class="btn btn-dark btn-sm" value="রিপোর্ট দেখুন">
                            </div>
                        </div>
                        </form>
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" id="chkAll" onclick="chkAll()">
                                    </th>
                                    <th>সিরিয়াল নং</th>
                                    <th>তারিখ</th>
                                    <th>ব্রাঞ্চ নাম</th>
                                    <th>ব্যায় খাত নাম</th>
                                    <th>টাকার পরিমাণ</th>
                                    <th>বিস্তারিত</th>
                                    <th>নোট</th>
                                    <th>স্ট্যাটাস</th>
                                    <th>অ্যাকশান</th>
                                    <th>অ্যাপ্রুভাল</th>
                                </tr>
                            </thead>
                            <tbody id="table_data">

                                @php
                                $i = 1;
                                @endphp

                                @if(isset($data))
                                @foreach($data as $d)

                                <tr>
                                    <td>
                                        <input onclick="chkAll()" id="chkNewExpense" type="checkbox" name="new_income[]" value="{{$d->id}}">
                                    </td>
                                   <td>{{ $i++ }}</td>
                                   <td>{{ $d->date }}</td>
                                   <td>{{ $d->branch_name }}</td>
                                   <td>{{ $d->title }}</td>
                                   <td>{{ $d->amount }}</td>
                                   <td>{{ $d->details }}</td>
                                   <td>{{ $d->comment }}</td>

                                   <td>
                                     @if($d->status == 1)
                                     <span class="btn btn-success btn-sm">Active</span>
                                     @else
                                     <span class="btn btn-danger btn-sm">Inactive</span>
                                     @endif
                                 </td>


                                   <td>

                                    <a style="float: left;margin-right:10px;" href="{{route('add_expense.edit',$d->id)}}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>
                                    <form action="{{ route('add_expense.destroy',$d->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{url('/approved_expense')}}/{{$d->id}}" class="btn btn-sm btn-dark">Approved</a>
                                </td>
                            </tr>
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                    <input type="button" class="btn btn-success btn-sm" value="Approve All" disabled id="approveAll" onclick="approveAllData()">
                </div>
            </div>
        </div>
        <!-- Latest Customers end -->
    </div>
    <!-- [ Main Content ] end -->
    <script>

        function loadBranchExpense()
        {
            var branch_id = $('#branch_id').val();

                if(branch_id == "")
                {
                    location.reload(true)
                }
                else
                {
                    // alert(branch_id);
                    $.ajax({

                        headers:{
                            'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                        },

                        url : '{{ url('loadBranchExpenseNew') }}',

                        type : 'POST',

                        data : {branch_id},

                        success : function(data)
                        {
                            // alert(data);
                            $('#table_data').html(data);
                        }

                    });
                }
        }

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
        function chkAll()
        {
            if($('#chkAll').is(':checked'))
            {
                $('input#chkNewExpense').prop('checked',true);
            }
            else
            {
                // $('input#chkSavingReg').prop('checked',false);
            }


            if($('input#chkNewExpense').is(':checked'))
            {
                $('#approveAll').prop('disabled',false);
            }
            else
            {
                $('#approveAll').prop('disabled',true);

            }
        }
    </script>
    <script>
        function approveAllData()
        {

            var id = [];

            $('#chkNewExpense:checked').each(function(key){

                id[key] = $(this).val();

                // alert(id);

                $.ajax({

                    headers:{
                        'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                    },

                    url : '{{ url('approveAllExpense') }}',

                    type : 'POST',

                    data : {new_expense : id},

                    success : function(data)
                    {
                        // console.log(data);
                        if(data == 1)
                        {
                            location.reload(true)
                        }
                    }

                });

            });

        }
    </script>
    @endsection
