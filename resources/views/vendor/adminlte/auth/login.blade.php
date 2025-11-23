@extends('adminlte::layouts.auth')

@section('htmlheader_title')
    Log in
@endsection

@section('content')
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> </title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <style>
            @font-face {
    font-family: myFirstFont;
    src: url("../../fonts/OLD.ttf");
}
            img {
                display: block;
                max-width:20px;
                max-height:95px;
                width: auto;
                height: auto;
            }
            .header{background-color: #fff;
                    padding: 10px;
            }
            .schoolname{
                font-family:"Times New Roman";
                font-size: 25pt; 
                color:#003147
            }
            .schoolname2{
                font-family:"Times New Roman";
                font-size: 25pt;  
                color:#003147
            }
            .footer {
                position:absolute;
                bottom:0;
                width:100%;
                height:30px;   /* Height of the footer */
                background:#fff;
                padding-top: 5px;
            }    
            .sis{
                text-align: right;

            }

            .sis #sisname{
                font-weight: bold; 
            }

            body{background-color:#ff3300;}
        </style>
    </head>
    <body class="hold-transition login-page" style="background-image: url('images/login-cover.jpg')">
        <div class="container-fluid header">    
            <div class="col-md-1 pull-left"><img class="image img-responsive logo" src="{{ asset('logo/logo.png') }}"></div>
            <div class="col-md-8"><span class="schoolname">Pangasinan State University</span>
                <br>
                <p><b>Domanpot, Asingan, Pangasinan 2439</b></p>
            </div>
            <div class="col-md-3 sis"><span id="sisname">Laboratory Scheduling System</span></div>
        </div>
        <div class="login-box">
 
    <div id="app">
        <div class="login-box">
            <div class="login-logo">
                <a style="color:white;" href="{{ url('/home') }}"><i class="fa fa-safari"></i> <b>LOG IN</b></a>
            </div><!-- /.login-logo -->

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Something went wrong.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="login-box-body">
        <p class="login-box-msg"></p>
        <form action="{{ url('/login') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Username" name="username"/>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="password"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember">Remember Me
                        </label>
                    </div>
                </div><!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                </div><!-- /.col -->
            </div>
        </form>

        @include('adminlte::auth.partials.social_login')

      <a href="{{ url('/password/reset') }}">Forgot Password?</a><br>
       <!--<a href="{{ url('/register') }}" class="text-center">{{ trans('adminlte_lang::message.registermember') }}</a>-->

    </div><!-- /.login-box-body -->

    </div><!-- /.login-box -->
    </div>
    @include('adminlte::layouts.partials.scripts_auth')
        </div>
    
    
            <div class="container-fluid footer">

            <!-- To the right -->
            <div class="pull-right hidden-xs">
                
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy;<a href="https://asingan.psu.edu.ph/"><span id="year"></span> Pangasinan State University - Asingan Campus</a></strong></a>
        </div>  
    <script>
        document.getElementById("year").textContent = new Date().getFullYear();
        $(function () {
            $('input').iCheck({ 
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

@endsection

