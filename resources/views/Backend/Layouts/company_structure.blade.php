@extends('Backend.Layouts.master')
@section('body')
<style>
    a.box-link {
    background: white;
    padding: 11px 12px;
    border-radius: 8px;
    box-shadow: 0px 3px 2px 1px;
    transition: .3s;
    margin-right: 15px;
    margin-top: 15px;
}

a.box-link:hover {
    background: #e3e0e0;
}
</style>
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">কোম্পানির তথ্যসমূহ</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{url('/')}}">কোম্পানির তথ্যসমূহ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->


        <div class="row mt-4">
            <!-- table card-1 start -->
            <div class="col-md-12 col-xl-4">
                <!-- widget primary card start -->
                <div class="card flat-card widget-primary-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="feather icon-user"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>{{$total_user}}</h4>
                            <h6>অ্যাডমিন</h6>
                        </div>
                    </div>
                </div>
                <!-- widget primary card end -->
            </div>
            <div class="col-md-12 col-xl-4">
                <!-- widget primary card start -->
                <div class="card flat-card widget-purple-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="feather icon-box"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>{{$investment_schema}}</h4>
                            <h6>বিনিয়োগ স্কিমা</h6>
                        </div>
                    </div>
                </div>
                <!-- widget primary card end -->
            </div>
            <div class="col-md-12 col-xl-4">
                <!-- widget primary card start -->
                <div class="card flat-card widget-primary-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="feather icon-box"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>{{$saving_schema}}</h4>
                            <h6>সঞ্চয় স্কিমা</h6>
                        </div>
                    </div>
                </div>
                <!-- widget primary card end -->
            </div>
            <div class="col-md-12 col-xl-4">
                <!-- widget primary card start -->
                <div class="card flat-card widget-purple-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="feather icon-box"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>{{$fixed_deposit_schema}}</h4>
                            <h6>ফিক্সড ডিপোজিট স্কিমা</h6>
                        </div>
                    </div>
                </div>
                <!-- widget primary card end -->
            </div>
            @php
            $total_member = DB::table('members')->where('status',1)->count();
            @endphp
            <div class="col-md-12 col-xl-4">
                <!-- widget primary card start -->
                <div class="card flat-card widget-primary-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="feather icon-user"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>{{$total_member}}</h4>
                            <h6>জন মোট সদস্য</h6>
                        </div>
                    </div>
                </div>
                <!-- widget primary card end -->
            </div>
            @php
            $total_saving_registration = DB::table('saving_registrations')->where('status',1)->where('approval',1)->count();
            @endphp
            <div class="col-md-12 col-xl-4">
                <!-- widget primary card start -->
                <div class="card flat-card widget-primary-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="feather icon-user"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>{{$total_saving_registration}}</h4>
                            <h6>জন মোট সঞ্চয় রেজিষ্ট্রেশন</h6>
                        </div>
                    </div>
                </div>
                <!-- widget primary card end -->
            </div>
            @php
            $total_fixedeposit_registration = DB::table('fixed_deposit_registrations')->where('status',1)->where('approval',0)->count();
            @endphp
            <div class="col-md-12 col-xl-4">
                <!-- widget primary card start -->
                <div class="card flat-card widget-primary-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="feather icon-user"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>{{$total_fixedeposit_registration}}</h4>
                            <h6>জন মোট ফিক্সড ডিপোজিট রেজিষ্ট্রেশন</h6>
                        </div>
                    </div>
                </div>
                <!-- widget primary card end -->
            </div>
            @php
            $total_investor_registration = DB::table('investor_registrations')->where('status',1)->where('approval',1)->count();
            @endphp
            <div class="col-md-12 col-xl-4">
                <!-- widget primary card start -->
                <div class="card flat-card widget-primary-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="feather icon-user"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>{{$total_investor_registration}}</h4>
                            <h6>জন মোট বিনিয়োগ রেজিষ্ট্রেশন</h6>
                        </div>
                    </div>
                </div>
                <!-- widget primary card end -->
            </div>
        </div>
            <!-- Widget primary-success card start -->
            <!-- Widget primary-success card end -->

        {{-- yearly --}}
        <div class="row mt-4">
            <div class="col-md-12 col-xl-4">
                <div class="card flat-card">
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <b>মোট ঋণ আদায়</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-md-center pt-2">
                                    <h5>{{$grandtotals['loan_recived']}} /-</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <b>মোট ঋণ প্রদান</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-md-center pt-2">
                                    <h5>{{$grandtotals['loan_provide']}} /-</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-4">
                <div class="card flat-card">
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <b>মোট সঞ্চয় আদায়</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-md-center pt-2">
                                    <h5>{{$grandtotals['saving_collection']}} /-</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <b>মোট সঞ্চয় ফেরত</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-md-center pt-2">
                                    <h5>{{$grandtotals['saving_provide']}} /-</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-4">
                <div class="card flat-card">
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <b>মোট ডিপোজিট আদায়</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-md-center pt-2">
                                    <h5>{{$grandtotals['deposit_collection']}} /-</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <b>মোট ডিপোজিট ফেরত</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-md-center pt-2">
                                    <h5>{{$grandtotals['deposit_provide']}} /-</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- daily --}}
        <div class="row mt-4">
            <div class="col-md-12 col-xl-4">
                <div class="card flat-card">
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <b>আজকের ঋণ আদায়</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-md-center pt-2">
                                    <h5>{{$totals['total_loan_recived']}} /-</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <b>আজকের ঋণ প্রদান</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-md-center pt-2">
                                    <h5>{{$totals['total_loan_provide']}} /-</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-4">
                <div class="card flat-card">
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <b>আজকের সঞ্চয় আদায়</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-md-center pt-2">
                                    <h5>{{$totals['total_saving_collection']}} /-</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <b>আজকের সঞ্চয় ফেরত</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-md-center pt-2">
                                    <h5>{{$totals['total_saving_provide']}} /-</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-4">
                <div class="card flat-card">
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <b>আজকের ডিপোজিট ফেরত</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-md-center pt-2">
                                    <h5>{{$totals['total_deposit_collection']}} /-</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <b>আজকের ডিপোজিট প্রদান</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-md-center pt-2">
                                    <h5>{{$totals['total_deposit_provide']}} /-</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
