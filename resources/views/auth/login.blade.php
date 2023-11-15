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

	<!-- vendor css -->
	<link rel="stylesheet" href="{{asset('')}}Backend/assets/css/style.css">




</head>

<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
	<div class="auth-content text-center">
		<img src="{{asset('Backend')}}/images/{{$companyInfo->logo}}" alt="" class="img-fluid mb-4" style="height: 99px;">
		<div class="card borderless">
			<form action="{{ route('login') }}" method="POST">
				@csrf
				<div class="row align-items-center ">
					<div class="col-md-12">
						<div class="card-body">
							<h4 class="mb-3 f-w-400">Login</h4>
							<hr>
							<div class="form-group mb-3">
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Give Your Email">
								@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="form-group mb-4">
								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Give Your Password">

								@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<button class="btn btn-block btn-primary mb-4">Signin</button>
							<hr>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- [ auth-signin ] end -->

<!-- Required Js -->
<script src="{{asset('')}}Backend/assets/js/vendor-all.min.js"></script>
<script src="{{asset('')}}Backend/assets/js/plugins/bootstrap.min.js"></script>

<script src="{{asset('')}}Backend/assets/js/pcoded.min.js"></script>



</body>

</html>
