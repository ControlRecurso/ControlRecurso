<!DOCTYPE html>
<html lang="es">
<head>



    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/cssLogin/util.css">
    <link rel="stylesheet" type="text/css" href="css/cssLogin/main.css">

    <!--===============================================================================================-->
    <link href="{{asset("/vendor/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="{{asset("/vendor/fontawesome-free/css/all.min.css")}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <title>
        Login
    </title>
</head>
<body id="page-top">


<div class="limiter">
    <div class="container-login100" style="background-image: url('images/HATSA.png');">
        <div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
                    <strong style="color: #f8f9fb;font-size: 90%">Control de Inventario Area IT </strong>
				</span>

            <form class="login100-form validate-form p-b-33 p-t-5" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                @if($errors->any())
                    <div class="alert alert-warning alert-dismissible fade show " role="alert">

                        @foreach ($errors->all() as $error)
                            <span class="fa fa-exclamation-triangle"></span> {{ $error }}
                        @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <label class="pl-4 mt-lg-1" style="color: #ffffff; font-size: 17px">
                    <strong>Correo Electrónico</strong>
                </label>
                <div class="wrap-input100 validate-input" data-validate="Enter username">
                    <input class="input100" type="text" name="email" placeholder="Ingrese su correo"  >
                    <span class="focus-input100" data-placeholder="&#x2709;"></span>
                </div>

                <label class="pl-4 mt-lg-1" style="color: #ffffff; font-size: 17px">
                    <strong>Contraseña</strong>
                </label>
                <div class="wrap-input100 validate-input" data-validate="Enter password">

                    <div class="input-group-append">
                        <input id ="txtPassword" class="input100" type="password" name="password" placeholder="Ingrese su clave"
                               required>
                    </div>

                </div>


                <div class="form-group row">
                    <div class="col-md-8 offset-md-1">
                        <div class="checkbox">
                            <strong>
                                <label style="color: #ffffff">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Recordar Contraseña') }}
                                </label>
                            </strong>
                        </div>
                    </div>
                </div>
                <div class="container-login100-form-btn m-t-32">
                    <button class="login100-form-btn">
                        Iniciar Sesión
                    </button>
                </div>

                <div class="form-group">
                    <center><a class="btn btn-link" style="align-items: center" href="{{ route('password.request') }}">
                            ¿Olvidaste tu contraseña?
                        </a></center>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function mostrarContrasena(){
        var cambio = document.getElementById("txtPassword");
        if(cambio.type == "password"){
            cambio.type = "text";
            $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        }else{
            cambio.type = "password";
            $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        }
    }


</script>



<div id="dropDownSelect1"></div>

<!--===============================================================================================-->

<script src="vendor/jquery/jquery.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/daterangepicker/moment.min.js"></script>
<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="js/jsLogin/main.js"></script>

</body>
</html>
