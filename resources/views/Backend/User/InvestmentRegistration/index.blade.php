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
                            <h5 class="m-b-10">বিনিয়োগ রেজিষ্ট্রেশন</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('investment_registration.index')}}">বিনিয়োগ রেজিষ্ট্রেশন</a></li>
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
                                <h5>বিনিয়োগ রেজিষ্ট্রেশন তথ্য</h5>
                            </div>
                            <div class="col-6" style="text-align: right">
                                <a href="{{route('investment_registration.create')}}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> নতুন বিনিয়োগ রেজিষ্ট্রেশন করুন</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>সিরিয়াল নং</th>
                                    <th>তারিখ</th>
                                    <th>রেজিঃ আইডি</th>
                                    <th>ব্রাঞ্চ নাম</th>
                                    <th>কেন্দ্র নাম</th>
                                    <th>মেম্বার নাম</th>
                                    <th>ফোন</th>
                                    <th>স্কিমা</th>
                                    <th>স্ট্যাটাস</th>
                                    <th>অ্যাকশান</th>
                                </tr>
                            </thead>
                            <tbody>

                                {{-- @php
                                $i = 1;
                                @endphp


                                @if(isset($data))
                                @foreach($data as $d)
                                <tr>
                                    <td>
                                        @if($d->approval == 1)
                                        <i style="color: green" class="fa fa-check"></i>
                                        @endif
                                    </td>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $d->date }}</td>
                                    <td>{{ $d->registration_id }}</td>
                                    <td>{{ $d->branch_name }}</td>
                                    <td>{{ $d->area_name }}</td>
                                    <td>{{ $d->aplicant_name }}</td>
                                    <td>{{ $d->phone }}</td>
                                    <td>{{ $d->investment_name }}</td>
                                    <td>
                                       @if($d->status == 1)
                                        <span class="btn btn-success btn-sm">Active</span>
                                       @else
                                        <span class="btn btn-danger btn-sm">Inactive</span>
                                       @endif
                                    </td>
                                    <td>
                                        @if(Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || $d->approval == 0)
                                        <a id="" style="float: left;margin-right:10px;" href="{{route('investment_registration.edit',$d->id)}}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>
                                        <form action="{{ route('investment_registration.destroy',$d->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are Your Sure?')" id="" type="submit" class="btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                                        </form>
                                        @endif
                                        <a href="{{ url("viewinvestment/".$d->id) }}" class="btn-sm btn btn-dark"><i class="feather icon-eye"></i></a>
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
                        url : "{{ url('viewInvestmentRegistration') }}",
                        type : 'POST',
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'date', name: 'date'},
                        {data: 'registration_id', name: 'registration_id'},
                        {data: 'branch_name', name: 'branch_name'},
                        {data: 'area_name', name: 'area_name'},
                        {data: 'aplicant_name', name: 'aplicant_name'},
                        {data: 'phone', name: 'phone'},
                        {data: 'investment_name', name: 'investment_name'},
                        {data: 'status', name: 'status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},

                        // {data: 'avg_con_time', name: 'avg_con_time'},
                    ]
                });
            });
        </script>
        @endsection
