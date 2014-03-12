
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">{{ucfirst($vendor->name)}} - View</h4>
</div>
 <div class="modal-body">
    <table class="table">
        <tr>
            <td>Name: </td>
            <td>{{ucfirst($vendor->name)}}</td>
        </tr>
        <tr>
            <td>Business Address: </td>
            <td>{{$vendor->address1}}, {{$vendor->address2}}, {{$vendor->address3}}</td>
        </tr>
        <tr>
            <td>Verified: </td>
            <td>
                <span class="label label-@if($vendor->is_verified){{'success'}} @else{{'danger'}} @endif">
                @if($vendor->is_verified) {{'Yes'}} @else {{'No'}} @endif
            </span>
            </td>
        </tr>
        <tr>
            <td>Email Address: </td>
            <td>
            <a href="mailto:{{$vendor->email}}">
            {{$vendor->email}}</a></td>
        </tr>
        <tr>
            <td>Contact Number: </td>
            <td>{{$vendor->contact}}</td>
        </tr>
    </table>
</div>
<div class="modal-footer">
    <a href="#edit-vendor-dialog" data-toggle="modal" class="btn btn-flat btn-info cancel" action-edit-vendor="{{$vendor->id}}" >Edit</a>
    <a href="#delete-vendor-dialog" data-toggle="modal" class="btn btn-flat btn-danger cancel" action-delete-vendor="{{$vendor->id}}">Delete</a>
    <button class="btn btn-flat btn-primary cancel" data-dismiss="modal">Close</button>
</div>