<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Acetillore Hardware - Delete</h4>
</div>
 <div class="modal-body">
    Are you sure you want to delete this vendor?
</div>
<div class="modal-footer">
	<form action="{{URL::to('vendor/delete')}}" method="POST" class="btn btn-flat">
	<input type="hidden" name="id" value="{{$vendor->id}}" />
    <button type="submit" class="btn btn-flat btn-danger cancel">Yes</button>
    </form>
    <button class="btn btn-flat btn-info cancel" data-dismiss="modal">No</button>
    <button class="btn btn-flat btn-warning cancel" data-dismiss="modal">Cancel</button>
</div>