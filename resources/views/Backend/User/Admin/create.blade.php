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
                            <h5 class="m-b-10">অ্যাডমিন তথ্যাবলি</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('create_admin.index')}}">অ্যাডমিন</a></li>
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
                        <h5>নতুন অ্যাডমিন তৈরি করুন</h5>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{route('create_admin.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label for="validationCustomUsername">কর্মকর্তা / কর্মচারী নির্বাচন করুন</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('employee_id') is-invalid @enderror" name="employee_id" id="employee_id" onchange="loadEmployeeData()">
                                            <option value="">নির্বাচন করুন</option>
                                           @if($employee)
                                           @foreach ($employee as $showemployee)
                                           @php
                                           $check = DB::table('users')->where('employee_id',$showemployee->id)->count();
                                           @endphp


                                           @if($check == 0)
                                            <option value="{{$showemployee->id}}">{{$showemployee->name}}</option>
                                            @else

                                            @endif


                                           @endforeach
                                           @endif
                                        </select>
                                    </div>
                                    @error('employee_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="validationCustomUsername">ইউজার রোল</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('user_role') is-invalid @enderror" name="user_role">
                                            <option value="">নির্বাচন করুন</option>
                                            @if(Auth::user()->user_role == 1)
                                            <option value="1">Super Admin</option>
                                            <option value="2">Main Admin</option>
                                            <option value="3">Sub Admin</option>
                                            @elseif (Auth::user()->user_role ==2)
                                            <option value="2">Main Admin</option>
                                            <option value="3">Sub Admin</option>
                                            @else
                                            <option value="3">Sub Admin</option>
                                            @endif
                                        </select>
                                    </div>
                                    @error('user_role')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row" id="emp_data">

                            </div>
                            {{-- hidden input --}}
                            <div class="submit-btn">
                                <input type="submit" class="btn btn-success" value="সেভ করুন">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Latest Customers end -->
        </div>
        <!-- [ Main Content ] end -->
        <script>
            function loadEmployeeData()
            {
                var emp_id = $('#employee_id').val();

                if(emp_id == "")
                {
                    alert('Select A Employee');
                }
                else
                {
                    $.ajax({
                        headers:{
                            'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                        },

                        url : '{{url('loadEmployee')}}',

                        type : 'POST',

                        data : {emp_id},

                        success : function(data)
                        {
                           $('#emp_data').html(data);
                        }
                    });
                }
            }


        </script>
@endsection
