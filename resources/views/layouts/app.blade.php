<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="Materia - Admin Template">
	<meta name="keywords" content="materia, webapp, admin, dashboard, template, ui">
	<meta name="author" content="solutionportal">
	<!-- <base href="/"> -->

	<title>Genius</title>

	<link rel="stylesheet" href="{{ asset('css/all.css') }}">


</head>
<body id="app" class="app off-canvas body-full">



	<!-- main-container -->
	<div class="main-container clearfix">

		<!-- content-here -->
		<div class="content-container" id="content">
			<div class="page page-auth">
				<div class="auth-container">

					<div class="form-head mb20">
						<h1 class="site-logo h2 mb5 mt5 text-center text-uppercase text-bold"><a href="/"><img src="{{asset('images/logo150.png')}}" ></a></h1>
						<!--<h5 class="text-normal h5 text-center">PAT</h5>-->
						@if(Session::has('error'))

                        <div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert">
								<span aria-hidden="true">×</span>
							</button>
							<div>{{Session::get('error')}}</div>
						</div>
                        {{Session::forget('error')}}
						@endif
					</div>

					<div class="form-container">

						@yield('content')

					</div>

				</div> <!-- #end signin-container -->
			</div>



		</div>
		<!-- #end content-container -->

	</div> <!-- #end main-container -->

	<!-- Dev only -->
	<script src="{{asset('/js/all.js')}}"></script>
</body>
</html>