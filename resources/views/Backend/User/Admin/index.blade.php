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
                            <h5 class="m-b-10">অ্যাডমিন তথ্য</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('create_admin.index')}}">অ্যাডমিন তথ্য</a></li>
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
                                <h5>সকল অ্যাডমিন</h5>
                            </div>
                            <div class="col-6" style="text-align: right">
                                <a href="{{route('create_admin.create')}}" class="btn btn-success btn-sm"> <i class="fa fa-user-plus"></i> নতুন অ্যাডমিন যুক্ত করুন</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>সিরিয়াল নং</th>
                                    <th>নাম</th>
                                    <th>ইউজার রোল</th>
                                    <th>ই-মেইল</th>
                                    <th>ফোন</th>
                                    <th>ঠিকানা</th>
                                    <th>ছবি</th>
                                    <th>স্ট্যাটাস</th>
                                    <th>অ্যাকশান</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($data)
                                @foreach($data as $showdata)
                                <tr>
                                    <td>{{$sl++}}</td>
                                    <td>{{$showdata->name}} {{$showdata->last_name}}</td>
                                    <td>@if($showdata->user_role == 1) Super Admin @elseif($showdata->user_role == 2) Main Admin @else Sub Admin @endif </td>
                                    <td>{{$showdata->email}}</td>
                                    <td>{{$showdata->phone}}</td>
                                    <td>{{$showdata->Address}}</td>
                                    <td>
                                        <img src="{{asset('/Backend/images/EmployeeImage')}}/{{$showdata->image}}" style="height: 80px;width:80px;border-radius:100px;" class="img-fluid">
                                    </td>
                                    <td>
                                        @if($showdata->status == 1)
                                        <div class="badge badge-success">Active</div>
                                        @else
                                        <div class="badge badge-danger">Inactive</div>
                                        @endif
                                    </td>
                                    <td>
                                        <a  style="float: left;margin-right:10px;" href="{{route('create_admin.edit',$showdata->id)}}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>
                                        <form action="{{ route('create_admin.destroy',$showdata->id) }}" method="post">
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
