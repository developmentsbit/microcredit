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
                            <h5 class="m-b-10">আয় খাত সমূহ</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('add_income_title.index')}}">আয় খাত সমূহ</a></li>
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
                                <h5>আয় খাত সমূহ</h5>
                            </div>
                            <div class="col-6" style="text-align: right">
                                <a href="{{route('add_income_title.create')}}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> নতুন আয় খাত ফেরত করুন</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>সিরিয়াল নং</th>
                                    <th>আয় খাত নাম</th>
                                    <th>বিস্তারিত</th>
                                    <th>স্ট্যাটাস</th>
                                    <th>অ্যাকশান</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                $i = 1;
                                @endphp

                                @if(isset($data))
                                @foreach($data as $d)

                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $d->title }}</td>
                                    <td>{{ $d->details }}</td>
                                    <td>
                                     @if($d->status == 1)
                                     <span class="btn btn-success btn-sm">Active</span>
                                     @else
                                     <span class="btn btn-danger btn-sm">Inactive</span>
                                     @endif
                                 </td>

                                 <td>

                                    <a id="" style="float: left;margin-right:10px;" href="{{route('add_income_title.edit',$d->id)}}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>
                                    @if($d->id == 1000)
                                    @else
                                    <form action="{{ route('add_income_title.destroy',$d->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are Your Sure?')" id="" type="submit" class="btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                                    </form>
                                    @endif
                                </td>

                            </tr>

                            @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Latest Customers end -->
    </div>
    <!-- [ Main Content ] end -->
    @endsection
