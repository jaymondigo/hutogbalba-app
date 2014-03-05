@extends('base')
	@section('html_attr') class="bg-black" @stop

@section('head')
	<meta charset="UTF-8">
    <title>Dream Builder Solutions | Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="{{URL::to('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="{{URL::to('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{URL::to('css/AdminLTE.css')}}" rel="stylesheet" type="text/css" />
@stop

@section('body')
	@section('body_attr') class="bg-black" @stop
	<div class="form-box" id="login-box">
            <div class="header">Sign In</div>
            <form action="index.html" method="post">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email Address"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>          
                    <div class="form-group">
                        <input type="checkbox" name="remember_me"/> Remember me
                    </div>
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Dream On</button>  
                    <p><a href="#">I forgot my password</a></p>
                    <a href="register.php" class="text-center">I wanna be a Dreamer</a>
                </div>
            </form>
            <!-- <div class="margin text-center">
                <span>Sign in using social networks</span>
                <br/>
                <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>
            </div> -->
        </div>
@stop

@section('scripts')
	<!-- jQuery 2.0.2 -->
    <script src="{{URL::to('js/jquery-2.0.3.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{URL::to('js/bootstrap.js')}}" type="text/javascript"></script>   
@stop