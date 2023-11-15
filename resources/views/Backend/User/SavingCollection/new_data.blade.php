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
                            {{-- <li class="breadcrumb-item"><a href="{{route('saving_collection.index')}}">সঞ্চয় আদায়</a></li> --}}
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
                                <h5>সঞ্চয় আদায় তথ্য</h5>
                            </div>
                            <div class="col-6" style="text-align: right">
                                {{-- <a href="{{route('saving_collection.create')}}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> নতুন সঞ্চয় আদায় করুন</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <form form-target="_blank" action="{{url('/showNewDataReport')}}" method="post">
                            @csrf
                            <div class="row mb-4">
                                <div class="input-single-box col-4">
                                    <label for="">ব্রাঞ্চ নির্বাচন করুন</label>
                                    <select name="branch_id" id="branch_id" class="form-control js-example-basic-single" onchange="loadArea();loadSavingCollBranch()" required>
                                        <option value="">নির্বাচন করুন</option>
                                        @if($branch)
                                        @foreach ($branch as $v)
                                            <option value="{{$v->id}}">{{$v->branch_name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="input-single-box col-4">
                                    <label for="">কেন্দ্র নির্বাচন করুন</label>
                                    <select name="area_id" id="area_id" class="form-control js-example-basic-single" onchange="loadAreaSavingColl()" required>
                                        <option value="">নির্বাচন করুন</option>
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
                                    <th>ব্রাঞ্চ</th>
                                    <th>কেন্দ্র নাম</th>
                                    <th>মেম্বার নাম</th>
                                    <th>ডিপোজিট পরিমাণ</th>
                                    <th>মন্তব্য</th>
                                    <th>অ্যাকশান</th>
                                    <th>অ্যাপ্রুভাল</th>
                                </tr>
                            </thead>
                            <tbody id="table_data">
                                @if($data)
                                @foreach ($data as $showdata)
                                <tr>
                                    <td>
                                        <input onclick="chkAll()" id="chkSavingColl" type="checkbox" name="saving_coll[]" value="{{$showdata->id}}">
                                    </td>
                                    <td>{{$sl++}}</td>
                                    <td>{{$showdata->date}}</td>
                                    <td>{{$showdata->branch_name}}</td>
                                    <td>{{$showdata->area_name}}</td>
                                    <td>{{$showdata->aplicant_name}}</td>
                                    <td>{{$showdata->deposit_ammount}}</td>
                                    <td>{{$showdata->comment}}</td>
                                    <td>
                                        {{-- <a style="float: left;margin-right:10px;" href="{{route('saving_collection.edit',$showdata->id)}}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a> --}}
                                        <form action="{{ route('saving_collection.destroy',$showdata->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{url('/approved_collection')}}/{{$showdata->id}}" class="btn btn-sm btn-dark">Approved</a>
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
            function chkAll()
            {
                if($('#chkAll').is(':checked'))
                {
                    $('input#chkSavingColl').prop('checked',true);
                }
                else
                {
                    // $('input#chkSavingReg').prop('checked',false);
                }


                if($('input#chkSavingColl').is(':checked'))
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
                function loadSavingCollBranch()
                {
                    var branch_id = $('#branch_id').val();

                    if(branch_id == "")
                    {
                        location.reload(true)
                    }
                    else
                    {
                        $.ajax({

                            headers:{
                                'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                            },

                            url : '{{ url('loadSavingCollBranch') }}',

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

            <script>

                function loadAreaSavingColl()
                {
                    var area_id = $('#area_id').val();

                    if(area_id == "")
                    {
                        location.reload(true)
                    }
                    else
                    {
                        $.ajax({

                            headers : {
                                'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                            },

                            url : '{{ url('loadAreaSavingColl') }}',

                            type : 'POST',

                            data : {area_id},

                            success : function(data)
                            {
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
            function approveAllData()
            {

                var id = [];

                $('#chkSavingColl:checked').each(function(key){

                    id[key] = $(this).val();

                    // alert(id);

                    $.ajax({

                        headers:{
                            'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                        },

                        url : '{{ url('approveAllSavingColl') }}',

                        type : 'POST',

                        data : {saving_coll_id : id},

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
