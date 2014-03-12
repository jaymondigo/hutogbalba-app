 
<form name="addProductForm" action="{{URL::to('product')}}" method="POST">
 <div class="modal-body">
    <label for="product_id">Product ID</label>
    <input type="text" name="productID" class="form-control" placeholder="CEM1234"><br>
    <label for="name">Name</label>
    <input type="text" name="name" class="form-control" placeholder="Fox Cement"><br>
     
    <label for="type">Type</label>
    <select name="type" class="form-control">
         @foreach ($elements as $element)
             <optgroup label="{{$element->name}}">
                @foreach($element->types as $type)
                    <option value="{{$type->id}}">{{$type->name}}</option> 
                @endforeach
             </optgroup>>
         @endforeach
    </select><br>
    <label for="price">Price</label>
    <section class="input-group">
        <span class="input-group-addon">PHP</span>
        <input type="text" class="form-control" name="price" placeholder="143.00">
    </section><br>
    <label for="availability">Availability</label>
    <select name="availability" class="form-control">
        <option value="available">Available</option>
        <option value="Out of stacks">Out of Stock</option>
        <option value="Few Stocks Left">Few Stocks Left</option>
    </select><br>
    <label for="vendor">Vendor</label>
    <select name="vendor" class="form-control">
       @foreach ($vendors as $vendor)
           <option value="{{$vendor->id}}">{{$vendor->name}}</option>
       @endforeach
    </select>
 
</div>
 <div class="modal-footer">
    <input type="submit" class="btn btn-flat btn-info cancel" value="Add" />
    <button class="btn btn-flat btn-danger cancel" data-dismiss="modal">Cancel</button>
</div>

</form> 
