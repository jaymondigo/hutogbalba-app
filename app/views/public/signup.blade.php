@extends('base')
	@section('html_attr') class="bg-black" @stop

@section('head')
	<meta charset="UTF-8">
    <title>Dream Builder Solutions | Log in</title>
    <link id="page_favicon" href="{{URL::to('img/logo.png')}}" rel="icon" type="image/x-icon">
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
            @if ( Session::get('error') )
                <div class="alert alert-error alert-danger" style="margin-left:0px;">
                    @if ( is_array(Session::get('error')) )
                        {{ head(Session::get('error')) }}
                    @endif
                </div>
            @endif

            @if ( Session::get('notice') )
                <div class="alert" style="margin-left:0px;">{{ Session::get('notice') }}</div>
            @endif
            <div class="header">Be a Dreamer</div>
            <form method="POST" action="{{{ (Confide::checkAction('UserController@store')) ?: URL::to('user')  }}}" accept-charset="UTF-8">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="firstname" class="form-control" placeholder="Firstname"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="lastname" class="form-control" placeholder="Lastname"/>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" class="form-control">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
                    </div>
                    <div class="form-group">
                         <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password">
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password_confirmation') }}}" type="password" name="password_confirmation" id="password_confirmation">
                    </div>
                </div>
                <div class="footer">                    

                    <button type="submit" class="btn bg-olive btn-block">Start Dreaming</button>

                    <a href="{{{ (Confide::checkAction('UserController@login')) ?: 'login' }}}" class="text-center">I am already a Dreamer</a>
                </div>
            </form>
            <!-- <div class="margin text-center">
                <span>Register using social networks</span>
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