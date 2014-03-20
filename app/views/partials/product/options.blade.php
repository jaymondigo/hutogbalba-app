<?php
	$html = '
		<select name="price['.$i.']" class="form-control" price-options>
			';
		 
		foreach($products as $index => $p){
			$selected = $index==0? 'selected="selected"': '';
			$html .= '<option '.$selected.'value="'.$p->price.'">'.$p->name.'</option>';
		} 

	$html .='
		</select>
	';
	$data = array(
			'type'=>$type,
			'html'=>$html
		);
	echo json_encode($data);
?>