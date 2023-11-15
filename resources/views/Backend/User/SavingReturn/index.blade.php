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
        <div class="row">
            <!-- table card-1 start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h5>সঞ্চয় ফেরত তথ্য</h5>
                            </div>
                            <div class="col-6" style="text-align: right">
                                <a href="{{route('saving_return.create')}}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> নতুন সঞ্চয় ফেরত করুন</a>
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
                                    <th>সঞ্চয় ফেরত পরিমাণ</th>
                                    <th>লাভ পরিমাণ</th>
                                    <th>মন্তব্য</th>
                                    <th>অ্যাকশান</th>
                                </tr>
                            </thead>
                            <tbody>
                            {{-- @if ($data)
                            @foreach ($data as $v)
                            <tr>
                                <td>
                                    @if($v->approval == 1)
                                    <i style="color: green" class="fa fa-check"></i>
                                    @endif
                                </td>
                                <td>{{$sl++}}</td>
                                <td>{{$v->date}}</td>
                                <td>{{$v->branch_name}}</td>
                                <td>{{$v->area_name}}</td>
                                <td>{{$v->aplicant_name}} - {{$v->member_id}}</td>
                                <td>{{$v->return_ammount}}</td>
                                <td>{{$v->profit_ammount}}</td>
                                <td>{{$v->comment}}</td>
                                <td>
                                    <a id="" target="blank" href="{{route('saving_return.show',$v->id)}}" class="btn btn-dark btn-sm" style="float: left;margin-right:10px;"><i class="feather icon-file"></i></a>
                                    @if(Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || $v->approval == 0)
                                    <form action="{{ route('saving_return.destroy',$v->id) }}" method="post">
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
                        url : "{{ url('viewSavingReturn') }}",
                        type : 'POST',
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'date', name: 'date'},
                        {data: 'branch_name', name: 'branch_name'},
                        {data: 'area_name', name: 'area_name'},
                        {data: 'applicant_name_id', name: 'applicant_name_id'},
                        {data: 'return_ammount', name: 'return_ammount'},
                        {data: 'profit_ammount', name: 'profit_ammount'},
                        {data: 'comment', name: 'comment'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},

                        // {data: 'avg_con_time', name: 'avg_con_time'},
                    ]
                });
            });
        </script>
@endsection
