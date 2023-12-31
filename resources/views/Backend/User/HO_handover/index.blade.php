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
                            <h5 class="m-b-10">H / O প্রদান</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('ho_handover.index')}}">H / O প্রদান</a></li>
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
                                <h5>H / O প্রদান</h5>
                            </div>
                            <div class="col-6" style="text-align: right">
                                <a href="{{route('ho_handover.create')}}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> নতুন H/O প্রদান করুন</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>সিরিয়াল নং</th>
                                    <th>তারিখ</th>
                                    <th>প্রদানকৃত ব্রাঞ্চ</th>
                                    <th>গ্রহীত ব্রাঞ্চ</th>
                                    <th>টাকার পরিমাণ</th>
                                    <th>বিস্তারিত</th>
                                    <th>স্ট্যাটাস</th>
                                    <th>অ্যাকশান</th>
                                </tr>
                            </thead>
                            <tbody>



                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Latest Customers end -->
</div>
<!-- [ Main Content ] end -->
<script type="text/javascript">
    $(function () {
    var table = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                headers:{
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },
                url : "{{ url('viewHoHandover') }}",
                type : 'POST',
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'date', name: 'date'},
                {data: 'branch_name', name: 'branch_name'},
                {data: 'branch_name2', name: 'branch_name2'},
                {data: 'amount', name: 'amount'},
                {data: 'details', name: 'details'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},

                // {data: 'avg_con_time', name: 'avg_con_time'},
            ]
        });
    });
</script>
@endsection
