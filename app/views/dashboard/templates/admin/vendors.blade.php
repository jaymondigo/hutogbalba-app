@extends('dashboard.index')
@section('main_content')
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar --> 
            @include('partials.sidebar')

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Vendors
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Vendors</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="pull-right">
                        <form class="col-lg-5 col-md-5 col-lg-offset-5 col-md-offset-5">
                            <section class="input-group">
                                <input type="search" class="form-control" placeholder="Search" />
                                <span class="input-group-btn">
                                    <button class="btn btn-flat btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                                </span>
                            </section>
                        </form>
                        <a href="#add-vendor-dialog" data-toggle="modal" class="btn btn-flat btn-primary" action-add-vendor>Add Vendor</a>
                    </div><br /><br />

                    <div class="table-responsive">
                        <table class="table">
                            <th>Name</th>
                            <th>Business Address</th>
                            <th>Verified</th>
                            <th>Email Address</th>
                            <th>Contact Number</th>
                            <th>Action</th>
                            <tbody>
                               @foreach ($vendors as $vendor)
                                   <tr>
                                    <td>
                                        {{$vendor->name}}
                                    </td>
                                    <td>
                                        {{$vendor->address1}}, {{$vendor->address2}}, {{$vendor->address3}}
                                    </td>
                                    <td><span class="label label-@if($vendor->is_verified){{'success'}} @else{{'danger'}} @endif">@if($vendor->is_verified){{'Yes'}} @else {{'No'}} @endif</span></td>
                                    <td>{{$vendor->email}}</td>
                                    <td>{{$vendor->contact}}</td>
                                    <td><a href="#view-vendor-dialog" data-toggle="modal" class="glyphicon glyphicon-eye-open" action-view-vendor="{{$vendor->id}}"></a>&nbsp;&nbsp;&nbsp;<a href="#edit-vendor-dialog" data-toggle="modal" class="glyphicon glyphicon-pencil" action-edit-vendor="{{$vendor->id}}"></a>&nbsp;&nbsp;&nbsp;<a href="#delete-vendor-dialog" data-toggle="modal" class="glyphicon glyphicon-trash" action-delete-vendor="{{$vendor->id}}"></a></td>
                                </tr>
                               @endforeach
                                
                            </tbody>
                        </table>
                        {{$vendors->links()}}
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <div class="modal fade" id="view-vendor-dialog" tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                   <div view-vendor>
                       
                   </div>
              </div>
            </div>
        </div>
        <div class="modal fade" id="edit-vendor-dialog" tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <div edit-vendor>

                    </div>
              </div>
            </div>
        </div>
        <div class="modal fade" id="add-vendor-dialog" tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Add vendor</h4>
                    </div>
                    <div add-vendor>

                    </div>
              </div>
            </div>
        </div>
        <div class="modal fade" id="delete-vendor-dialog" tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div delete-vendor>
                       
                   </div>
              </div>
            </div>
        </div>
@stop

@section('other_scripts')
    <script src="{{URL::to('js/vendor.js')}}" type="text/javascript"></script> 
@stop