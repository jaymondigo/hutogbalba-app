<form action="{{URL::to('vendor')}}" method="POST" vendor-form>
<div class="modal-body">
        <div class="form-group">
            <label for="vendor-name">Name</label>
            <input required type="text" name="name" class="form-control" placeholder="Acetillore Hardware" />
        </div>
        <div class="form-group">
            <label for="vendor-business-name">Business Address</label>
            <input required type="text" name="address1" class="form-control" placeholder="Concepcion" />
            <input required type="text" name="address2" class="form-control" placeholder="Danao" />
            <input required type="text" name="address3" class="form-control" placeholder="Bohol" />
        </div>
        <label for="vendor-verified">Verified</label>
        <div class="form-group">
            <input required type="radio" value="1" name="is_verified" /> YES &nbsp;
            <input required type="radio" value="0" checked name="is_verified" /> NO
        </div>
        <div class="form-group">
            <label for="vendor-email">Email Address</label>
            <input required type="email" name="email" class="form-control" placeholder="info@acetillorehardware.com" />
        </div>
        <div class="form-group">
            <label for="vendor-contact">Contact Number</label>
            <input required type="text" name="contact" class="form-control" placeholder="09336696985" />
        </div>
</div>
<div class="modal-footer">
    <input type="submit" class="btn btn-flat btn-info cancel" value="Add"/>
    <button class="btn btn-flat btn-danger cancel" data-dismiss="modal">Cancel</button>
</div>

</form>