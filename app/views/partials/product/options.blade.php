<?php
	$html = '
		<select name="price['.$i.']" class="form-control">
			';
		 
		foreach($products as $p){
			$html .= '<option value="'.$p->price.'">'.$p->name.'</option>';
		} 

	$html .='
		</select>
	';
	$data = array(
			'type'=>$type,
			'data'=>$html
		);
	echo json_encode($data);
?>