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
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <h5>আপনার তথ্য</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label for="validationCustomUsername">প্রথম নাম</label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm @error('first_name') is-invalid @enderror" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="First Name" name="first_name" value="{{$data->name}}" readonly>
                                </div>
                                @error('first_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label for="validationCustomUsername">শেষ নাম</label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm @error('last_name') is-invalid @enderror" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="Last Name" name="last_name" value="{{$data->last_name}}" readonly>
                                </div>
                                @error('last_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label for="validationCustomUsername">Phone</label>
                                <div class="input-group">
                                    <input type="number" class="form-control form-control-sm @error('phone') is-invalid @enderror" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="Phone" name="phone" value="{{$data->phone}}" readonly>
                                </div>
                                @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label for="validationCustomUsername">Email</label>
                                <div class="input-group">
                                    <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="Email" name="email" value="{{$data->email}}" readonly>
                                </div>
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5>পাসওয়ার্ড পরিবর্তন করুন</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 mb-3">
                                <label for="old_pwd">পূর্বের পাসওয়ার্ড</label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm @error('old_pwd') is-invalid @enderror" id="old_pwd" aria-describedby="inputGroupPrepend" name="old_pwd" onkeyup="checkPwd()">
                                </div>
                                <div class="alert alert-danger" id="pass_message">পূর্ববর্তী পাসওয়ার্ড সঠিক নয়</div>
                                @error('old_pwd')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="hidden" value="{{Auth::user()->id}}" id="admin_id">
                            
                        </div>
                        <form method="post" action="{{url('change_password')}}">
                            @csrf
                        <div class="row" id="load_form">
                            
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4 col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Your Profile</h5>
                    </div>
                    <div class="card-body">
                        <div class="profile-image">
                            <img src="{{asset('/Backend/images/EmployeeImage')}}/{{Auth::user()->image}}" alt="">
                        </div>
                        <div class="profile-text">
                            <b>{{Auth::user()->name}} {{Auth::user()->last_name}}</b><br>
                            <span>
                                @if(Auth::user()->user_role == 1)
                                <span>Super Admin</span>
                                @elseif(Auth::user()->user_role == 2)
                                <span>Main Admin</span>
                                @else
                                <span>Sub Admin</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Latest Customers end -->
        </div>
        <!-- [ Main Content ] end -->
        <script type="text/javascript">
            $('#pass_message').hide();
        </script>
        <script>
            
            function checkPwd()
            {
                
                var oldPwd = $('#old_pwd').val();
                var admin_id = $('#admin_id').val();
                if(oldPwd == "")
                {

                }
                else
                {
                    $.ajax({
                        headers : 
                        {
                            'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                        },

                        url : '{{url('check_pass')}}',

                        type : 'POST',

                        data : {oldPwd,admin_id},

                        success : function(data)
                        {
                            if(data == 0)
                            {

                                // alert();
                                $('#pass_message').show();
                            }
                            else
                            {
                                $('#pass_message').hide();
                                $('#load_form').html(data);
                            }
                            
                        }
                    })
                }
            }
        </script>

@endsection