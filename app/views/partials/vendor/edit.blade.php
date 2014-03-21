<form action="{{URL::to('vendor')}}" method="POST" vendor-form>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">{{ucfirst($vendor->name)}} - Edit</h4>
</div>
<div class="modal-body">
       <input type="hidden" name="id" value="{{$vendor->id}}">
        <div class="form-group">
            <label for="vendor-name">Name</label>
            <input type="text" class="form-control" value="{{$vendor->name}}" name="name" />
        </div>
        <div class="form-group">
            <label for="vendor-business-name">Business Address</label>
            <input type="text" name="address1" class="form-control" value="{{$vendor->address1}}" />
            <input type="text" name="address2" class="form-control" value="{{$vendor->address2}}" />
            <input type="text" name="address3" class="form-control" value="{{$vendor->address3}}" />
        </div>
        <label for="vendor-verified">Verified</label>
        <div class="form-group">
            <input type="radio" value="1" name="is_verified" @if($vendor->is_verified){{'checked'}} @endif /> YES &nbsp;
            <input type="radio" value="0" name="is_verified" @if(!$vendor->is_verified){{'checked'}} @endif /> NO
        </div>
        <div class="form-group">
            <label for="vendor-email">Email Address</label>
            <input type="email" name="email" class="form-control" value="{{$vendor->email}}" />
        </div>
        <div class="form-group">
            <label for="vendor-contact">Contact Number</label>
            <input type="text" class="form-control" name="contact" value="{{$vendor->contact}}" />
        </div> 
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-flat btn-info cancel" >Update</button>
    <a href="#delete-vendor-dialog" data-toggle="modal" class="btn btn-flat btn-danger cancel" action-delete-vendor="{{$vendor->id}}">Delete</a>
    <button class="btn btn-flat btn-primary cancel" data-dismiss="modal">Close</button>
</div>
</form>