@inject('funciones','App\Http\Controllers\FuncionesController')
<!DOCTYPE html>
<html lang="es" dir="ltr">
	<head>

		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="zendash - Admin Dashboard HTML Template" name="description">
		<meta content="Spruko Technologies Private Limited" name="author">
		<meta name="keywords" content="admin, bootstrap admin template, bootstrap dashboard, dashboard, panel, simple dashboard html template, dashboard template bootstrap 4, simple admin panel template, bootstrap 4 admin dashboard, html css dashboard template, themeforest admin template, premium bootstrap template, admin panel html template, admin template design, dark admin template, admin dashboard ui, css admin template, cool admin template, nice admin template"/>

		<!-- CSRF Token -->
    	<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- Title -->
		<title> Canjes - Jumpin </title>

		<!--Favicon -->
		<link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon"/>

		<!-- Bootstrap css -->
		<link href="{{ asset('zendash/assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet" />

		<!-- Style css -->
		<link href="{{ asset('zendash/assets/css/style.css') }}" rel="stylesheet" />

		<!-- Dark css -->
		<link href="{{ asset('zendash/assets/css/dark.css') }}" rel="stylesheet" />

		<!-- Skins css -->
		<link href="{{ asset('zendash/assets/css/skins.css') }}" rel="stylesheet" />

		<!-- Animate css -->
		<link href="{{ asset('zendash/assets/css/animated.css') }}" rel="stylesheet" />

		<!--Sidemenu css -->
        <link href="{{ asset('zendash/assets/css/sidemenu.css') }}" rel="stylesheet">

		<!-- P-scroll bar css-->
		<link href="{{ asset('zendash/assets/plugins/p-scrollbar/p-scrollbar.css') }}" rel="stylesheet" />

		<!---Icons css-->
		<link href="{{ asset('zendash/assets/css/icons.css') }}" rel="stylesheet" />

		<!-- INTERNAl Select2 css -->
		<link href="{{ asset('zendash/assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />

		<!-- INTERNAL Date Picker css -->
		<link href="{{ asset('zendash/assets/plugins/date-picker/date-picker.css') }}" rel="stylesheet" />

		<!-- INTERNAL Morris Charts css -->
		<link href="{{ asset('zendash/assets/plugins/morris/morris.css') }}" rel="stylesheet" />

		<!-- INTERNAL Data table css -->
		<link href="{{ asset('zendash/assets/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">


		<!-- Jquery js-->
		<script src="{{ asset('zendash/assets/js/jquery-3.5.1.min.js') }}"></script>

		<script type="text/javascript">
			function solo_nums(e){
          		var key = window.Event ? e.which : e.keyCode
         		 return (key >= 48 && key <= 57)
      		}
		</script>
	</head>


	<body class="app sidebar-mini">

		<!---Global-loader-->
		<div id="global-loader" >
			<img src="{{ asset('zendash/assets/images/svgs/loader.svg') }}" alt="loader">
		</div>
		<!---/Global-loader-->

		<!-- Page -->
		<div class="page">
			<div class="page-main">

				<!--aside open-->
				<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
				<aside class="app-sidebar">
					<div class="app-sidebar__logo">
						<a class="header-brand" href="{{ route('home') }}">
							APP 
						</a>
					</div>
					<div class="app-sidebar3">
						<div class="app-sidebar__user">
							<div class="dropdown user-pro-body text-center">
								<div class="user-pic">
									<img src="{{ asset('images/logouncp.png') }}" alt="user-img" class="avatar-lg rounded-circle mb-1">
								</div>
								<div class="user-info">
									<h5 class=" mb-0 font-weight-normal">{{ Auth::user()->nombre_usuario }}</h5>
									<span class="text-muted app-sidebar__user-name text-sm">
										{{ $funciones->Cargo_Usuario(Auth::user()->id_cargo) }}
									</span>
								</div>
							</div>
						</div>
						<ul class="side-menu">
							<li class="slide">
								<a class="side-menu__item"   href="{{ route('home') }}">
									<span class="shape1"></span>
									<span class="shape2"></span>
									<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
									<span class="side-menu__label">Inicio</span>
								</a>
							</li>

							@if(Auth::user()->id_cargo==1)
							<li class="slide">
								<a class="side-menu__item"   href="{{ route('listar.usuarios') }}">
									<span class="shape1"></span>
									<span class="shape2"></span>
									<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
									<span class="side-menu__label">Responsables</span>
								</a>
							</li>



							<li class="slide">
								<a class="side-menu__item"   href="{{ route('listar.estaciones') }}">
									<span class="shape1"></span>
									<span class="shape2"></span>
									<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
									<span class="side-menu__label">Sucursales</span>
								</a>
							</li>


							<li class="slide">
								<a class="side-menu__item"   href="{{ route('listapersonas') }}">
									<span class="shape1"></span>
									<span class="shape2"></span>
									<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
									<span class="side-menu__label">Empleados</span>
								</a>
							</li>

							@endif

						<li class="slide">
								<a class="side-menu__item"   href="{{ route('listar.actividades') }}">
									<span class="shape1"></span>
									<span class="shape2"></span>
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="side-menu__icon"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line></svg>
									<span class="side-menu__label">Actividades</span>
								</a>
							</li>

							
							<li class="slide">
								<a class="side-menu__item"   href="{{ route('listar.puntos') }}">
									<span class="shape1"></span>
									<span class="shape2"></span>
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="side-menu__icon"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
									<span class="side-menu__label">
									@if(Auth::user()->id_cargo==1)
									Registrar Puntos
									@else
									Mis Puntos
									@endif
								</span>
								</a>
							</li>



							<li class="slide">
								<a class="side-menu__item"   href="{{ route('listar.regalos') }}">
									<span class="shape1"></span>
									<span class="shape2"></span>
									<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
									<span class="side-menu__label">Cupones</span>
								</a>
							</li>

							<li class="slide">
								<a class="side-menu__item"   href="{{ route('listar.canjes') }}">
									<span class="shape1"></span>
									<span class="shape2"></span>
									<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
									<span class="side-menu__label">
									@if(Auth::user()->id_cargo==1)
									Canjes
									@else
									Mis Canjes
									@endif

									</span>
								</a>
							</li>

						</ul>
					</div>
				</aside>
				<!--aside closed-->

				<div class="app-content">
					<div class="side-app">

						<!--app header-->
						<div class="app-header header">
							<div class="container-fluid">
								<div class="d-flex">
									<a class="header-brand" href="{{ route('home') }}" style="color: #29327f;">
										Acumula y canjea
									</a>
									<div class="app-sidebar__toggle" data-toggle="sidebar">
										<a class="open-toggle" href="#">
											<svg class="header-icon mt-1" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M21 11.01L3 11v2h18zM3 16h12v2H3zM21 6H3v2.01L21 8z"></path></svg>
										</a>
									</div>
									<div class="mt-1">
										<form class="form-inline" style="display: none;">
											<div class="search-element">
												<input type="search" class="form-control header-search" placeholder="Buscar…" aria-label="Search" tabindex="1">
												<button class="btn btn-primary-color" type="submit">
													<svg class="header-icon search-icon" x="1008" y="1248" viewBox="0 0 24 24"  height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
														<path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
													</svg>
												</button>
											</div>
										</form>
									</div><!-- SEARCH -->
									<div class="d-flex order-lg-2 ml-auto">
									
										<div class="dropdown header-message" style="display: none;">
											<a class="nav-link icon p-0" data-toggle="dropdown">
												<svg class="header-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3"/><path d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z"/></svg>
												<span class="badge badge-success">8</span>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow  animated p-0">
												<div class="message-menu">
													<a class="dropdown-item d-flex pb-3 border-bottom" href="#">
														<span class="avatar avatar-md brround mr-3 align-self-center cover-image" data-image-src="{{ asset('zendash/assets/images/users/1.jpg') }}"></span>
														<div>
															<strong>Madeleine</strong> Hey! there I' am available....
															<div class="small text-muted">
																3 hours ago
															</div>
														</div>
													</a>
													<a class="dropdown-item d-flex pb-3 border-bottom" href="#">
														<span class="avatar avatar-md brround mr-3 align-self-center cover-image" data-image-src="{{ asset('zendash/assets/images/users/12.jpg') }}"></span>
														<div>
															<strong>Anthony</strong> New product Launching...
															<div class="small text-muted">
																5 hour ago
															</div>
														</div>
													</a>
													<a class="dropdown-item d-flex pb-3 border-bottom" href="#">
														<span class="avatar avatar-md brround mr-3 align-self-center cover-image" data-image-src="{{ asset('zendash/assets/images/users/4.jpg') }}"></span>
														<div>
															<strong>Olivia</strong> New Schedule Realease......
															<div class="small text-muted">
																45 mintues ago
															</div>
														</div>
													</a>
													<a class="dropdown-item d-flex pb-3 border-bottom" href="#">
														<span class="avatar avatar-md brround mr-3 align-self-center cover-image" data-image-src="{{ asset('zendash/assets/images/users/15.jpg') }}"></span>
														<div>
															<strong>Sanderson</strong> New Schedule Realease......
															<div class="small text-muted">
																2 days ago
															</div>
														</div>
													</a>
												</div>
												<a href="#" class="dropdown-item text-center">See all Messages</a>
											</div>
										</div>
										<div class="dropdown   header-fullscreen" >
											<a  class="nav-link icon full-screen-link p-0"  id="fullscreen-button">
												<svg class="header-icon" x="1008" y="1248" viewBox="0 0 24 24"  height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false"><path d="M7,14 L5,14 L5,19 L10,19 L10,17 L7,17 L7,14 Z M5,10 L7,10 L7,7 L10,7 L10,5 L5,5 L5,10 Z M17,17 L14,17 L14,19 L19,19 L19,14 L17,14 L17,17 Z M14,5 L14,7 L17,7 L17,10 L19,10 L19,5 L14,5 Z"></path></svg>
											</a>
										</div>
										<div class="dropdown profile-dropdown">
											<a href="#" class="nav-link pr-0 pl-2 leading-none" data-toggle="dropdown">
												<span>
													<img src="{{ asset('images/logouncp.png') }}" alt="img" class="avatar avatar-md brround">
												</span>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated p-0">
												<div class="text-center border-bottom pb-4 pt-4">
													<a href="#" class="text-center user pb-0 font-weight-bold">
														{{ Auth::user()->nombre_usuario }}
													</a>
													<p class="text-center user-semi-title mb-0">
														{{ $funciones->Cargo_Usuario(Auth::user()->id_cargo) }}
													</p>
												</div>
												<!-- 

												<a class="dropdown-item border-bottom" href="#">
													<i class="dropdown-icon  mdi mdi-settings"></i> Cambiar clave
												</a>
												 -->


												<a class="dropdown-item border-bottom" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
													<i class="dropdown-icon mdi  mdi-logout-variant"></i> Salir
												</a>
			                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
			                                        @csrf
			                                    </form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--/app header-->

						<h4 class="page-title">@yield('titulo','')</h4>
						<hr class="m-1">

						<!-- Contenido Dinámico -->
						@yield('contenido')
						<!-- Contenido Dinámico -->

					</div>
				</div><!-- end app-content-->
			</div>

			<!--Footer-->
			<footer class="footer">
				<div class="container">
					<div class="row align-items-center flex-row-reverse">
						<div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
							<!--Copyright © {{ date('Y') }} <a href="www.jumpin.com.mx" target="_blank"> - Jump World </a>.--><!--   Desarrollado por Daniel Alcalá. Todos los derechos reservados.-->
						</div>
					</div>
				</div>
			</footer>
			<!-- End Footer-->

		</div>

		<!-- Back to top -->
		<a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>



		<!-- Bootstrap4 js-->
		<script src="{{ asset('zendash/assets/plugins/bootstrap/popper.min.js') }}"></script>
		<script src="{{ asset('zendash/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

		<!--Othercharts js-->
		<script src="{{ asset('zendash/assets/plugins/othercharts/jquery.sparkline.min.js') }}"></script>

		<!-- Circle-progress js-->
		<script src="{{ asset('zendash/assets/js/circle-progress.min.js') }}"></script>

		<!-- Jquery-rating js-->
		<script src="{{ asset('zendash/assets/plugins/rating/jquery.rating-stars.js') }}"></script>

		<!--Sidemenu js-->
		<script src="{{ asset('zendash/assets/plugins/sidemenu/sidemenu.js') }}"></script>

		<!-- P-scroll js-->
		<script src="{{ asset('zendash/assets/plugins/p-scrollbar/p-scrollbar.js') }}"></script>
		<script src="{{ asset('zendash/assets/plugins/p-scrollbar/p-scroll1.js') }}"></script>


		<!--INTERNAL Select2 js -->
		<script src="{{ asset('zendash/assets/plugins/select2/select2.full.min.js') }}"></script>
		<script src="{{ asset('zendash/assets/js/select2.js') }}"></script>

		<!-- Timepicker js -->
		<script src="{{ asset('zendash/assets/plugins/time-picker/jquery.timepicker.js') }}"></script>
		<script src="{{ asset('zendash/assets/plugins/time-picker/toggles.min.js')}}"></script>

		<!-- Datepicker js -->
		<script src="{{ asset('zendash/assets/plugins/date-picker/date-picker.js') }}"></script>
		<script src="{{ asset('zendash/assets/plugins/date-picker/jquery-ui.js') }}"></script>
		<script src="{{ asset('zendash/assets/plugins/input-mask/jquery.maskedinput.js') }}"></script>

		<!-- INTERNAL ECharts js -->
		<script src="{{ asset('zendash/assets/plugins/echarts/echarts.js') }}"></script>

		<!-- Peitychart js-->
		<script src="{{ asset('zendash/assets/plugins/peitychart/jquery.peity.min.js') }}"></script>
		<script src="{{ asset('zendash/assets/plugins/peitychart/peitychart.init.js') }}"></script>

		<!--INTERNAL  Apexchart js-->
		<script src="{{ asset('zendash/assets/js/apexcharts.js') }}"></script>

		<!--Moment js-->
		<script src="{{ asset('zendash/assets/plugins/moment/moment.js') }}"></script>

		<!-- INTERNAL Data tables js-->
		<script src="{{ asset('zendash/assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
		<script src="{{ asset('zendash/assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
		<script src="{{ asset('zendash/assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
		<script src="{{ asset('zendash/assets/plugins/datatable/responsive.bootstrap4.min.js') }}"></script>


		<!--INTERNAL Morris Charts js -->
		<script src="{{ asset('zendash/assets/plugins/morris/raphael-min.js') }}"></script>
		<script src="{{ asset('zendash/assets/plugins/morris/morris.js') }}"></script>

		<!--INTERNAL Chart js -->
		<script src="{{ asset('zendash/assets/plugins/chart/chart.bundle.js') }}"></script>
		<script src="{{ asset('zendash/assets/plugins/chart/custom-chart.js') }}"></script>

		<!-- INTERNAL Index js-->
		<script src="{{ asset('zendash/assets/js/index1-dark.js') }}"></script>


		<!-- Form Advanced Element -->
		<script src="{{ asset('zendash/assets/js/formelementadvnced.js') }}"></script>
		<script src="{{ asset('zendash/assets/js/form-elements.js') }}"></script>

		
		<!-- Loader js-->
		<script src="{{ asset('zendash/assets/js/loader.js') }}"></script>

		<!-- Custom js-->
		<script src="{{ asset('zendash/assets/js/custom.js') }}"></script>


	</body>
</html>