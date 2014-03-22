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
                        <a href="#add-product-dialog" data-toggle="modal" class="btn btn-flat btn-primary" id="addProduct">Add Product</a>
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
                            @foreach ($products as $product) 
                                 <tr class="bg-success">
                                    <td>{{$product->productID}}</td>
                                    <td>{{$product->name}}</td> 
                                    <td>
                                        @if(isset($product->productType->name))
                                        {{$product->productType->name}}
                                        @endif
                                    </td>
                                    <td>{{$product->price}}</td>
                                    <td><span class="label label-@if($product->availability=='available'){{'success'}} @elseif($product->availability=='Out of stacks'){{'danger'}}@else{{'warning'}} @endif">{{$product->availability}}</span></td>
                                    <td>
                                        @if(isset($product->vendor_profile->name))
                                            {{$product->vendor_profile->name}} 
                                        @endif
                                    </td>
                                    <td><a href="#view-product-dialog" data-toggle="modal" class="glyphicon glyphicon-eye-open" view-product="{{$product->id}}">
                                    </a>&nbsp;&nbsp;&nbsp;<a href="#edit-product-dialog" edit-product="{{$product->id}}" data-toggle="modal" class="glyphicon glyphicon-pencil">
                                    </a>&nbsp;&nbsp;&nbsp;
                                   <a href="#delete-product-dialog" product-id="{{$product->id}}" id="deleteProduct" data-toggle="modal" class="deleteProduct glyphicon glyphicon-trash"></a>
                                    </td>
                                </tr>
                            @endforeach
                               
                            </tbody>
                        </table>
                       {{$products->links()}}
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <div class="modal fade" id="view-product-dialog" data-view-product tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                   
                   <div view-product-con> 
                   </div>
              </div>
            </div>
        </div>
        <div class="modal fade" id="edit-product-dialog" tabindex="-1" role="dialog" aria-labelledby="form-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <div data-edit-product>

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
                    <div add-product>                            

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
                    <div delete-con-modal>

                    </div>
              </div>
            </div>
        </div>
@stop

@section('other_scripts')
    <script src="{{URL::to('js/product.js')}}" type="text/javascript"></script> 
@stop