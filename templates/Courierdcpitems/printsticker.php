<div class="col-md-6 nopadding">
<?php 
if($courierdcpitem->status=="1"){
	echo $this->element('sticker/dcp', ['courierdcpitem' => $courierdcpitem]); 
}else{
	echo "Please dispatch first the item / package";
}	

?>
</div>

