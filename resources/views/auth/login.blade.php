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
        <title>Canjes - Jumpin </title>

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

        <!---Icons css-->
        <link href="{{ asset('zendash/assets/css/icons.css') }}" rel="stylesheet" />

    </head>

    <body class="h-100vh page-style1">

        <div class="page">
            <div class="page-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 d-block mx-auto">
                            <div class="row">
                                <div class="col-md-5 p-md-0">
                                    <div class="card br-0 mb-0">
                                        <div class="card-body page-single-content">
                                            <div class="w-100">

                                                    <div style="display: flex;justify-content: center;">
                                                        <img src="{{ asset('images/logo.png') }}"  alt="logo" width="50%">
                                                    </div>
                                                    

                                                <div class="">
                                                    <h2>Inicio de sesión</h2>
                                                </div>
                                                <form method="POST" action="{{ route('login') }}">
                                                    @csrf
                                                
                                                <div class="input-group mb-4">
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Usuario">

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="input-group mb-4">
                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-right mt-1" style="display: none;">
                                                        <a href="{{ route('password.request') }}" class="text-muted">Olvidaste contraseña</a>
                                                    </div>
                                                    <div class="col-12 mt-5">
                                                        <button type="submit" class="btn btn-lg btn-primary btn-block">Ingresar</button>
                                                    </div>
                                                </div>
                                                </form>
                                                <div class="text-center mt-7">
                                                    <div class="font-weight-normal fs-16 text-muted"> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7 p-0">
                                    <div class="card text-white custom-content page-content mt-0">
                                        <div class="card-body text-center justify-content-center">
                                            <br><br>
                                                <img src="{{ asset('images/logotc.png') }}" width="50%">
                                                <br><br>
                                                <h4 class="text-white-100">
                                                    ¡Recompensamos tu esfuerzo!
                                                </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <!-- Jquery js-->
        <script src="{{ asset('zendash/assets/js/jquery-3.5.1.min.js') }}"></script>

        <!-- Bootstrap4 js-->
        <script src="{{ asset('zendash/assets/plugins/bootstrap/popper.min.js') }}"></script>
        <script src="{{ asset('zendash/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

        <!--Othercharts js-->
        <script src="{{ asset('zendash/assets/plugins/othercharts/jquery.sparkline.min.js') }}"></script>

        <!-- Circle-progress js-->
        <script src="{{ asset('zendash/assets/js/circle-progress.min.js') }}"></script>

        <!-- Jquery-rating js-->
        <script src="{{ asset('zendash/assets/plugins/rating/jquery.rating-stars.js') }}"></script>

    </body>
</html>
