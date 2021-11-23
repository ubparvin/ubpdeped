<div class="col-md-6 nopadding">
<?php 
if($couriertxtitem->status=="1"){
	echo $this->element('sticker/'.$contract, ['couriertxtitem' => $couriertxtitem]); 
}else{
	echo "Please dispatch first the item / package";
}	

?>
</div>

