<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">{{ucfirst($product->name)}} - Edit</h4>
</div>
<form name="editProductForm" action="{{URL::to('product')}}" method="POST" enctype="multipart/form-data">
    <div class="modal-body" >
    <input type="hidden" name="id" value="{{$product->id}}">
    <label for="product_id">Product ID</label>
    <input disabled type="text" class="form-control" placeholder="CEM1234"><br>
    <label for="name">Name</label>
    <input required type="text" value="{{$product->name}}" name="name" class="form-control" placeholder="Fox Cement"><br>
     
    <label for="type">Type</label>
    <select name="type" class="form-control">
         @foreach ($elements as $element)
             <optgroup label="{{$element->name}}">
                @foreach($element->types as $type)
                    <option value="{{$type->id}}" @if($type->id==$product->type) selected="selected" @endif>{{$type->name}}</option> 
                @endforeach
             </optgroup>>
         @endforeach
    </select><br>
    <label for="price">Price</label>
    <section class="input-group">
        <span class="input-group-addon">PHP</span>
        <input required type="text" value="{{$product->price}}" class="form-control" name="price" placeholder="143.00">
    </section><br>
    <label for="availability">Availability</label>
    <select name="availability" class="form-control" value="{{$product->availability}}">
        <option value="available" @if($product->availability=='available') {{'selected'}} @endif>Available</option>
        <option value="Out of stacks" @if($product->availability=='Out of stacks') {{'selected'}} @endif>Out of Stock</option>
        <option value="Few Stocks Left" @if($product->availability=='Few Stocks Left') {{'selected'}} @endif>Few Stocks Left</option>
    </select><br>
    <label for="vendor">Vendor</label>
    <select name="vendor" class="form-control">
       @foreach ($vendors as $vendor)
           <option value="{{$vendor->id}}" @if($vendor->id == $product->vendor) selecte="selected" @endif>{{$vendor->name}}</option>
       @endforeach
    </select>
    <br/>
    <label for="picture">Picture</label>
    <input type="file" name="picture" />
                  
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-flat btn-info cancel">Update</button>
    <a href="#delete-product-dialog" product-id="{{$product->id}}" id="deleteProduct" data-toggle="modal" class="deleteProduct btn btn-flat btn-danger cancel">Delete</a>
    <button class="btn btn-flat btn-primary cancel" data-dismiss="modal">Close</button>
</div>


</form> 
