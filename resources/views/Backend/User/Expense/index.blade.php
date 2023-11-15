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
                            <h5 class="m-b-10">ব্যায় সমূহ</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('add_expense.index')}}">ব্যায় সমূহ</a></li>
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
                                <a href="{{route('add_expense.create')}}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> নতুন ব্যায় যুক্ত করুন</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>সিরিয়াল নং</th>
                                    <th>তারিখ</th>
                                    <th>ব্রাঞ্চ নাম</th>
                                    <th>ব্যায় খাত নাম</th>
                                    <th>টাকার পরিমাণ</th>
                                    <th>বিস্তারিত</th>
                                    <th>নোট</th>
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
                                    @if(Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || $d->approval == 0)
                                    <a id="" style="float: left;margin-right:10px;" href="{{route('add_expense.edit',$d->id)}}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>
                                    <form action="{{ route('add_expense.destroy',$d->id) }}" method="post">
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
                    url : "{{ url('viewExpenses') }}",
                    type : 'POST',
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'date', name: 'date'},
                    {data: 'branch_name', name: 'branch_name'},
                    {data: 'title', name: 'title'},
                    {data: 'amount', name: 'amount'},
                    {data: 'details', name: 'details'},
                    {data: 'comment', name: 'comment'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},

                    // {data: 'avg_con_time', name: 'avg_con_time'},
                ]
            });
        });
    </script>
    @endsection
