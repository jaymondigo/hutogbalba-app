 <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Cost Calculator</h4>
</div>
<div class="modal-body"> 
    <div class="row"> 
         <table class="table table-hover">
         	<caption><b>{{$dream->name}} - Estimate</b></caption>
         	<thead>
         		<tr>
         			<th>Material</th>
         			<th>Number/Quantity</th>
         			<th>Product Use</th>
         			<th>Price</th>
         			<th>Cost</th>
         		</tr>
         	</thead>
         	<tbody>
         		@foreach($dream->materials as $i => $material)
         		<tr>
         			<td>{{ucfirst(str_replace('_',' ',$i))}}</td>

         			<td><span p-qnty="{{$i}}">{{ceil($material)}}</span> {{ucfirst(DbsHelper::unit($i ))}}</td>
         			<td type="{{$i}}" class="product-type"></td>
         			<td>&#x20B1;<span p-price='{{$i}}'></span></td>
         			<td>&#x20B1;<span p-tprice='{{$i}}'></span></td>
         		</tr>		
         		@endforeach
         	</tbody>
         </table>
         <div class="pull-right" style="margin-right: 68px;"><label> Overall Total Cost:  &nbsp;&#x20B1;</label> <span overall-total-price>{{0}}</span></div>
 
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-flat btn-primary" data-dismiss="modal">Close</button>
</div>

 
