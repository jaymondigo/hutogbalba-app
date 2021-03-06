@extends('dashboard.index')
<style type="text/css">
    a[disabled]{
        color: #C09F9F !important;
    }
    a[disabled]:hover{        
        background: none !important;        
        cursor: not-allowed !important;
    }
    .popover{
        width:250px;
    }
</style>
@section('main_content')
            <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            @include('partials.sidebar')

            <!-- Right side column. Contains the navbar and content of the page -->
             <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 house-title>
                        Dreamer
                        <small>Sketcher</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dreams</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    @if(Session::has('success'))
                        <div>
                        <div class="alert alert-success alert-dismissable" style="padding-left:10px; margin-left:0px;">
                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <a href="#" class="alert-link" notification-content>
                          {{Session::get('message')}}
                          </a>
                        </div>
                        </div>
                    @endif
                    <div class="notification" style="display:none;">
                        <div id="alert-con" class="alert alert-success alert-dismissable" style="padding-left:10px; margin-left:0px;">
                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <a href="#" class="alert-link" notification-content>
                          Alert!
                          </a>
                        </div>
                    </div>
                    <div class="navbar navbar-default navbar-static-top">
                        <div class="container">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            </div>
                            <div class="navbar-collapse collapse">
                                <ul class="nav navbar-nav">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">File <b class="caret"></b></a>
                                        <ul class="dropdown-menu" file-menu>
                                            <li><a href="#" id="new">New</a></li>
                                            <li><a href="#" id="save">Save</a></li>
                                            <li><a href="#" id="save-as" class="save-as" style="display:none">Save As New</a></li>
                                            <li><a href="#" id="rename" style="display:none">Rename</a></li>
                                            <li><a href="#" id="open">Open</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" action-tools class="dropdown-toggle" data-toggle="dropdown">Tools <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#new-room-dialog" data-toggle="modal" id="new-room">New Room</a></li>
                                            <li><a href="#new-door-dialog" data-toggle="modal" id="new-door">New Door</a></li>
                                            <li><a href="#new-window-dialog" data-toggle="modal" id="new-window">New Window</a></li>
                                            <li><a href="#new-wall-dialog" data-toggle="modal" id="new-wall">New Wall</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" action-view class="dropdown-toggle" data-toggle="dropdown">View <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0)" id="view-3d" house-id="">3D</a></li>
                                            <li><a href="javascript:void(0)" id="view-floorplan" house-id="">Floorplan</a></li>
                                            <li><a href="javascript:void(0)" tabindex="-1" view-estimate>Estimate</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Help <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a id="options" href="#options-dialog" data-toggle="modal" view-options>FAQ</a></li>
                                            <li><a href="#about-dialog" data-toggle="modal" id="about">About</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div style="background: #DFDFF8;">
                        <span id="debug"></span> 
                        <div class="zoom-in-out" style="font-size: 31px; 
                            font-weight: bold;
                            border: 1px solid #C7ACAC;
                            width: 24px;
                            text-align: center;
                            position: absolute;
                            border-radius: 6px;
                            z-index: 100;
                            margin: 10px;">
                            <a href="javascript:void(0)" zoom-in>+</a>
                            <a href="javascript:void(0)" zoom-orig>o</a>
                            <a href="javascript:void(0)" zoom-out>-</a>
                        </div>
                        <center id="sketchpad" style="zoom:100%;width:100%;height:87% !important;min-height:87% !important;overflow: hidden;cursor:pointer">
                        </center>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->

            <!-- Modals-->
                <div class="modal fade" id="new-room-dialog" tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="" id="new-room-form">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Enter Room Information</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12"> 
                                        <fieldset>
                                            <legend>Room Dimensions</legend>
                                            <img src="{{URL::to('img/dimensions.png')}}" />
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">     
                                        <fieldset>
                                            <div class="form-group">
                                                <legend>Room Size</legend>
                                                <label for="room-area">Area: </label>
                                                <section class="input-group">
                                                    <input value="4" name="room-area" type="text" class="form-control" disabled data-content="Please edit this" data-original-title="Room area here"/>
                                                    <span class="input-group-addon">m<sup>2</sup></span>
                                                </section>
                                            </div>
                                            <div class="form-group">
                                                <label for="room-length">a. Room Width: </label>
                                                <section class="input-group">
                                                    <input required min="2" value="2" name="room-length" type="text" class="form-control" data-content="The length of the room on the side labeled <b>a</b><br/><i>Please refer to the image at the left</i>" data-original-title="Length of the room"/>
                                                    <span class="input-group-addon" >m</span>
                                                </section>
                                            </div>
                                            <div class="form-group">
                                                <label for="room-width">b. Room Length: </label>
                                                <section class="input-group">
                                                    <input data-content="The wideness of the room on the side labeled <b>a</b><br/><i>Please refer to the image at the left</i>" data-original-title="Width of the room" required min="2" value="2" name="room-width" type="text" class="form-control" />
                                                    <span class="input-group-addon">m</span>
                                                </section>
                                            </div>
                                            <div class="form-group">
                                                <label for="room-name">Room Label: </label>
                                                <input data-content="Descriptive label of the room" data-original-title="Room label" type="text" name="room-name" class="form-control" />
                                            </div>
                                            <fieldset>
                                                <legend>Door</legend>
                                                <div class="form-group">
                                                    <label for="wall">Where: </label>
                                                    <select name="room-door-where" class="form-control" data-content="Select where to put the door" data-original-title="Door Placement">
                                                        <option value="left">a. Left</option>
                                                        <option value="top">b. Top</option>
                                                        <option value="right">c. Right</option>
                                                        <option value="bottom">d. Bottom</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="wall">Available Doors: </label>
                                                    <ul class="list-unstyled">
                                                        <li><label><input type="radio" checked name="room-door-dim" value="6.6x2.10" data-type="A" data-content="Please edit this" data-original-title="Available Doors"> 6'6" &times; 2'10"</label></li>
                                                        <li><label><input type="radio" name="room-door-dim" value="6.8x2.10" data-type="B"> 6'8" &times; 2'10"</label></li>
                                                        <li><label><input type="radio" name="room-door-dim" value="7.0x2.10" data-type="C"> 7'0" &times; 2'10"</label></li>
                                                        <li><label><input type="radio" name="room-door-dim" value="8.0x2.10" data-type="D"> 8'0" &times; 2'10"</label></li>
                                                    </ul>
                                                </div>
                                            </fieldset>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-flat btn-info" id="add-room" value="Add" />
                                <a class="btn btn-flat btn-danger cancel" href="#" data-dismiss="modal">Cancel</a>
                            </div>
                            </form>
                      </div>
                    </div>
                </div>
                <div class="modal fade" id="new-door-dialog" tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="" id="new-door-form">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Choose Door Dimension</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4">
                                        <img src="{{URL::to('img/walls.png')}}" />
                                    </div>
                                    <div class="col-lg-8 col-md-8">
                                        <div class="form-group">
                                            <label for="wall">Where: </label>
                                            <select name="door-where" class="form-control" data-content="Select where do you want to put the door<br/><i>Refer to the image at the left</i>" data-original-title="Door position">
                                                <option value="left">a. Left</option>
                                                <option value="top">b. Top</option>
                                                <option value="right">c. Right</option>
                                                <option value="bottom">d. Bottom</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="wall">Available Doors: </label>
                                            <ul class="list-unstyled">
                                                <li><label><input type="radio" checked name="door-dim" value="6.6x2.10" data-type="A" data-content="Please edit this" data-original-title="Available Doors"> 6'6" &times; 2'10"</label></li>
                                                <li><label><input type="radio" name="door-dim" value="6.8x2.10" data-type="B"> 6'8" &times; 2'10"</label></li>
                                                <li><label><input type="radio" name="door-dim" value="7.0x2.10" data-type="C"> 7'0" &times; 2'10"</label></li>
                                                <li><label><input type="radio" name="door-dim" value="8.0x2.10" data-type="D"> 8'0" &times; 2'10"</label></li>
                                            </ul>
                                        </div>
                                        <div class="form-group">
                                            <label for="wall" data-content="Select what type of the door to be added" data-original-title="Door type">Door Type: </label>
                                            <select name="door-num" class="form-control">
                                                <option value="1">Single</option>
                                                <option value="2">Double</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-flat btn-info" value="Add" />
                                <a href="#" class="btn btn-flat btn-danger cancel" data-dismiss="modal">Cancel</a>
                            </div>
                            </form>
                      </div>
                    </div>
                </div>
                <div class="modal fade" id="new-window-dialog" tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="" id="new-window-form">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Choose Window Dimension</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4">
                                        <img src="{{URL::to('img/walls.png')}}" />
                                    </div>
                                    <div class="col-lg-8 col-md-8">
                                        <div class="form-group">
                                            <label for="window">Where: </label>
                                            <select name="window-where" class="form-control" data-content="The side you want the window to be put<br/><i>Please refer to the image at the left</i>" data-original-title="Window placement">
                                                <option value="left">a. Left</option>
                                                <option value="top">b. Top</option>
                                                <option value="right">c. Right</option>
                                                <option value="bottom">d. Bottom</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="wall">Available Windows: </label>
                                            <ul class="list-unstyled">
                                                <li><label><input type="radio" checked name="window-dim" value="2.5x2.5" data-content="Please edit this" data-original-title="Available Windows"> 2'5" &times; 2'5"</label></li>
                                                <li><label><input type="radio" name="window-dim" value="3.5x3.5"> 3'5" &times; 3'5"</label></li>
                                                <li><label><input type="radio" name="window-dim" value="4.5x4.5"> 4'5" &times; 4'5"</label></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-flat btn-info" value="Add" />
                                <a href="#" class="btn btn-flat btn-danger cancel" data-dismiss="modal">Cancel</a>
                            </div>
                            </form>
                      </div>
                    </div>
                </div>
                <div class="modal fade" id="new-wall-dialog" tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="" id="new-wall-form">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Add Wall</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4">
                                        <img src="{{URL::to('img/walls.png')}}" />
                                    </div>
                                    <div class="col-lg-8 col-md-8">
                                        <div class="form-group">
                                            <label for="wall">Orientation: </label>
                                            <ul class="list-unstyled">
                                                <li><label><input type="radio" checked name="wall-orientation" value="vertical" data-content="Please edit this" data-original-title="Available Doors">Vertical</label></li>
                                                <li><label><input type="radio" name="wall-orientation" value="horizontal">Horizontal</label></li>
                                            </ul>
                                        </div>
                                        <div class="form-group">
                                            <label for="wall">Thickness: </label>
                                            <section class="input-group">
                                                <input required min="10" value="10" name="wall-thickness" type="text" class="form-control" />
                                                <span class="input-group-addon">cm</span>
                                            </section>
                                        </div>
                                        <div class="form-group">
                                            <label for="wall">Width: </label>
                                            <section class="input-group">
                                                <input required min="1" value="1" name="wall-width" type="text" class="form-control" />
                                                <span class="input-group-addon">m</span>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-flat btn-info" value="Add" />
                                <a href="#" class="btn btn-flat btn-danger cancel" data-dismiss="modal">Cancel</a>
                            </div>
                            </form>
                      </div>
                    </div>
                </div>
                <div class="modal fade" id="step1" tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Welcome To The Dream Builder Wizard</h4>
                            </div>
                            <div class="modal-body">
                                <p>How do you get started? Creating a house can be a long task. You need the basic shape, add a garage (if necessary), add additional floors, build a roof, and so much more.</p>
                                <p>A simple House Builder Wizard has been created to help you with these tasks. You will be lead through several easy steps to help give you the basic structure which can then be adjusted to suit your needs.</p>
                                <p>To get started, Click Next.</p>
                                <p>If you would like to design from scratch, simple click Cancel.</p>
                            </div>
                            <div class="modal-footer">
                                <a href="#" class="btn btn-flat btn-info disabled back">Back</a>
                                <button class="btn btn-flat btn-info next" data-dismiss="modal">Next</button>
                                <a href="#" class="btn btn-flat btn-danger cancel" data-dismiss="modal">Cancel</a>
                            </div>
                      </div>
                    </div>
                </div>
                <div class="modal fade" id="step2" tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="step2-form" action="">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Setup your Floors and Foundation</h4>
                            </div>
                            <div class="modal-body">
                                <fieldset>
                                    <legend>Floors</legend>
                                    <div class="row">
                                        <div class="col-lg-8 col-md-8">
                                            <label for="num-floors">Number of Floors: </label>
                                            <select name="num-floors" class="form-control" data-content="Number of floors available" data-original-title="Number of floors">
                                                <option value="1">1</option>
                                            </select><br />
                                            <label for="terrain">a. Ground floor Height above the terrain: </label>
                                            <section class="input-group">
                                                <input value="0.2" disabled name="terrain" type="text" class="form-control" data-content="Ground floor Height above the terrain" data-original-title="Floor height above the terrain"/>
                                                <span class="input-group-addon">m</span>
                                            </section><br />
                                            <label for="height">b. Floor to Ceiling Height: </label>
                                            <section class="input-group">
                                                <input required name="height" value="2.75" type="text" min="2.75" class="form-control" data-content="Measurement/ Height of the wall from the ground up to the ceiling" data-original-title="Floor to ceiling height"/>
                                                <span class="input-group-addon">m</span>
                                            </section>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <img src="{{URL::to('img/floors-foundation.png')}}" />
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="modal-footer">
                                <a href="#" class="btn btn-flat btn-info back" data-dismiss="modal">Back</a>
                                <input type="submit" class="btn btn-flat btn-info" value="Next" />
                                <a href="#" class="btn btn-flat btn-danger cancel" data-dismiss="modal">Cancel</a>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="step3" tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="step3-form">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Enter Building Dimensions</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12"> 
                                        <fieldset>
                                            <legend>Building Dimensions</legend>
                                            <img src="{{URL::to('img/dimensions.png')}}" />
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">     
                                        <fieldset>
                                            <legend>Building Size</legend>
                                            <label for="area">Area: </label>
                                            <section class="input-group">
                                                <input value="6.25" name="area" type="text" class="form-control" disabled data-content="Please edit this" data-original-title="Building size"/>
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                            </section><br />
                                            <label for="length">a. Length: </label>
                                            <section class="input-group">
                                                <input required name="length" min="2.5" value="2.5" type="text" class="form-control" data-content="Length of the house on the side labeled <b>a</b> <i>Please refer to the image at the left</i>" data-original-title="Building Length"/>
                                                <span class="input-group-addon">m</span>
                                            </section><br />
                                            <label for="width">b. Width: </label>
                                            <section class="input-group">
                                                <input required name="width" min="2.5" value="2.5" type="text" class="form-control" data-content="Wideness of the house on the side labeled <b>b</b> <i>Please refer to the image at the left</i>" data-original-title="Building width" />
                                                <span class="input-group-addon">m</span>
                                            </section>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="#" class="btn btn-flat btn-info back" data-dismiss="modal">Back</a>
                                <input type="submit" class="btn btn-flat btn-info" value="Next" />
                                <a href="#" class="btn btn-flat btn-danger cancel" data-dismiss="modal">Cancel</a>
                            </div>
                            </form>
                      </div>
                    </div>
                </div>
                <div class="modal fade" id="step4" tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
                 
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="step4-form">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Select Building Elements</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="roof-type">Roof</label>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3">
                                            <select class="form-control" name="roof-type" data-content="Hip is a pyramid-shaped roof" data-original-title="Type of the roof">
                                                <option value="hip">Hip</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <select class="form-control" name="roof-pitch" data-content="slope measurement of the roof" data-original-title="Hip type">
                                                <option value="4-12">4/12 Pitch Hip</option>
                                                <option value="8-12">8/12 Pitch Hip</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-5 col-md-5">
                                            <select class="form-control" name="roof-element" data-content=" 
                                            <figure style='float:left'>
                                              <img src='{{URL::to('img/roof/asphalt_shingles.png')}}' alt='Asphalt shingles' width='80'>
                                              <figcaption>Asphalt Shingle</figcaption>
                                            </figure>

                                            <figure style='float:right'>
                                              <img src='{{URL::to('img/roof/clay_tiles.png')}}' alt='Clay Tiles' width='80'>
                                              <figcaption>Clay Tiles</figcaption>
                                            </figure>

                                            <figure style='float:left'>
                                              <img src='{{URL::to('img/roof/wood_shakes.png')}}' alt='Wood shakes' width='80'>
                                              <figcaption>Wood shakes</figcaption>
                                            </figure>
                                            " data-original-title="Roof material types">
                                                <option value="asphalt_shingles">Asphalt Shingles</option>
                                                <option value="clay_tiles">Clay Tiles</option>
                                                <option value="wood_shakes">Wood Shakes</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="roof-type">Walls</label>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4">
                                            <select class="form-control" name="wall-dim" data-content="The thickness of the wall" data-original-title="Walls">
                                                <option value="10">10 cm</option>
                                                <option value="15">15 cm</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-8 col-md-8">
                                            <select class="form-control" name="wall-element" data-content=
                                            " 
                                            <figure style='float:left'>
                                              <img src='{{URL::to('img/wall/horizontal_sliding_wall.png')}}' alt='Horizontal Sliding wall' width='80'>
                                              <figcaption>Horizontal Sliding</figcaption>
                                            </figure>

                                            <figure style='float:right'>
                                              <img src='{{URL::to('img/wall/masonry_wall.png')}}' alt='Masonry Wall' width='80'>
                                              <figcaption>Masonry Wall</figcaption>
                                            </figure>

                                            <figure style='float:left'>
                                              <img src='{{URL::to('img/wall/plywood.png')}}' alt='Plywood Wall' width='80'>
                                              <figcaption>Plywood</figcaption>
                                            </figure>

                                            <figure style='float:right'>
                                              <img src='{{URL::to('img/wall/stone_wall.png')}}' alt='Stone Wall' width='80'>
                                              <figcaption>Stone Wall</figcaption>
                                            </figure>
                                            "
                                            data-original-title="Wall types">
                                                <option value="horizontal_sliding_wall">Horizontal Sliding Wall</option>
                                                <option value="masonry_wall">Masonry Wall</option>
                                                <option value="stone_wall">Stone Wall</option>
                                                <option value="plywood">Plywood</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="roof-type">Floors</label>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4">
                                            <select class="form-control" name="floor-type" data-content="Select floor type" data-original-title="Floors">
                                                <option value="ceramic_tile">Ceramic Tile</option>
                                                <option value="wood_flooring">Wood Flooring</option>
                                            </select>
                                        </div>
                                        <!-- <div class="col-lg-4 col-md-4">
                                            <select class="form-control" name="tile-dim">
                                                <option value="5.1x5.1">51 mm &times; 51 mm</option>
                                                <option value="10.2x10.2">102 mm &times; 102 mm</option>
                                                <option value="20.4x20.4">204 mm &times; 204 mm</option>
                                                <option value="25.4x25.4">254 mm &times; 254 mm</option>
                                                <option value="30.5x30.5">305 mm &times; 305 mm</option>
                                                <option value="33.1x33.1">331 mm &times; 331 mm</option>
                                                <option value="40.7x40.7">407 mm &times; 407 mm</option>
                                            </select>
                                        </div> -->
                                        <!-- <div class="col-lg-4 col-md-4">
                                            <select class="form-control" name="wood-element">
                                                <option value="hardwood_floor">Hardwood Floor</option>
                                                <option value="laminate_floor">Laminate Floor</option>
                                                <option value="parquet_floor">Parquet Floor</option>
                                            </select>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="#" class="btn btn-flat btn-info back" data-dismiss="modal">Back</a>
                                <input type="submit" class="btn btn-flat btn-info" value="Next" />
                                <a href="#" class="btn btn-flat btn-danger cancel" data-dismiss="modal">Cancel</a>
                            </div>
                            </form>
                      </div>
                    </div>
                </div>
                <div class="modal fade" id="step5" tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Completing the Wizard</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">   
                                        <img src="{{URL::to('img/2d3d.png')}}" />
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">   
                                        <p>You are about to complete the Dream Builder Wizard.</p>
                                        <p>Once you click Finish,  a structure similar to the one on the left will be placed in your workspace.</p>
                                        <p>The structure is made of inidividual walls, floors, and roof that can be moved, modified, added to or delete as you wish.</p>
                                        <p>Click Finish to build your house.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="#" class="btn btn-flat btn-info back" data-dismiss="modal">Back</a>
                                <a href="#" class="btn btn-flat btn-success" id="finish" data-dismiss="modal">Finish</a>
                                <a href="#" class="btn btn-flat btn-danger cancel" data-dismiss="modal">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="about-dialog" tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">About Dream Builder Solutions</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row" style="text-align: center;">
                                    <h1>Dream Builder Solutions</h1>
                                    <p>Copyright &copy; 2014 <a href="http://www.dreambuildersolutions.com">Dream Builder Solutions, Inc.</a></p>
                                    <p><small>Beta Channel, Build 143</small></p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-flat btn-primary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="open-dialog" tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Select Design</h4>
                            </div>
                            <div class="modal-body">
                                <div id="designs"></div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-flat btn-primary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="save-dialog" tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Save Design</h4>
                            </div>
                            <div class="modal-body">
                                <div class="save-notification" style="display:none;">
                                    <div class="alert alert-danger" style="padding-left:10px; margin-left:0px;"> 
                                      <a href="#" class="alert-link" save-notification-content>
                                      Alert!
                                      </a>
                                    </div>
                                </div>
                                <label for="design_name" >Name</label>
                                <input type="text" data-content="The name of your dream house" data-original-title="House design name"placeholder="My first dream house" class="form-control" name="design_name">
                            </div>
                            <div class="modal-footer">
                                 <button class="btn btn-flat btn-success" id="saveHouse">Save</button>
                                <button class="btn btn-flat btn-primary" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="save-as-dialog" tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Save Design</h4>
                            </div>
                            <div class="modal-body">
                                <div class="save-notification" style="display:none;">
                                    <div class="alert alert-danger" style="padding-left:10px; margin-left:0px;"> 
                                      <a href="#" class="alert-link" save-notification-content>
                                      Alert!
                                      </a>
                                    </div>
                                </div>
                                <label for="design_name2" >Name</label>
                                <input type="text" data-content="The name of your dream house" data-original-title="House design name"placeholder="My first dream house" class="form-control" name="design_name2">
                            </div>
                            <div class="modal-footer">
                                 <button class="btn btn-flat btn-success save-as" id="saveAsHouse">Save</button>
                                <button class="btn btn-flat btn-primary" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="estimate-dialog" tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content" estimate-content>
                           
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="options-dialog" tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content" options-content>
                        <h3><b>Frequently Asked Questions</b></h3>
                        <h5>What is Dream Builder Solutions?</h5>
                            <p>Is a web app, which helps dreamers visualize their dream house in a fun and
                            easy way. This displays 2D, 3D and floor plan view of house design plus cost 
                            of materials to be used depending on the supplier price.</p>

                        <h5>Is Dream Builder Solutions free?</h5>
                            <p>Yes, this is absolutely free. What you need to do is just to signup an account 
                            and start visualizing your dreams!</p>

                        <h5>Where did Dream Builder Solutions gathered the costing of the materials?</h5>
                            <p>Researchers of this system gathered information from the hardware suppliers of 
                            cebu city based on their current prices.</p>

                        <h5>How do i get started?</h5>
                            <p>Click on Sign Up, complete the validation process... and you are ready to design! :)</p>

                        <h5>Can I edit the measurement of the house? E.g Door; Window; Wall</h5>
                            <p>You cannot edit but you need to delete first and create the door one more time. You can remove undesired doors, windows, walls and rooms.</p>

                        <h5>How do I delete it?</h5>
                            <p>Just right click the tool you want to delete.</p>

                        <h5>What is the fastest way to create a door , window, wall and room?</h5>
                            <p>The basic way to do it is to manually create it in the app, but we have this feature that can duplicate tool, 
                            just right click the thing you want to duplicate.</p>

                        </div>
                    </div>
                </div>



                <div id="contextMenu" style="position: absolute; display: none;" class="dropdown clearfix">
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block;position:static;margin-bottom:5px;">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#" id="delete-set">Delete</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#" id="duplicate-set">Duplicate</a></li>
                    </ul>
                </div>

            <!-- /Modals-->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->

@stop

@section('other_scripts') 
    <script type="text/javascript">
        window.baseUrl = $('[base-url]').attr('base-url');
    </script>
    <script src="{{URL::to('js/dreams-page.custom.js')}}" type="text/javascript"></script>
    <script src="{{URL::to('js/dreambuilder.js')}}" type="text/javascript"></script>
    <script src="{{URL::to('js/2d.dreambuilder.js')}}" type="text/javascript"></script>
    <script src="{{URL::to('js/sketcher.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $('input, select, textarea').popover({
            html: true,
            trigger: 'focus'
        });

        if (typeof DreamBuilder != 'undefined' && (DreamBuilder.ID == 0 || DreamBuilder.ID == '')) {
            $('[action-tools]').prop('disabled', true).attr('disabled', 'disabled');
            $('[action-view]').prop('disabled', true).attr('disabled', 'disabled');
        }

        $(window).bind('beforeunload', function(e){
            
            return 'Make sure that everything was saved before leaving or reloading this page.';
        });
    </script>
    
@stop