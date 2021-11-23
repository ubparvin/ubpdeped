	
	
	/*
	$(document).on("hidden.bs.modal", "#form_content_with_place", function(){
		
		$("#p_table").DataTable().ajax.url(getTheWebroot()  + "distributions/indexajax").load();
	});
	*/
	
	$(document).on("click", ".cancel_action", function(e){
		var _con = confirm("You are about to cancel the distribution. Please click OK to confirm");
		if(_con){
			
			
			var url = $(this).attr("href");
			showLoadingModal("show");
			$.get(url, function(resp){
				var resp = JSON.parse(resp);
				showLoadingModal("hide");
				alert(resp.msg);
				
			});
			
			e.preventDefault();
			
		}else{
			return false;
			e.preventDefault();
		}
	});
	
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
				$(".modal-title").html(title);
				$(".modal-note").html(note);
			
				inputMasking();
				getRegionList();
				getProvinceList();
				getCityList();
				getBarangayList();
				generateAddress();
				allowEdit("#product_form");
				itemQty();
				
				$("#receive_item").click( function(){
					var form	=  $(this).attr("form");
					var postdata = $(form).serialize();
					var url		 = $(this).attr("url"); //$("#default_form").attr("action");
					var action   = $(this).attr("action");
					
					var _conf = confirm("You are about to add quantity to the selected item. Please click OK to confirm");	
					if(_conf){
						showLoading("show");
						$.post(url, postdata, function(resp){
							var res = JSON.parse(resp);
							alert(res.msg);
							showLoading("hide");
						});
					}
				});
				
				
				$("#btnpro").on("click", function(e){	
					var _conf = confirm("You are about to submit the information. Please click OK to confirm.");
					
					if(_conf){
						
						var form	=  $(this).attr("form");
						var postdata = $(form).serialize();
						var url		 = $(this).attr("url"); //$("#default_form").attr("action");
						var action   = $(this).attr("action");
						
						$(this).prop("disabled", true);	
					
						//$("#form_content_with_place").modal("hide");
						
					
						$.ajax({
							url: url,
							data: postdata,
							type: "JSON",
							method: "post",
							beforeSend: function(){
								//$("#m_loading").modal("show");
								showLoading("show");
							},
							success:function(resp){
								var res = JSON.parse(resp);
								//console.log(res);
								
								if(res.resp=="1"){
									//$("#m_success").modal("show");
									//$(".m_resp").html(res.msg);
									//alert(res.msg);
									if(action=="new"){
										$('#product_form').trigger("reset");
									}
									//showLoading("hide");
								}
								//}else{
									//$("#m_error").modal("show");
									//$(".m_resp").html(res.msg);
									
									/*setTimeout( function(){
										$("#m_error").modal("hide");
										$("#form_content_with_place").modal("show");
									}, 1000);*/
									
									
								//}
								alert(res.msg);
								showLoading("hide");
								
							},
							error: function(e1, e2, e3){
								//$("#m_error").modal("show");
								alert("Unable to process your request at the moment. Please try again in a short while");
								showLoading("hide");
							},
							complete: function(){
								//$("#m_loading").modal("hide");
								$("#btnpro").prop("disabled", false);
								
							}
							
						});
					}else{
						e.preventDefault();
						return false;
					}
				});
				
			});
			
			
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
				
				getRegionList();
				
				
				$("#btnfilter").click( function(e){
					//var form	=  $(this).attr("form");
					//var postdata = $(form).serialize();
					//var url		 = $(this).attr("url"); //$("#default_form").attr("action");
					//var action   = $(this).attr("action");
					
					//date
					var d_from 		= $("#date_from").val();
					var d_to 		= $("#date_to").val();
					if(d_from==="" || d_from===undefined){ d_from = 0; }
					if(d_to==="" || d_to===undefined){ d_to = 0; }
					
					//status
					var status 		= $("#status").val();
					if(status==="" || status===undefined){ status = 0; }
					
					//school
					var school 		= $("#school").val();
					if(school==="" || school===undefined){ school = 0; }
					
					//place
					var region 		= $("#loc_region").val();
					var province 	= $("#loc_province").val();
					var city 		= $("#loc_city").val();
					var barangay 	= $("#loc_barangay").val();
					
					if((region==="" || region===undefined) || region===null){ region = 0; }
					if((province==="" || province===undefined) || province===null){ province = 0; }
					if((city==="" || city===undefined) || city===null){ city = 0; }
					if((barangay==="" || barangay===undefined) || barangay===null){ barangay = 0; }
					
					//filter type
					var filter_type 		= $("#filter_type").val();
					
					//items
					var category_id 		= $("#category_id").val();
					var tagging_id 			= $("#tagging_id").val();
					var vendor_id			= $("#vendor_id").val();
					var program_id 			= $("#program_id").val();
					var subcategory_id 		= $("#subcategory_id").val();
					
					if(category_id==="" || category_id===undefined){ category_id = 0; }
					if(tagging_id==="" || tagging_id===undefined){ tagging_id = 0; }
					if(vendor_id==="" || vendor_id===undefined){ vendor_id = 0; }
					if(program_id==="" || program_id===undefined){ program_id = 0; }
					if(subcategory_id==="" || subcategory_id===undefined){ subcategory_id = 0; }

					
					var url = "distributions/indexajax/filter/" + filter_type + "/" + program_id + "/" + category_id + "/" + vendor_id + "/" + tagging_id + "/" + subcategory_id + "/" + school + "/" + status + "/" + region + "/" + province +"/"+ city +"/"+ barangay +"/"+ d_from +"/"+ d_to;
					
					//console.log(getTheWebroot()  + url);
					$("#p_table").DataTable().ajax.url(getTheWebroot()  + url).load();
					
				});
				
			});
		});
									
	});
	
	$(document).on("click", ".view_details_vstat", function(e){
		var status = $(this).attr("status-id");
		var url = "distributions/indexajax/filter/status/0/0/0/0/0/0/" + status + "/0/0/0/0/0/0";
					
		//console.log(getTheWebroot()  + url);
		$("#p_table").DataTable().ajax.url(getTheWebroot()  + url).load();
					
	});
	

