@php
use App\Models\company_information;

$companyInfo = company_information::first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
	<title>{{$companyInfo->title}}</title>
	<!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 11]>
    	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    	<![endif]-->
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="" />
	<meta name="keywords" content="">
	<meta name="author" content="Phoenixcoded" />
	<!-- Favicon icon -->
	<link rel="icon" href="{{asset('/Backend/images')}}/{{$companyInfo->short_logo}}" type="image/x-icon">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.13/dist/css/uikit.min.css" />
	<!-- vendor css -->
	<link rel="stylesheet" href="{{asset('/Backend/assets/css/style.css')}}">

	{{-- data tables --}}
	<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


	{{-- fantswosome css --}}
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/brands.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/fontawesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/regular.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/solid.min.css">



	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="https://www.jonthornton.com/jquery-timepicker/jquery.timepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="https://www.jonthornton.com/jquery-timepicker/jquery.timepicker.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.standalone.css" />

    <script src="{{asset('Backend/date_picker')}}/lib/pikaday.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('Backend/date_picker')}}/lib/pikaday.css" />

    <script src="{{asset('Backend/date_picker')}}/lib/jquery.ptTimeSelect.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('Backend/date_picker')}}/lib/jquery.ptTimeSelect.css" />
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/ui-lightness/jquery-ui.css" type="text/css" media="all" />

    <script src="{{asset('Backend/date_picker')}}/lib/moment.min.js"></script>
    <script src="{{asset('Backend/date_picker')}}/lib/site.js"></script>
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('Backend/date_picker')}}/lib/site.css" /> --}}

    <script src="{{asset('Backend/date_picker')}}/dist/datepair.js"></script>
    <script src="{{asset('Backend/date_picker')}}/dist/jquery.datepair.js"></script>



</head>


<style>
    div#showData {
    height: 299px;
    overflow: scroll;
    border-top: 1px solid black;
    overflow-x: hidden;
}
</style>

<body class="">
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->
	<!-- [ navigation menu ] start -->
	<nav class="pcoded-navbar  ">
		<div class="navbar-wrapper  ">
			<div class="navbar-content scroll-div ">

				<div class="">
					<div class="main-menu-header">
						<img class="img-radius" src="{{asset('Backend/')}}/images/EmployeeImage/{{Auth::user()->image}}" alt="User-Profile-Image">
						<div class="user-details">
							<span>{{Auth::user()->name}} {{Auth::user()->last_name}}</span>
							<div id="more-details">@if(Auth::user()->user_role == 1) Super Admin @elseif(Auth::user()->user_role == 2) Main Admin @else Sub Admin @endif<i class="fa fa-chevron-down m-l-5"></i></div>
						</div>
					</div>
					<div class="collapse" id="nav-user-link">
						<ul class="list-unstyled">
							<li class="list-group-item"><a href="{{route('create_admin.show',Auth::user()->id)}}"><i class="feather icon-user m-r-5"></i>আপনার প্রোফাইল দেখুন</a></li>
							<li class="list-group-item"><a href="#!"><i class="feather icon-settings m-r-5"></i>সেটিংস</a></li>
							<li class="list-group-item"><a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                 <i class="feather icon-log-out m-r-5"></i> লগআউট
                             </a>
                             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form></li>
						</ul>
					</div>
				</div>

				<ul class="nav pcoded-inner-navbar ">
					<li class="nav-item pcoded-menu-caption">
						<label>নেভিগেশন</label>
					</li>
					<li class="nav-item">
					    <a href="{{url('/dashboard')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">ড্যাশবোর্ড</span></a>
					</li>
					<li class="nav-item pcoded-hasmenu">
					    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">সিস্টেম সেটিংস</span></a>
					    <ul class="pcoded-submenu">
							@if(Auth::user()->user_role == 1)
					        <li><a href="{{ route('main_menu.index') }}" target="">মেইন লিংক</a></li>
					        <li><a href="{{route('sub_menu.index')}}" target="">সাব লিংক</a></li>
					        <li><a href="{{route('company_information.index')}}" target="">কোম্পানি ইনফরমেশন</a></li>
							@endif
					    </ul>
					</li>

					<li class="nav-item pcoded-menu-caption">
						<label>নেভিগেশন</label>
					</li>
					@php
					Use App\Models\admin_main_menu;
					Use App\Models\admin_sub_menu;
					Use App\Models\main_menu_priority;
					Use App\Models\sub_menu_priority;
					Use App\Models\branch_info;
					Use App\Models\admin_branch_info;
					$main_menu = admin_main_menu::where('status',1)->orderby('serial_no','ASC')->get();
					$sub_menu = admin_sub_menu::where('status',1)->get();
					@endphp

					@if (Auth::user()->user_role == 1)

					@if($main_menu)
					@foreach($main_menu as $showdata)
					<li class="nav-item pcoded-hasmenu">
						<a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">{{$showdata->main_menu}}</span></a>
						<ul class="pcoded-submenu">
							@if($sub_menu)
							@foreach($sub_menu as $showsub_menu)
							@if($showdata->id == $showsub_menu->main_menu_id)
							<li><a href="{{url($showsub_menu->route_name)}}">{{$showsub_menu->sub_menu}}</a></li>
							@endif
							@endforeach
							@endif
						</ul>
					</li>
					@endforeach
					@endif

					@else

					@php
						$main_menu = main_menu_priority::where('main_menu_priorities.admin_id',Auth::user()->id)
									 ->join('admin_main_menus','admin_main_menus.id','=','main_menu_priorities.main_menu_id')
									 ->select('admin_main_menus.*')
									 ->orderby('admin_main_menus.serial_no','ASC')
									 ->get();

						$sub_menus = sub_menu_priority::where('sub_menu_priorities.admin_id',Auth::user()->id)
									->join('admin_sub_menus','admin_sub_menus.id','=','sub_menu_priorities.sub_menu_id')
									->select('admin_sub_menus.*')
									->get();

					@endphp

					@if($main_menu)
					@foreach($main_menu as $showdata)
					<li class="nav-item pcoded-hasmenu">
						<a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">{{$showdata->main_menu}}</span></a>
						<ul class="pcoded-submenu">
							@if($sub_menu)
							@foreach($sub_menus as $showsub_menu)
							@if($showdata->id == $showsub_menu->main_menu_id)
							<li><a href="{{url($showsub_menu->route_name)}}">{{$showsub_menu->sub_menu}}</a></li>
							@endif
							@endforeach
							@endif
						</ul>
					</li>
					@endforeach
					@endif

					@endif

					<br><br><br>
				</ul>
			</div>
		</div>
	</nav>
	<!-- [ navigation menu ] end -->
	<!-- [ Header ] start -->
	<header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">

				<div class="m-header">
					<a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
					<a href="{{url('home_dashboard')}}" class="b-brand">
						<!-- ========   change your logo hear   ============ -->
						<img src="{{asset('Backend')}}/images/{{$companyInfo->logo}}" alt="" class="logo">
						<img src="{{asset('Backend')}}/images/{{$companyInfo->logo}}" alt="" class="logo-thumb">
					</a>
					<a href="#!" class="mob-toggler">
						<i class="feather icon-more-vertical"></i>
					</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
							<div class="search-bar">
								<input type="text" class="form-control border-0 shadow-none" placeholder="Search By Member ID or Member Name or Member Phone Number" onkeypress="return getMemberData();" id="searchData">
								<button type="button" class="close" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
                                <div id="showData" style="color: black !important;">

                                </div>
							</div>
						</li>
						<div class="dropdown-menu dropdown-menu-right notification">
									<div class="noti-head">
										<h6 class="d-inline-block m-b-0">Notifications</h6>
										<div class="float-right">
											<a href="#!" class="m-r-10">mark as read</a>
											<a href="#!">clear all</a>
										</div>
									</div>
									<ul class="noti-body">
										<li class="n-title">
											<p class="m-b-0">NEW</p>
										</li>
										<li class="notification">
											<div class="media">
												<img class="img-radius" src="assets/images/user/avatar-1.jpg" alt="Generic placeholder image">
												<div class="media-body">
													<p><strong>John Doe</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>5 min</span></p>
													<p>New ticket Added</p>
												</div>
											</div>
										</li>
										<li class="n-title">
											<p class="m-b-0">EARLIER</p>
										</li>
										<li class="notification">
											<div class="media">
												<img class="img-radius" src="assets/images/user/avatar-2.jpg" alt="Generic placeholder image">
												<div class="media-body">
													<p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>10 min</span></p>
													<p>Prchace New Theme and make payment</p>
												</div>
											</div>
										</li>
										<li class="notification">
											<div class="media">
												<img class="img-radius" src="assets/images/user/avatar-1.jpg" alt="Generic placeholder image">
												<div class="media-body">
													<p><strong>Sara Soudein</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>12 min</span></p>
													<p>currently login</p>
												</div>
											</div>
										</li>
										<li class="notification">
											<div class="media">
												<img class="img-radius" src="assets/images/user/avatar-2.jpg" alt="Generic placeholder image">
												<div class="media-body">
													<p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>30 min</span></p>
													<p>Prchace New Theme and make payment</p>
												</div>
											</div>
										</li>
									</ul>
									<div class="noti-footer">
										<a href="#!">show all</a>
									</div>
								</div>


						{{-- <li class="nav-item">
							<div class="dropdown">
								<a class="dropdown-toggle h-drop" href="#" data-toggle="dropdown">
									আপনার ব্রাঞ্চ সমূহ
								</a>
								<div class="dropdown-menu profile-notification ">
									<ul class="pro-body">
										@php
										$admin_id = Auth::user()->id;
										$branch = admin_branch_info::where('admin_branch_infos.admin_id',$admin_id)
												  ->join('branch_infos','branch_infos.id','=','admin_branch_infos.branch_id')
												  ->select('branch_infos.branch_name','admin_branch_infos.*')
												  ->get();
										@endphp
										<li><a href="{{url()->current()}}" class="dropdown-item"><i class="fas fa-circle"></i> All</a></li>
										@if($branch)
										@foreach ($branch as $showbranch)
										<li><a href="{{url()->current()}}/?branch_id={{$showbranch->branch_id}}" class="dropdown-item"><i class="fas fa-circle"></i> {{$showbranch->branch_name}}</a></li>
										@endforeach
										@endif
									</ul>
								</div>
							</div>
						</li> --}}



						{{-- <li class="nav-item">
							<div class="dropdown mega-menu">
								<a class="dropdown-toggle h-drop" href="#" data-toggle="dropdown">
									Mega
								</a>
								<div class="dropdown-menu profile-notification ">
									<div class="row no-gutters">
										<div class="col">
											<h6 class="mega-title">UI Element</h6>
											<ul class="pro-body">
												<li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Alert</a></li>
												<li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Button</a></li>
												<li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Badges</a></li>
												<li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Cards</a></li>
												<li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Modal</a></li>
												<li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Tabs & pills</a></li>
											</ul>
										</div>
										<div class="col">
											<h6 class="mega-title">Forms</h6>
											<ul class="pro-body">
												<li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i> Elements</a></li>
												<li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i> Validation</a></li>
												<li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i> Masking</a></li>
												<li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i> Wizard</a></li>
												<li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i> Picker</a></li>
												<li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i> Select</a></li>
											</ul>
										</div>
										<div class="col">
											<h6 class="mega-title">Application</h6>
											<ul class="pro-body">
												<li><a href="#!" class="dropdown-item"><i class="feather icon-mail"></i> Email</a></li>
												<li><a href="#!" class="dropdown-item"><i class="feather icon-clipboard"></i> Task</a></li>
												<li><a href="#!" class="dropdown-item"><i class="feather icon-check-square"></i> To-Do</a></li>
												<li><a href="#!" class="dropdown-item"><i class="feather icon-image"></i> Gallery</a></li>
												<li><a href="#!" class="dropdown-item"><i class="feather icon-help-circle"></i> Helpdesk</a></li>
											</ul>
										</div>
										<div class="col">
											<h6 class="mega-title">Extension</h6>
											<ul class="pro-body">
												<li><a href="#!" class="dropdown-item"><i class="feather icon-file-plus"></i> Editor</a></li>
												<li><a href="#!" class="dropdown-item"><i class="feather icon-file-minus"></i> Invoice</a></li>
												<li><a href="#!" class="dropdown-item"><i class="feather icon-calendar"></i> Full calendar</a></li>
												<li><a href="#!" class="dropdown-item"><i class="feather icon-upload-cloud"></i> File upload</a></li>
												<li><a href="#!" class="dropdown-item"><i class="feather icon-scissors"></i> Image cropper</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</li> --}}
					</ul>
					<ul class="navbar-nav ml-auto">
                        <li>{{date('d M Y')}}</li>
					<li>
						@if(Auth::user()->user_role == 3)

						@else

							<a target="" class="" href="{{url('incoming_data')}}" data-toggle="">
								{{-- <i class="icon feather icon-bell"></i> --}}
								<span>নতুন ডাটা সমূহ</span>
								{{-- <span class="badge badge-pill badge-danger">5</span> --}}
							</a>

						@endif
					</li>
				<li>
					<div class="dropdown drp-user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="feather icon-user"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right profile-notification">
							<div class="pro-head">
								<img src="{{asset('/Backend')}}/images/EmployeeImage/{{Auth::user()->image}}" class="img-radius" alt="User-Profile-Image">
								<span>{{Auth::user()->name}} {{Auth::user()->last_name}}</span>
								{{-- <a class="dud-logout" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
									<i class="feather icon-log-out"></i>
								</a> --}}

								<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
									@csrf
								</form>
							</div>
							<ul class="pro-body">
								<li><a href="{{route('create_admin.show',Auth::user()->id)}}" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
								{{-- <li><a href="email_inbox.html" class="dropdown-item"><i class="feather icon-mail"></i> My Messages</a></li> --}}
								<li><a class="dud-logout dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><i class="feather icon-log-out"></i>  লগআউট</a></li>
							</ul>
						</div>
					</div>
				</li>
			</ul>
		</div>


	</header>
	<!-- [ Header ] end -->


	@yield('body')


	</div>
	</div>
	<!-- [ Main Content ] end -->
	<!-- Warning Section start -->
	<!-- Older IE warning message -->
	<!--[if lt IE 11]>
        <div class="ie-warning">
            <h1>Warning!!</h1>
            <p>You are using an outdated version of Internet Explorer, please upgrade
               <br/>to any of the following web browsers to access this website.
            </p>
            <div class="iew-container">
                <ul class="iew-download">
                    <li>
                        <a href="http://www.google.com/chrome/">
                            <img src="{{asset('')}}/assets/images/browser/chrome.png" alt="Chrome">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="{{asset('')}}/assets/images/browser/firefox.png" alt="Firefox">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="{{asset('')}}/assets/images/browser/opera.png" alt="Opera">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="{{asset('')}}/assets/images/browser/safari.png" alt="Safari">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="{{asset('')}}/assets/images/browser/ie.png" alt="">
                            <div>IE (11 & above)</div>
                        </a>
                    </li>
                </ul>
            </div>
            <p>Sorry for the inconvenience!</p>
        </div>
    <![endif]-->
	<!-- Warning Section Ends -->

	<!-- Required Js -->
	<script src="{{asset('Backend')}}/assets/js/vendor-all.min.js"></script>
	<script src="{{asset('Backend')}}/assets/js/plugins/bootstrap.min.js"></script>
	<script src="{{asset('Backend')}}/assets/js/pcoded.min.js"></script>

	<!-- Apex Chart -->
	<script src="{{asset('Backend')}}/assets/js/plugins/apexcharts.min.js"></script>


	<!-- custom-chart js -->
	<script src="{{asset('Backend')}}/assets/js/pages/dashboard-main.js"></script>

	{{-- data tables --}}
	<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/uikit@3.15.13/dist/js/uikit.min.js"></script>



	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/brands.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/fontawesome.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/regular.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/solid.min.js"></script>

	<script>
		$(document).ready(function() {
			$('.js-example-basic-single').select2();
		});
	</script>

	<script>
		$(document).ready(function() {
			$('#myTable').DataTable();
		});
	</script>

	@if(Session::has('success'))
	<script>
		swal('', '{{ session('success') }}', 'success');
	</script>

	@endif

	@if(Session::has('error'))
	<script>
		swal('', '{{ session('error') }}', 'error');
	</script>

	@endif

	@if(Session::has('info'))
	<script>
		swal('', '{{ session('info') }}', 'info');
	</script>

	@endif


	<script type="text/javascript">
		$('#pass_message').hide();
	</script>


	<script>
		$('.date').datepicker({
        'format': 'dd/mm/yyyy',
        'autoclose': true
    });
	</script>

{{-- <script type="text/javascript">

    $('.onlyEng').bind('keyup blur',function() {
          $(this).val($(this).val().replace(/[^A-Za-z0-9]/g,''))
      });

</script> --}}


<script>

$('#myTable').on('click', '.confirm', function () {
        // e.preventDefault();
        if(confirm("Are You Sure!"))
        {
            return true;
        }
        else
        {
            return false;
        }

    });



    function getMemberData()
    {
        var data = $('#searchData').val();

        // console.log(data);

        var loading = `
            <div class="row">
                <div class="col-12 text-center">
                    <h3>Loading......</h3>
                    </div>
                </div>
        `;

        if(data != "")
        {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN' : '{{csrf_token()}}'
                },

                url : '{{url('getMemberData')}}',

                type : 'POST',

                data : {data},

                beforeSend : function(r)
                {
                    $('#showData').html(loading);
                },

                success : function(response)
                {
                    $('#showData').html(response);
                }
            });
        }
    }


</script>

</body>

</html>
