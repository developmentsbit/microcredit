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
                            <h5 class="m-b-10">কেন্দ্র তথ্য</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('area_info.index')}}">কেন্দ্র</a></li>
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
                                <h5>সকল কেন্দ্র সমূহ</h5>
                            </div>
                            <div class="col-6" style="text-align: right">
                                <a href="{{route('area_info.create')}}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> নতুন কেন্দ্র যুক্ত করুন</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>সিরিয়াল নং</th>
                                    <th>ব্রাঞ্চ নাম</th>
                                    <th>কেন্দ্র নাম</th>
                                    <th>টাইপ</th>
                                    <th>স্ট্যাটাস</th>
                                    <th>অ্যাকশান</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($data)
                                @foreach ($data as $showdata)
                                <tr>
                                    <td>{{$showdata->sl}}</td>
                                    <td>{{$showdata->branch_name}}</td>
                                    <td>{{$showdata->area_name}}</td>
                                    <td>
                                        @if($showdata->type == 'daily')
                                        দৈনিক
                                        @elseif($showdata->type == 'weekly')
                                        সাপ্তাহিক ({{$showdata->day}})
                                        @elseif($showdata->type  == 'monthly')
                                        মাসিক
                                        @elseif($showdata->type == 'yearly')
                                        বার্ষিক
                                        @endif
                                    </td>
                                    <td>
                                        @if($showdata->status == 1)
                                        <div class="badge badge-success">Active</div>
                                        @else
                                        <div class="badge badge-danger">Inactive</div>
                                        @endif
                                    </td>
                                    <td>
                                        <a style="float: left;margin-right:10px;" href="{{route('area_info.edit',$showdata->id)}}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>
                                        <form action="{{ route('area_info.destroy',$showdata->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are Your Sure?')" type="submit" class="btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                                        </form>
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
