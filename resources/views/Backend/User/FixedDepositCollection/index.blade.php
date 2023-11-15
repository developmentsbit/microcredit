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
                            <h5 class="m-b-10">ফিক্সড ডিপোজিট আদায়</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('fixeddeposit_collection.index')}}">ফিক্সড ডিপোজিট আদায়</a></li>
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
                                <h5>ফিক্সড ডিপোজিট আদায় তথ্য</h5>
                            </div>
                            <div class="col-6" style="text-align: right">
                                <a href="{{route('fixeddeposit_collection.create')}}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> নতুন ফিক্সড ডিপোজিট আদায় করুন</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>সিরিয়াল নং</th>
                                    <th>তারিখ</th>
                                    <th>ব্রাঞ্চ</th>
                                    <th>কেন্দ্র নাম</th>
                                    <th>মেম্বার নাম</th>
                                    <th>ডিপোজিট পরিমাণ</th>
                                    <th>সর্ভিস চার্জ</th>
                                    <th>মোট</th>
                                    <th>মন্তব্য</th>
                                    <th>স্ট্যাটাস</th>
                                    <th>অ্যাকশান</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @if($data)
                                @foreach ($data as $v)
                                <tr>
                                    <td>
                                        @if($v->approval == 1)
                                        <i style="color: green" class="fa fa-check"></i>
                                        @endif
                                    </td>
                                    <td>{{$sl++}}</td>
                                    <td>{{$v->collection_date}}</td>
                                    <td>{{$v->branch_name}}</td>
                                    <td>{{$v->area_name}}</td>
                                    <td>{{$v->aplicant_name}} - {{$v->registration_id}}</td>
                                    <td>{{$v->deposit_ammount}}</td>
                                    <td>{{$v->service_charge}}</td>
                                    <td>{{$v->total}}</td>
                                    <td>{{$v->comment}}</td>
                                    <td>@if($v->status == 1) <div class="badge badge-success">Active</div>@else <div class="badge badge-danger">Inactive</div> @endif</td>
                                    <td>
                                        @if(Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || $v->approval == 0)
                                        <form action="{{ route('fixeddeposit_collection.destroy',$v->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are Your Sure?')" id="" type="submit" class="btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                @endif --}}
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
                        url : "{{ url('viewFixedDepositCollection') }}",
                        type : 'POST',
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'collection_date', name: 'collection_date'},
                        {data: 'branch_name', name: 'branch_name'},
                        {data: 'area_name', name: 'area_name'},
                        {data: 'applicant_name_id', name: 'applicant_name_id'},
                        {data: 'deposit_ammount', name: 'deposit_ammount'},
                        {data: 'service_charge', name: 'service_charge'},
                        {data: 'total', name: 'total'},
                        {data: 'comment', name: 'comment'},
                        {data: 'status', name: 'status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},

                        // {data: 'avg_con_time', name: 'avg_con_time'},
                    ]
                });
            });
        </script>
@endsection
