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
                            <h5 class="m-b-10">নতুন ডাটা</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{url('/')}}">নতুন ডাটা</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="card">
            <div class="card-header">
                <h5>নতুন ডাটা সমূহ</h5>
            </div>
            <div class="data-list">

                <li>
                    <a href="{{url('/saving_new_data')}}">সঞ্চয় রেজিষ্ট্রেশন</a> <div class="badge badge-danger">{{$totalNewSaving}}</div>
                </li>
                <li>
                    <a href="{{url('/saving_coll_new')}}">সঞ্চয় আদায়</a> <div class="badge badge-danger">{{$totalSavingColl}}</div>
                </li>
                <li>
                    <a href="{{url('/saving_return_new')}}">সঞ্চয় ফেরত</a> <div class="badge badge-danger">{{$totalSavingRet}}</div>
                </li>
                <li>
                    <a href="{{url('/new_income')}}">নতুন আয় সমূহ</a> <div class="badge badge-danger">{{$totalNewIncome}}</div>
                </li>

                <li>
                    <a href="{{url('/new_expense')}}">নতুন ব্যায় সমূহ</a> <div class="badge badge-danger">{{$totalNewExpense}}</div>
                </li>


                <li>
                    <a href="{{url('/new_ho_handover')}}">নতুন H/O প্রদান সমূহ</a> <div class="badge badge-danger">{{$totalHO_handover}}</div>
                </li>

                <li>
                    <a href="{{url('/new_ho_collection')}}">নতুন H/O আদায় সমূহ</a> <div class="badge badge-danger">{{$totalHO_coll}}</div>
                </li>


                <li>
                    <a href="{{url('/new_internalloan_handover')}}">অভ্যন্তরীণ লোন প্রদান</a> <div class="badge badge-danger">{{$totalInterLoanHandover}}</div>
                </li>

                <li>
                    <a href="{{url('/new_internalloan_collection')}}">অভ্যন্তরীণ লোন আদায়</a> <div class="badge badge-danger">{{$totalInterLoanColl}}</div>
                </li>


                <li>
                    <a href="{{url('/new_asset_expense')}}">অ্যাসেট সংক্রান্ত ব্যায়</a> <div class="badge badge-danger">{{$totalAssetExpense}}</div>
                </li>

                <li>
                    <a href="{{url('/new_fixed_deposit_coll')}}">ফিক্সড ডিপোজিট আদায় ও ফেরত</a> <div class="badge badge-danger">{{$totalFixedDepositColl}}</div>
                </li>


                


                <li>
                    <a href="{{url('/investor_reg')}}">বিনিয়োগ রেজিষ্ট্রেশন</a> <div class="badge badge-danger">{{ $totalinvestor }}</div>
                </li>

                <li>
                    <a href="{{url('/investment_handovers_show')}}">বিনিয়োগ প্রদান</a> <div class="badge badge-danger">{{ $investment_handovers }}</div>
                </li>

                <li>
                    <a href="{{url('/investment_collections_show')}}">বিনিয়োগ আদায়</a> <div class="badge badge-danger">{{ $investment_collections }}</div>
                </li>


                <li>
                    <a href="{{url('/draftsalarycheck')}}"> কর্মকর্তা / কর্মচারী বেতন</a>
                </li>
                <!--<li>-->
                <!--    <a href="{{url('/draftemployeesalarycheck')}}"> কর্মকর্তা / কর্মচারী বেতন</a>-->
                <!--</li>-->



            </div>
            
        </div>

        @endsection