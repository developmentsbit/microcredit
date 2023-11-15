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
                            <h5 class="m-b-10">অ্যাসেট ডিপ্রেসিয়েশন</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('add_asset_depreciation.index')}}">অ্যাসেট ডিপ্রেসিয়েশন</a></li>
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
                                <h5>অ্যাসেট ডিপ্রেসিয়েশন</h5>
                            </div>
                            <div class="col-6" style="text-align: right">
                                <a href="{{route('add_asset_depreciation.create')}}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> অ্যাসেট ডিপ্রেসিয়েশন যু্ক্ত করুন</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>সিরিয়াল নং</th>
                                    <th>অ্যাসেট টাইটেল</th>
                                    <th>বিস্তারিত</th>
                                    <th>ডিপ্রেসিয়েশন ভ্যালু পার্সেন্টেজ</th>
                                    <th>অ্যাডমিন</th>
                                    <th>স্ট্যাটাস</th>
                                    <th>অ্যাকশান</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($data)
                                    @foreach ($data as $v)
                                    <tr>
                                        <td>{{$v->sl}}</td>
                                        <td>{{$v->asset_title}}</td>
                                        <td>{{$v->description}}</td>
                                        <td>{{$v->depreciation_value_per}}</td>
                                        <td>{{$v->name}} {{$v->last_name}}</td>
                                        <td>
                                            @if($v->status == 1)
                                            <div class="badge badge-success">Active</div>
                                            @else
                                            <div class="badge badge-danger">Inactive</div>
                                            @endif
                                        </td>
                                        <td>
                                            <a id="" style="float: left;margin-right:10px;" href="{{route('add_asset_depreciation.edit',$v->id)}}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>
                                            <form action="{{ route('add_asset_depreciation.destroy',$v->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Are Your Sure?')" id="" type="submit" class="btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
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
