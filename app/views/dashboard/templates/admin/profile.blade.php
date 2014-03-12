@extends('dashboard.index')
@section('other_css')
    <link href="{{URL::to('css/profile.css')}}" rel="stylesheet" type="text/css" />
@stop
@section('main_content')
    <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar --> 
            @include('partials.sidebar')

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        My Profile
                        <small>Edit Settings</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Profile</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    @if(Session::has('avatar_errors')&&count(Session::get('avatar_errors'))>0)
                        <div id="error-avatar" class="alert alert-danger alert-dismissable" style="padding-left:10px; margin-left:0px;">
                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <a href="#" class="alert-link">
                          Error uploading avatar. Please try again.
                          </a>
                        </div>
                    @elseif(Session::has('avatar_errors'))
                        <div id="success-avatar" class="alert alert-success alert-dismissable" style="padding-left:10px; margin-left:0px;">
                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <a href="#" class="alert-link">
                          Avatar Successfully changed.
                          </a>
                        </div>
                    @endif

                    @if(Session::has('password-success'))
                    <div id="success-password" class="alert alert-success alert-dismissable" style="padding-left:10px; margin-left:0px;">
                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <a href="#" class="alert-link">
                      Password successfully changed
                      </a>
                    </div>
                    @endif
                    <div class="profile-user-info profile-user-info-striped">
                    <div >
                        <form action="{{URL::to('user/upload-avatar')}}" name="avatar-form" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="{{$myAccount->id}}"/>
                        <input type="file" name="avatar" style="display:none;">
                        </form>
                        <span class="profile-picture" >
                            <img id="avatar" title="Change Avatar" class="editable img-responsive editable-click editable-empty" alt="Alex's Avatar" src="{{URL::to($myAccount->avatar->url('medium'))}}" style="cursor:pointer;" /> 
                        </span>

                        <div class="space-4"></div> 
                    </div>
                    <input type="hidden" value="{{$myAccount->id}}" name="id">
                    <div class="profile-info-row">
                        <div class="profile-info-name"> Username </div>

                        <div class="profile-info-value">
                            <span class="" id="username" style="display: inline;">{{$myAccount->username}}</span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Email </div>

                        <div class="profile-info-value">
                            <i class="icon-map-marker light-orange bigger-110"></i>
                            <span class="editable editable-click" id="email" style="display: inline;">{{$myAccount->email}}</span> 
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Firstname </div>

                        <div class="profile-info-value">
                            <span class="editable editable-click" id="firstname" style="display: inline;">{{$myAccount->firstname}}</span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Lastname </div>

                        <div class="profile-info-value">
                            <span class="editable editable-click" id="lastname" style="display: inline;">{{$myAccount->lastname}}</span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Gender </div>

                        <div class="profile-info-value">
                            <span id="gender" style="display: inline;">{{$myAccount->gender}}</span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Joined </div>

                        <div class="profile-info-value">
                            <span id="date_joined" style="display: inline;">{{date('F Y', strtotime($myAccount->created_at))}}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> Password </div>

                        <div class="profile-info-value">
                            <a href="#change-pass-dialog" data-toggle="modal"  id="change-pass" >Change</a>
                        </div>
                    </div>
                </div>
                <br/>
                <button id="saveChanges" disabled class="btn btn-success" style="margin-left:10px;">Save Changes</button>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <div class="modal fade" id="change-pass-dialog" tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Change password</h4>
                    </div>
                    <div class="modal-body">   
                        @if(Session::has('password-error')&&!empty(Session::get('password-error')))
                        <div id="error-password" class="alert alert-danger alert-dismissable" style="padding-left:10px; margin-left:0px;">
                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <a href="#" class="alert-link">@if(is_array(Session::get('password-error')))
                          @foreach (Session::get('password-error') as $error)
                            {{$error}}<br/>
                          @endforeach

                          @else
                            {{Session::get('password-error')}}
                          @endif
                          </a>
                        </div>
                        @endif

                        <form action="{{URL::to('user/update-password')}}" method="post">
                        {{Form::token()}}
                        <label for="old_password">Old password</label>
                        <input type="password" name="old_password" class="form-control">
                        <hr>
                        <label for="new_password">password</label>
                        <input type="password" name="password" class="form-control">
                        <label for="confirm_password">Confirm password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                        <div id="password-alert" class="alert alert-danger alert-dismissable" style="padding-left:10px; margin-left:0px;display:none;">
                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <a href="#" class="alert-link">Password confirmation did not match</a>
                        </div>
                        <br/>
                        <input type="submit" disabled id="submit-change-pass" class="btn btn-success">

                        </form>
                    </div>
                    
              </div>
            </div>
        </div>
 @stop

@section('other_scripts') 
    <script src="{{URL::to('js/profile.js')}}" type="text/javascript" charset="utf-8" async defer></script>
@stop