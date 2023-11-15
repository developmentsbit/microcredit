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
                            <h5 class="m-b-10">সঞ্চয়  রেজিষ্ট্রেশন</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('saving_registration.index')}}">সঞ্চয়  রেজিষ্ট্রেশন নতুন ডাটা</a></li>
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
                                <h5>সঞ্চয়  রেজিষ্ট্রেশন নতুন ডাটা</h5>
                            </div>
                            {{-- <div class="col-6" style="text-align: right">
                                <a href="{{route('saving_registration.create')}}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> নতুন সঞ্চয় রেজিষ্ট্রেশন করুন</a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <div class="row mb-4">
                            <div class="input-single-box col-4">
                                <label for="">ব্রাঞ্চ নির্বাচন করুন</label>
                                <select name="branch_id" id="branch_id" class="form-control js-example-basic-single" onchange="loadArea();loadSavingBranch()">
                                    <option value="">নির্বাচন করুন</option>
                                    @if($branch)
                                    @foreach ($branch as $v)
                                        <option value="{{$v->id}}">{{$v->branch_name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="input-single-box col-4">
                                <label for="">কোন্দ্র নির্বাচন করুন</label>
                                <select name="area_id" id="area_id" class="form-control js-example-basic-single" onchange="loadAreaSaving()">
                                    <option value="">নির্বাচন করুন</option>
                                </select>
                            </div>
                        </div>

                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" id="chkAll" onclick="chkAll()">
                                    </th>
                                    <th>সিরিয়াল নং</th>
                                    <th>তারিখ</th>
                                    <th>রেজিঃ আইডি</th>
                                    <th>ব্রাঞ্চ নাম</th>
                                    <th>কেন্দ্র নাম</th>
                                    <th>মেম্বার নাম</th>
                                    <th>ফোন</th>
                                    <th>বিস্তারিত</th>
                                    <th>স্ট্যাটাস</th>
                                    <th>অ্যাকশান</th>
                                    <th>অ্যাপ্রুভ</th>
                                </tr>
                            </thead>
                            <tbody id="table_data">
                            @if ($data)
                                @foreach ($data as $showdata)
                                    <tr>
                                        <td><input onclick="chkAll()" id="chkSavingReg" type="checkbox" name="saving_reg[]" value="{{$showdata->id}}"></td>
                                        <td>{{$sl++}}</td>
                                        <td>{{$showdata->application_date}}</td>
                                        <td>{{$showdata->registration_id}}</td>
                                        <td>{{$showdata->branch_name}}</td>
                                        <td>{{$showdata->area_name}}</td>
                                        <td>{{$showdata->aplicant_name}}</td>
                                        <td>{{$showdata->phone}}</td>
                                        <td>
                                            <!-- This is a button toggling the modal -->
                                            <a href="{{route('saving_registration.show',$showdata->id)}}" class="btn btn-dark btn-sm"><i class="fa fa-eye"></i></a>
    
                                            <!-- This is the modal -->
                                            <div id="modal-example-{{$showdata->id}}" uk-modal>
                                                <div class="uk-modal-dialog uk-modal-body">
                                                    
                                                    <p class="uk-text-right">
                                                        <button class="uk-button uk-button-default uk-modal-close" type="button">Close</button>
                                                        {{-- <button class="uk-button uk-button-primary" type="button">Save</button> --}}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>@if($showdata->status == 1) <div class="badge badge-success">Active</div> @else <div class="badge badge-danger">Inactive</div> @endif</td>
                                        <td>
                                            <a style="float: left;margin-right:10px;" href="{{route('saving_registration.edit',$showdata->id)}}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>
                                        <form action="{{ route('saving_registration.destroy',$showdata->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                                        </form>
                                        </td>
                                        <td>
                                            <a href="{{url('saving_approve')}}/{{$showdata->id}}" class="btn btn-dark btn-sm">Approve</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <input type="button" class="btn btn-success btn-sm" value="Approve All" disabled id="approveAll" onclick="approveAllData()">
                    </form>
                    </div>
                </div>
            </div>
            <!-- Latest Customers end -->
        </div>
        <!-- [ Main Content ] end -->

        <script>
            function loadSavingBranch()
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

                        url : '{{ url('loadBranchSavingNew') }}',

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
            
            function loadAreaSaving()
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

                        url : '{{ url('loadAreaSaving') }}',

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
            function chkAll()
            {
                if($('#chkAll').is(':checked'))
                {
                    $('input#chkSavingReg').prop('checked',true);
                }
                else
                {
                    // $('input#chkSavingReg').prop('checked',false);
                }


                if($('input#chkSavingReg').is(':checked'))
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

                $('#chkSavingReg:checked').each(function(key){

                    id[key] = $(this).val();

                    // alert(id);

                    $.ajax({

                        headers:{
                            'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                        },

                        url : '{{ url('approve_all') }}',

                        type : 'POST',

                        data : {saving_id : id},

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