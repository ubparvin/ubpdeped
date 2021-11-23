<?php 

	$options = array(
		'BOX',
		'CRATES',
		'LBS',
		'KILO',
		'SACK',
		'PCS'
	);
	
	foreach($options as $o):
		echo '<option value="'.$o.'">'.$o.'</option>';
	endforeach;
?>