	
	
	function getTheWebroot(){
		return ("https:"==document.location.protocol?"https://":"http://") + document.location.hostname + "/dashboard/";
	}

	var _webroot = getTheWebroot();
	
	