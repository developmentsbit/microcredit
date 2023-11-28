@extends('Backend.Layouts.master')
@section('body')
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">গ্রহকের তথ্য</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('add_member.index')}}">গ্রাহকের তথ্য</a></li>
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
                    <div class="col-12 mt-2">
                        <input type="text" class="form-control form-control-sm" placeholder="Search By Name or Member ID" onchange="getMember()" id="searchData">
                    </div>
                    <div class="card-header">
                        <div class="row">

                            <div class="col-6">
                                <h5>গ্রাহকের তথ্য</h5>
                            </div>
                            <div class="col-6" style="text-align: right">
                                <a href="{{route('add_member.create')}}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> নতুন গ্রাহক যোগ করুন</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>সিরিয়াল নং</th>
                                    <th>ব্রাঞ্চ নাম</th>
                                    <th>কেন্দ্র নাম</th>
                                    <th>মেম্বার আইডি</th>
                                    <th>নাম</th>
                                    <th>ফোন</th>
                                    <th>এন আই ডি</th>
                                    <th>স্ট্যাটাস</th>
                                    <th>ছবি</th>
                                    <th>অ্যাকশান</th>
                                </tr>
                            </thead>
                            <tbody id="showMember">



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Latest Customers end -->
    </div>
    <!-- [ Main Content ] end -->


    <script>
        function getMember()
        {
            let data = $('#searchData').val();
            // alert(data);
            if(!data)
            {
                alert('Give Some Information To Search');
            }
            else
            {
                $.ajax({
                    headers : {
                        'X-CSRF-TOKEN' : '{{ csrf_token() }}',
                    },

                    url : '{{ url('getMember') }}',

                    type : 'POST',

                    data : {data},

                    beforeSend : function(d){
                        $('#showMember').html('Loading........');
                    },

                    success : function(response)
                    {
                        $('#showMember').html(response);
                    }
                });
            }
        }
    </script>

    <script type="text/javascript">
        $(function () {
        var table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    headers:{
                        'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                    },
                    url : "{{ url('viewmember') }}",
                    type : 'POST',
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'branch_name', name: 'branch_name'},
                    {data: 'area_name', name: 'area_name'},
                    {data: 'member_id', name: 'member_id'},
                    {data: 'aplicant_name', name: 'aplicant_name'},
                    {data: 'phone', name: 'phone'},
                    {data: 'nid_no', name: 'nid_no'},
                    {data: 'status', name: 'status'},
                    {data: 'image', name: 'image'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},

                    // {data: 'avg_con_time', name: 'avg_con_time'},
                ]
            });
        });
    </script>

    @endsection
