<?php

	//require APP . 'vendor/phpqrcode/qrlib.php';
	require_once(ROOT . DS . 'vendor' . DS . "phpqrcode" . DS . "qrlib.php");
	
	ob_start();
	QRCode::png($details, null);
	$imageString = base64_encode(ob_get_contents());
	ob_end_clean();
	
	$color = "";
	if(isset($color)){
		$color = "red";
	}
?>

<div class="col-md-12 centerdiv" style="text-align: center; width: 100%;">
	<div>
		<img src="data:image/png;base64,<?php echo $imageString; ?>" style="padding: 0; margin: 0; width: 100% !important;"/>
	</div>
	
</div>	
<div class="clear" style="clear: both;"></div>