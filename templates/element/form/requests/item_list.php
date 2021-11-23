<?php 
	foreach($items as $i):
		echo '<option value="'.$i->id.'">'.(!empty($i->name) ? $i->name : $i->subname).'</option>';
	endforeach;
?>