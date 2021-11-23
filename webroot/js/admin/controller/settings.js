
	$(document).on("hidden.bs.modal", "#form_content_sub", function(e){
		
		var table 		= $(".table").val(); 
		var controller 	= $(".controller").val(); 
		$("#" + table).DataTable().ajax.url(getTheWebroot()  + controller + "/indexajax").load();
		
	});
	
	
	$(document).on("click", ".modal_view", function(e){
		e.preventDefault();
		var url		 	= $(this).attr("href");
		var title    	= $(this).attr("title");
		var note    	= $(this).attr("note");
		var table	 	= $(this).attr("data-table");
		var controller 	= $(this).attr("data-controller");
						
				
		$(".modal-body").html("");
		showLoadingModal("show");
		$.get(url, function(resp){
			$(".modal-body").html(resp).promise().done( function(){
				
				showLoadingModal("hide");
				$(".modal-title").html(title);
				$(".modal-note").html(note);
			
				//var table = $(e.relatedTarget).data("table");
				//var controller = $(e.relatedTarget).data("controller");
				
				showIndexTable("#" + table, getTheWebroot()  +  controller + "/indexajax");
				$("#refresh_table").on("click", function(){	
					$("#" + table).DataTable().ajax.url(getTheWebroot()  + controller + "/indexajax").load();
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
				
				
				
				inputMasking();
				//getRegionList();
				getProvinceList();
				getCityList();
				getBarangayList();
				generateAddress();
				allowEdit("#settings_form");
				
				$(".table").val($(e.relatedTarget).data("table"));
				$(".controller").val($(e.relatedTarget).data("controller"));
				 
				//$("#default_form").on("submit", function(e){
				$("#btnsettings").on("click", function(e){	
					var _conf = confirm("You are about to submit the information. Please click OK to confirm.");
					
					if(_conf){
						
						var form	=  $(this).attr("form");
						var postdata = $(form).serialize();
						var url		 = $(this).attr("url"); //$("#default_form").attr("action");
						var action   = $(this).attr("action");
						
						$(this).prop("disabled", true);	
					
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
										$('#settings_form').trigger("reset");
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
								$("#btnsettings").prop("disabled", false);
								
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
	
