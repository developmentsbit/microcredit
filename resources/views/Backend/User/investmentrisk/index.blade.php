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
                            <h5 class="m-b-10">ঝুঁকি উত্তোলন</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ url('riskamount_withdraw')}}">   ঝুঁকি উত্তোলন</a></li>
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
                                <h5>    ঝুঁকি উত্তোলন তথ্য</h5>
                            </div>
                            <div class="col-6" style="text-align: right">
                                <a href="{{ url('create_investorriskamount')}}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> নতুন  ঝুঁকি উত্তোলন করুন</a>
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
                                    <th>মেম্বার আইডি</th>
                                    <th>উত্তোলন পরিমাণ</th>
                                    <th>মন্তব্য</th>
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
                                    <td>{{ $d->date }}</td>
                                    <td>{{ $d->branch_name }}</td>
                                    <td>{{ $d->area_name }}</td>
                                    <td>{{ $d->registration_id }}</td>
                                    <td>{{ $d->withdraw }}</td>
                                    <td>{{ $d->comment }}</td>

                                    <td>

                                      {{--   <a id="confirm" style="float: left;margin-right:10px;" href="{{route('investment_handover.edit',$d->id)}}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a> --}}
                                        <form id="" action="{{ url('deleteinvestor_riskamount',$d->id) }}" method="get" onsubmit="showAlert()">
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
