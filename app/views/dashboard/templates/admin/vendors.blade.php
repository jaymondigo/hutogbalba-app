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
                        <a href="#add-vendor-dialog" data-toggle="modal" class="btn btn-flat btn-primary">Add Vendor</a>
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
                                <tr>
                                    <td>Acetillore Hardware</td>
                                    <td>Cebu City</td>
                                    <td><span class="label label-warning">NO</span></td>
                                    <td>info@acetillorehardware.com</td>
                                    <td>(+639) 336696985</td>
                                    <td><a href="#view-vendor-dialog" data-toggle="modal" class="glyphicon glyphicon-eye-open"></a>&nbsp;&nbsp;&nbsp;<a href="#edit-vendor-dialog" data-toggle="modal" class="glyphicon glyphicon-pencil"></a>&nbsp;&nbsp;&nbsp;<a href="#delete-vendor-dialog" data-toggle="modal" class="glyphicon glyphicon-trash"></a></td>
                                </tr>
                                <tr>
                                    <td>Acetillore Hardware</td>
                                    <td>Cebu City</td>
                                    <td><span class="label label-success">YES</span></td>
                                    <td>info@acetillorehardware.com</td>
                                    <td>(+639) 336696985</td>
                                    <td><a href="#view-vendor-dialog" data-toggle="modal" class="glyphicon glyphicon-eye-open"></a>&nbsp;&nbsp;&nbsp;<a href="#edit-vendor-dialog" data-toggle="modal" class="glyphicon glyphicon-pencil"></a>&nbsp;&nbsp;&nbsp;<a href="#delete-vendor-dialog" data-toggle="modal" class="glyphicon glyphicon-trash"></a></td>
                                </tr>
                            </tbody>
                        </table>
                        <ul class="pagination pull-right">
                            <li><a href="#">&laquo;</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <div class="modal fade" id="view-vendor-dialog" tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Acetillore Hardware - View</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <tr>
                                <td>Name: </td>
                                <td>Acetillore Hardware</td>
                            </tr>
                            <tr>
                                <td>Business Address: </td>
                                <td>Cebu City</td>
                            </tr>
                            <tr>
                                <td>Verified: </td>
                                <td><span class="label label-success">YES</span></td>
                            </tr>
                            <tr>
                                <td>Email Address: </td>
                                <td><a href="mailto:info@acetillorehardware.com">info@acetillorehardware.com</a></td>
                            </tr>
                            <tr>
                                <td>Contact Number: </td>
                                <td>(+639) 336696985</td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <a href="#edit-vendor-dialog" data-toggle="modal" class="btn btn-flat btn-info cancel" data-dismiss="modal">Edit</a>
                        <button class="btn btn-flat btn-danger cancel" data-dismiss="modal">Delete</button>
                        <button class="btn btn-flat btn-primary cancel" data-dismiss="modal">Close</button>
                    </div>
              </div>
            </div>
        </div>
        <div class="modal fade" id="edit-vendor-dialog" tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Acetillore Hardware - Edit</h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="vendor-name">Name</label>
                                <input type="text" class="form-control" value="Acetillore Hardware" />
                            </div>
                            <div class="form-group">
                                <label for="vendor-business-name">Business Address</label>
                                <input type="text" class="form-control" value="Cebu City" />
                            </div>
                            <label for="vendor-verified">Verified</label>
                            <div class="form-group">
                                <input type="radio" value="yes" checked name="vendor-verified" /> YES &nbsp;
                                <input type="radio" value="no" name="vendor-verified" /> NO
                            </div>
                            <div class="form-group">
                                <label for="vendor-email">Email Address</label>
                                <input type="email" class="form-control" value="info@acetillorehardware.com" />
                            </div>
                            <div class="form-group">
                                <label for="vendor-contact">Contact Number</label>
                                <input type="text" class="form-control" value="09336696985" />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-flat btn-info cancel" data-dismiss="modal">Update</button>
                        <a href="#delete-vendor-dialog" data-toggle="modal" class="btn btn-flat btn-danger cancel" data-dismiss="modal">Delete</a>
                        <button class="btn btn-flat btn-primary cancel" data-dismiss="modal">Close</button>
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
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="vendor-name">Name</label>
                                <input type="text" class="form-control" placeholder="Acetillore Hardware" />
                            </div>
                            <div class="form-group">
                                <label for="vendor-business-name">Business Address</label>
                                <input type="text" class="form-control" placeholder="Cebu City" />
                            </div>
                            <label for="vendor-verified">Verified</label>
                            <div class="form-group">
                                <input type="radio" value="yes" name="vendor-verified" /> YES &nbsp;
                                <input type="radio" value="no" checked name="vendor-verified" /> NO
                            </div>
                            <div class="form-group">
                                <label for="vendor-email">Email Address</label>
                                <input type="email" class="form-control" placeholder="info@acetillorehardware.com" />
                            </div>
                            <div class="form-group">
                                <label for="vendor-contact">Contact Number</label>
                                <input type="text" class="form-control" placeholder="09336696985" />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-flat btn-info cancel" data-dismiss="modal">Add</button>
                        <button class="btn btn-flat btn-danger cancel" data-dismiss="modal">Cancel</button>
                    </div>
              </div>
            </div>
        </div>
        <div class="modal fade" id="delete-vendor-dialog" tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Acetillore Hardware - Delete</h4>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this vendor?
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-flat btn-danger cancel" data-dismiss="modal">Yes</button>
                        <button class="btn btn-flat btn-info cancel" data-dismiss="modal">No</button>
                        <button class="btn btn-flat btn-warning cancel" data-dismiss="modal">Cancel</button>
                    </div>
              </div>
            </div>
        </div>
@stop