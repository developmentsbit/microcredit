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
                            <h5 class="m-b-10">অ্যাসেট সংক্রান্ত ব্যায়</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('add_asset_expense.index')}}">অ্যাসেট সংক্রান্ত ব্যায়</a></li>
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
                                <h5>অ্যাসেট সংক্রান্ত ব্যায়</h5>
                            </div>
                            <div class="col-6" style="text-align: right">
                                <a href="{{route('add_asset_expense.create')}}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> অ্যাসেট সংক্রান্ত ব্যায় যু্ক্ত করুন</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>সিরিয়াল নং</th>
                                    <th>তারিখ</th>
                                    <th>ব্রাঞ্চ নাম</th>
                                    <th>অ্যাসেট টাইটেল</th>
                                    <th>টাকার পরিমাণ</th>
                                    <th>বিস্তারিত</th>
                                    <th>অ্যাডমিন</th>
                                    <th>স্ট্যাটাস</th>
                                    <th>অ্যাকশান</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($data)
                                    @foreach ($data as $v)
                                        <tr>
                                            <td>
                                                @if($v->approval == 1)
                                                <i style="color: green" class="fa fa-check"></i>
                                                @endif
                                            </td>
                                            <td>{{$v->serial_no}}</td>
                                            <td>{{$v->date}}</td>
                                            <td>{{$v->branch_name}}</td>
                                            <td>{{$v->asset_title}}</td>
                                            <td>{{$v->taka_ammount}}</td>
                                            <td>{{$v->description}}</td>
                                            <td>{{$v->name}} {{$v->last_name}}</td>
                                            <td>
                                                @if($v->status == 1)
                                                <div class="badge badge-success">Active</div>
                                                @else
                                                <div class="badge badge-danger">Inactive</div>
                                                @endif
                                            </td>
                                            <td>
                                                @if(Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || $v->approval == 0)
                                                <a id="" style="float: left;margin-right:10px;" href="{{route('add_asset_expense.edit',$v->id)}}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>
                                                <form action="{{ route('add_asset_expense.destroy',$v->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Are Your Sure?')" id="confirm" type="submit" class="btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
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
