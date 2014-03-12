<form action="{{URL::to('vendor')}}" method="POST">
<div class="modal-body">
        <div class="form-group">
            <label for="vendor-name">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Acetillore Hardware" />
        </div>
        <div class="form-group">
            <label for="vendor-business-name">Business Address</label>
            <input type="text" name="address1" class="form-control" placeholder="Concepcion" />
            <input type="text" name="address2" class="form-control" placeholder="Danao" />
            <input type="text" name="address3" class="form-control" placeholder="Bohol" />
        </div>
        <label for="vendor-verified">Verified</label>
        <div class="form-group">
            <input type="radio" value="1" name="is_verified" /> YES &nbsp;
            <input type="radio" value="0" checked name="is_verified" /> NO
        </div>
        <div class="form-group">
            <label for="vendor-email">Email Address</label>
            <input type="email" name="email" class="form-control" placeholder="info@acetillorehardware.com" />
        </div>
        <div class="form-group">
            <label for="vendor-contact">Contact Number</label>
            <input type="text" name="contact" class="form-control" placeholder="09336696985" />
        </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-flat btn-info cancel">Add</button>
    <button class="btn btn-flat btn-danger cancel" data-dismiss="modal">Cancel</button>
</div>

</form>