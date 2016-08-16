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
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">

	<script>var numeral_format='0,0.00';</script>
	<script>var url='{{url('/')}}/';</script>



</head>
<body id="app" class="app off-canvas theme-four" data-ng-app="genius">
	<!-- header -->
	<header class="site-head" id="site-head">
		<ul class="list-unstyled left-elems">
			<!-- nav trigger/collapse -->
			<li>
				<a href="javascript:;" class="nav-trigger ion ion-drag"></a>
			</li>
			<!-- #end nav-trigger -->

			<!-- Search box -->
			<li>
				<div class="form-search hidden-xs">
					<form id="site-search" action="javascript:;">
						<input type="search" class="form-control" placeholder="Buscar proyecto por nombre de cliente">
						<button type="submit" class="ion ion-ios-search-strong"></button>
					</form>
				</div>
			</li>	<!-- #end search-box -->

			<!-- site-logo for mobile nav -->
			<!--<li>
				<div class="site-logo visible-xs">
					<a href="javascript:;" class="text-uppercase h3">
						<span class="text">Expopack</span>
					</a>
				</div>
			</li>--> <!-- #end site-logo -->


			<!-- fullscreen -->
			<li class="fullscreen hidden-xs">
				<a href="javascript:;"><i class="ion ion-qr-scanner"></i></a>

			</li>	<!-- #end fullscreen -->





			<!-- notification drop -->


		</ul>

		<ul class="list-unstyled right-elems">

            <li><a href="javascript:;" class="text-white">{{App\Util::dateSpanish()}}&nbsp;&nbsp;</a></li>
            <li class="profile-drop hidden-xs dropdown">
				<a href="javascript:;" data-toggle="dropdown" aria-expanded="true">
					<img src="{{asset('/')}}images/admin.jpg" alt="admin-pic">
				</a>
				<ul class="dropdown-menu dropdown-menu-right">
					<!--<li><a href="javascript:;"><span class="ion ion-person">&nbsp;&nbsp;</span>Profile</a></li>
					<li><a href="javascript:;"><span class="ion ion-settings">&nbsp;&nbsp;</span>Settings</a></li>
					<li class="divider"></li>
					<li><a href="javascript:;"><span class="ion ion-lock-combination">&nbsp;&nbsp;</span>Lock Screen</a></li>-->
					<li><a href="{{ url('/logout') }}"><span class="ion ion-power">&nbsp;&nbsp;</span>Cerrar sesión</a></li>
				</ul>
			</li>



		</ul>

	</header>
	<!-- #end header -->


	<!-- main-container -->
	<div class="main-container clearfix ">
		<!-- main-navigation -->
		<aside class="nav-wrap" id="site-nav" data-perfect-scrollbar>
			<div class="nav-head">
				<!-- site logo -->
				<a href="{{url('/')}}" class="site-logo text-uppercase">
					<img src="{{asset('images/logo35.png')}}" width="35px">
					<span class="text"><img src="{{asset('images/logoletras.png')}}" width="100px"></span>
				</a>
			</div>

			<!-- Site nav (vertical) -->

			<nav class="site-nav clearfix" role="navigation">
				<div class="profile clearfix mb15">
					<img src="{{asset('/')}}images/admin.jpg" alt="admin">
					<div class="group">
						<h5 class="name">{{Auth::user()->name}}</h5>
						<small class="desig text-uppercase">{{Auth::user()->roles->implode('name','-')}}</small>
					</div>
				</div>

				<!-- navigation -->
				<ul class="list-unstyled clearfix nav-list mb15">
					<li class="menu-dashboard">
						<a href="{{url('home')}}">
							<i class="ion ion-monitor"></i>
							<span class="text">Dashboard</span>
						</a>
					</li>

					<li class="menu-dashboard">
						<a href="{{url('admin/usuarios')}}">
							<i class="ion ion-person"></i>
							<span class="text">Usuarios</span>
						</a>
					</li>

					<li class="menu-dashboard">
						<a href="{{url('admin/reglas')}}">
							<i class="ion ion-ios-pricetag"></i>
							<span class="text">Reglas</span>
						</a>
					</li>

					<li class="menu-dashboard">
						<a href="{{url('admin/fechas')}}">
							<i class="ion ion-calendar"></i>
							<span class="text">Fechas</span>
						</a>
					</li>
	
					@if(Shinobi::can('usuarios.access'))
						<li class="menu-dashboard">
							<a href="{{url('admin/usuario')}}">
								<i class="ion ion-person"></i>
								<span class="text">Usuarios</span>
							</a>
						</li>
					@endif
					
					@if(Shinobi::can('company.access'))

						<li class="menu-quiz">
							<a href="{{url('company/quiz')}}">
								<i class="ion ion-clipboard"></i>
								<span class="text">Encuestas</span>
							</a>
						</li>

						<li class="menu-group">
							<a href="{{url('company/group')}}">
								<i class="ion ion-person-stalker"></i>
								<span class="text">Grupos de Envio</span>
							</a>
						</li>

						<li class="menu-user">
							<a href="{{url('company/user')}}">
								<i class="ion ion-person"></i>
								<span class="text">Usuarios</span>
							</a>
						</li>
					@endif

					@if(Shinobi::can('companies.access'))
						<li class="menu-companies">
							<a href="{{url('companies')}}">
								<i class="ion ion-ios-briefcase"></i>
								<span class="text">Empresas</span>
							</a>
						</li>
					@endif

					@if(Shinobi::can('nse.access'))
						<li class="menu-nse">
							<a href="javascript:;">
								<i class="ion ion-ios-pie-outline"></i>
								<span class="text">NSE</span>
								<i class="arrow ion-chevron-left"></i>
							</a>
							<ul class="inner-drop list-unstyled">
								<li><a href="{{url('nse/quiz')}}">Encuesta</a></li>
								<li><a href="{{url('nse/level')}}">Niveles</a></li>
							</ul>
						</li>

					@endif

                    @if(Shinobi::can('config.access'))
                    <li class="menu-config">
						<a href="javascript:;">
							<i class="ion ion-ios-settings-strong"></i>
							<span class="text">Configuración</span>
							<i class="arrow ion-chevron-left"></i>
						</a>
						<ul class="inner-drop list-unstyled">
							<li><a href="{{url('config/user')}}">Usuarios</a></li>
							<li><a href="{{url('config/plan')}}">Planes</a></li>
						</ul>
					</li>

					@endif

					@if(Shinobi::can('report.access'))
					<li class="menu-report">
						<a href="javascript:;">
							<i class="ion ion-stats-bars"></i>
							<span class="text">Reportes</span>
							<i class="arrow ion-chevron-left"></i>
						</a>
						<ul class="inner-drop list-unstyled">
							<li><a href="{{url('report/users')}}">Personas</a></li>
							<li><a href="{{url('report/quizzes')}}">Encuestas respondidas</a></li>
						</ul>


					</li>
					@endif



				</ul> <!-- #end navigation -->
			</nav>

			<!-- nav-foot -->
			<footer class="nav-foot">
				<p>{{date('Y')}} &copy; <span>Expopack</span></p>
			</footer>

		</aside>
		<!-- #end main-navigation -->

		<!-- content-here -->
		<div class="content-container" id="content">
            <div class="page page-ui-tabs">
                @if(Session::has('success'))
                    <div class="alert alert-success flash">{{ Session::get('success') }}</div>
                @endif

                @if(Session::has('error'))

                    <div class="alert alert-danger">
                    	<button type="button" class="close" data-dismiss="alert">
                    		<span aria-hidden="true">×</span>
                    	</button>
                    	<div>{{ Session::get('error') }}</div>
                    </div>
                @endif

                @yield('content')
            </div>
		</div> <!-- #end content-container -->

	</div> <!-- #end main-container -->


	<!-- theme settings -->
	<div class="site-settings clearfix hidden-xs" style="display: none !important;">
		<div class="settings clearfix">
			<div class="trigger ion ion-settings left"></div>
			<div class="wrapper left">
				<ul class="list-unstyled other-settings">
					<li class="clearfix mb10">
						<div class="left small">Nav Horizontal</div>
						<div class="md-switch right">
							<label>
								<input type="checkbox" id="navHorizontal">
								<span>&nbsp;</span>
							</label>
						</div>


					</li>
					<li class="clearfix mb10">
						<div class="left small">Fixed Header</div>
						<div class="md-switch right">
							<label>
								<input type="checkbox"  id="fixedHeader">
								<span>&nbsp;</span>
							</label>
						</div>
					</li>
					<li class="clearfix mb10">
						<div class="left small">Nav Full</div>
						<div class="md-switch right">
							<label>
								<input type="checkbox"  id="navFull">
								<span>&nbsp;</span>
							</label>
						</div>
					</li>
				</ul>
				<hr/>
				<ul class="themes list-unstyled" id="themeColor">
					<li data-theme="theme-zero" class="active"></li>
					<li data-theme="theme-one"></li>
					<li data-theme="theme-two"></li>
					<li data-theme="theme-three"></li>
					<li data-theme="theme-four"></li>
					<li data-theme="theme-five"></li>
					<li data-theme="theme-six"></li>
					<li data-theme="theme-seven"></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- #end theme settings -->




	<!-- Dev only -->
	<!-- Vendors -->


	<script src="{{asset('/js/all.js')}}"></script>

	@yield('script')

    <!-- PREVENT ENTER KEY ON FORMS -->
    <script>
    $(document).on('keyup keypress', 'form input', function(e) {
      if(e.which == 13) {
        e.preventDefault();
        return false;
      }
    });



    </script>
</body>
</html>