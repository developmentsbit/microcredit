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
@php
use App\Models\company_information;

$companyInfo = company_information::first();
@endphp
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">ড্যাশবোর্ড</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{url('/')}}">ড্যাশবোর্ড</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row pt-2 mt-4" style="background-color: white;">
            <div class="col-2">
                <a href="{{url('viewAllNotice')}}">নোটিশ সমূহ :</a>
            </div>
            @php
            $data = DB::table('notices')->where('status',1)->orderBy('id','DESC')->take(1)->get();
            @endphp
            <div class="col-10">
                <marquee onmouseover="this.stop()" onmouseout="this.start()">@foreach ($data as $v)
                    <img src="{{asset('/Backend/images')}}/{{$companyInfo->short_logo}}" alt="" style="max-height: 15px;">  <a href="{{route('notices.show',$v->id)}}"> {{$v->title}} </a>
                @endforeach</marquee>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <a class="box-link col-lg-2 col-md-6 col-12" href="{{route('add_member.create')}}">
                <div class="link-box text-center" >
                    <img src="{{asset('Backend/avatar')}}/add_user.png" alt="" class="img-fluid" style="max-width: 90px;"><br>
                    <b>সদস্য ভর্তি</b>
                </div>
            </a>
            <a class="box-link col-lg-2 col-md-6 col-12" href="{{route('add_member.index')}}">
                <div class="link-box text-center" >
                    <img src="{{asset('Backend/avatar')}}/view_user.png" alt="" class="img-fluid" style="max-width: 90px;"><br>
                    <b>সদস্য তালিকা</b>
                </div>
            </a>
            <a class="box-link col-lg-2 col-md-6 col-12" href="#">
                <div class="link-box text-center" >
                    <img src="{{asset('Backend/avatar')}}/passbook.png" alt="" class="img-fluid" style="max-width: 90px;"><br>
                    <b>সদস্য পাসবই</b>
                </div>
            </a>
            <a class="box-link col-lg-2 col-md-6 col-12" href="{{route('saving_registration.create')}}">
                <div class="link-box text-center" >
                    <img src="{{asset('Backend/avatar')}}/add_savings.png" alt="" class="img-fluid" style="max-width: 90px;"><br>
                    <b>নতুন সঞ্চয় রেজিষ্ট্রেশন</b>
                </div>
            </a>
            <a class="box-link col-lg-2 col-md-6 col-12" href="{{route('saving_collection.create')}}">
                <div class="link-box text-center" >
                    <img src="{{asset('Backend/avatar')}}/saving_coll.png" alt="" class="img-fluid" style="max-width: 90px;"><br>
                    <b>সঞ্চয় জমা</b>
                </div>
            </a>
            <a class="box-link col-lg-2 col-md-6 col-12" href="{{route('saving_return.create')}}">
                <div class="link-box text-center" >
                    <img src="{{asset('Backend/avatar')}}/saving_return.png" alt="" class="img-fluid" style="max-width: 90px;"><br>
                    <b>সঞ্চয় ফেরত</b>
                </div>
            </a>
            <a class="box-link col-lg-2 col-md-6 col-12" href="#">
                <div class="link-box text-center" >
                    <img src="{{asset('Backend/avatar')}}/saving-close.png" alt="" class="img-fluid" style="max-width: 90px;"><br>
                    <b>ক্যাশ ক্লোজ তৈরি করুন</b>
                </div>
            </a>
            <a class="box-link col-lg-2 col-md-6 col-12" href="{{route('fixeddeposit_registration.create')}}">
                <div class="link-box text-center" >
                    <img src="{{asset('Backend/avatar')}}/new_fixed_deposit.png" alt="" class="img-fluid" style="max-width: 90px;"><br>
                    <b>সঞ্চয় হিসাব ক্লোজ </b>
                </div>
            </a>
            <a class="box-link col-lg-2 col-md-6 col-12" href="{{route('investment_registration.create')}}">
                <div class="link-box text-center" >
                    <img src="{{asset('Backend/avatar')}}/add_loan.png" alt="" class="img-fluid" style="max-width: 90px;"><br>
                    <b>নতুন ঋণ হিসাব</b>
                </div>
            </a>
            <a class="box-link col-lg-2 col-md-6 col-12" href="{{route('investment_registration.index')}}">
                <div class="link-box text-center" >
                    <img src="{{asset('Backend/avatar')}}/loan_list.png" alt="" class="img-fluid" style="max-width: 90px;"><br>
                    <b>ঋণ তালিকা</b>
                </div>
            </a>
            <a class="box-link col-lg-2 col-md-6 col-12" href="{{route('investment_collection.create')}}">
                <div class="link-box text-center" >
                    <img src="{{asset('Backend/avatar')}}/loan_instalment.png" alt="" class="img-fluid" style="max-width: 90px;"><br>
                    <b>ঋণ কিস্তি</b>
                </div>
            </a>
            <a class="box-link col-lg-2 col-md-6 col-12" href="#">
                <div class="link-box text-center" >
                    <img src="{{asset('Backend/avatar')}}/collection-sheet-entry.png" alt="" class="img-fluid" style="max-width: 90px;"><br>
                    <b>সমিতি কালেকশন</b>
                </div>
            </a>
            <a class="box-link col-lg-2 col-md-6 col-12" href="#">
                <div class="link-box text-center" >
                    <img src="{{asset('Backend/avatar')}}/quick-collection.png" alt="" class="img-fluid" style="max-width: 90px;"><br>
                    <b>সদস্য কিস্তি কালেকশন </b>
                </div>
            </a>
            <a class="box-link col-lg-2 col-md-6 col-12" href="{{url('weeklysavingloancollsheet')}}">
                <div class="link-box text-center" >
                    <img src="{{asset('Backend/avatar')}}/collection-details-report.png" alt="" class="img-fluid" style="max-width: 90px;"><br>
                    <b>আজকের সকল কালেকশন</b>
                </div>
            </a>
            <a class="box-link col-lg-2 col-md-6 col-12" href="{{url('monthlyprofitsheet')}}">
                <div class="link-box text-center" >
                    <img src="{{asset('Backend/avatar')}}/collection_sheet_report.png" alt="" class="img-fluid" style="max-width: 90px;"><br>
                    <b>মাসিক কালেকশান শীট</b>
                </div>
            </a>
            <a class="box-link col-lg-2 col-md-6 col-12" href="{{url('bankstatement')}}">
                <div class="link-box text-center" >
                    <img src="{{asset('Backend/avatar')}}/cash-and-bank.png" alt="" class="img-fluid" style="max-width: 90px;"><br>
                    <b>ব্যাংক স্টেটমেন্ট রিপোর্ট</b>
                </div>
            </a>
            <a class="box-link col-lg-2 col-md-6 col-12" href="#">
                <div class="link-box text-center" >
                    <img src="{{asset('Backend/avatar')}}/transection.png" alt="" class="img-fluid" style="max-width: 90px;"><br>
                    <b>এ্যাকাউন্ট লেনদেন</b>
                </div>
            </a>
            <a class="box-link col-lg-2 col-md-6 col-12" href="#">
                <div class="link-box text-center" >
                    <img src="{{asset('Backend/avatar')}}/ledger-transaction.png" alt="" class="img-fluid" style="max-width: 90px;"><br>
                    <b>লেজার লেনদেন</b>
                </div>
            </a>
            <a class="box-link col-lg-2 col-md-6 col-12" href="#">
                <div class="link-box text-center" >
                    <img src="{{asset('Backend/avatar')}}/list.png" alt="" class="img-fluid" style="max-width: 90px;"><br>
                    <b>ভাউচার তালিকা</b>
                </div>
            </a>
            <a class="box-link col-lg-2 col-md-6 col-12" href="#">
                <div class="link-box text-center" >
                    <img src="{{asset('Backend/avatar')}}/collection-sheet-report.png" alt="" class="img-fluid" style="max-width: 90px;"><br>
                    <b>কালেকশন শীট</b>
                </div>
            </a>
            <a class="box-link col-lg-2 col-md-6 col-12" href="#">
                <div class="link-box text-center" >
                    <img src="{{asset('Backend/avatar')}}/account-receipt-payment.png" alt="" class="img-fluid" style="max-width: 90px;"><br>
                    <b>এ্যাকাউন্ট ভিত্তিক প্রাপ্তি-প্রদান</b>
                </div>
            </a>
            <a class="box-link col-lg-2 col-md-6 col-12" href="#">
                <div class="link-box text-center" >
                    <img src="{{asset('Backend/avatar')}}/cash-and-bank.png" alt="" class="img-fluid" style="max-width: 90px;"><br>
                    <b>ক্যাশ বুক  (ক্যাশ এবং ব্যাংক)</b>
                </div>
            </a>
            <a class="box-link col-lg-2 col-md-6 col-12" href="#">
                <div class="link-box text-center" >
                    <img src="{{asset('Backend/avatar')}}/excel.png" alt="" class="img-fluid" style="max-width: 90px;"><br>
                    <b>ডি.সি.আর</b>
                </div>
            </a>
            <a class="box-link col-lg-2 col-md-6 col-12" href="#">
                <div class="link-box text-center" >
                    <img src="{{asset('Backend/avatar')}}/loan_1.png" alt="" class="img-fluid" style="max-width: 90px;"><br>
                    <b>লোন রিকভারি রিপোর্ট</b>
                </div>
            </a>
            <a class="box-link col-lg-2 col-md-6 col-12" href="#">
                <div class="link-box text-center" >
                    <img src="{{asset('Backend/avatar')}}/profits.png" alt="" class="img-fluid" style="max-width: 90px;"><br>
                    <b>আয়-ব্যায় বিবরণী</b>
                </div>
            </a>
            <a class="box-link col-lg-2 col-md-6 col-12" href="#">
                <div class="link-box text-center" >
                    <img src="{{asset('Backend/avatar')}}/address-book.png" alt="" class="img-fluid" style="max-width: 90px;"><br>
                    <b>ভর্তি রেজিঃ</b>
                </div>
            </a>
            <a class="box-link col-lg-2 col-md-6 col-12" href="#">
                <div class="link-box text-center" >
                    <img src="{{asset('Backend/avatar')}}/address-book-48.png" alt="" class="img-fluid" style="max-width: 90px;"><br>
                    <b>বিতরণ রেজিঃ</b>
                </div>
            </a>
            <a class="box-link col-lg-2 col-md-6 col-12" href="#">
                <div class="link-box text-center" >
                    <img src="{{asset('Backend/avatar')}}/customs-officer-80.png" alt="" class="img-fluid" style="max-width: 90px;"><br>
                    <b>ফিল্ড অফিসার রিপোর্ট</b>
                </div>
            </a>
            <a class="box-link col-lg-2 col-md-6 col-12" href="#">
                <div class="link-box text-center" >
                    <img src="{{asset('Backend/avatar')}}/health-graph-100.png" alt="" class="img-fluid" style="max-width: 90px;"><br>
                    <b>সদস্য ব্যালেন্স রিপোর্ট</b>
                </div>
            </a>
        </div>

        <div class="row mt-4 d-none">
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

            <!-- prject ,team member start -->
            {{-- <div class="row">
            <div class="col-xl-6 col-md-12">
                <div class="card table-card">
                    <div class="card-header">
                        <h5>Projects</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                    <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                    <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                    <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="chk-option">
                                                <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">
                                                    <input type="checkbox" class="custom-control-input">
                                                    <span class="custom-control-label"></span>
                                                </label>
                                            </div>
                                            Assigned
                                        </th>
                                        <th>Name</th>
                                        <th>Due Date</th>
                                        <th class="text-right">Priority</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="chk-option">
                                                <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">
                                                    <input type="checkbox" class="custom-control-input">
                                                    <span class="custom-control-label"></span>
                                                </label>
                                            </div>
                                            <div class="d-inline-block align-middle">
                                                <img src="{{asset('public/Backend')}}/assets/images/user/avatar-4.jpg" alt="user image" class="img-radius wid-40 align-top m-r-15">
                                                <div class="d-inline-block">
                                                    <h6>John Deo</h6>
                                                    <p class="text-muted m-b-0">Graphics Designer</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Able Pro</td>
                                        <td>Jun, 26</td>
                                        <td class="text-right"><label class="badge badge-light-danger">Low</label></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="chk-option">
                                                <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">
                                                    <input type="checkbox" class="custom-control-input">
                                                    <span class="custom-control-label"></span>
                                                </label>
                                            </div>
                                            <div class="d-inline-block align-middle">
                                                <img src="{{asset('public/Backend')}}/assets/images/user/avatar-2.jpg" alt="user image" class="img-radius wid-40 align-top m-r-15">
                                                <div class="d-inline-block">
                                                    <h6>Jenifer Vintage</h6>
                                                    <p class="text-muted m-b-0">Web Designer</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Mashable</td>
                                        <td>March, 31</td>
                                        <td class="text-right"><label class="badge badge-light-primary">high</label></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="chk-option">
                                                <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">
                                                    <input type="checkbox" class="custom-control-input">
                                                    <span class="custom-control-label"></span>
                                                </label>
                                            </div>
                                            <div class="d-inline-block align-middle">
                                                <img src="{{asset('public/Backend')}}/assets/images/user/avatar-3.jpg" alt="user image" class="img-radius wid-40 align-top m-r-15">
                                                <div class="d-inline-block">
                                                    <h6>William Jem</h6>
                                                    <p class="text-muted m-b-0">Developer</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Flatable</td>
                                        <td>Aug, 02</td>
                                        <td class="text-right"><label class="badge badge-light-success">medium</label></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="chk-option">
                                                <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">
                                                    <input type="checkbox" class="custom-control-input">
                                                    <span class="custom-control-label"></span>
                                                </label>
                                            </div>
                                            <div class="d-inline-block align-middle">
                                                <img src="{{asset('public/Backend')}}/assets/images/user/avatar-2.jpg" alt="user image" class="img-radius wid-40 align-top m-r-15">
                                                <div class="d-inline-block">
                                                    <h6>David Jones</h6>
                                                    <p class="text-muted m-b-0">Developer</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Guruable</td>
                                        <td>Sep, 22</td>
                                        <td class="text-right"><label class="badge badge-light-primary">high</label></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-12">
                <div class="card latest-update-card">
                    <div class="card-header">
                        <h5>Latest Updates</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                    <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                    <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                    <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="latest-update-box">
                            <div class="row p-t-30 p-b-30">
                                <div class="col-auto text-right update-meta">
                                    <p class="text-muted m-b-0 d-inline-flex">2 hrs ago</p>
                                    <i class="feather icon-twitter bg-twitter update-icon"></i>
                                </div>
                                <div class="col">
                                    <a href="#!">
                                        <h6>+ 1652 Followers</h6>
                                    </a>
                                    <p class="text-muted m-b-0">You’re getting more and more followers, keep it up!</p>
                                </div>
                            </div>
                            <div class="row p-b-30">
                                <div class="col-auto text-right update-meta">
                                    <p class="text-muted m-b-0 d-inline-flex">4 hrs ago</p>
                                    <i class="feather icon-briefcase bg-c-red update-icon"></i>
                                </div>
                                <div class="col">
                                    <a href="#!">
                                        <h6>+ 5 New Products were added!</h6>
                                    </a>
                                    <p class="text-muted m-b-0">Congratulations!</p>
                                </div>
                            </div>
                            <div class="row p-b-0">
                                <div class="col-auto text-right update-meta">
                                    <p class="text-muted m-b-0 d-inline-flex">2 day ago</p>
                                    <i class="feather icon-facebook bg-facebook update-icon"></i>
                                </div>
                                <div class="col">
                                    <a href="#!">
                                        <h6>+1 Friend Requests</h6>
                                    </a>
                                    <p class="text-muted m-b-10">This is great, keep it up!</p>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <tr>
                                                <td class="b-none">
                                                    <a href="#!" class="align-middle">
                                                        <img src="{{asset('public/Backend')}}/assets/images/user/avatar-2.jpg" alt="user image" class="img-radius wid-40 align-top m-r-15">
                                                        <div class="d-inline-block">
                                                            <h6>Jeny William</h6>
                                                            <p class="text-muted m-b-0">Graphic Designer</p>
                                                        </div>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="#!" class="b-b-primary text-primary">View all Projects</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- prject ,team member start -->
            <!-- seo start -->
            <div class="col-xl-4 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h3>$16,756</h3>
                                <h6 class="text-muted m-b-0">Visits<i class="fa fa-caret-down text-c-red m-l-10"></i></h6>
                            </div>
                            <div class="col-6">
                                <div id="seo-chart1" class="d-flex align-items-end"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h3>49.54%</h3>
                                <h6 class="text-muted m-b-0">Bounce Rate<i class="fa fa-caret-up text-c-green m-l-10"></i></h6>
                            </div>
                            <div class="col-6">
                                <div id="seo-chart2" class="d-flex align-items-end"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h3>1,62,564</h3>
                                <h6 class="text-muted m-b-0">Products<i class="fa fa-caret-down text-c-red m-l-10"></i></h6>
                            </div>
                            <div class="col-6">
                                <div id="seo-chart3" class="d-flex align-items-end"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- seo end -->

            <!-- Latest Customers start -->
            <div class="col-lg-8 col-md-12">
                <div class="card table-card review-card">
                    <div class="card-header borderless ">
                        <h5>Customer Reviews</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                    <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                    <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                    <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div class="review-block">
                            <div class="row">
                                <div class="col-sm-auto p-r-0">
                                    <img src="{{asset('public/Backend')}}/assets/images/user/avatar-2.jpg" alt="user image" class="img-radius profile-img cust-img m-b-15">
                                </div>
                                <div class="col">
                                    <h6 class="m-b-15">John Deo <span class="float-right f-13 text-muted"> a week ago</span></h6>
                                    <a href="#!"><i class="feather icon-star-on f-18 text-c-yellow"></i></a>
                                    <a href="#!"><i class="feather icon-star-on f-18 text-c-yellow"></i></a>
                                    <a href="#!"><i class="feather icon-star-on f-18 text-c-yellow"></i></a>
                                    <a href="#!"><i class="feather icon-star f-18 text-muted"></i></a>
                                    <a href="#!"><i class="feather icon-star f-18 text-muted"></i></a>
                                    <p class="m-t-15 m-b-15 text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                    <a href="#!" class="m-r-30 text-muted"><i class="feather icon-thumbs-up m-r-15"></i>Helpful?</a>
                                    <a href="#!"><i class="feather icon-heart-on text-c-red m-r-15"></i></a>
                                    <a href="#!"><i class="feather icon-edit text-muted"></i></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-auto p-r-0">
                                    <img src="{{asset('public/Backend')}}/assets/images/user/avatar-4.jpg" alt="user image" class="img-radius profile-img cust-img m-b-15">
                                </div>
                                <div class="col">
                                    <h6 class="m-b-15">Allina D’croze <span class="float-right f-13 text-muted"> a week ago</span></h6>
                                    <a href="#!"><i class="feather icon-star-on f-18 text-c-yellow"></i></a>
                                    <a href="#!"><i class="feather icon-star f-18 text-muted"></i></a>
                                    <a href="#!"><i class="feather icon-star f-18 text-muted"></i></a>
                                    <a href="#!"><i class="feather icon-star f-18 text-muted"></i></a>
                                    <a href="#!"><i class="feather icon-star f-18 text-muted"></i></a>
                                    <p class="m-t-15 m-b-15 text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                    <a href="#!" class="m-r-30 text-muted"><i class="feather icon-thumbs-up m-r-15"></i>Helpful?</a>
                                    <a href="#!"><i class="feather icon-heart-on text-c-red m-r-15"></i></a>
                                    <a href="#!"><i class="feather icon-edit text-muted"></i></a>
                                    <blockquote class="blockquote m-t-15 m-b-0">
                                        <h6>Allina D’croze</h6>
                                        <p class="m-b-0 text-muted">Lorem Ipsum is simply dummy text of the industry.</p>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="mb-3">Power</h5>
                                <h2>2789<span class="text-muted m-l-5 f-14">kw</span></h2>
                                <div id="power-card-chart1"></div>
                                <div class="row">
                                    <div class="col col-auto">
                                        <div class="map-area">
                                            <h6 class="m-0">2876 <span> kw</span></h6>
                                            <p class="text-muted m-0">month</p>
                                        </div>
                                    </div>
                                    <div class="col col-auto">
                                        <div class="map-area">
                                            <h6 class="m-0">234 <span> kw</span></h6>
                                            <p class="text-muted m-0">Today</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="mb-3">Temperature</h5>
                                <h2>7.3<span class="text-muted m-l-10 f-14">deg</span></h2>
                                <div id="power-card-chart3"></div>
                                <div class="row">
                                    <div class="col col-auto">
                                        <div class="map-area">
                                            <h6 class="m-0">4.5 <span> deg</span></h6>
                                            <p class="text-muted m-0">month</p>
                                        </div>
                                    </div>
                                    <div class="col col-auto">
                                        <div class="map-area">
                                            <h6 class="m-0">0.5 <span> deg</span></h6>
                                            <p class="text-muted m-0">Today</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card chat-card">
                    <div class="card-header">
                        <h5>Chat</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                    <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                    <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                    <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row m-b-20 received-chat">
                            <div class="col-auto p-r-0">
                                <img src="{{asset('public/Backend')}}/assets/images/user/avatar-2.jpg" alt="user image" class="img-radius wid-40">
                            </div>
                            <div class="col">
                                <div class="msg">
                                    <p class="m-b-0">Nice to meet you!</p>
                                </div>
                                <p class="text-muted m-b-0"><i class="fa fa-clock-o m-r-10"></i>10:20am</p>
                            </div>
                        </div>
                        <div class="row m-b-20 send-chat">
                            <div class="col">
                                <div class="msg">
                                    <p class="m-b-0">Nice to meet you!</p>
                                </div>
                                <p class="text-muted m-b-0"><i class="fa fa-clock-o m-r-10"></i>10:20am</p>
                            </div>
                            <div class="col-auto p-l-0">
                                <img src="{{asset('public/Backend')}}/assets/images/user/avatar-3.jpg" alt="user image" class="img-radius wid-40">
                            </div>
                        </div>
                        <div class="row m-b-20 received-chat">
                            <div class="col-auto p-r-0">
                                <img src="{{asset('public/Backend')}}/assets/images/user/avatar-2.jpg" alt="user image" class="img-radius wid-40">
                            </div>
                            <div class="col">
                                <div class="msg">
                                    <p class="m-b-0">Nice to meet you!</p>
                                    <img src="{{asset('public/Backend')}}/assets/images/widget/dashborad-1.jpg" alt="">
                                    <img src="{{asset('public/Backend')}}/assets/images/widget/dashborad-3.jpg" alt="">
                                </div>
                                <p class="text-muted m-b-0"><i class="fa fa-clock-o m-r-10"></i>10:20am</p>
                            </div>
                        </div>
                        <div class="input-group m-t-15">
                            <input type="text" name="task-insert" class="form-control" id="Project" placeholder="Send message">
                            <div class="input-group-append">
                                <button class="btn btn-primary">
                                    <i class="feather icon-message-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3">Total Leads</h5>
                            <p class="text-c-green f-w-500"><i class="fa fa-caret-up m-r-15"></i> 18% High than last month</p>
                            <div class="row">
                                <div class="col-4 b-r-default">
                                    <p class="text-muted m-b-5">Overall</p>
                                    <h5>76.12%</h5>
                                </div>
                                <div class="col-4 b-r-default">
                                    <p class="text-muted m-b-5">Monthly</p>
                                    <h5>16.40%</h5>
                                </div>
                                <div class="col-4">
                                    <p class="text-muted m-b-5">Day</p>
                                    <h5>4.56%</h5>
                                </div>
                            </div>
                        </div>
                        <div id="tot-lead" style="height:150px"></div>
                    </div>
            </div>
            <!-- Latest Customers end -->
        </div> --}}
        <!-- [ Main Content ] end -->
@endsection
