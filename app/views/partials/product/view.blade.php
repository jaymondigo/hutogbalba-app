 <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">{{ucfirst($product->name)}} - View</h4>
</div>
<div class="modal-body" > 

    <table class="table">
        <tr> 
            <td><img src="{{URL::to($product->picture->url('medium'))}}" /></td>
        </tr>
        <tr>
            <td>Product ID: </td>
            <td>{{$product->productID}}</td>
        </tr>
        <tr>
            <td>Name: </td>
            <td>{{$product->name}}</td>
        </tr>
        <tr>
            <td>Type: </td>
            <td>{{$product->product_type->name}}</td>
        </tr>
        <tr>
            <td>Price: </td>
            <td>PHP {{$product->price}}</td>
        </tr>
        <tr>
            <td>Availability: </td>
            <td><span class="label label-@if($product->availability=='available'){{'success'}} @elseif($product->availability=='Out of stacks'){{'danger'}}@else{{'warning'}} @endif">{{$product->availability}}</span></td>
        </tr>
        <tr>
            <td>Vendor: </td>
            <td>{{$product->vendor_profile->name}}</td>
        </tr>
    </table>
</div>
<div class="modal-footer">
    <a href="#edit-product-dialog" edit-product="{{$product->id}}" data-toggle="modal" class="btn btn-flat btn-info cancel" data-dismiss="modal">Edit</a>
    <a href="#delete-product-dialog" product-id="{{$product->id}}" id="deleteProduct" data-toggle="modal" class="deleteProduct btn btn-flat btn-danger cancel">Delete</a> 
    <button class="btn btn-flat btn-primary cancel" data-dismiss="modal">Close</button>
</div>
 

