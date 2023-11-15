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
                            <h5 class="m-b-10">বিনিয়োগ স্কিমা </h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('add_schema.index')}}">বিনিয়োগ স্কিমা </a></li>
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
                                <h5>সকল বিনিয়োগ স্কিমা</h5>
                            </div>
                            <div class="col-6" style="text-align: right">
                                <a href="{{route('add_schema.create')}}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> নতুন স্কিমা যুক্ত করুন</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>সিরিয়াল নং</th>
                                    <th>বিনিয়োগ স্কিমা নাম</th>
                                    <th>শর্ট নাম</th>
                                    <th>মেয়াদকাল</th>
                                    <th>শতকরা</th>
                                    <th>কিস্তির পরিমাণ</th>
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
                                    <td>{{ $d->investment_name }}</td>
                                    <td>{{ $d->short_name }}</td>
                                    <td>{{ $d->duration }}</td>
                                    <td>{{ $d->percentage }}</td>
                                    <td>{{ $d->installment_no }}</td>
                                    <td>

                                        <a  style="float: left;margin-right:10px;" href="{{route('add_schema.edit',$d->id)}}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>
                                        @if($d->id != 2)
                                        @if(Auth::user()->email == 'info@sbit.com.bd')
                                        <form action="{{ route('add_schema.destroy',$d->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are Your Sure?')"  type="submit" class="btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                                        </form>
                                        @endif
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
