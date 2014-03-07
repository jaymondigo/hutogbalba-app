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
                        Products
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Products</li>
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
                        <a href="#add-product-dialog" data-toggle="modal" class="btn btn-flat btn-primary">Add Product</a>
                    </div><br /><br />

                    <div class="table-responsive">
                        <table class="table">
                            <th>Product ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Availability</th>
                            <th>Vendor</th>
                            <th>Action</th>
                            <tbody>
                                <tr class="bg-success">
                                    <td>CEM1234</td>
                                    <td>Fox Cement</td>
                                    <td>Cement</td>
                                    <td>PHP 143.00</td>
                                    <td><span class="label label-success">Available</span></td>
                                    <td>Acetillore Hardware</td>
                                    <td><a href="#view-product-dialog" data-toggle="modal" class="glyphicon glyphicon-eye-open"></a>&nbsp;&nbsp;&nbsp;<a href="#edit-product-dialog" data-toggle="modal" class="glyphicon glyphicon-pencil"></a>&nbsp;&nbsp;&nbsp;<a href="#delete-product-dialog" data-toggle="modal" class="glyphicon glyphicon-trash"></a></td>
                                </tr>
                                <tr class="bg-warning">
                                    <td>CEM1234</td>
                                    <td>Fox Cement</td>
                                    <td>Cement</td>
                                    <td>PHP 143.00</td>
                                    <td><span class="label label-warning">Few Stocks Left</span></td>
                                    <td>Acetillore Hardware</td>
                                    <td><a href="#view-product-dialog" data-toggle="modal" class="glyphicon glyphicon-eye-open"></a>&nbsp;&nbsp;&nbsp;<a href="#edit-product-dialog" data-toggle="modal" class="glyphicon glyphicon-pencil"></a>&nbsp;&nbsp;&nbsp;<a href="#delete-product-dialog" data-toggle="modal" class="glyphicon glyphicon-trash"></a></td>
                                </tr>
                                <tr class="bg-danger">
                                    <td>CEM1234</td>
                                    <td>Fox Cement</td>
                                    <td>Cement</td>
                                    <td>PHP 143.00</td>
                                    <td><span class="label label-danger">Out of Stock</span></td>
                                    <td>Acetillore Hardware</td>
                                    <td><a href="#view-product-dialog" data-toggle="modal" class="glyphicon glyphicon-eye-open"></a>&nbsp;&nbsp;&nbsp;<a href="#edit-product-dialog" data-toggle="modal" class="glyphicon glyphicon-pencil"></a>&nbsp;&nbsp;&nbsp;<a href="#delete-product-dialog" data-toggle="modal" class="glyphicon glyphicon-trash"></a></td>
                                </tr>
                                <tr class="bg-success">
                                    <td>CEM1234</td>
                                    <td>Fox Cement</td>
                                    <td>Cement</td>
                                    <td>PHP 143.00</td>
                                    <td><span class="label label-success">Available</span></td>
                                    <td>Acetillore Hardware</td>
                                    <td><a href="#view-product-dialog" data-toggle="modal" class="glyphicon glyphicon-eye-open"></a>&nbsp;&nbsp;&nbsp;<a href="#edit-product-dialog" data-toggle="modal" class="glyphicon glyphicon-pencil"></a>&nbsp;&nbsp;&nbsp;<a href="#delete-product-dialog" data-toggle="modal" class="glyphicon glyphicon-trash"></a></td>
                                </tr>
                                <tr class="bg-success">
                                    <td>CEM1234</td>
                                    <td>Fox Cement</td>
                                    <td>Cement</td>
                                    <td>PHP 143.00</td>
                                    <td><span class="label label-success">Available</span></td>
                                    <td>Acetillore Hardware</td>
                                    <td><a href="#view-product-dialog" data-toggle="modal" class="glyphicon glyphicon-eye-open"></a>&nbsp;&nbsp;&nbsp;<a href="#edit-product-dialog" data-toggle="modal" class="glyphicon glyphicon-pencil"></a>&nbsp;&nbsp;&nbsp;<a href="#delete-product-dialog" data-toggle="modal" class="glyphicon glyphicon-trash"></a></td>
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

        <div class="modal fade" id="view-product-dialog" tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Fox Cement - View</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <tr>
                                <td>Product ID: </td>
                                <td>CEM1234</td>
                            </tr>
                            <tr>
                                <td>Name: </td>
                                <td>Fox Cement</td>
                            </tr>
                            <tr>
                                <td>Type: </td>
                                <td>Cement</td>
                            </tr>
                            <tr>
                                <td>Price: </td>
                                <td>PHP 143.00</td>
                            </tr>
                            <tr>
                                <td>Availability: </td>
                                <td><span class="label label-success">Available</span></td>
                            </tr>
                            <tr>
                                <td>Vendor: </td>
                                <td>Acetillore Hardware</td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <a href="#edit-product-dialog" data-toggle="modal" class="btn btn-flat btn-info cancel" data-dismiss="modal">Edit</a>
                        <button class="btn btn-flat btn-danger cancel" data-dismiss="modal">Delete</button>
                        <button class="btn btn-flat btn-primary cancel" data-dismiss="modal">Close</button>
                    </div>
              </div>
            </div>
        </div>
        <div class="modal fade" id="edit-product-dialog" tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Fox Cement - Edit</h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <label for="product_id">Product ID</label>
                            <input type="text" class="form-control" value="CEM1234" /><br />
                            <label for="name">Name</label>
                            <input type="text" class="form-control" value="Fox Cement" /><br />
                            <label for="type">Type</label>
                            <select name="type" class="form-control">
                                <option value="cement">Cement</option>
                                <option value="cement">Cement</option>
                                <option value="cement">Cement</option>
                                <option value="cement">Cement</option>
                                <option value="cement">Cement</option>
                            </select><br />
                            <label for="price">Price</label>
                            <section class="input-group">
                                <span class="input-group-addon">PHP</span>
                                <input type="text" class="form-control" value="143.00" />
                            </section><br />
                            <label for="availability">Availability</label>
                            <select name="availability" class="form-control">
                                <option value="available">Available</option>
                                <option value="available">Out of Stock</option>
                                <option value="available">Few Stocks Left</option>
                            </select><br />
                            <label for="availability">Vendor</label>
                            <select name="availability" class="form-control">
                                <option value="available">Acetillore Hardware</option>
                                <option value="available">Acetillore Hardware</option>
                                <option value="available">Acetillore Hardware</option>
                            </select>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-flat btn-info cancel" data-dismiss="modal">Update</button>
                        <a href="#delete-product-dialog" data-toggle="modal" class="btn btn-flat btn-danger cancel" data-dismiss="modal">Delete</a>
                        <button class="btn btn-flat btn-primary cancel" data-dismiss="modal">Close</button>
                    </div>
              </div>
            </div>
        </div>
        <div class="modal fade" id="add-product-dialog" tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Add Product</h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <label for="product_id">Product ID</label>
                            <input type="text" class="form-control" placeholder="CEM1234" /><br />
                            <label for="name">Name</label>
                            <input type="text" class="form-control" placeholder="Fox Cement" /><br />
                            <label for="type">Type</label>
                            <select name="type" class="form-control">
                                <option value="cement">Cement</option>
                                <option value="cement">Cement</option>
                                <option value="cement">Cement</option>
                                <option value="cement">Cement</option>
                                <option value="cement">Cement</option>
                            </select><br />
                            <label for="price">Price</label>
                            <section class="input-group">
                                <span class="input-group-addon">PHP</span>
                                <input type="text" class="form-control" placeholder="143.00" />
                            </section><br />
                            <label for="availability">Availability</label>
                            <select name="availability" class="form-control">
                                <option value="available">Available</option>
                                <option value="available">Out of Stock</option>
                                <option value="available">Few Stocks Left</option>
                            </select><br />
                            <label for="availability">Vendor</label>
                            <select name="availability" class="form-control">
                                <option value="available">Acetillore Hardware</option>
                                <option value="available">Acetillore Hardware</option>
                                <option value="available">Acetillore Hardware</option>
                            </select>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-flat btn-info cancel" data-dismiss="modal">Add</button>
                        <button class="btn btn-flat btn-danger cancel" data-dismiss="modal">Cancel</button>
                    </div>
              </div>
            </div>
        </div>
        <div class="modal fade" id="delete-product-dialog" tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Fox Cement - Delete</h4>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this product?
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