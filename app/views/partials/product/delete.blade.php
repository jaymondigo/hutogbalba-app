<div class="modal-body">
    Are you sure you want to delete this product?
</div>
<div class="modal-footer">
	<form action="{{URL::to('product/delete')}}" method="POST" class="btn btn-flat" style="padding:0px;">
	<input type="hidden" name="id" value="{{$product->id}}" />
	 <button type="submit" class="btn btn-flat btn-danger cancel" >
	 	Yes
	 </button>
	</form>
   
    <button class="btn btn-flat btn-info cancel" data-dismiss="modal">No</button>
    <button class="btn btn-flat btn-warning cancel" data-dismiss="modal">Cancel</button>
</div>