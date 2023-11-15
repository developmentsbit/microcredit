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
                            <h5 class="m-b-10">সঞ্চয়  রেজিষ্ট্রেশন</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('saving_registration.index')}}">সঞ্চয়  রেজিষ্ট্রেশন</a></li>
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
                                <h5>সঞ্চয়  রেজিষ্ট্রেশন তথ্য</h5>
                            </div>
                            <div class="col-6" style="text-align: right">
                                <a href="{{route('saving_registration.create')}}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> নতুন সঞ্চয় রেজিষ্ট্রেশন করুন</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    {{-- <th></th> --}}
                                    <th>সিরিয়াল নং</th>
                                    <th>তারিখ</th>
                                    <th>রেজিঃ আইডি</th>
                                    <th>ব্রাঞ্চ নাম</th>
                                    <th>কেন্দ্র নাম</th>
                                    <th>স্কিমা নাম</th>
                                    <th>মেম্বার নাম</th>
                                    <th>ফোন</th>
                                    <th>বিস্তারিত</th>
                                    <th>স্ট্যাটাস</th>
                                    <th>অ্যাকশান</th>
                                </tr>
                            </thead>
                            <tbody>
                            {{-- @if ($data)
                                @foreach ($data as $showdata)
                                    <tr>
                                        <td>
                                            @if($showdata->approval == 1)
                                            <i style="color: green" class="fa fa-check"></i>
                                            @endif
                                        </td>
                                        <td>{{$sl++}}</td>
                                        <td>{{$showdata->application_date}}</td>
                                        <td>{{$showdata->registration_id}}</td>
                                        <td>{{$showdata->branch_name}}</td>
                                        <td>{{$showdata->area_name}}</td>
                                        <td>{{$showdata->aplicant_name}}</td>
                                        <td>{{$showdata->phone}}</td>
                                        <td>
                                            <a href="{{route('saving_registration.show',$showdata->id)}}" class="btn btn-dark btn-sm"><i class="fa fa-eye"></i></a>
                                        </td>
                                        <td>@if($showdata->status == 1) <div class="badge badge-success">Active</div> @else <div class="badge badge-danger">Inactive</div> @endif</td>
                                        <td>
                                            <a id="" style="float: left;margin-right:10px;" href="{{route('saving_registration.edit',$showdata->id)}}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>
                                            @if(Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || $showdata->approval == 0)
                                                <form action="{{ route('saving_registration.destroy',$showdata->id) }}" method="post">
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
                        url : "{{ url('viewSavingRegistrations') }}",
                        type : 'POST',
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'application_date', name: 'application_date'},
                        {data: 'registration_id', name: 'registration_id'},
                        {data: 'branch_name', name: 'branch_name'},
                        {data: 'area_name', name: 'area_name'},
                        {data: 'schema', name: 'schema'},
                        {data: 'aplicant_name', name: 'aplicant_name'},
                        {data: 'phone', name: 'phone'},
                        {data: 'show', name: 'show'},
                        {data: 'status', name: 'status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},

                        // {data: 'avg_con_time', name: 'avg_con_time'},
                    ]
                });
            });
        </script>

@endsection
