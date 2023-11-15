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
                            <h5 class="m-b-10">সঞ্চয় স্কিমা</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('add_saving_schema.index')}}">সঞ্চয় স্কিমা</a></li>
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
                                <h5>সকল সঞ্চয় স্কিমা সমূহ সমূহ</h5>
                            </div>
                            <div class="col-6" style="text-align: right">
                                <a href="{{route('add_saving_schema.create')}}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> নতুন সঞ্চয় স্কিমা যুক্ত করুন</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>সিরিয়াল নং</th>
                                    <th>সঞ্চয় স্কিমা নাম</th>
                                    <th>শর্ট নাম</th>
                                    <th>মেয়াদকাল</th>
                                    <th>শতকরা</th>
                                    <th>কিস্তির পরিমাণ</th>
                                    <th>অ্যাকশান</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($data)
                                @foreach ($data as $showdata)
                                <tr>
                                    <td>{{$showdata->sl}}</td>
                                    <td>{{$showdata->deposit_name}}</td>
                                    <td>{{$showdata->short_name}}</td>
                                    <td>{{$showdata->duration}}</td>
                                    <td>{{$showdata->percantage}}</td>
                                    <td>{{$showdata->installment_no}}</td>
                                    <td>
                                        <a  style="float: left;margin-right:10px;" href="{{route('add_saving_schema.edit',$showdata->id)}}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>
                                        @if(Auth::user()->email == 'info@sbit.com.bd')
                                        <form action="{{ route('add_saving_schema.destroy',$showdata->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button  onclick="return confirm('Are Your Sure?')" type="submit" class="btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
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
