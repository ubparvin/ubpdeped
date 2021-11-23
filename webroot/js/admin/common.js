	
	/*IDLE DETECTION*/
	$(document).idleTimer({
		//timeout:60000, //1 minute
		//timeout:1800000, //30 minutes
		timeout:1800000000, //30 minutes
		idle:true,
		events: ['mousemove keydown wheel DOMMouseScroll mousewheel mousedown touchstart touchmove MSPointerDown MSPointerMove'],
		timerSyncId: null
	});
		
	$(document).on( "idle.idleTimer", function(event, elem, obj){
		// function you want to fire when the user goes idle
		$.get(_webroot + "users/logout/", function(){
			//notification modal
			$("#logoutModal").modal("show");
		});
	});
	
	/*
	$(document).on("click", ".modal_view", function(e){
		e.preventDefault();
		var url		 = $(this).attr("href");
		var title    = $(this).attr("title");
		var note    = $(this).attr("note");
		$(".modal-body").html("");
		showLoadingModal("show");
		$.get(url, function(resp){
			$(".modal-body").html(resp).promise().done( function(){
				
				showLoadingModal("hide");
			});
			$(".modal-title").html(title);
			$(".modal-note").html(note);
			
		});
									
	});
	
	$(document).on("click", ".modal_view_sub", function(e){
		e.preventDefault();
		var url		 = $(this).attr("href");
		var title    = $(this).attr("title");
		var note    = $(this).attr("note");
		$(".modal-body-sub").html("");
		showLoadingModal("show");
		$.get(url, function(resp){
			
			$(".modal-body-sub").html(resp).promise().done( function(){
				
				showLoadingModal("hide");
				$(".modal-title-sub").html(title);
				$(".modal-note-sub").html(note);
			});
		});
									
	});
	*/
	
	function seriesQty(){
		
		$(".series_end, .series_start").focusout( function(){
			var s_end = parseInt($(this).val());
			var s_start = parseInt($(".series_start").val());
			var total = ((s_end - s_start) + parseInt(1));
			
			if(total >= 1){
				$(".qty").val(total);
			}
		});
	}
	
	function itemQty(){
		$(".inc").click( function(){
			
			var qty = parseInt($(".qty_wrapper").find(".qty").val());
			$(".qty_wrapper").find(".qty").val(qty + 1);
		});
		
		$(".dec").click( function(){
			var qty = parseInt($(".qty_wrapper").find(".qty").val());
			if(qty > 1){
			$(".qty_wrapper").find(".qty").val(qty - 1);
			}
		});
	}
	
	function inputMasking(){
		$(".letters_only").inputmask({
			regex			: "[a-zA-Z\\s]+",
			casing 			: "upper",
			leftAlign		: true,
			placeholder		: ""
		});
		
		$(".numbers_only").inputmask({
			regex			: "[0-9]*",
			casing 			: "upper",
			leftAlign		: true,
			placeholder		: ""
		});
		
		$(".numbers_and_letters").inputmask({
			regex			: "[a-zA-Z0-9._-\\s]+",
			casing 			: "upper",
			leftAlign		: true,
			placeholder		: ""
		});
		
		$(".allcaps").inputmask({
			//regex			: "[a-zA-Z0-9._-\\s]+",
			casing 			: "upper",
			leftAlign		: true,
			placeholder		: ""
		});
		
		$(".contact").inputmask("99999999999", {"placeholder": ""});
		$(".tel_no").inputmask("999999999999999", {"placeholder": ""});
		$(".contact_no").inputmask("99999999999", {"placeholder": ""});
		
		$(".amount").inputmask({
			'alias': 'decimal', 
			'groupSeparator': ',', 
			'autoGroup': true, 
			'digits': 2, 
			'digitsOptional': false, 
			'placeholder': '0.00', 
			rightAlign : false,
			clearMaskOnLostFocus: !1 
		});
		
	}
	
	
	function showLoading(type){
		if(type=="show"){
			$("#m_process").removeClass("nodisplay");
		}else{
			$("#m_process").addClass("nodisplay");
		}
	}
	
	function showLoadingModal(type){
		if(type=="show"){
			$("#modal-body-loding").removeClass("nodisplay");
		}else{
			$("#modal-body-loding").addClass("nodisplay");
		}
	}
	
	function getLocName(url, wrapper){
		var address = $(wrapper).val();
		
		$.get(url, function(resp){
			var resp = JSON.parse(resp);
			if(resp.status==1){
				$(wrapper).val(address + " " + resp.message);
			}
		});
		
	}
	
	
	function getRegionList(){
		//_url = _webroot + "regions/getList/";
		//getOptionList(_url, ".loc_region");
		getProvinceList();
	}

	function getProvinceList(){
			$(".loc_region").change( function(){
				showLoading("show");
				
				//$(".sitio, .address").val("");
				var _sel = $(".loc_region option:selected").val();
				
				var _url = "";
				if(_sel===""){
					$(".loc_province").empty();
					$(".loc_city").empty();
					$(".loc_barangay").empty();
					
					alert("Please select a Region.");
					showLoading("hide");
					
					
				}else{
					_url = _webroot + "provinces/getList/" + _sel;
					showLoading("hide");
					getOptionList(_url, ".loc_province");
					$(".loc_city").empty();
					$(".loc_barangay").empty();
					getCityList();
					
				}
				
				
			});
	}
	
    function getCityList(){	
			$(".loc_province").change( function(){
				showLoading("show");
				
					
				//$(".sitio, .address").val("");
				var _sel = $(".loc_region option:selected").val();
				var _sel_pr = $(".loc_province option:selected").val();
				var _url = "";
				if(_sel===""){
					$(".loc_city").empty();
					$(".loc_barangay").empty();
					alert("Please select a Province.");
					showLoading("hide");
				
				}else{
					
					_url = _webroot + "cities/getList/" + _sel + "/" + _sel_pr;
					showLoading("hide");
					getOptionList(_url, ".loc_city");
					$(".loc_barangay").empty();
					getBarangayList();
					//getLocName(_webroot + "provinces/getAddressName/" + _sel_pr, ".address");
				}

			});
	}

	function getBarangayList(){
			$(".loc_city").change( function(){
				showLoading("show");
				//$(".sitio, .address").val("");
				var _sel = $(".loc_region option:selected").val();
				var _sel_pr = $(".loc_province option:selected").val();
				var _sel_ct = $(".loc_city option:selected").val();
				var _url = "";
				if(_sel===""){
					alert("Please select a City.");
					showLoading("hide");
				}else{
					_url = _webroot + "barangays/getList/" + _sel + "/" + _sel_pr + "/" + _sel_ct;
					showLoading("hide");
					getOptionList(_url, ".loc_barangay");
					//generateAddress();
					//getLocName(_webroot + "cities/getAddressName/" + _sel_ct, ".address");
				}
			});
			
			//$(".loc_barangay").change( function(){
				//$(".sitio, .address").val("");
			//});
	}
	
	
	function allowEdit(form){
		$(".edit_btn").click( function(){
			$(form + " *").removeAttr("disabled");
		});
	}
	
	function generateAddress(){
		//$(".loc_barangay").change( function(){
		/*$(".sitio").keypress( function(){
				var region 		= $(".loc_region :selected").text();
				region = region.replace("-Choose-Choose-Choose-Choose", "");
				region = region.replace("--Choose--Choose--Choose--Choose", "");
				//region = region.replace("REGION II (CAGAYAN VALLEY)REGION II (CAGAYAN VALLEY)REGION II (CAGAYAN VALLEY)REGION II (CAGAYAN VALLEY)", "");
				//region = region.replace("REGION I (ILOCOS REGION)REGION I (ILOCOS REGION)REGION I (ILOCOS REGION)REGION I (ILOCOS REGION)", "");
				var province 	= $(".loc_province :selected").text();
				province = province.replace("--Choose--Choose--Choose--Choose", "");
				var city 		= $(".loc_city :selected").text();
				city = city.replace("--Choose--Choose--Choose--Choose", "");
				var barangay 	= $(".loc_barangay :selected").text();
				barangay = barangay.replace("--Choose--Choose--Choose--Choose", "");
				barangay = barangay.replace("--Choose", "");

				
				if(barangay!==""){
					$(".address").val($(this).val() + " " + barangay + " " + city + " " + province + " " + region);
				}else{
					alert("Please provide the proper address information");
					$(this).val("");
				}
		});*/
	}
	
	function getOptionList(_url, optionid){
		
		
		$.ajax({
				method		: "GET",
				url			: _url,
				cache		: false,				
				beforeSend	: function(){
					//_loading_message("show");
				},
				success		: function(resp){
							_data = JSON.parse(resp);
							$(optionid).empty();
							if(_data.status===200){
								$(optionid).append($("<option>", { 
										value: "",
										text : "--Choose"
								}));
								
								$.each(_data.data, function (i, item) {
									
									$(optionid).append($("<option>", { 
										value: item.id,
										text : item.name 
									}));
									
								});
								
								//var tempregCode = $(".tempregCode").val();
								//if(tempregCode!==""){
									//$('.loc_region > [value="' + tempregCode + '"]').attr("selected", "true");	
								//}
								
							}else{
								
								alert(_data.message);
							}
						
				},
				error		: function(err1, err2, err3){
					//_error_message("show", "Opps! something went wrong, please try again.");
					alert("Opps! something went wrong, please try again.");
				
				},
				complete	: function(){
					//_loading_message("hide");
					
				},				
			});	
	}
	
	
	function massUploadForm(_url, types, param){
		//var postdata = param;
		
		$("#uploadbtn").prop("disabled", true);
		var uploadObj  = $("#fileuploader").uploadFile({
			url: _url,
			headers: {
						'X-CSRF-Token' : $('[name="_csrfToken"]').val()
			},
			maxFileCount: 1,
			allowedTypes: types,
			//allowedTypes: "png, jpg, jpeg, JPG, JPEG, PNG",
			fileName:"branchfile",
			formData: {
				postdata : param,
			},
			dragDrop: true,
			showCancel: false,
			cancelStr: "Remove File",
			uploadStr: "Browse File ( " + types + " )",
			showDone: false,			
			showError: true,				
			showDelete: false,
			showAbort: false,
			extErrorStr: " Is not a valid file. Please upload the file with the following extension(s) - ",
			onSuccess:function(files,data,xhr,pd){
				showLoading("hide");
								
				//console.log(data);
				var _data  = JSON.parse(data);	
				if(_data.respcode=="1"){		
					$("#upload_response").html(_data.data);
				}else{
					alert(_data.message);					
				}
								
				uploadObj.reset();
				//$("#uploadbtn").prop("disabled", false);
			},
			onError: function(files,status,errMsg,pd){
				showLoading("hide");
				//$("#uploadbtn").addClass("disabled");
				alert("Something went wrong, please try again");
				uploadObj.reset();
				//$("#uploadbtn").prop("disabled", false);
				$("#uploadbtn").prop("disabled", true);
			},
			onSelect:function(files){
				/*setTimeout( function(){
				if($(".ajax-file-upload-error").text() === "") {
					if(files[0].type==="application/vnd.ms-excel" || files[0].type===""){					
					$(".response_message").html("Continue uploading " + files[0].name + "?. The system will proceed parsing the data, please confirm.");
					$("#response_modal__").modal("show");
						$(".message_modal_text_nc").html("");
					}else{
						_responseMsg("You have uploaded an invalid file. Please check and try again.");		
					uploadObj.reset();
					}
				}
				}, 100);*/
				//$("#uploadbtn").removeClass("disabled");
				uploadObj.reset();
				$("#uploadbtn").prop("disabled", false);
			},
			onSubmit:function(files){
				showLoading("show");
			},
			showProgress: true,
			autoSubmit: false,
			doneStr: "file successfully uploaded",	
			showStatusAfterSuccess: false,
			showFileCounter: false,
			showFileSize: false,
			showPreview: false,		
			sequential:false,
			sequentialCount:1
		});
						
		$("#uploadbtn").click( function(){				
			showLoading("show");
			uploadObj.startUpload();
			$(this).prop("disabled", true);
		});	

		$("#cancelupload").click( function(){
			uploadObj.reset();
		});
					
	}
	
	function uploadImage(_url, types, form){
		var postdata = $(form).serialize();
		$("#uploadbtn").prop("disabled", true);
		var uploadObj  = $("#imagefile").uploadFile({
			url: _url,
			headers: {
						'X-CSRF-Token' : $('[name="_csrfToken"]').val()
			},
			maxFileCount: 1,
			allowedTypes: types,
			//allowedTypes: "png, jpg, jpeg, JPG, JPEG, PNG",
			fileName:"imagefile",
			formData: {
				id 		: $("#d_id").val(),
				refid 	: $("#d_refid").val()
			},
			dragDrop: true,
			showCancel: false,
			cancelStr: "Remove File",
			uploadStr: "Browse File ( " + types + " )",
			showDone: false,			
			showError: true,				
			showDelete: false,
			showAbort: false,
			extErrorStr: " Is not a valid file. Please upload the file with the following extension(s) - ",
			onSuccess:function(files,data,xhr,pd){
				showLoading("hide");
								
				//console.log(data);
				var _data  = JSON.parse(data);	
				if(_data.respcode=="1"){		
					$("#upload_response").html(_data.data);
				}else{
					alert(_data.message);					
				}
								
				uploadObj.reset();
				//$("#uploadbtn").prop("disabled", false);
			},
			onError: function(files,status,errMsg,pd){
				showLoading("hide");
				//$("#uploadbtn").addClass("disabled");
				alert("Something went wrong, please try again");
				uploadObj.reset();
				$("#uploadbtn").prop("disabled", true);
				//$("#uploadbtn").prop("disabled", false);
			},
			onSelect:function(files){
				/*setTimeout( function(){
				if($(".ajax-file-upload-error").text() === "") {
					if(files[0].type==="application/vnd.ms-excel" || files[0].type===""){					
					$(".response_message").html("Continue uploading " + files[0].name + "?. The system will proceed parsing the data, please confirm.");
					$("#response_modal__").modal("show");
						$(".message_modal_text_nc").html("");
					}else{
						_responseMsg("You have uploaded an invalid file. Please check and try again.");		
					uploadObj.reset();
					}
				}
				}, 100);*/
				//$("#uploadbtn").removeClass("disabled");
				$("#uploadbtn").prop("disabled", false);
				uploadObj.reset();
			},
			onSubmit:function(files){
				showLoading("show");
			},
			showProgress: true,
			autoSubmit: false,
			doneStr: "file successfully uploaded",	
			showStatusAfterSuccess: false,
			showFileCounter: false,
			showFileSize: false,
			showPreview: true,		
			sequential:false,
			sequentialCount:1
		});
						
		$("#uploadbtn").click( function(){				
			showLoading("show");
			uploadObj.startUpload();
			$(this).prop("disabled", true);
		});	

		$("#cancelupload").click( function(){
			uploadObj.reset();
		});
					
	}
			