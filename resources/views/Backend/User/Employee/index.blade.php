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
                            <h5 class="m-b-10">কর্মকর্তা ও কর্মচারী তথ্য</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('add_employee.index')}}">কর্মকর্তা ও কর্মচারী তথ্য</a></li>
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
                                <h5>কর্মকর্তা ও কর্মচারী তথ্য</h5>
                            </div>
                            <div class="col-6" style="text-align: right">
                                <a href="{{route('add_employee.create')}}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> নতুন কর্মকর্তা ও কর্মচারী করুন</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>সিরিয়াল নং</th>
                                    <th>ব্রাঞ্চ নাম</th>
                                    <th>নাম</th>
                                    <th>ধরণ</th>
                                    <th>পদবী</th>
                                    <th>ফোন</th>
                                    <th>বিস্তারিত</th>
                                    <th>স্ট্যাটাস</th>
                                    <th>ছবি</th>
                                    {{-- <th>বিস্তারিত</th> --}}
                                    <th>অ্যাকশান</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($data)
                                @foreach ($data as $showdata)
                                <tr>
                                    <td>{{$showdata->sl}}</td>
                                    <td>{{$showdata->branch_name}}</td>
                                    <td>{{$showdata->name}}</td>
                                    <td>
                                        @if($showdata->type == 1)
                                        কর্মকর্তা
                                        @else
                                        কর্মচারী
                                        @endif
                                    </td>
                                    <td>{{$showdata->designation}}</td>
                                    <td>{{$showdata->phone}}</td>
                                    <td>
                                        <!-- This is a button toggling the modal -->
                                        <button class="uk-button uk-button-default uk-margin-small-right" type="button" uk-toggle="target: #modal-example-{{$showdata->id}}">বিস্তারিত</button>

                                        {{-- <!-- This is an anchor toggling the modal -->
                                        <a href="#modal-example" uk-toggle>Open</a> --}}

                                        <!-- This is the modal -->
                                        <div id="modal-example-{{$showdata->id}}" uk-modal>
                                            <div class="uk-modal-dialog uk-modal-body">
                                                <h4 class="uk-modal-title">বিস্তারিত তথ্য</h4>
                                                <div class="information-box">
                                                    <div class="profile-image">
                                                        <img src="{{asset('Backend/images/EmployeeImage')}}/{{$showdata->image}}" class="img-fluid" style="height: 100px;width:100px;border-radius:100%;">
                                                    </div>
                                                    <div class="informaiton-body">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-12">
                                                                <div class="input-single-box">
                                                                    <label>ব্রাঞ্চ নাম</label>
                                                                    <input type="text" readonly value="{{$showdata->branch_name}}" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-12">
                                                                <div class="input-single-box">
                                                                    <label>নাম</label>
                                                                    <input type="text" readonly value="{{$showdata->name}}" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-12">
                                                                <div class="input-single-box">
                                                                    <label>পিতার নাম</label>
                                                                    <input type="text" readonly value="{{$showdata->fathers_name}}" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-12">
                                                                <div class="input-single-box">
                                                                    <label>মাতার নাম</label>
                                                                    <input type="text" readonly value="{{$showdata->mothers_name}}" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-12">
                                                                <div class="input-single-box">
                                                                    <label>পদবী</label>
                                                                    <input type="text" readonly value="@if($showdata->mothers_name == 1) কর্মকর্তা @else কর্মচারী @endif" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-12">
                                                                <div class="input-single-box">
                                                                    <label>ফোন</label>
                                                                    <input type="text" readonly value="{{$showdata->phone}}" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-12">
                                                                <div class="input-single-box">
                                                                    <label>ফোন ২</label>
                                                                    <input type="text" readonly value="{{$showdata->phone2}}" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-12">
                                                                <div class="input-single-box">
                                                                    <label>ই-মেইল</label>
                                                                    <input type="text" readonly value="{{$showdata->email}}" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-12">
                                                                <div class="input-single-box">
                                                                    <label>জন্ম তারিখ</label>
                                                                    <input type="text" readonly value="{{$showdata->date_of_birth}}" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-12">
                                                                <div class="input-single-box">
                                                                    <label>লিঙ্গ</label>
                                                                    <input type="text" readonly value="{{$showdata->gender}}" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-12">
                                                                <div class="input-single-box">
                                                                    <label>বর্তমান ঠিকানা</label>
                                                                    <input type="text" readonly value="{!! $showdata->present_address !!}" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-12">
                                                                <div class="input-single-box">
                                                                    <label>স্থায়ী ঠিকানা</label>
                                                                    <input type="text" readonly value="{!! $showdata->permenant_address !!}" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-12">
                                                                <div class="input-single-box">
                                                                    <label>জাতীয় পরিচয় পত্র নং</label>
                                                                    <input type="text" readonly value="{{$showdata->nid_no}}" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-12">
                                                                <div class="input-single-box">
                                                                    <label>স্ট্যাটাস</label>
                                                                    <input type="text" readonly value="@if($showdata->status == 1) Active @else Inactive @endif" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-12">
                                                                <div class="input-single-box">
                                                                    <label>যোগদানের তারিখ</label>
                                                                    <input type="text" readonly value="{{$showdata->join_date}}" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-12">
                                                                <div class="input-single-box">
                                                                    <label>জাতীয় পরিচয় পত্র</label>
                                                                    <img src="{{asset('Backend/images/EmployeeNid')}}/{{$showdata->nid_image}}" class="img-fluid" style="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="uk-text-right">
                                                    <button class="uk-button uk-button-default uk-modal-close" type="button">Close</button>
                                                    {{-- <button class="uk-button uk-button-primary" type="button">Save</button> --}}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($showdata->status == 1)
                                        <div class="badge badge-success">Active</div>
                                        @else
                                        <div class="badge badge-danger">Inactive</div>
                                        @endif
                                    </td>
                                    <td>
                                        <img src="{{asset('Backend/images/EmployeeImage')}}/{{$showdata->image}}" class="img-fluid" style="height: 50px;width:50px;border-radius:100%;">
                                    </td>
                                    {{-- <td>
                                        <a class="btn btn-sm btn-info" href="#modal-center-{{$showdata->id}}" uk-toggle>বিস্তারিত</a>
                                        <div id="modal-center-{{$showdata->id}}" class="uk-flex-top" uk-modal>
                                            <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

                                                <button class="uk-modal-close-default" type="button" uk-close></button>



                                            </div>
                                        </div>
                                    </td> --}}
                                    <td>

                                        <a id="" style="float: left;margin-right:10px;" href="{{route('add_employee.edit',$showdata->id)}}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>
                                        <form action="{{ route('add_employee.destroy',$showdata->id) }}" method="post">
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
