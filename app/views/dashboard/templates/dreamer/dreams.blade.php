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
                    <h1>
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
                                            <li><a href="#" id="open">Open</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" action-tools class="dropdown-toggle" data-toggle="dropdown">Tools <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#new-room-dialog" data-toggle="modal" id="new-room">New Room</a></li>
                                            <li><a href="#new-door-dialog" data-toggle="modal" id="new-door">New Door</a></li>
                                            <li><a href="#new-window-dialog" data-toggle="modal" id="new-window">New Window</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" action-view class="dropdown-toggle" data-toggle="dropdown">View <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0)" id="view-3d" house-id="">3D</a></li>
                                            <li><a href="javascript:void(0)" id="view-floorplan" house-id="">Floorplan</a></li>
                                            <li><a href="#estimate-dialog" data-toggle="modal" tabindex="-1" view-estimate>Estimate</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Help <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a id="options" href="#options-dialog" data-toggle="modal" view-options>Options</a></li>
                                            <li><a href="#about-dialog" data-toggle="modal" id="about">About</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div id="sketchpad"></div>

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
                                            <legend>Room Size</legend>
                                            <label for="room-area">Area: </label>
                                            <section class="input-group">
                                                <input value="4" name="room-area" type="text" class="form-control" disabled data-content="Please edit this" data-original-title="Room area here"/>
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                            </section><br />
                                            <label for="room-length">a. Length: </label>
                                            <section class="input-group">
                                                <input required min="2" value="2" name="room-length" type="text" class="form-control" data-content="Please edit this" data-original-title="Length of the room"/>
                                                <span class="input-group-addon" >m</span>
                                            </section><br />
                                            <label for="room-width">b. Width: </label>
                                            <section class="input-group">
                                                <input data-content="Please edit this" data-original-title="Width of the room" required min="2" value="2" name="room-width" type="text" class="form-control" />
                                                <span class="input-group-addon">m</span>
                                            </section><br />
                                            <label for="room-name">Room Label: </label>
                                            <input data-content="Please edit this" data-original-title="Room label" type="text" name="room-name" class="form-control" />
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
                                            <label for="wall">Select Which Wall to Attach: </label>
                                            <select name="door-where" class="form-control" data-content="Please edit this" data-original-title="Select which wall to attached">
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
                                            <label for="wall">Chuvaness: </label>
                                            <select name="door-num" class="form-control">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
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
                                            <label for="wall">Select Which Wall to Attach: </label>
                                            <select name="window-where" class="form-control" data-content="Please edit this" data-original-title="Select which wall to attached">
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
                                            <select name="num-floors" class="form-control" data-content="Please edit this" data-original-title="Number of floors">
                                                <option value="1">1</option>
                                            </select><br />
                                            <label for="terrain">a. Ground floor Height above the terrain: </label>
                                            <section class="input-group">
                                                <input value="0.2" disabled name="terrain" type="text" class="form-control" data-content="Please edit this" data-original-title="Terrain"/>
                                                <span class="input-group-addon">m</span>
                                            </section><br />
                                            <label for="height">b. Floor to Ceiling Height: </label>
                                            <section class="input-group">
                                                <input required name="height" value="2.75" type="text" min="2.75" class="form-control" data-content="Please edit this" data-original-title="Floor to ceiling height"/>
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
                                                <input required name="length" min="2.5" value="2.5" type="text" class="form-control" data-content="Please edit this" data-original-title="Building Length"/>
                                                <span class="input-group-addon">m</span>
                                            </section><br />
                                            <label for="width">b. Width: </label>
                                            <section class="input-group">
                                                <input required name="width" min="2.5" value="2.5" type="text" class="form-control" data-content="Please edit this" data-original-title="Building width" />
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
                                            <select class="form-control" name="roof-type" data-content="Please edit this" data-original-title="Roof">
                                                <option value="hip">Hip</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <select class="form-control" name="roof-pitch" data-content="Please edit this" data-original-title="Hip type">
                                                <option value="4-12">4/12 Pitch Hip</option>
                                                <option value="8-12">8/12 Pitch Hip</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-5 col-md-5">
                                            <select class="form-control" name="roof-element" data-content="Please edit this" data-original-title="Asphalt">
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
                                            <select class="form-control" name="wall-dim" data-content="Please edit this" data-original-title="Walls">
                                                <option value="10">10 m</option>
                                                <option value="15">15 m</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-8 col-md-8">
                                            <select class="form-control" name="wall-element" data-content="Please edit this" data-original-title="Wall types">
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
                                            <select class="form-control" name="floor-type" data-content="Please edit this" data-original-title="Floors">
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
                                <input type="text" data-content="Please edit this" data-original-title="House design name"placeholder="My first dream house" class="form-control" name="design_name">
                            </div>
                            <div class="modal-footer">
                                 <button class="btn btn-flat btn-success" id="saveHouse">Save</button>
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
                           
                        </div>
                    </div>
                </div>



                <div id="contextMenu" style="position: absolute; display: none;" class="dropdown clearfix">
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block;position:static;margin-bottom:5px;">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#" id="delete-set">Delete</a></li>
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

        $(window).bind('beforeunload', function(){
             
            return 'Make sure that everything was saved before leaving or reloading this page.';
        });
    </script>
    
@stop